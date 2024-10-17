<?php

function my_pagination($total, $limit, $page_limit, $page, $base_url) {
    $total_page = ceil($total / $limit);
    $start_page = ((floor(($page - 1) / $page_limit)) * $page_limit) + 1;
    $end_page = $start_page + $page_limit - 1;

    if ($end_page > $total_page) {
        $end_page = $total_page;
    }

    $pagination_str = "";  // 오타 제거됨

    // 1. 현재 페이지 표시
    $pagination_str .= "현재 페이지는 {$page}입니다. ";

    // First 링크
    if ($page > 1) {
        $pagination_str .= "<a href='{$base_url}?page=1'>First</a> ";
    }

    // Prev 링크
    $prev_page = $page - 1;
    if ($prev_page >= 1) {
        $pagination_str .= "<a href='{$base_url}?page={$prev_page}'>Prev</a> ";
    }

    // 페이지 번호 출력
    for ($i = $start_page; $i <= $end_page; $i++) {
        if ($i == $page) {
            $pagination_str .= "<strong>{$i}</strong> ";
        } else {
            $pagination_str .= "<a href='{$base_url}?page={$i}'>{$i}</a> ";
        } 
    }

    // 2. 몇 페이지씩 건너뛰기 기능 추가
$jump_page = 5;  // 5페이지씩 점프
if ($page + $jump_page <= $total_page) {
    $pagination_str .= "<a href='{$base_url}?page=" . ($page + $jump_page) . "'>+{$jump_page} Pages</a> ";
}
if ($page - $jump_page >= 1) {
    $pagination_str .= "<a href='{$base_url}?page=" . ($page - $jump_page) . "'>-{$jump_page} Pages</a> ";
}


    // Next 링크
    $next_page = $page + 1;
    if ($next_page <= $total_page) {
        $pagination_str .= "<a href='{$base_url}?page={$next_page}'>Next</a> ";
    }

    // Last 링크
    if ($page < $total_page) {
        $pagination_str .= "<a href='{$base_url}?page={$total_page}'>Last</a> ";
    }

    return $pagination_str;
}

// 3. 페이지 이동 입력창 추가
$pagination_str .= "
    <form action='{$base_url}' method='GET'>
        <input type='number' name='page' min='1' max='{$total_page}' value='{$page}' />
        <input type='submit' value='Go' />
    </form>
";


?>
