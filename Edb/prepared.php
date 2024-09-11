<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kingchobo";

try {
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

    echo "<p>DB 연결에 성공했습니다.</p>";

} catch (PDOException $e) {
    echo $e->getMessage();
}

?>