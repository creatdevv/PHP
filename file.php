<?php 

// 1. 읽기전용 파일열기
$file = 'imsi.txt';     //만들어놓은 imsi.txt 파일열기(같은 경로기 때문에 따로 / 없이 입력)
$pf = fopen($file, 'r');        // 파일 열건데 'r' : 읽기 모드로 열겠다. pf라는 변수 만들어서
$fz = filesize($file);      // 읽기 전 파일 사이즈 알기
$fr = fread($pf, $fz);

echo $fr;


?>
