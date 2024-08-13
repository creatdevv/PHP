<?php 
// 쿠키에 대한 기본 설명!!
# 쿠키는 종종 사용자를 식별하는데 사용된다.
# 쿠키는 서버가 이용자의 컴퓨터를 저장하는 작은 파일이다
# 같은 컴퓨터가 브라우저로 페이지를 요청할 때마다 쿠키도 함께 보낸다
# PHP를 사용하면 쿠키 값을 만들고 검색할 수 있다



echo '이름은 : '. $_COOKIE['ck_name'] .'입니다.';      // >> 내 이름은: 홍길동 입니다 출력

// *쿠키 확인 (make.php와 연결)
if (isset($_COOKIE['ck_name'])) {
    echo '이름은: ' . $_COOKIE['ck_name'] .'입니다.<br>';
} else {
    echo '이름을 모르겠습니다.<br>';
}
if (isset($_COOKIE['ck_age'])) {
    echo '나이는: ' . $_COOKIE['ck_age'] .'입니다.<br>';
} else {
    echo '나이를 모르겠습니다.';
}

?>
<br>
<!-- <a href="delete.php">쿠키 지우기</a> -->
 <a href="cookie.php">쿠키 확인</a>