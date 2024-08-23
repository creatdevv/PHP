<?php 

// class Fruit {
//     public $name;
//     protected $color;
//     private $weight;

// }

// $mango = new Fruit();

// $mango->name = "Mango";
// $mango->color = "노랑색";        // protected라 접근 불가 (이 클래스 내에서만 접근 가능, 외부에서 직접 접근 불가)
// $mango->weight = '300';        // private라 접근 불가(이 클래스 내에서만 접근 가능, 외부와 상속받은 클래스도 접근 불가)

?>


<?php 
// # 가능케 만들기~!!
class Fruit {
    public $name;
    protected $color;
    private $weight;

    // Setter for color
    public function setColor($color) {
        $this->color = $color;
    }

    // Getter for color
    public function getColor() {
        return $this->color;
    }

    // Setter for weight
    public function setWeight($weight) {
        $this->weight = $weight;
    }

    // Getter for weight
    public function getWeight() {
        return $this->weight;
    }
}

$mango = new Fruit();

$mango->name = "Mango";        // public이므로 접근 가능
$mango->setColor("노랑색");    // setter 메서드를 통해 설정 가능
$mango->setWeight(300);        // setter 메서드를 통해 설정 가능

// 출력 확인
echo $mango->name;             // "Mango"
echo $mango->getColor();       // "노랑색"
echo $mango->getWeight();      // 300






?>