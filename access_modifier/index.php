<?php 

class Fruit {
    public $name;
    protected $color;
    private $weight;

}

$mango = new Fruit();

$mango->name = "Mango";
// $mango->color = "노랑색";        // protected라 접근 불가 (이 클래스 내에서만 접근 가능, 외부에서 직접 접근 불가)
// $mango->weight = '300';        // private라 접근 불가(이 클래스 내에서만 접근 가능, 외부와 상속받은 클래스도 접근 불가)

?>