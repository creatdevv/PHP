<?php 
$servername = "localhost";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "<p>Database에 연결했습니다.</p>";
} catch(PDOException $e) {
    echo $e->getMessage();
    exit;
}

try {
//  $sql = "CREATE DATABASE firstdb";       // phpMyAdmin에 firstdb 만들어 줄 것임
 $sql = "CREATE DATABASE firstdb1";       
//  $sql = "DROP DATABASE firstdb1";      
 $conn->exec($sql);                     // *DB 만들것을 실행 명령어(근데 실행 안될 수도 있으므로 또 try&catch문으로 잡아주기)

echo "<p>firstdb가 생성되었습니다.</p>";    // 정상적으로 작동시, try문 실행됨  

}catch(PDOException $e) {               // 에러발생시, catch문 실행됨
    echo $e->getMessage();
}

$conn = null;

?>