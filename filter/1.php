<?php 

// $i = 100;
// $i = 'a';        // 아무것도 출력 안됨
$i = '33.333';

$j = filter_var($i, FILTER_VALIDATE_INT);

// echo $j;            // 검증 확인완료(웹브라우저에서 100 출력됨- filter/1.php) / $I = 100; 일 경우에만 적용!

if($j) {
    echo $i. "는 제대로 된 정수입니다,.";
} else {
    echo $i. "는 제대로 된 정수가 아닙니다.";
}

?>