<?php 

// # 정수 필터: FILTER_VALIDATE_INT
// # 실수 필터: FILTER_VALIDATE_FLOAT
// # IP 필터: FILTER_VALIDATE_IP
// # 이메일 필터 : FILTER_VALIDATE_EMAIL
// # URL 필터 : FILTER_VALIDATE_URL
// # 범위 내/외 확인
// # IPv6 주소 확인



// $i = 100;
// $i = 'a';        // 아무것도 출력 안됨
// $i = '33.333';         // 정수필터 x
//  $i = 'AJJJ-0-0';     // 실수필터 x
//  $i = 0;
// $ip = '127.0.0.1';           // ip필터
// $ip = '127.0. 0.12';
// $ip = 'aa.aa@bbbb.com';         // 이메일필터 - 공백은 제대로 된 이메일 아니지만, .이나 정상적인 모습으로 나올떄 제대로 된 이메일로 출력
// $ip = 'htps://daum./net';       // URL 필터 (패턴중의 Https는 무시됨. 다른 형식이 와도 규칙 맞음)



// $ip = trim($ip);

// *범위
// $int = 133;
// $min = 1;
// $max = 200;
// if(filter_var($int, FILTER_VALIDATE_INT, array("options" => array("min_range"=>$min, "max_range"=>$max))) === false) {
//     echo "범위를 벗어납니다";              // false 일 경우 (범위 지정만큼)
// } else {
//     echo "범위 안에 들어와 있습니다.";      // false 아닐 경우
// }


//*IPv6 주소
// $ip = "2001:0db8:85a3:08d3:1319:8a2e:0370:7334";
$ip = '127.0.0.1';

if(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) === false) {
    echo "잘못된 IPV6 입니다. ";
} else {
    echo " 정상적인 IPV6입니다.";
}




// $j = filter_var($i, FILTER_VALIDATE_INT);
// $j = filter_var($i, FILTER_VALIDATE_FLOAT);
// $j = filter_var($ip, FILTER_VALIDATE_URL);

// // echo $j;            // 검증 확인완료(웹브라우저에서 100 출력됨- filter/1.php) / $I = 100; 일 경우에만 적용!


// // if($j) {
// // if(filter_var($i, FILTER_VALIDATE_INT) === 0 || !filter_var($i, FILTER_VALIDATE_INT) == false) {
// if($j) {

//     // echo $i. "는 제대로 된 정수입니다.";
//     echo $ip. "는 제대로 된 URL 입니다.";

// } else {
//     // echo $i. "는 제대로 된 정수가 아닙니다.";
//     echo $ip. "는 제대로 된 URL이 아닙니다.";

// }

?>