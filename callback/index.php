<?php 

function my_callback($item) {
    return strlen($item);
}

$strings = ["apple", "orange", "pear", "pineapple"];

$lengths = array_map("my_callback", $strings);  
// array_map 함수를 사용하면, ()안에 있는 것을 사용하는데 위에 있는[]배열의 횟수 만큼 호출해서 담아주는 것이다.
// 1) 사용자 내장함수(array_map))에서 사용하는 콜백함수 알아봄 : 글자수 대로 출력되므로 [0~3] => 5,6,4,9 차례로 출력됨
// 2) 직접 사용자 정의함수를 만들어서 사용하는 법 : 1.php 파일 참고!!

print_r($lengths);

?>