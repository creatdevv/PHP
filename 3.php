
<?php 

// PHP 비교 연산자

$a = 10;
$b = 11;

var_dump($a != $b);    // 이것까지 입력했을떄, bool(true)까지 확인되어 출력

if($a != $b) {         // 조건 만족시키는 true 므로, 앞의 같지 않다 출력
    echo "a와 b는 같지 않다";

} else {
    echo "a와 b는 같다.";
}



?>
