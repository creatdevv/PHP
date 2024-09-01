<?php 

// 반복문(Loop): for문, foreach문

// 1. for 문 : (시작/초기값; 조건; 증감식) {}
// for($i = 1; $i < 10; $i++) {

//     echo "<h2>$i 출력</h2>";    // 조건식에 10보다 작은 $i 므로, 1출력~9출력 출력됨

// }


for($j = 1; $j < 10; $j = $j + 2) { //  $j += 2 와 동일하다

    echo "<h2>$j 출력</h2>";    // 증감 변경(10이하 홀수만 출력!), 1,3,5,7,9출력 출력됨

}

/* 2. foreach 문 
    - 배열
    - for of, for in
*/

// 예제1.
// $arr = array('사과', '바나나', '딸기', '오렌지');
$arr = ['사과1', '바나나1', '딸기1', '오렌지1'];

foreach($arr AS $fruit) {
    echo "<h2>$fruit</h2>";
}


// 예제2.
$arr = array (
    1 => "사과",
    2 => "배",
    3 => "딸기"
);

foreach($arr AS $key => $val) {
    echo "<h2>$val</h2>";

    echo "<h3>$arr[$key]</h3>";
}

// >> 각각 val, key 값으로 사이즈 변경되서 출력됨

?>