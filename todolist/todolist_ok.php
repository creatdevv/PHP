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

//#취소선
} else if($_POST['mode'] == 'done') {
    $idx = $_POST['idx'];
    do_undo($idx, 1);
    // print_r($_POST);
 
    // $sql = "UPDATE `todolist` SET `status`=1 WHERE `idx`=:idx";
    // $stmt = $conn->prepare($sql);
    // $stmt->bindParam(':idx', $_POST['idx']);
    // $stmt->execute();

    // echo "
    // <script>
    //     self.location.href='./index.php';
    // </script>
    // ";
}

//#취소선을 취소
else if($_POST['mode'] == 'undone') {
    $idx = $_POST['idx'];
    do_undo($idx, 0);
    // print_r($_POST);

    // $sql = "UPDATE `todolist` SET `status`=0 WHERE `idx`=:idx";
    // $stmt = $conn->prepare($sql);
    // $stmt->bindParam(':idx', $_POST['idx']);
    // $stmt->execute();

    // echo "
    // <script>
    //     self.location.href='./index.php';
    // </script>
    // ";
}

//#삭제 기능
else if($_POST['mode'] == 'del') {
    $sql = "DELETE FROM `todolist` WHERE `idx`=:idx";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idx', $_POST['idx']);
    $stmt->execute();

    echo "
    <script>
        self.location.href='./index.php';
    </script>
    
    ";
}  

//#취소선,취소선을 취소 간단히(한번에)
function do_undo($idx, $status) {
    global $conn;               // global : 외부에 있는 변수를 쓰겠다~~

    $sql = "UPDATE `todolist` SET `status`=:status WHERE `idx`=:idx";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idx',$idx);
    $stmt->bindParam(':status', $status);
    $stmt->execute();

    echo "
    <script>
        self.location.href='./index.php';
    </script>
    
    ";
}




?>