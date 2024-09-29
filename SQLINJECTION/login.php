<?php 

include 'db.php';

$id = $_POST['id'];
$pw = $_POST['pw'];

// $sql = "SELECT * FROM member WHERE user_id='{$id}' AND passwd='{$pw}'";
$sql = "SELECT * FROM member WHERE user_id=:user_id AND passwd=:pw";
// echo $sql;
$stmt = $conn->prepare($sql);

// 바인딩 해주기
$stmt->bindParam(':user_id', $id);
$stmt->bindParam(':pw', $pw);

$stmt->execute();
$row = $stmt->fetch();

var_dump($row);

?>