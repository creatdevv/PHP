<?php
include 'db.php';
include 'lib.php';

// 게시물 총 개수 구함
$sql = "SELECT COUNT(*) AS cnt FROM freeboard";
$stmt = $conn->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$total = $stmt->fetch()['cnt'];

// 게시물 목록 조회
$sql = "SELECT idx, subject, author, rdate FROM freeboard";
$stmt = $conn->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$rs = $stmt->fetchAll();

echo "<table>";
foreach($rs as $row) {
    echo "
    <tr>
        <td>".$row['idx']."</td>
        <td>".$row['subject']."</td>
        <td>".$row['author']."</td>
        <td>".$row['rdate']."</td>
    </tr>
    ";
}
echo "</table>";

// 페이지네이션 관련 설정
$limit = 10;
$page_limit = 5;
$page = (isset($_GET['page']) && $_GET['page'] != '' && is_numeric($_GET['page'])) ? $_GET['page'] : 1;

$start = ($page - 1) * $limit;
$end = (($start + $limit) > $total) ? $total : ($start + $limit);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>페이지네이션 예시</title>
</head>
<body>

<?php
// 게시물 출력
for($i = $start; $i < $end; $i++) {
    if (isset($rs[$i])) {
        echo $rs[$i]['idx'] . '번 게시글 - ' . $rs[$i]['subject'] . '<br>';
    }
}

// 페이지네이션 링크 출력
echo my_pagination($total, $limit, $page_limit, $page, '001.php');
?>

</body>
</html>
