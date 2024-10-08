<?php 

class Car {
    // #프로퍼티 만들기
    private static $count = 0;
    private static $carList = [];
    // public static $count = 0;       // *public으로 하고, 아래 echo Car::$count;로 직접적으로도 만들 수 있음
    private $name;
    

    // #생성자 만들기 - 메소드로
    function __construct($name) {
        $this->name = $name;
        self::$count = self::$count + 1; // 위에 static 정적 만들어주고, self:: 만들어서, 순서대로 1씩 자동으로 증가 생산번호 지정 만들어줌
        array_push(self::$carList, $name);
    }

    // #출력 탬플릿(순서))
    function message(){
        echo "<p>" .$this->name."가 생성되었습니다.</p>";

        // echo "<p>[생성번호: " .$this->count."]</p>";
        echo "<p>[생성번호: " .self::$count."]</p>";        // 출력 증가

    }

    static function getCarList(){
        return self::$carList;
    } 
}

// *public - 직접적으로 만들기
// echo Car::$count;       // >> 맨위 0으로 찍힘 


// 각각 출력들 생성됨
$p1 = new Car('볼보');
$p1->message();

$p2 = new Car('아우디');
$p2->message();

$p3 = new Car('페라리');
$p3->message();

// *public - 직접적으로 만들기
// echo Car::$count;  // >> 맨 아래 3으로 찍힘

$a = implode(',', Car::getCarList());
echo "<p>". $a."</p>";      // >> 볼보,아우디,페라리 출력

?>