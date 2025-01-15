<?php
// 오류 보고 설정
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 디렉토리 경로 설정
$dir_name = "./upload";

// 디렉토리 존재 여부 확인
if (!is_dir($dir_name)) {
    die("디렉토리가 존재하지 않습니다. 경로를 확인하세요: $dir_name");
}

// 디렉토리 열기
$d = dir($dir_name);
if (!$d) {
    die("디렉토리를 열 수 없습니다: $dir_name");
}

// HTML 헤더 출력
echo "<!DOCTYPE html>
<html lang='ko'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>디렉토리 파일 목록</title>
    <style>
        img {
            margin: 10px;
            border: 1px solid #ccc;
            padding: 5px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>디렉토리의 파일 목록</h1>
    <div>";

// 디렉토리 내 파일 읽기
while (($file_name = $d->read()) !== false) {
    // '.' 및 '..' 무시
    if ($file_name === '.' || $file_name === '..') {
        continue;
    }

    // 파일 경로 생성
    $file_path = "$dir_name/$file_name";

    // 파일인지 확인
    if (is_file($file_path)) {
        // 파일 MIME 타입 확인
        $mime_type = mime_content_type($file_path);

        // 이미지만 표시 (image/png, image/jpeg 등)
        if (strpos($mime_type, 'image/') === 0) {
            echo "<img src='$file_path' alt='$file_name' width='100'><br>";
        } else {
            echo "<p>이미지가 아닌 파일: $file_name</p>";
        }
    }
}

// 디렉토리 닫기
$d->close();

// HTML 푸터 출력
echo "
    </div>
</body>
</html>";
?>
