<?php 

class Car {
    public $name;   // 자동차 이름
    public $color;   // 자동차 색상

    function __construct($name, $color)
    {
        $this->name = $name;
        $this->color = $color;

        echo "<p>자동차가 생산되었습니다.</p>";
        echo "<p>이름: $this->name";
        echo "색상: $this->color</p>";
    }

    function __destruct() {
        echo "<p>자동차 폐차가 되었습니다.</p>";
        echo "<p>차향등록말소사실증명서가 발급되었습니다.</p>";
    }

}
$volvo = new Car("볼보", "빨강");

// 소멸자가 먼저 실행되고, 마지막 아래가 실행되도록 만들기
Unset($volvo);

// 인위적으로 호출도 가능 (Unset 없으면 소멸자 전에 이게 중간에 실행된다.)
echo "<p>프로그램 실행중</p>"

?>