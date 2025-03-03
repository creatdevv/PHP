<?php
// 데이터베이스 연결 파일 포함
include 'db.php';

/**
 * 데이터베이스 연결 확인 함수
 *
 * @return bool 연결 성공 여부
 */
function check_db_connection() {
    global $conn;

    try {
        if ($conn && $conn->query("SELECT 1")) {
            return true;
        }
    } catch (PDOException $e) {
        error_log("데이터베이스 연결 실패: " . $e->getMessage());
    }
    return false;
}

// 데이터베이스 연결 확인
if (!check_db_connection()) {
    die("데이터베이스 연결에 문제가 발생했습니다. 관리자에게 문의하세요.");
}

/**
 * 사용자 알림 생성 함수
 *
 * @param int $user_id 사용자 ID
 * @param string $message 알림 메시지
 * @return bool 성공 여부
 */
function notify_user($user_id, $message) {
    global $conn;

    // 입력값 유효성 검사
    if (!is_int($user_id) || $user_id <= 0) {
        error_log("유효하지 않은 사용자 ID: " . $user_id);
        return false;
    }

    if (empty($message) || strlen($message) > 255) {
        error_log("유효하지 않은 메시지 내용: " . $message);
        return false;
    }

    try {
        // 알림 삽입 SQL 작성 및 실행
        $sql = "INSERT INTO notifications (user_id, message, is_read) VALUES (:user_id, :message, 0)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindValue(':message', $message, PDO::PARAM_STR);
        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        error_log("알림 삽입 중 오류: " . $e->getMessage());
        return false;
    }
}

/**
 * 알림 상태 업데이트 함수
 *
 * @param int $notification_id 알림 ID
 * @param bool $is_read 읽음 상태
 * @return bool 성공 여부
 */
function update_notification_status($notification_id, $is_read) {
    global $conn;

    try {
        $sql = "UPDATE notifications SET is_read = :is_read WHERE id = :notification_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':notification_id', $notification_id, PDO::PARAM_INT);
        $stmt->bindValue(':is_read', $is_read ? 1 : 0, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    } catch (PDOException $e) {
        error_log("알림 상태 업데이트 중 오류: " . $e->getMessage());
        return false;
    }
}

/**
 * 알림 삭제 함수
 *
 * @param int $notification_id 알림 ID
 * @return bool 성공 여부
 */
function delete_notification($notification_id) {
    global $conn;

    try {
        $sql = "DELETE FROM notifications WHERE id = :notification_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':notification_id', $notification_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    } catch (PDOException $e) {
        error_log("알림 삭제 중 오류: " . $e->getMessage());
        return false;
    }
}

/**
 * 알림 로그 확인 함수
 * 알림 삽입 결과를 확인할 때 유용
 *
 * @param int $user_id 사용자 ID
 */
function log_notification($user_id) {
    global $conn;

    try {
        $sql = "SELECT * FROM notifications WHERE user_id = :user_id ORDER BY created_at DESC LIMIT 5";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "<h3>사용자 ID {$user_id}의 최근 알림</h3>";
        foreach ($notifications as $notification) {
            $status = $notification['is_read'] ? "읽음" : "읽지 않음";
            echo "<p>{$notification['message']} (상태: {$status}, 생성일: {$notification['created_at']})</p>";
        }
    } catch (PDOException $e) {
        error_log("알림 로그 조회 중 오류: " . $e->getMessage());
    }
}

// 테스트 데이터 삽입
$enable_test = true;

if ($enable_test) {
    $test_user_id = 1; // 테스트용 사용자 ID
    $test_message = "테스트 알림 메시지입니다.";

    echo "<h2>알림 테스트</h2>";
    if (notify_user($test_user_id, $test_message)) {
        echo "테스트 알림이 성공적으로 추가되었습니다.<br>";
        log_notification($test_user_id); // 최근 알림 로그 확인

        // 테스트: 알림 읽음 처리
        $notification_id = $conn->lastInsertId();
        if (update_notification_status($notification_id, true)) {
            echo "알림 ID {$notification_id}를 읽음 처리했습니다.<br>";
        }

        // 테스트: 알림 삭제
        if (delete_notification($notification_id)) {
            echo "알림 ID {$notification_id}를 삭제했습니다.<br>";
        }
    } else {
        echo "테스트 알림 추가 실패.<br>";
    }
}
?>
