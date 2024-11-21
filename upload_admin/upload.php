<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $upload_dir = 'uploads/'; // 업로드 폴더
    $filename = basename($_FILES['file']['name']);
    $filepath = $upload_dir . $filename;

    // 파일 저장
    if (move_uploaded_file($_FILES['file']['tmp_name'], $filepath)) {
        // DB에 파일 정보 저장
        $sql = "INSERT INTO uploads (filename, filepath) VALUES (:filename, :filepath)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':filename' => $filename,
            ':filepath' => $filepath
        ]);
        echo "파일이 업로드되었습니다.";
    } else {
        echo "파일 업로드에 실패했습니다.";
    }
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>파일 업로드</title>
</head>
<body>
    <h1>파일 업로드</h1>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="file" required>
        <button type="submit">업로드</button>
    </form>
</body>
</html>

<!-- # sql 테이블 생성 미리 만들기 
 CREATE TABLE uploads (
    id INT AUTO_INCREMENT PRIMARY KEY,
    filename VARCHAR(255) NOT NULL,
    filepath VARCHAR(255) NOT NULL,
    uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-->
