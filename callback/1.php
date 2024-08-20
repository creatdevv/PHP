<?php 
// 2) 직접 사용자 정의함수를 만들어서 사용


// function exclaim($str) {        // 문자열 1개만 출력할 수 있는 형태로
//     return $str ."!";           // 문자열 1개만 출력할 수 있는 형태로
    function exclaim($name, $str) {        // 2개 조건 함수 출력할 수 있는 형태로
        return $name . "님,". $str ."! <br>" ;  
}

function ask($name, $str) {
    return $name ."님,". $str . "?<br>";
}

function printFormatted($name, $str, $format) {
    echo $format($name, $str);
}

// *호출
printFormatted("톰", "안녕하세요", "exclaim");        // >> 톰님, 안녕하세요! 출력
printFormatted("브라이언", "어디가세요", "ask");       // >> 브라이언님, 어디가세요? 출력
  

?>
