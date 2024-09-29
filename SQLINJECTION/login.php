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

// var_dump($row);
if($row) {
    session_start();
    $_SESSION['id']=$id;
    echo "<script>self.location.href='/member.php';</script>";      // 로그인시, 넘어가는 페이지 만들어주기
} else {
    exit;
}

?>