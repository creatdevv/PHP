<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $subject = $_POST['subject'] ?? '';
    $content = $_POST['content'] ?? '';
    $author = $_POST['author'] ?? '';
    $filename = '';

    try {
        // 파일 업로드 로직 추가
        if (isset($_FILES['upload_file']) && $_FILES['upload_file']['error'] == UPLOAD_ERR_OK) {
            $upload_dir = 'uploads/';
            $original_filename = basename($_FILES['upload_file']['name']);
            $file_ext = pathinfo($original_filename, PATHINFO_EXTENSION);

            // 허용된 파일 확장자 검사
            $allowed_extensions = ['jpg', 'png', 'gif', 'pdf', 'txt'];
            if (!in_array(strtolower($file_ext), $allowed_extensions)) {
                throw new Exception("허용되지 않는 파일 형식입니다.");
            }

            // 고유한 파일명 생성 및 파일 저장
            $filename = uniqid() . '.' . $file_ext;
            $filepath = $upload_dir . $filename;
            if (!move_uploaded_file($_FILES['upload_file']['tmp_name'], $filepath)) {
                throw new Exception("파일 업로드에 실패했습니다.");
            }
        }

        // 게시물 삽입
        $sql = "INSERT INTO freeboard (subject, content, author, rdate, filename) VALUES (:subject, :content, :author, NOW(), :filename)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':subject', $subject, PDO::PARAM_STR);
        $stmt->bindValue(':content', $content, PDO::PARAM_STR);
        $stmt->bindValue(':author', $author, PDO::PARAM_STR);
        $stmt->bindValue(':filename', $filename, PDO::PARAM_STR);
        $stmt->execute();

        header("Location: 001.php");
        exit;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>글쓰기</title>
</head>
<body>
    <h2>게시물 작성</h2>
    <form action="write.php" method="post" enctype="multipart/form-data">
        <label for="author">작성자:</label>
        <input type="text" id="author" name="author" required><br>

        <label for="subject">제목:</label>
        <input type="text" id="subject" name="subject" required><br>

        <label for="content">내용:</label><br>
        <textarea id="content" name="content" rows="10" cols="50" required></textarea><br>

        <label for="upload_file">파일:</label>
        <input type="file" name="upload_file"><br><br>

        <button type="submit">저장</button>
    </form>
</body>
</html>
