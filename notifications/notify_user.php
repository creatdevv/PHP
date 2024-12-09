<?php
include 'db.php';

// 데이터베이스 연결 확인
if (!$conn) {
    die("데이터베이스 연결 실패: " . $conn->errorInfo()[2]);
}
echo "데이터베이스 연결 성공!<br>";

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
    if (empty($user_id) || empty($message)) {
        echo "유효하지 않은 입력 값입니다.<br>";
        return false;
    }

    try {
        $sql = "INSERT INTO notifications (user_id, message) VALUES (:user_id, :message)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindValue(':message', $message, PDO::PARAM_STR);
        $stmt->execute();
        echo "알림이 성공적으로 추가되었습니다!<br>";
        return true;
    } catch (PDOException $e) {
        error_log("알림 삽입 중 오류: " . $e->getMessage());
        echo "알림 삽입 중 오류가 발생했습니다.<br>";
        return false;
    }
}

// 테스트용 데이터 삽입
try {
    $test_user_id = 1; // 테스트용 사용자 ID
    $test_message = "테스트 알림 메시지입니다.";
    notify_user($test_user_id, $test_message);
} catch (Exception $e) {
    echo "테스트 알림 삽입 중 오류: " . $e->getMessage();
}
?>
