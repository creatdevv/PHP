<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$file_path = "/Applications/XAMPP/xamppfiles/htdocs/a.txt";
$content = "Hello PHP";

if (file_put_contents($file_path, $content) !== false) {
    echo "파일이 성공적으로 생성되었습니다. 내용: " . file_get_contents($file_path);
} else {
    echo "파일 생성에 실패했습니다.";
}
?>