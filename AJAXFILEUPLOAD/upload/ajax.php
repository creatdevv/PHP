<?php 

// print_r($FILES["photo"]);
// print_r($FILES);

copy($_FILES['photo']['tmp_name'], "upload/" . $_FILES['photo']['name']);


$arr = array("resulr" => "success", "img" => "upload/". $_FILES['photo']['name']);

die(json_encode($arr));

?>
