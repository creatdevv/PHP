<?php
include 'db.php';

$idx = isset($_GET['idx']) ? intval($_GET['idx']) : 0;

$sql = "SELECT filename FROM freeboard WHERE idx = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$idx]);
$file = $stmt->fetch(PDO::FETCH_ASSOC);

if ($file && $file['filename']) {
    $filepath = 'uploads/' . $file['filename'];

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        readfile($filepath);
        exit;
    } else {
        echo "파일이 존재하지 않습니다.";
    }
} else {
    echo "잘못된 요청입니다.";
}
?>
