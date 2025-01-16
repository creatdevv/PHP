<?php
include 'db.php';

$id = $_GET['id'];
$sql = "SELECT * FROM posts WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$post) {
    die('게시글을 찾을 수 없습니다.');
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($post['title']) ?></title>
</head>
<body>
    <h1><?= htmlspecialchars($post['title']) ?></h1>
    <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
    <p>작성일: <?= htmlspecialchars($post['created_at']) ?></p>
    <a href="edit.php?id=<?= $post['id'] ?>">수정</a>
    <a href="delete.php?id=<?= $post['id'] ?>" onclick="return confirm('정말 삭제하시겠습니까?')">삭제</a>
    <a href="index.php">목록으로</a>
</body>
</html>
