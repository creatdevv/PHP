<?php

include 'lib.php';

// 게시물의 총 갯수
$total = 101;

// 한 화면 출력 갯수
$limit = 10;

// 출력페이지수 맨처음 < 1 2 3 4 5 > 맨마지막
$page_limit = 5;

// 현재 페이지
$page = (isset($_GET['page']) && $_GET['page'] != '' && is_numeric($_GET['page'])) ? $_GET['page'] : 1;

// 게시물 데이터
$data = range(1, $total); 

$start = ($page - 1) * $limit;
$end = (($start + $limit) > $total) ? $total : ($start + $limit);

// 출력
for($i = $start; $i < $end; $i++) {
  if(isset($data[$i])) {
    echo $data[$i] .'번 게시글 <br>';
  }
}

// 1 2 3 4 5  =====  6 7 8 9 10
// 총 페이지 수
$total_page = ceil($total / $limit);

// 1 1
// 2 1
// 3 1
// 4 1
// 5 1
// 6 6
// 7 6
// 8 6
// 9 6
// 10 6
// 11 11

$start_page = ( ( floor( ($page - 1 ) / $page_limit ) ) * $page_limit ) + 1;
$end_page = $start_page + $page_limit -1;

if($end_page > $total_page) {
  $end_page = $total_page;
}

$prev_page = $start_page - 1;
if($prev_page < 1) {
  $prev_page = 1;
}


// 1page 0.0 --> 0*5 + 1 = 1
// 2page 0.2 --> 0*5 + 1 = 1
// 3page 0.4 --> 0*5 + 1 = 1
// 4page 0.6 --> 0*5 + 1 = 1
// 5page 0.8 --> 0*5 + 1 = 1
// 6page 1.0 --> 1*5 + 1 = 6
// 7page 1.2 --> 1*5 + 1 = 6
// 8page 1.4 --> 1*5 + 1 = 6
// 9page 1.6 --> 1*5 + 1 = 6
// 10page 1.8 --> 1*5 + 1 = 6
// 11page 2.0 --> 1*5 + 1 = 11

echo "<a href='001.php?page=1'>First</a> ";

if($prev_page > 1) {
  echo "<a href='001.php?page={$prev_page}'>Prev</a> ";
}

for($i = $start_page; $i <= $end_page; $i++) {
  if($i == $page) {
    echo $i .' ';
  }else {
    echo "<a href='001.php?page={$i}'>{$i}</a> ";
  }
}

$next_page = $end_page + 1;
if($next_page <= $total_page) {
  echo "<a href='001.php?page={$next_page}'>Next</a> ";
}

if($page < $total_page) {
  echo "<a href='001.php?page={$total_page}'>Last</a> ";
}
