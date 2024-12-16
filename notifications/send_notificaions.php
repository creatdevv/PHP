<?php
include 'db.php';

/**
 * 데이터베이스 연결 확인
 *
 * @return void
 */
function check_db_connection() {
    global $conn;

    if (!$conn) {
        error_log("데이터베이스 연결 실패: " . $conn->errorInfo()[2]);
        die("데이터베이스 연결 실패: 관리자에게 문의하세요.");
    }
}

// 데이터베이스 연결 확인
check_db_connection();

/**
 * 사용자를 위한 알림 생성 함수
 *
 * @param int $user_id 사용자 ID
 * @param string $message 알림 메시지
 * @return bool 성공 여부
 */
function notify_user($user_id, $message) {
    global $conn;

    // 유효성 검사
    if (!is_int($user_id) || $user_id <= 0) {
        error_log("유효하지 않은 사용자 ID: " . $user_id);
        return false;
    }

    if (empty($message) || strlen($message) > 255) {
        error_log("유효하지 않은 메시지: " . $message);
        return false;
    }

    try {
        $sql = "INSERT INTO notifications (user_id, message) VALUES (:user_id, :message)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindValue(':message', $message, PDO::PARAM_STR);
        $stmt->execute();
        error_log("알림이 성공적으로 추가되었습니다: 사용자 ID $user_id");
        return true;
    } catch (PDOException $e) {
        error_log("알림 삽입 중 오류: " . $e->getMessage());
        return false;
    }
}

// 테스트 데이터 삽입 여부
$enable_test = true;

if ($enable_test) {
    try {
        $test_user_id = 1; // 테스트용 사용자 ID
        $test_message = "테스트 알림 메시지입니다.";
        if (notify_user($test_user_id, $test_message)) {
            echo "테스트 알림이 성공적으로 추가되었습니다.<br>";
        } else {
            echo "테스트 알림 추가 실패.<br>";
        }
    } catch (Exception $e) {
        error_log("테스트 알림 삽입 중 오류: " . $e->getMessage());
    }
}
?>
