<?php 

// var_dump($_FILES);
// print_r($_FILES);

// echo "파일명은".$_FILES['utile']
// ['name'];
// echo "이고, ";
// echo "파일 용량은 ";
// echo $_FILES['ufile']['size'] .
// '입니다.';

// 1. 파일 업로드 경로 설정
// $tfile = './upload/abc.png';
// move_uploaded_file($FILES['ufile']['tmp_name'], $tfile);


// 2. readfile : 파일을 읽어와서 출력하는 함수
// readfile("a.txt");      // a.txt 를 불러와서 읽기
// echo __DIR__; // 현재 디렉토리의 절대 경로 출력(생성 안됨 확인) > create_file.php에 만들기

// // readfile("some.php");
// include "some.php";

$filepath = 'a.txt';
$filesize = filesize($filepath);    // 파일 사이즈 구하기
$filename = 'a.txt';

// 헤더 설정
header("Content-Type: applicaiton/octet-stream");
header("Content-Disposition: attachment; filename='$filenam'");  // 다운로드되는 파일의 이름을 지정
header("Content-Transfer-Encoding: binary");
header("Content-Length: $filesize");    // 파일 사이즈 명시

ob_clean();
flush();    // 버퍼 비우기
readfile($filepath);    // 파일 읽어서 출력하기


?>