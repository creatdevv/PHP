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

my_pagenation($total, $limit, $page_limit, $page);

function my_pagenation($total, $limit, $page_limit, $page) {

$total = 312;   // #게시물 총 개수

$limit = 10;    // 한 화면 출력 개수  (1페이지: 0~9, 2페이지: 10~19, ...)

// 출력 페이지수(하단 쪽)  << 1 2 3 4 5 >>
$page_limit = 5;

$data = range(1, $total);      // 게시물 데이터 생성 (1~100)

// 현재 페이지
// $page = isset($_GET['page']) && $_GET['page'] != '' && is_numeric($_GET['page']) ? $_GET['page'] : 1;   // 페이지 설정 (URL에 ?page=2 와 같은 값을 받을 때)

$start = ($page -1) * $limit;       // 게시물 시작 인덱스


// 게시물 출력
for($i = $start; $i < ($start + $limit); $i++) {
    if(isset($data[$i])) {
        echo $data[$i] . "번 게시글 <br>";  // 게시물 출력
    }
}
//  >>웹 브라우저 맨 끝에 ?page=2  을 추가하면, 11번 게시글~20번 게시글 을 보여준다.

$total_page = ceil($total / $limit);        // #총 페이지 수 계산 (ceil: 천장펜 으로 반올림 처리함 나타냄)
$start_page = ((floor($page -1) / $page_limit) * $page_limit ) + 1;  // #페이징 시작 페이지 계산 (floor 이용)
$end_page = $start_page+ $page_limit -1;    // #페이징 끝 페이지 계산
if($end_page > $total_page) {
    $end_page = $total_page;
}

echo "<a href='001.php?page=1'>First</a> ";

$prev_page = $start_page -1;
if($prev_page > 1) {
    echo "<a href='001.php?page=".$prev_page."'>Prev</a> ";
}

// 페이징 출력
for ($i = $start_page; $i <= $end_page; $i++) {
    if ($page == $i) {
        // 현재 페이지는 텍스트로 표시
        echo "<strong>" . $i . "</strong> ";
    } else {
        // 다른 페이지는 링크로 표시
        echo "<a href='001.php?page=" . $i . "'>" . $i . "</a> ";
    }
}

$next_page = $end_page + 1;
if($next_page <= $total_page) {
    echo " <a href='001.php?page=". $next_page. "'>Next</a> ";
}

echo "<a href='001.php?page=". $total_page."'>Last</a>";

// ## 예시
// 1 1~5
// 2 1~5
// 3 1~5
// 4 1~5
// 5 1~5
// 6 6~10
// 7 6~10
// 8 6~10
// 9 6~10
// 10 6~10
// 11 11~15
// ... 총 페이지 수 까지

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

}

?>
