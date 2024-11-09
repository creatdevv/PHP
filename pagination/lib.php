<?php
// PHP 오류 로그 설정
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function my_pagination($total, $limit, $page_limit, $page, $base_url) {
    $total_page = ceil($total / $limit);
    $start_page = ((floor(($page - 1) / $page_limit)) * $page_limit) + 1;
    $end_page = min($start_page + $page_limit - 1, $total_page);

    $pagination_str = "<div class='pagination'>";

    // 현재 페이지 표시
    $pagination_str .= "<p>현재 페이지: <strong>{$page}</strong> / 총 <strong>{$total_page}</strong> 페이지</p>";

    // First 링크
    if ($page > 1) {
        $pagination_str .= "<a href='{$base_url}?page=1'>First</a> ";
    }

    // Prev 링크
    if ($page > 1) {
        $pagination_str .= "<a href='{$base_url}?page=" . ($page - 1) . "'>Prev</a> ";
    } else {
        $pagination_str .= "<span class='disabled'>Prev</span> ";
    }

    // 페이지 번호 출력
    for ($i = $start_page; $i <= $end_page; $i++) {
        if ($i == $page) {
            $pagination_str .= "<strong class='current'>{$i}</strong> ";
        } else {
            $pagination_str .= "<a href='{$base_url}?page={$i}'>{$i}</a> ";
        }
    }

    // Next 링크
    if ($page < $total_page) {
        $pagination_str .= "<a href='{$base_url}?page=" . ($page + 1) . "'>Next</a> ";
    } else {
        $pagination_str .= "<span class='disabled'>Next</span> ";
    }

    // Last 링크
    if ($page < $total_page) {
        $pagination_str .= "<a href='{$base_url}?page={$total_page}'>Last</a> ";
    }

    // 페이지 이동 입력창
    $pagination_str .= "
        <form action='{$base_url}' method='GET' class='page-jump'>
            <label for='page'>페이지 이동:</label>
            <input type='number' name='page' min='1' max='{$total_page}' value='{$page}' required />
            <button type='submit'>Go</button>
        </form>
    ";

    $pagination_str .= "</div>";
    return $pagination_str;
}
?>
