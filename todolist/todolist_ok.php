<?php 

// print_r($_POST);   // post 방식으로 넘겼을때 주소값 표시 안되는지 결과값 확인 >> 정상적으로 넘어가고 페이지 내용에 표시 확인완료(제대로 받아진 것 확인!)

require "db.php";               //반드시 필요하다~!! (db.php 연결)

if($_POST['mode'] == "input") {

$subject = $_POST['subject'];
$sql = "INSERT INTO `todolist`(subject) VALUES(:subject)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':subject', $subject);
$rs = $stmt->execute();

// print_r($rs);

if($rs) {
    echo "
    <script>
    //alert('정상적으로 등록되었습니다.');
    self.location.href='./index.php';
    </script>
    ";
} else {
    echo "
    <script>
    alert('등록 과정에서 오류가 발생하였습니다.');
    history.go(-1);
    </script>
    ";
}

} else if($_POST['mode'] == 'done') {
    // print_r($_POST);
    $sql = "UPDATE `todolist` SET `status`=1 WHERE `idx`=:idx";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idx', $_POST['idx']);
    $stmt->execute();

    echo "
    <script>
        self.location.href='./index.php';
    </script>
    
    "


}
?>