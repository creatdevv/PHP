<?php 

// # 정수 필터: FILTER_VALIDATE_INT
// # 실수 필터: FILTER_VALIDATE_FLOAT
// # IP 필터: FILTER_VALIDATE_IP


// $i = 100;
// $i = 'a';        // 아무것도 출력 안됨
// $i = '33.333';         // 정수필터 x
//  $i = 'AJJJ-0-0';     // 실수필터 x
//  $i = 0;
// $ip = '127.0.0.1';
$ip = '127.0. 0.12';


// $j = filter_var($i, FILTER_VALIDATE_INT);
// $j = filter_var($i, FILTER_VALIDATE_FLOAT);
$j = filter_var($ip, FILTER_VALIDATE_IP);

// echo $j;            // 검증 확인완료(웹브라우저에서 100 출력됨- filter/1.php) / $I = 100; 일 경우에만 적용!


// if($j) {
// if(filter_var($i, FILTER_VALIDATE_INT) === 0 || !filter_var($i, FILTER_VALIDATE_INT) == false) {
if($j) {

    // echo $i. "는 제대로 된 정수입니다.";
    echo $ip. "는 제대로 된 ip입니다.";

} else {
    // echo $i. "는 제대로 된 정수가 아닙니다.";
    echo $ip. "는 제대로 된 ip가 아닙니다.";

}

?>