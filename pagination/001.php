<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판 목록</title>
</head>
<body>

<!-- 검색 입력창 -->
<form method="GET" action="001.php">
    <input type="text" name="search" placeholder="검색어 입력" value="<?= htmlspecialchars($search) ?>">
    <button type="submit">검색</button>
</form>

<?php
include 'db.php';
include 'lib.php';

// 검색어 처리
$search = isset($_GET['search']) ? $_GET['search'] : '';

// 페이지네이션 설정
$limit = 10; // 페이지당 게시물 수
$page_limit = 5; // 표시할 페이지 번호 개수
$page = (isset($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

// 검색어에 따른 게시물 총 개수 구함
$sql = "SELECT COUNT(*) AS cnt FROM freeboard WHERE subject LIKE ?";
$stmt = $conn->prepare($sql);
$stmt->execute(["%$search%"]);
$total = $stmt->fetchColumn();

// 게시물 목록 조회 (조회수 추가)
$sql = "SELECT idx, subject, author, rdate, views FROM freeboard WHERE subject LIKE ? ORDER BY rdate DESC LIMIT $start, $limit";
$stmt = $conn->prepare($sql);
$stmt->execute(["%$search%"]);
$rs = $stmt->fetchAll();

// 게시물 목록 테이블 출력
echo "<table border='1'>
    <tr>
        <th>번호</th>
        <th>제목</th>
        <th>작성자</th>
        <th>작성일</th>
        <th>조회수</th> <!-- 조회수 열 추가 -->
    </tr>";
foreach($rs as $row) {
    echo "
    <tr>
        <td>{$row['idx']}</td>
        <td><a href='view.php?idx={$row['idx']}'>{$row['subject']}</a></td>
        <td>{$row['author']}</td>
        <td>{$row['rdate']}</td>
        <td>{$row['views']}</td> <!-- 조회수 표시 -->
    </tr>
    ";
}
echo "</table>";

// 페이지네이션 링크 출력
echo my_pagination($total, $limit, $page_limit, $page, '001.php?search=' . urlencode($search));
?>

<a href="write.php">글쓰기</a>

</body>
</html>
