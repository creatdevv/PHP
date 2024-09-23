<?php 

// print_r($FILES["photo"]);
// print_r($FILES);                 // 결과 확인

// #파일 1개 업로드 넘어오는거 받기
// copy($_FILES['photo']['tmp_name'], "upload/" . $_FILES['photo']['name']);
// $arr = array("resulr" => "success", "img" => "upload/". $_FILES['photo']['name']);
// die(json_encode($arr));

// #파일 여러개 업로드 넘어보낼때
if(is_array($_FILES['photo']['tmp_name'])) {

    $cnt = count($_FILES['photo']['name']);
    $rs_arr = [];               // = $rs_arr = arrray; (배열로 만든이유는 이미지를 한꺼번에 여러개 넘겨주기 위해서)
    for ($i = 0; $i < $cnt; $i++) {
        copy($_FILES['photo']['tmp_name'][$i], "upload/" .$_FILES['photo']['name']);
        $rs_arr[] = "upload/". $_FILES['photo']['name'][$i];
    }

    $arr = array("result" => "success", "img" => implode('|', $rs_arr));

    // upload/1.png|upload/2.png

    die(json_encode($arr));             // = {"result": "success", "img" : "upload/1.png|upload/2.png"}   >>개발자도구에 이런식으로 결과 생성될 것임
    

} else {
    copy($_FILES['photo']['tmp_name'], "upload/" . $_FILES['photo']['name']);
    $arr = array("result" => "success", "img" => "upload/". $_FILES['photo']['name']);
    die(json_encode($arr));
}

?>
