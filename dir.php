<?php
// # 디렉토리(폴더) 파일 불러오기: dir() 함수 사용법

$dir_name = "./upload";
// if (is_dir($dir_name)) {
    $d = dir($dir_name);        // <생성>인스턴스 만들어 준다.

while (( $file_name = $d ->read()) !== false) {
    if($file_name == '.'  or $file_name=='..'){
        continue;
    }

    // echo $file_name . "<br>";

    // 이미지를 HTML로 출력
    // echo '<img src="upload/'.$file_name.'" width="100">';        // 이미지 업로드(3가지 방법)
    // echo"<img src='upload/{$file_name}' width='100>";
    ?>
    <img src='upload/<?php echo $file_name; ?>' width='100'><br>
    <?php
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
