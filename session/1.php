<?php

// 세션 생성
session_start();

$_SESSION['ss_name']  = '홍길동';
$_SESSION['s_age']  = '14세'

?>
세션이 생성되었습니다.
<a href="2.php">세션확인</a>