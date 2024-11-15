<?php
include 'db.php';

$id = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_POST['author'];

    $sql = "UPDATE posts SET title = ?, content = ?, author = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$title, $content, $author, $id]);

    header("Location: view.php?id=$id");
    exit;
}

$sql = "SELECT * FROM posts WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$id]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$post) {
    echo "게시글이 존재하지 않습니다.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>글 수정</title>
</head>
<body>
    <h1>글 수정</h1>
    <form action="edit.php?id=<?= $id ?>" method="POST">
        제목: <input type="text" name="title" value="<?= htmlspecialchars($post['title']) ?>" required><br>
        작성자: <input type="text" name="author" value="<?= htmlspecialchars($post['author']) ?>" required><br>
        내용:<br>
        <textarea name="content" rows="10" cols="50" required><?= htmlspecialchars($post['content']) ?></textarea><br>
        <button type="submit">수정</button>
    </form>
    <a href="view.php?id=<?= $id ?>">취소</a>
</body>
</html>
