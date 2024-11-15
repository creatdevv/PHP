<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_POST['author'];

    $sql = "INSERT INTO posts (title, content, author) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$title, $content, $author]);

    header("Location: list.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>글 작성</title>
</head>
<body>
    <h1>글 작성</h1>
    <form action="write.php" method="POST">
        제목: <input type="text" name="title" required><br>
        작성자: <input type="text" name="author" required><br>
        내용:<br>
        <textarea name="content" rows="10" cols="50" required></textarea><br>
        <button type="submit">작성</button>
    </form>
    <a href="list.php">목록으로 돌아가기</a>
</body>
</html>
