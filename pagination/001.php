<?php 

$total = 100;   // 게시물 총 개수

$limit = 10;    // 한 화면 출력 개수  (1페이지: 0~9, 2페이지: 10~19, ...)

// 출력 페이지수(하단 쪽)  << 1 2 3 4 5 >>
$page_limit = 5;

$data = range(1, $total);      // 게시물

$page = isset($_GET['page']) && $_GET['page'] != '' && is_numeric($_GET['page']) ? $_GET['page'] : 1;

$start = ($page -1) * $limit;

for($i = $start; $i < ($start + $limit); $i++) {
    if(isset($data[$i])) {
        echo $data[$i] . "번 게시글 <br>";  // 여기에서 . 연산자를 사용해 변수를 문자열과 연결
    }
}
//  >>웹 브라우저 맨 끝에 ?page=2  을 추가하면, 11번 게시글~20번 게시글 을 보여준다.

$total_page = ceil($total / $limit);        // #총 페이지 수 (ceil: 천장펜 으로 반올림을 나타냄)


?>
