<?php
include 'db.php';

$search_keyword = isset($_GET['q']) ? trim($_GET['q']) : '';
$search_category = isset($_GET['category']) ? $_GET['category'] : '';
$results = [];

try {
    $sql = "SELECT * FROM posts WHERE (title LIKE :keyword OR content LIKE :keyword)";
    if ($search_category !== '') {
        $sql .= " AND category = :category";
    }
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
    if ($search_category !== '') {
        $stmt->bindValue(':category', $search_category, PDO::PARAM_STR);
    }
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "오류: " . $e->getMessage();
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
        <select name="category">
            <option value="">전체</option>
            <option value="프로그래밍" <?= $search_category === '프로그래밍' ? 'selected' : '' ?>>프로그래밍</option>
            <option value="최적화" <?= $search_category === '최적화' ? 'selected' : '' ?>>최적화</option>
            <option value="트렌드" <?= $search_category === '트렌드' ? 'selected' : '' ?>>트렌드</option>
        </select>
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
                        <small>카테고리: <?= $row['category'] ?> | 작성일: <?= $row['created_at'] ?></small>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>검색 결과가 없습니다.</p>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>
