<?php
include 'db.php';

function log_activity($user_id, $action, $page) {
    global $conn;
    
    $ip_address = $_SERVER['REMOTE_ADDR']; // 사용자의 IP 주소 가져오기
    
    try {
        $sql = "INSERT INTO user_logs (user_id, action, page, ip_address) VALUES (:user_id, :action, :page, :ip_address)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindValue(':action', $action, PDO::PARAM_STR);
        $stmt->bindValue(':page', $page, PDO::PARAM_STR);
        $stmt->bindValue(':ip_address', $ip_address, PDO::PARAM_STR);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error logging activity: " . $e->getMessage();
    }
}
?>

<!-- 데이터베이스 테이블 생성
CREATE TABLE user_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    action VARCHAR(255) NOT NULL,
    page VARCHAR(255) NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ip_address VARCHAR(50)
);
 
-->