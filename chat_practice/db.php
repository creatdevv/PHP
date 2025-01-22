<?php
$host = 'localhost'; // 데이터베이스 호스트
$dbname = 'chat_db'; // 데이터베이스 이름
$username = 'root';  // 사용자 이름
$password = '';      // 비밀번호

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("데이터베이스 연결 실패: " . $e->getMessage());
}
?>
