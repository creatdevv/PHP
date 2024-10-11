<?php 
$total = 101;
$limit = 10;
$page_limit = 5;
$page = (isset($_GET['page'])&& $_GET['page'] != '' && is_numeric($_GET['page'])) ? $_GET['page'] : 1;

/*
 total : 게시물의 총 개수
 limit : 게시물의 총 개수
 page_limit : 출력페이지수
 page : 현재페이지
*/

$rs_str = my_pagination($total, $limit, $page_limit, $page);

echo $rs_str;



?>
