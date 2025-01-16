<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "INSERT INTO posts (title, content, created_at) VALUES (:title, :content, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':title', $title, PDO::PARAM_STR);
    $stmt->bindValue(':content', $content, PDO::PARAM_STR);
    $stmt->execute();

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>새 글 작성</title>
</head>
<body>
    <h1>새 글 작성</h1>
    <form action="" method="post">
        <label for="title">제목:</label><br>
        <input type="text" id="title" name="title" required><br>
        <label for="content">내용:</label><br>
        <textarea id="content" name="content" rows="5" required></textarea><br>
        <button type="submit">작성</button>
    </form>
</body>
</html>
