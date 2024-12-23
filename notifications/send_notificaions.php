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
        error_log("데이터베이스 연결 실패: " . ($conn->errorInfo()[2] ?? '알 수 없는 오류'));
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
        error_log("유효하지 않은 사용자 ID: " . json_encode($user_id));
        return false;
    }

    if (empty($message) || strlen($message) > 255) {
        error_log("유효하지 않은 메시지: " . json_encode($message));
        return false;
    }

    try {
        $sql = "INSERT INTO notifications (user_id, message) VALUES (:user_id, :message)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindValue(':message', $message, PDO::PARAM_STR);
        $stmt->execute();
        error_log("알림이 성공적으로 추가되었습니다: 사용자 ID $user_id, 메시지: $message");
        return true;
    } catch (PDOException $e) {
        error_log("알림 삽입 중 오류: " . $e->getMessage());
        return false;
    }
}

/**
 * 사용자 그룹에 알림 보내기
 *
 * @param array $user_ids 사용자 ID 배열
 * @param string $message 알림 메시지
 * @return array 성공 및 실패 결과 배열
 */
function notify_users(array $user_ids, $message) {
    $results = [
        'success' => [],
        'failed' => []
    ];

    foreach ($user_ids as $user_id) {
        if (notify_user($user_id, $message)) {
            $results['success'][] = $user_id;
        } else {
            $results['failed'][] = $user_id;
        }
    }

    return $results;
}

// 테스트 데이터 삽입 여부
$enable_test = true;

if ($enable_test) {
    try {
        $test_user_ids = [1, 2, 3]; // 테스트용 사용자 ID 배열
        $test_message = "이것은 테스트 알림 메시지입니다.";

        echo "<h2>테스트 알림 발송 결과</h2>";
        $results = notify_users($test_user_ids, $test_message);

        echo "<h3>성공적으로 알림을 받은 사용자 ID:</h3>";
        echo "<ul>";
        foreach ($results['success'] as $success_id) {
            echo "<li>사용자 ID: $success_id</li>";
        }
        echo "</ul>";

        echo "<h3>알림 발송 실패 사용자 ID:</h3>";
        echo "<ul>";
        foreach ($results['failed'] as $failed_id) {
            echo "<li>사용자 ID: $failed_id</li>";
        }
        echo "</ul>";

    } catch (Exception $e) {
        error_log("테스트 알림 발송 중 오류: " . $e->getMessage());
        echo "테스트 알림 발송 중 오류가 발생했습니다.";
    }
}
?>
