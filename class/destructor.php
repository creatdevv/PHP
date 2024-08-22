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

?>