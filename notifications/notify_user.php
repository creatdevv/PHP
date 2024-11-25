<?php
include 'db.php';

function notify_user($user_id, $message) {
    global $conn;
    $sql = "INSERT INTO notifications (user_id, message) VALUES (:user_id, :message)";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindValue(':message', $message, PDO::PARAM_STR);
    $stmt->execute();
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
