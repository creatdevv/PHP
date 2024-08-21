<?php

// $age = array("Peter" => 35, "Ben" => 37, "Joe" => 20);
$age = [
    "Peter" => 35, 
    "Ben" => 37, 
    "Joe" => 20
    ];

//PHP 연관배열 => JSON
// echo json_encode($age);

$json = '{"Peter":35, "Ben":37, "Joe":20 }';

// var_dump(json_decode($json));
$arr = json_decode($json);

echo $arr->Peter;           //>> 35 출력

?>