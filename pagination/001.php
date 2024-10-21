<?php
include 'db.php';
include 'lib.php';

// 게시물의 총 개수
$total = 101; 
$limit = 10;
$page_limit = 5;
$page = (isset($_GET['page']) && $_GET['page'] != '' && is_numeric($_GET['page'])) ? $_GET['page'] : 1;

$data = range(1, $total); 

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
    if (isset($data[$i])) {
        echo $data[$i] . '번 게시글 <br>';
    }
} 

// 페이지네이션 링크 출력
echo my_pagination($total, $limit, $page_limit, $page, '001.php');
?>

</body>
</html>
