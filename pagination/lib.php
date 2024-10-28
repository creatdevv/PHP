<?php
// PHP 오류 로그 확인
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function my_pagination($total, $limit, $page_limit, $page, $base_url) {
    $total_page = ceil($total / $limit);
    $start_page = ((floor(($page - 1) / $page_limit)) * $page_limit) + 1;
    $end_page = $start_page + $page_limit - 1;

    if ($end_page > $total_page) {
        $end_page = $total_page;
    }

    $pagination_str = "";

    // 현재 페이지 표시
    $pagination_str .= "현재 페이지는 {$page}입니다. ";

    // First 링크
    if ($page > 1) {
        $pagination_str .= "<a href='{$base_url}?page=1'>First</a> ";
    }

    // Prev 링크 (비활성화 포함)
    $prev_page = $page - 1;
    if ($prev_page < 1) {
        $pagination_str .= "<span class='disabled'>Prev</span> ";
    } else {
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

    // 몇 페이지씩 건너뛰기 기능
    $jump_page = 5;
    if ($page + $jump_page <= $total_page) {
        $pagination_str .= "<a href='{$base_url}?page=" . ($page + $jump_page) . "'>+{$jump_page} Pages</a> ";
    }
    if ($page - $jump_page >= 1) {
        $pagination_str .= "<a href='{$base_url}?page=" . ($page - $jump_page) . "'>-{$jump_page} Pages</a> ";
    }

    // Next 링크 (비활성화 포함)
    $next_page = $page + 1;
    if ($next_page > $total_page) {
        $pagination_str .= "<span class='disabled'>Next</span> ";
    } else {
        $pagination_str .= "<a href='{$base_url}?page={$next_page}'>Next</a> ";
    }

    // Last 링크
    if ($page < $total_page) {
        $pagination_str .= "<a href='{$base_url}?page={$total_page}'>Last</a> ";
    }

    // 페이지 이동 입력창
    $pagination_str .= "
        <form action='{$base_url}' method='GET'>
            <input type='number' name='page' min='1' max='{$total_page}' value='{$page}' />
            <input type='submit' value='Go' />
        </form>
    ";

    return $pagination_str;
}

?>
