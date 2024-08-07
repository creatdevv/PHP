<?php
// 디렉토리(폴더) 파일 불러오기: dir() 함수 사용법

$dir_name = "./upload";
$d = dir($dir_name);        // <생성>인스턴스 만들어 준다.

while (($file_name = $d->read()) !== false) {
    if($file_name == '.' or $file_name == '..'){
        continue;
    }
    echo "<img src='upload/$file_name' width='100'><br>";
}

$d->close(); // <닫기>
?>

