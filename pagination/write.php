<?php

// 게시물 작성 페이지
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $subject = $_POST['subject'] ?? '';
    $content = $_POST['content'] ?? '';
    $author = $_POST['author'] ?? '';

    try {
        $sql = "INSERT INTO freeboard (subject, content, author, rdate) VALUES (:subject, :content, :author, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':subject', $subject, PDO::PARAM_STR);
        $stmt->bindValue(':content', $content, PDO::PARAM_STR);
        $stmt->bindValue(':author', $author, PDO::PARAM_STR);
        $stmt->execute();
        header("Location: 001.php");
        exit;
    } catch (PDOException $e) {
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
    <form action="write.php" method="post">
        <label for="author">작성자:</label>
        <input type="text" id="author" name="author" required><br>

        <label for="subject">제목:</label>
        <input type="text" id="subject" name="subject" required><br>

        <label for="content">내용:</label><br>
        <textarea id="content" name="content" rows="10" cols="50" required></textarea><br>

        <button type="submit">저장</button>
    </form>

  

</body>
</html>
