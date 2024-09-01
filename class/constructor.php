<?php 

class Fruit {
    public $name;
    public $color;

    // 생성자 constructor
    function __construct($name, $color = "unknown") {
        $this->name = $name;
        $this->color = $color;  
    }

    function get_name() {
        return $this->name;
    }

    function get_color() {
        return $this->color;
    }
}

$apple = new Fruit("사과");      // "사과"와 기본값 "unknown"
$banana = new Fruit("바나나", "노랑"); // "바나나"와 "노랑" (unknown이 없으면 2개 매개변수니깐 2개 써야 오류안난다.)

// echo $apple->get_name();  // "사과" 출력
// echo $banana->get_color(); // "노랑" 출력
echo "이 과일의 이름은". $apple->get_name();
echo "이고 색깔은 ". $apple->get_color(); 
echo "입니다.<br>";

echo "이 과일의 이름은". $banana->get_name();
echo "이고 색깔은 ". $banana->get_color(); 
echo "입니다.<br>";

?>
