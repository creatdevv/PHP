
<?php 

// 1. 논리 연산자
// and, or, xor, &&, ||, !

$x = true;
$y = true;
var_dump(!$x);

// 논리 곱(둘다 true 여야 한다. 둘 중 하나라도 false 되면, false 나옴) : and, &&
var_dump($x and $y);   // 1 * 1 = 1
var_dump($x && $y);   // 1 * 1 = 1 같은 방식

// 논리 합(둘 중 하나만 true여도 true 이다.) : or, ||
var_dump($x or $y);
var_dump($x || $y);

// xor (둘다 한쌍이 같은 것으로 따라감. 하나라도 다르면 false)
var_dump($x xor $y);

// 2. 문자열 연산자
// . .=  (concat같은 의미, 현재 변수에 문자열 추가하여 연결한다.)
$a = "hello";
$a .= "world";
// $a = $a. "world";

echo $a;
// helloworld 출력

?>
