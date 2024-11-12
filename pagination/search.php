<?php
include 'db.php';

$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';

if ($keyword) {
    $sql = "SELECT idx, subject, author, rdate, views FROM freeboard 
            WHERE subject LIKE :keyword OR content LIKE :keyword 
            ORDER BY rdate DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':keyword', "%{$keyword}%", PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetchAll();
} else {
    $results = [];
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시물 검색</title>
</head>
<body>
    <h2>게시물 검색</h2>
    <form action="search.php" method="get">
        <input type="text" name="keyword" value="<?= htmlspecialchars($keyword) ?>" placeholder="검색어 입력">
        <button type="submit">검색</button>
    </form>

    <?php if ($keyword && $results): ?>
        <h3>검색 결과:</h3>
        <ul>
            <?php foreach ($results as $row): ?>
                <li>
                    <a href="view.php?idx=<?= $row['idx'] ?>"><?= htmlspecialchars($row['subject']) ?></a>
                    - <?= htmlspecialchars($row['author']) ?> | <?= $row['rdate'] ?> | 조회수: <?= $row['views'] ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php elseif ($keyword): ?>
        <p>검색 결과가 없습니다.</p>
    <?php endif; ?>
</body>
</html>
