<?php 

class Car {
    // 프로퍼티 만들기
    private $count = 0;
    private $name;


    // 생성자 만들기
    function __construct($name) {
        $this->name = $name;

    }

    // 출력 탬플릿(순서))
    function message(){
        echo "<p>" .$this->name."가 생성되었습니다.</p>";
        echo "<p>[생성번호: " .$this->count."]</p>";
    }
}

// 각각 출력들 생성됨
$p1 = new Car('볼보');
$p1->message();

$p2 = new Car('아우디');
$p2->message();


?>