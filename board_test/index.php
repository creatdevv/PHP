<?php
include 'db.php';

// 게시글 목록 가져오기
$sql = "SELECT * FROM posts ORDER BY created_at DESC";
$stmt = $conn->query($sql);
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>게시판</title>
</head>
<body>
    <h1>게시판 목록</h1>
    <a href="write.php">새 글 작성</a>
    <table border="1">
        <tr>
            <th>번호</th>
            <th>제목</th>
            <th>작성일</th>
        </tr>
        <?php foreach ($posts as $post): ?>
            <tr>
                <td><?= htmlspecialchars($post['id']) ?></td>
                <td><a href="read.php?id=<?= $post['id'] ?>"><?= htmlspecialchars($post['title']) ?></a></td>
                <td><?= htmlspecialchars($post['created_at']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
