<?php 

// 1. 내장함수 (이미 예약 되어있는것)
// 2. 사용자 정의함수

// 1-1. 내장함수 예시
$money = 3000;

echo number_format($money). "<br>";  
// >> number_format이라는 함수를 사용해서 , 가 자동으로 해서 출력됨 : 3,000


// *사용자 정의함수 사용 공식*
// function 함수이름() {
//     echo "구문";
// }
// 함수이름();


// 2-1. 사용자 정의함수 (return 없는 경우) 예시
function getString() {
    echo "구문". "<br>";
}
getString();
// >> 구문 출력됨


// 2-2. 사용자 정의함수 (return 있는 경우) 예시
function getString2() {
    echo "구문2!";
    return 3;
}
    $a = getString2();

    echo $a;
// >> 구문2!3 출력됨


// 3-1. (매개변수0, 인자x) 예시
function addNumber($a, $b) {
    return $a + $b;
}
echo "<h2>" . addNumber(3,5) . "</h2>";  // >> 더한 값 8 출력됨, 이하 모두 더한값 차례로 출력값 확인
echo "<h2>" . addNumber(13,5) . "</h2>";
echo "<h2>" . addNumber(32,5) . "</h2>";
echo "<h2>" . addNumber(3,15) . "</h2>";
echo "<h2>" . addNumber(23,5) . "</h2>";


// 3-2. (매개변수0, 인자0, return0) 예시
function addNumber2(int $a, int $b) {
    return $a + $b;
}

$c = addNumber2(5, "4");     // >> 문자열도 숫자로 인식하여 9 출력됨
echo $c . "<br>";


// 3-3. (매개변수0, 인자0, return0 ) 동일 방식 값 예시
//declare(strict_type=1 );
function addNumber3(int $a, int $b) {
    //return $a + $b;

    return "Hello";
}

$c = addNumber3(5,14);
echo $c . "<br>";

// >> Hello 출력됨


?>