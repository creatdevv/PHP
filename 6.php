<?php 
// #PHP Superglobal 

//1)
// print_r($_SERVER);      // 소스보기로 하면 배열 형태로 내 현재 서버 상태에 대해서 확인 가능!

//1-1)
// echo $_SERVER['PHP_SELF'];      // /6.php 출력

//2)*브라우저 정보 확인!!
// echo $_SERVER['HTTP_USER_AGENT'];   // *브라우저 정보, 데이터저장하는 곳 등등 확인

//3)
// $ag = $_SERVER['HTTP_USER_AGENT'];   // 크롬 유저시군요 출력

// if (strpos($ag, 'Chrome')) {
//     echo '크롬 유저시군요';
// } else {
//     echo '크롬 유저가 아니시군요';
// }

// 4)*아이피 주소 확인(방문자 확인) / 구독서비스 할때 사용하기(엄청 많이 사용됨)
echo "당신의 IP는 " . $_SERVER['REMOTE_ADDR'] . "입니다.";



?>

<!-- <a href="<?= $_SERVER['PHP_SELF'];?>?a=b">b값 가져오기</a> -->
