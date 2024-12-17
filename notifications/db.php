<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=your_database_name", "your_username", "your_password");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("데이터베이스 연결 실패: " . $e->getMessage());
}
?>
