<?php 
// db 연결
require_once("db.php");

$user_id = $_GET["id"];
// echo $user_id;

$sql = "SELECT COUNT(*) cnt FROM member WHERE user_id". $user_id ."'";
$stmt = $conn->prepare($sql);
$stmt->execute();

$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$roow = $stmt->fetch();

// print_r($row);       >>확인용

$arr = array("result" => $row["cnt"] ? "exist" : "not_exist");
// $rs = $row["cnt"] ? "exist" : "not_exist";       >> 위와 같은 방식
// $arr = array("result"=> $rs);



?>

?>