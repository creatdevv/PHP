<?php 

// *쿠키 만들기
setcookie("ck_name", "홍길동", time() +240, "/");
setcookie("ck_age", "100세", time() +240, "/");
// ㄴ 설명: setcookie 함수를 이용함, ck_name 변수(쿠키이름), 들어갈 내용(이름), 유효기간설정- 얼마동안 사용할지 (끝나는시간-240초동안만), /로 경로설정 
// ㄴ 웹브라우저: localhost/cookies/cookie.php     >> 내 이름은 홍길동 입니다. 출력
// $_COOKIE["ck_name]

?>
쿠키가 생성되었습니다 <br>
<a href="cookie.php">쿠키 확인</a>