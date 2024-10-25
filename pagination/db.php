<?php 
$servername = "localhost";
$username = "root";
$password = ""; // 비밀번호 추가
$dbname = "kingchobo";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // DB 연결이 성공한 경우 메시지를 표시하지 않음
} catch (PDOException $e) {
    // 오류 메시지를 파일에 기록
    error_log("Connection failed: " . $e->getMessage(), 3, "/path/to/error_log.log");
    exit("Database connection error. Please try again later."); // 사용자에게 보안상 간단한 메시지 표시
}
?>
