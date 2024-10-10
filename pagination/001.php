<?php 
$total = 101;
$limit = 10;
$page_limit = 5;
$page = (isset($_GET['page'])&& $_GET['page'] != '' && is_numeric($_GET['page'])) ? $_GET['page'] : 1;

$rs_str = my_pagenation($total, $limit, $page_limit, $page);

echo $rs_str;

function my_pagenation($total, $limit, $page_limit, $page) {
    $start = ($page -1) * $limit; // 게시물 시작 인덱스

    // 게시물 출력
    for($i = $start; $i < ($start + $limit); $i++) {
        if($i < $total) {
            echo ($i + 1) . "번 게시글 <br>"; // 게시물 번호를 1부터 시작
        }
    }

    $total_page = ceil($total / $limit); // 총 페이지 수 계산
    $start_page = ((floor(($page - 1) / $page_limit)) * $page_limit) + 1; // 페이징 시작 페이지
    $end_page = $start_page + $page_limit - 1; // 페이징 끝 페이지

    if ($end_page > $total_page) {
        $end_page = $total_page;
    }

    $rs_str = "<a href='001.php?page=1'>First</a> ";

    $prev_page = $page - 1; // 현재 페이지의 이전 페이지
    if($prev_page >= 1) {
        $rs_str .= "<a href='001.php?page=" . $prev_page . "'>Prev</a> "; // Prev 링크 추가
    }

    // 페이징 출력
    for ($i = $start_page; $i <= $end_page; $i++) {
        if ($page == $i) {
            $rs_str .= "<strong>" . $i . "</strong> ";
        } else {
            $rs_str .= "<a href='001.php?page=" . $i . "'>" . $i . "</a> ";
        }
    }

    $next_page = $page + 1;
    if($next_page <= $total_page) {
        $rs_str .= "<a href='001.php?page=" . $next_page . "'>Next</a> "; // Next 링크 추가
    }

    $rs_str .= "<a href='001.php?page=" . $total_page . "'>Last</a>";

    return $rs_str;
}
?>
