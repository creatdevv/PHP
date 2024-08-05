<?php
// 디렉토리(폴더) 파일 불러오기: dir() 함수 사용법

$dir_name = "./upload";
// if (is_dir($dir_name)) {
    $d = dir($dir_name);        // <생성>인스턴스 만들어 준다.

while (( $file_name = $d ->read()) !== false) {
    echo $file_name . "<br>";
}

    // echo "파일 목록:<br>";
    // while (($file_name = $d->read()) !== false) {    // <사용>
    //     echo $file_name . "<br>";
    // }

    $d->close();                // <닫기>

// } else {
//     echo "디렉토리를 찾을 수 없습니다.";
// }

// http://localhost/file_gallery/dir.php
?>
