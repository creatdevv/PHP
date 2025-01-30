<?php
include 'db.php';

$uploadDir = 'uploads/';
$allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
$maxFileSize = 2 * 1024 * 1024; // 2MB

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $file = $_FILES['image'];

    // 파일 크기 검사
    if ($file['size'] > $maxFileSize) {
        echo json_encode(['success' => false, 'message' => '파일 크기가 2MB를 초과합니다.']);
        exit;
    }

    // MIME 유형 검사
    if (!in_array($file['type'], $allowedTypes)) {
        echo json_encode(['success' => false, 'message' => '허용되지 않은 파일 형식입니다.']);
        exit;
    }

    // 파일명 난수화
    $fileExt = pathinfo($file['name'], PATHINFO_EXTENSION);
    $newFileName = uniqid('img_', true) . '.' . $fileExt;
    $filePath = $uploadDir . $newFileName;

    // 파일 이동
    if (move_uploaded_file($file['tmp_name'], $filePath)) {
        echo json_encode(['success' => true, 'url' => $filePath]);
    } else {
        echo json_encode(['success' => false, 'message' => '파일 업로드 실패']);
    }
} else {
    echo json_encode(['success' => false, 'message' => '잘못된 요청']);
}
?>
