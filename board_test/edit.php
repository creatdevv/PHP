<?php
include 'db.php';

$id = $_GET['id'];
$sql = "SELECT * FROM posts WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "UPDATE posts SET title = :title, content = :content WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':title', $title, PDO::PARAM_STR);
    $stmt->bindValue(':content', $content, PDO::PARAM_STR);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    header('Location: read.php?id=' . $id);
    exit;
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>게시글 수정</title>
</head>
<body>
    <h1>게시글 수정</h1>
    <form action="" method="post">
        <label for="title">제목:</label><br>
        <input type="text" id="title" name="title" value="<?= htmlspecialchars($post['title']) ?>" required><br>
        <label for="content">내용:</label><br>
        <textarea id="content" name="content" rows="5" required><?= htmlspecialchars($post['content']) ?></textarea><br>
        <button type="submit">수정</button>
    </form>
</body>
</html>
