<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$file_path = "/Applications/XAMPP/xamppfiles/htdocs/a.txt";
$content = "이것은 a.txt 파일의 내용입니다.";

if (file_put_contents($file_path, $content) !== false) {
    echo "파일이 성공적으로 생성되었습니다: $file_path";
} else {
    echo "파일 생성에 실패했습니다.";
}
?>
