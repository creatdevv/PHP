<?php 
include 'db.php';

$sql = "SELECT * FROM myguests";
$stmtt = $conn->prepare($sql);
$stmt->execute();           // 실행
$rs = $stmt->fetchAll();    // 가져오기

var_dump($rs);


?>