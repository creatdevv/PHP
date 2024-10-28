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

// 게시물 총 개수 구함
$sql = "SELECT COUNT(*) AS cnt FROM freeboard";
$stmt = $conn->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$total = $stmt->fetch()['cnt'];

// 페이지네이션 관련 설정
$limit = 10;
$page_limit = 5;
$page = (isset($_GET['page']) && $_GET['page'] != '' && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

// 게시물 목록 조회
$sql = "SELECT idx, subject, author, rdate FROM freeboard LIMIT $start, $limit";
$stmt = $conn->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$rs = $stmt->fetchAll();

echo "<table border='1'>";
foreach($rs as $row) {
    echo "
    <tr>
        <td>{$row['idx']}</td>
        <td><a href='view.php?idx={$row['idx']}'>{$row['subject']}</a></td>
        <td>{$row['author']}</td>
        <td>{$row['rdate']}</td>
    </tr>
    ";
}
echo "</table>";

// 페이지네이션 링크 출력
echo my_pagination($total, $limit, $page_limit, $page, '001.php');
?>

<a href="write.php">글쓰기</a>
</body>
</html>
