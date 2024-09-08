<?php 
// DB연결은 PDO방식으로~!!

$servername = "localhost";
$username = "root";
$password = "";     // 실제 MySQL root 계정 비밀번호를 입력하면, 정상적으로 성공되었다는 메세지 나옴!
$dbname = "kingchobo";  // 올바른 데이터베이스 이름


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "DB연결 성공";
} catch(PDOException $e) {
    echo $e->getMessage();
}
?>