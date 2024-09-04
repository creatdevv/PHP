<?php 
// php 설치 정보 확인 (+ PDO 설치되어있는지 확인)
phpinfo();
exit;

// DB와 연동하기 (MySQL): MySQLi OOP
$servername = "localhost";
$username = "root";
$password = "";

// $conn = new mysqli($servername, $username, $password);               // 1번째 방법
// $conn = mysqli_connect($servername, $username, $password);           // 2번째 방법
$conn = new PDO("mysql:host=$servername", $username, $password);        // try&catch 사용

//1-1
// if ($conn->connect_error) {
    // echo "DB 연결에 실패했습니다.";
    // exit;

//2-1
// if (!$conn) {
//     die("DB 연결에 실패했습니다.");
// }

// echo "DB 연결에 성공했습니다.";


//3-1
try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    echo "DB 연결 성공했습니다.";
} catch (PDOException $e) {
    echo "DB 연결 실패했습니다.";
}

?>
