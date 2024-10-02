<?php 

include "db.php";

// print_r($_POST);        // 로그인시 정보 넘어오는지 확인~~

$id = $_POST['id'];
$pwd = $_POST['pwd'];

$sql = "SELECT * FROM member WHERE user_id=:user_id AND passwd=pw";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':user_id', $id);
$stmt->bindParam(':pw', $pw);
$stmt->execute();
$row = $stmt->fetch();

if($row) {
    session_start();
    $_SESSION['id'] = $id;

    $arr = ['result' => 'success'];
    die(json_encode($arr));

} else {
    $arr = ['result' => 'fail'];
    die(json_encode($arr));
}

?>