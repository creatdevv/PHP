<?php
include 'db.php';

$limit = 5; // 페이지당 표시할 게시물 수
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// 페이징을 고려한 쿼리
$sql .= " LIMIT :limit OFFSET :offset";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 총 게시물 수 조회
$count_sql = "SELECT COUNT(*) FROM posts WHERE (title LIKE :keyword OR content LIKE :keyword)";
if ($search_category !== '') {
    $count_sql .= " AND category = :category";
}
$count_stmt = $conn->prepare($count_sql);
$count_stmt->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
if ($search_category !== '') {
    $count_stmt->bindValue(':category', $search_category, PDO::PARAM_STR);
}
$count_stmt->execute();
$total_count = $count_stmt->fetchColumn();

$total_pages = ceil($total_count / $limit); // 총 페이지 수



// 검색어와 카테고리 가져오기
$search_keyword = isset($_GET['q']) ? trim($_GET['q']) : '';
$search_category = isset($_GET['category']) ? $_GET['category'] : '';
$results = [];

try {
    // 페이징 관련 변수 설정
    $limit = 5; // 페이지당 표시할 게시물 수
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $limit;

    // 게시물 가져오기 쿼리
    $sql = "SELECT * FROM posts WHERE (title LIKE :keyword OR content LIKE :keyword)";
    if ($search_category !== '') {
        $sql .= " AND category = :category";
    }
    $sql .= " LIMIT :limit OFFSET :offset"; // 페이징 처리 추가

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
    if ($search_category !== '') {
        $stmt->bindValue(':category', $search_category, PDO::PARAM_STR);
    }
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 총 게시물 수 계산
    $count_sql = "SELECT COUNT(*) FROM posts WHERE (title LIKE :keyword OR content LIKE :keyword)";
    if ($search_category !== '') {
        $count_sql .= " AND category = :category";
    }
    $count_stmt = $conn->prepare($count_sql);
    $count_stmt->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
    if ($search_category !== '') {
        $count_stmt->bindValue(':category', $search_category, PDO::PARAM_STR);
    }
    $count_stmt->execute();
    $total_count = $count_stmt->fetchColumn();

    $total_pages = ceil($total_count / $limit); // 총 페이지 수 계산
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

            <!-- 페이징 링크 -->
            <div>
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <a href="search.php?q=<?= urlencode($search_keyword) ?>&category=<?= urlencode($search_category) ?>&page=<?= $i ?>">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>
            </div>
        <?php else: ?>
            <p>검색 결과가 없습니다.</p>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>
