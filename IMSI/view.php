<?php 
include 'db.php';

$idx = $_GET["idx"];

$sql = "SELECT * FROM board WHERE idx={$idx}";
$stmt = $conn->prepare($sql);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$row = $stmt->fetch(PDO::FETCH_BOTH);       // Default 값
$row = $stmt->fetch(PDO::FETCH_NUM);       // 숫자로 보여주기


// pre : 나와있는 함수 그대로 출력하겠다.
echo "<pre>";
print_r($row);
echo "</pre>";


?>