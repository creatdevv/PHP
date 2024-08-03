<?php 
// 1. 읽기전용 파일열기 : r
$file = 'imsi.txt';     //만들어놓은 imsi.txt 파일열기(같은 경로기 때문에 따로 / 없이 입력)- 경로

// 에러처리 해주기
if (file_exists($file)) {        // 1) 먼저 파일이 있는지 존재여부 확인
 $pf = fopen($file, 'r');        // <열기> 파일 열건데 'r' : 읽기 모드로 열겠다. pf라는 변수 만들어서
  if($pf) {
   $fz = filesize($file);          // 읽기 전 파일 사이즈 알기
   $fr = fread($pf, $fz);        //<읽기>
    if($fr) {
     echo $fr;
      fclose($pf);        // <닫기> 열었으면 반드시 닫아줘야 함
} else {
    echo "파일 읽기에 실패했습니다.";
}
} else {
    echo "파일 열기에 실패했습니다.";
}
} else {                      // 2) 존재하지 않을때
    echo "존재하지 않는 파일입니다.";
}


// 2. 쓰기 전용 : w
$file = 'imsi1.txt';

$pf = fopen($file, 'w');        // <열기> 파일 열건데 'w' : 쓰기 모드로 열겠다.
fwrite($pf, PHP_EOL."Say Hello~");      // PHP_EOL : 파일에 줄바꿈 포함하여 쓰기
fwrite($pf, "\r\nSay, Hello~");         // PHP_EOL 과 동일(따옴표 안에서 동작!)

fclose($pf);

// 3. 읽기,쓰기 동시 사용 : a+ (이건 사용 잘 안한다.)



?>
