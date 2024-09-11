<?php 

include "db.php";

print_r($_FILES);
// fgetcsv()    : csv에서 파일 불러오기

// $arr = [];      //배열

$file = fopen($_FILES['csv']['tmp_name'], 'r');

$conn->beginTransaction();      //-데이터 많을때, 한꺼번에 한번에 밀어넣기!
while(($line = fgetcsv($file)) !== FALSE) {
    // array_push($arr, $line);

    $sql = "INSERT INTO csvmember(cs_name, cs_email) VALUES('". $line[0]."',
    '". $line[1] ."');";

    // echo $sql;
    // exit;

    $conn->exec($sql);      // db에서 conn 의 이름으로 연결했었기 때문이고(setAttribute~), 다른 이름으로 바꿔서 할 수도 있다.

}

$conn->commit();        //-데이터많을떄, 한꺼번에 밀어넣기!

fclose($file);      // 열었으면, 반드시 닫아주기

// print_r($arr);      // *출력문으로 확인해보기 
// >> member.php에 있는 목록들 배열로 0~4 나오고, 세부정보도 다시 0,1로 해서 나눠져서 순서대로 출력됨 확인됨

$conn = null;    // 한번 실행 끝나면, 초기화 해줘야하니깐~~


?>