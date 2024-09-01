<?php 
session_start();        // 1.php 처럼 똑같이 일단 session 시작해주는 함수 만들기

if(isset($_SESSION['ss_name'])) {
    echo "이름은 ". $_SESSION['ss_name'] .'입니다.<br>';

} else {
    echo "이름을 모르겠습니다.<br>"; 
}

if(isset($_SESSION['ss_age'])) {
    echo "나이는 ". $_SESSION['ss_age'] .'입니다.<br>';

} else {
    echo "나이를 모르겠습니다.<br>";
}

?>
<a href="3.php">세션 삭제</a>