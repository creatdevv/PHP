<?php

// 세션 생성
session_start();

$_SESSION['ss_name']  = '홍길동';
$_SESSION['s_age']  = '14세'


// echo $_COOKIE['PHPSESSID']; 
// 세션에 아이디 부여해서 키로 사용할 수 있게 서버에 생성됨 (나머지 다 주석처리하고 이것만 해서 확인해보자!)


?>
세션이 생성되었습니다.
<a href="2.php">세션확인</a>