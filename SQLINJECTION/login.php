<?php 

include 'db.php';

$id = $_POST['id'];
$pw = $_POST['pw'];

$sql = "SELECT * FROM member WHERE user_id='{$id}' AND passwd='{$pw}'";
echo $sql;

?>