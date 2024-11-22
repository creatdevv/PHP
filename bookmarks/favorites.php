<?php
include 'db.php';

$user_id = 1; // 임시 사용자 ID

// 즐겨찾기 목록 가져오기
$sql = "
    SELECT f.id AS favorite_id, fb.idx AS post_id, fb.subject, fb.author, fb.rdate
    FROM favorites f
    INNER JOIN freeboard fb ON f.item_id = fb.idx
    WHERE f.user_id = :user_id
    ORDER BY f.added_at DESC
";
$stmt = $conn->prepare($sql);
$stmt->execute([':user_id' => $user_id]);
$favorites = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>즐겨찾기 목록</title>
</head>
<body>
    <h1>즐겨찾기 목록</h1>
    <table border="1">
        <tr>
            <th>제목</th>
            <th>작성자</th>
            <th>작성일</th>
            <th>삭제</th>
        </tr>
        <?php foreach ($favorites as $favorite): ?>
        <tr>
            <td><a href="view.php?idx=<?= $favorite['post_id'] ?>"><?= htmlspecialchars($favorite['subject']) ?></a></td>
            <td><?= htmlspecialchars($favorite['author']) ?></td>
            <td><?= $favorite['rdate'] ?></td>
            <td><a href="remove_favorite.php?favorite_id=<?= $favorite['favorite_id'] ?>">삭제</a></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
