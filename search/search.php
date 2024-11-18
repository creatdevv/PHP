<?php
include 'db.php'; // 데이터베이스 연결

$search_keyword = isset($_GET['q']) ? trim($_GET['q']) : ''; // 검색 키워드 가져오기
$results = [];

if ($search_keyword) {
    try {
        $sql = "SELECT * FROM posts WHERE title LIKE :keyword OR content LIKE :keyword";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "오류: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>검색</title>
</head>
<body>
    <h1>게시물 검색</h1>
    <form method="GET" action="search.php">
        <input type="text" name="q" placeholder="검색어를 입력하세요" value="<?= htmlspecialchars($search_keyword) ?>">
        <button type="submit">검색</button>
    </form>

    <?php if ($search_keyword): ?>
        <h2>"<?= htmlspecialchars($search_keyword) ?>"에 대한 검색 결과</h2>
        <?php if (count($results) > 0): ?>
            <ul>
                <?php foreach ($results as $row): ?>
                    <li>
                        <a href="view.php?id=<?= $row['id'] ?>">
                            <?= htmlspecialchars($row['title']) ?>
                        </a>
                        <p><?= htmlspecialchars(substr($row['content'], 0, 100)) ?>...</p>
                        <small>작성일: <?= $row['created_at'] ?></small>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>검색 결과가 없습니다.</p>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>
