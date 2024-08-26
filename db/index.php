<?php 
// DB와 연동하기 (MySQL): MySQLi OOP
$servername = "localhost";
$username = "root";
$password = "";

// $conn = new mysqli($servername, $username, $password);
$conn = mysqli_connect($servername, $username, $password);

// if ($conn->connect_error) {
    // echo "DB 연결에 실패했습니다.";
    // exit;
if (!$conn) {
    die("DB 연결에 실패했습니다.");
}

echo "DB 연결에 성공했습니다.";

?>
