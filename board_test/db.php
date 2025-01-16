<?php
$host = 'localhost';
$dbname = 'board';
$username = 'root'; // MySQL 사용자 이름
$password = ''; // MySQL 비밀번호

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("데이터베이스 연결 실패: " . $e->getMessage());
}
?>
