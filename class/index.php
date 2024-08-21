<?php 
// # PHP OOP 클래스 만들기

class Fruit {
    //Properties
    public $name;
    public $color;

    // Methods
    function set_name($name) {
        $this->name = $name;
    }

    function get_name() {
        return $this->name;
    }
}

$apple =  new Fruit();
$banana = new Fruit();
$apple->set_name('Apple');
$banana->set_name('Banana');

echo $apple->get_name();            // >> Apple 출력
echo "<br>";
echo $banana->get_name()            // >> Banana 출력

?>