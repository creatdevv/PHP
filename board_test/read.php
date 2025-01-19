<?php
// 데이터베이스 연결
include 'db.php';

// GET 요청에서 id 가져오기
$id = $_GET['id'] ?? null;
if (!$id) {
    die('게시글 ID가 필요합니다.');
}

// 게시글 조회 쿼리
$sql = "SELECT * FROM posts WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$post = $stmt->fetch(PDO::FETCH_ASSOC);

// 게시글이 없을 경우
if (!$post) {
    die('게시글을 찾을 수 없습니다.');
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($post['title']) ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
        }
        h1 {
            color: #333;
        }
        a {
            text-decoration: none;
            color: #007BFF;
        }
        a:hover {
            text-decoration: underline;
        }
        .actions {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1><?= htmlspecialchars($post['title']) ?></h1>
    <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
    <p><strong>작성일:</strong> <?= htmlspecialchars($post['created_at']) ?></p>
    <div class="actions">
        <a href="edit.php?id=<?= $post['id'] ?>">수정</a>
        <a href="delete.php?id=<?= $post['id'] ?>" onclick="return confirm('정말 삭제하시겠습니까?')">삭제</a>
        <a href="index.php">목록으로</a>
    </div>
</body>
</html>
