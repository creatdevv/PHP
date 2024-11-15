<?php
include 'db.php';

$id = $_GET['id'];
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
    <title><?= htmlspecialchars($post['title']) ?></title>
</head>
<body>
    <h1><?= htmlspecialchars($post['title']) ?></h1>
    <p>작성자: <?= htmlspecialchars($post['author']) ?></p>
    <p>작성일: <?= $post['created_at'] ?></p>
    <div><?= nl2br(htmlspecialchars($post['content'])) ?></div>

    <a href="edit.php?id=<?= $post['id'] ?>">수정</a>
    <a href="delete.php?id=<?= $post['id'] ?>">삭제</a>
    <a href="list.php">목록으로 돌아가기</a>
</body>
</html>
