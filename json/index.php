<?php

// $age = array("Peter" => 35, "Ben" => 37, "Joe" => 20);
$age = [
    "Peter" => 35, 
    "Ben" => 37, 
    "Joe" => 20
    ];

//PHP 연관배열 => JSON
// echo json_encode($age);      // Peter~Joe 차례로 출력



// var_dump(json_decode($json));
// $arr = json_decode($json);

// $json = '{"Peter":35, "Ben":37, "Joe":20 }';
// $obj = json_decode($json, false);
// echo $arr->Peter;           

$json = '{"Peter":35, "Ben":37, "Joe":20 }';
$obj = json_decode($json, true);
// $arr = json_decode($json, true);         // >> NULL 출력

var_dump($obj);      
// array 형태로 출력됨 >> array(3) { ["Peter"]=> int(35) ["Ben"]=> int(37) ["Joe"]=> int(20) } 출력



?>