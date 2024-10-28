<?php
include 'db.php';
include 'lib.php';

// 검색어와 정렬 설정
$search = isset($_GET['search']) ? $_GET['search'] : '';
$order = isset($_GET['order']) ? $_GET['order'] : 'rdate DESC';

// 페이지네이션 설정
$limit = 10; // 페이지당 게시물 수
$page_limit = 5; // 표시할 페이지 번호 개수
$page = (isset($_GET['page']) && $_GET['page'] != '' && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

// 총 게시물 수 구하기
try {
    $sql = "SELECT COUNT(*) AS cnt FROM freeboard WHERE subject LIKE :search OR author LIKE :search";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
    $stmt->execute();
    $total = $stmt->fetch()['cnt'];
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}

// 게시물 목록 조회 (검색 및 정렬 포함)
try {
    $sql = "SELECT idx, subject, author, rdate FROM freeboard WHERE subject LIKE :search OR author LIKE :search ORDER BY $order LIMIT :start, :limit";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
    $stmt->bindValue(':start', $start, PDO::PARAM_INT);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    $rs = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>페이지네이션 게시판</title>
</head>
<body>
    <!-- 검색 기능 -->
    <form method="get" action="001.php">
        <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="검색어 입력">
        <button type="submit">검색</button>
    </form>

    <!-- 정렬 링크 -->
    <a href="001.php?order=rdate DESC&search=<?= urlencode($search) ?>">최신순</a> |
    <a href="001.php?order=author ASC&search=<?= urlencode($search) ?>">작성자순</a>

    <!-- 게시물 목록 -->
    <table border="1">
        <tr>
            <th>번호</th>
            <th>제목</th>
            <th>작성자</th>
            <th>작성일</th>
        </tr>
        <?php foreach($rs as $row): ?>
        <tr>
            <td><?= $row['idx'] ?></td>
            <td><a href="view.php?idx=<?= $row['idx'] ?>"><?= htmlspecialchars($row['subject']) ?></a></td>
            <td><?= htmlspecialchars($row['author']) ?></td>
            <td><?= $row['rdate'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <!-- 페이지네이션 링크 출력 -->
    <?php
    echo my_pagination($total, $limit, $page_limit, $page, '001.php?search='.urlencode($search).'&order='.urlencode($order));
    ?>

    <!-- 새 글 작성 링크 -->
    <a href="write.php">새 글 작성</a>
</body>
</html>
