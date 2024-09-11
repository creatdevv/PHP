<?php 

include "db.php";

print_r($_FILES);
// fgetcsv()    : csv에서 파일 불러오기

// $arr = [];      //배열

$file = fopen($_FILES['csv']['tmp_name'], 'r');
while(($line = fgetcsv($file)) !== FALSE) {
    // array_push($arr, $line);

    $sql = "INSERT INTO csvmember(cs_name, cs_email) VALUES('". $line[0]."',
    '". $line[1] ."');";

    echo $sql;
    exit;

}

fclose($file);      // 열었으면, 반드시 닫아주기

print_r($arr);      // 출력문으로 확인해보기 
// >> member.php에 있는 목록들 배열로 0~4 나오고, 세부정보도 다시 0,1로 해서 나눠져서 순서대로 출력됨 확인됨



?>