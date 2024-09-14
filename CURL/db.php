<?php 
$servername = "localhost";
$username = "root";
$password = ""; // MySQL 비밀번호
$dbname = "kingchobo"; // 데이터베이스 이름

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

    // 데이터베이스 연결 확인
    echo "<p>DB 연결에 성공했습니다.</p>";

    // 예를 들어 csvmember 테이블의 데이터 가져오기
    $stmt = $conn->query("SELECT * FROM csvmember");
    $results = $stmt->fetchAll();
    
    foreach ($results as $row) {
        echo "Name: " . $row['cs_name'] . " - Email: " . $row['cs_email'] . "<br>";
    }
} catch (PDOException $e) {
    echo "<p>DB 연결 실패: " . $e->getMessage() . "</p>";
}
?>
