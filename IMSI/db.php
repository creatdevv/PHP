<?php 
// DB연결은 PDO방식으로~!
$dsn = 'mysql:host=localhost;dbname=your_database_name';
// $servername = "localhost";
$username = "root";
$password = "";     // 실제 MySQL root 계정 비밀번호를 입력하면, 정상적으로 성공되었다는 메세지 나옴!
// $dbname = "kingchobo";  // 데이터베이스 이름


// try {
//     $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     echo "DB연결 성공";
// } catch(PDOException $e) {
//     echo $e->getMessage();
//     exit;
// }

try {
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully"; // This line is for testing
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

phpinfo();

?>