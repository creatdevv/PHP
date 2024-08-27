<?php 
$servername = "localhost";
$username = "root";
$password = "";

try {
    // #DB에 연동할 연결개체 만들기($conn)
    $conn = new PDO("mysql:host=$servername", $username, $password);    // 연결하기
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);     //에러시 메세지 보일 수 있게

    echo "<p>Database에 연결했습니다.</p>";

} catch(PDOException $e) {
    echo $e->getMessage();
    exit;
}


try {
//  $sql = "CREATE DATABASE firstdb";       // [생성] phpMyAdmin에 firstdb 만들어 줄 것임
//  $sql = "CREATE DATABASE firstdb1";
// $sql = "DROP DATABASE firstdb1";        // [삭제]   
// $sql = "DROP DATABASE aaa";          

 $dbname ="aaa";            //데이터베이스 이름 꼭 집어서 삭제요청시도        
  $sql = "DROP DATABASE ". $dbname;

 $conn->exec($sql);                     // *DB 생성/삭제 등 실행 명령어(근데 실행 안될 수도 있으므로 또 try&catch문으로 잡아주기)

// echo "<p>firstdb가 생성되었습니다.</p>";    // 정상적으로 작동시, try문 실행됨  
echo "<p>" .$dbname."가 삭제 되었습니다.</p>";  

}catch(PDOException $e) {               // 에러발생시, catch문 실행됨
    echo $e->getMessage();
}

$conn = null;

?>