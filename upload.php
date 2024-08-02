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
readfile("a.txt");      // a.txt 를 불러와서 읽기
echo __DIR__; // 현재 디렉토리의 절대 경로 출력(생성 안됨 확인) > create_file.php에 만들기


?>