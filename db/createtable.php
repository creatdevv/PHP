<?php 
$servername = "localhost";
$username = "root";
$password = "";

// *DB 연결
try {
    $conn = new PDO("mysql:host=$servername;dbname=abc", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<p>DB 연결에 성공했습니다.</p>";
}catch(PDOException $e) {
    echo $e->getMessage();
    exit;
}

// *DB 생성
// $sql = "CREATE DATABASE 생성할데이터베이스이름";
// $conn->exec($sql);


// *테이블 생성 (+테이블 구조)
try {
$sql = "CREATE TABLE MyGuests (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
email VARCHAR(50),
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE
CURRENT_TIMESTAMP
)";

$conn->exec($sql);          // 쿼리문($sql)에 담아서 실행하겠다~~!!
echo "<p>테이블이 생성되었습니다.</p>";

} catch(PDOException $e) {
    echo $e->getMessage();
}

$conn = null;

?>