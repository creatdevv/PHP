<?php
include 'db.php';

// 데이터베이스 연결 확인
if ($conn) {
    echo "데이터베이스 연결 성공!<br>";
} else {
    die("데이터베이스 연결 실패!");
}

function notify_user($user_id, $message) {
    global $conn;
    $sql = "INSERT INTO notifications (user_id, message) VALUES (:user_id, :message)";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindValue(':message', $message, PDO::PARAM_STR);
    $stmt->execute();
    echo "알림이 성공적으로 추가되었습니다!<br>";
}

// 테스트용 데이터 삽입
try {
    notify_user(1, "테스트 알림 메시지");
} catch (PDOException $e) {
    echo "알림 삽입 중 오류: " . $e->getMessage();
}
?>


<!-- # 데이터베이스 테이블 미리 생성 
CREATE TABLE notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    message TEXT NOT NULL,
    is_read TINYINT(1) DEFAULT 0, -- 0: 읽지 않음, 1: 읽음
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
 -->
