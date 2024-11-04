<?php
// 페이지당 결과 개수 정의
$results_per_page = 10;

// 현재 페이지 번호 설정 (기본값은 1)
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// 오프셋 계산
$offset = ($current_page - 1) * $results_per_page;

// 데이터베이스에서 총 결과 개수 가져오기
// $stmt = $conn->prepare("SELECT COUNT(*) FROM your_table_name"); // 실제 데이터베이스 쿼리
// $stmt->execute();
// $total_results = $stmt->fetchColumn();

// 가상 데이터 (테스트용)
// 실제로는 위에서 데이터베이스에서 $total_results 값을 가져와야 합니다.
$total_results = 100;

// 전체 페이지 수 계산
$total_pages = ceil($total_results / $results_per_page);

// 현재 페이지에 대한 결과 가져오기
// $stmt = $conn->prepare("SELECT * FROM your_table_name LIMIT $offset, $results_per_page"); // 실제 데이터베이스 쿼리
// $stmt->execute();
// $results = $stmt->fetchAll();

// 가상 결과 (테스트용)
$results = array_slice(array_fill(0, 100, 'Result'), $offset, $results_per_page);

// 현재 페이지의 결과 표시
foreach ($results as $result) {
    echo $result, '<br>';
}

// 페이지네이션 링크 표시
echo '<nav aria-label="Page navigation">';
echo '<ul class="pagination">';

// "이전" 링크 표시
if ($current_page > 1) {
    echo '<li class="page-item">';
    echo '<a class="page-link" href="?page=' . ($current_page - 1) . '" aria-label="Previous">';
    echo '<span aria-hidden="true">&laquo;</span>';
    echo '<span class="sr-only">이전 페이지</span>';
    echo '</a>';
    echo '</li>';
}

// 페이지 번호 표시
for ($i = 1; $i <= $total_pages; $i++) {
    echo '<li class="page-item' . ($i == $current_page ? ' active' : '') . '">';
    echo '<a class="page-link" href="?page=' . $i . '">' . $i . '</a>';
    echo '</li>';
}

// "다음" 링크 표시
if ($current_page < $total_pages) {
    echo '<li class="page-item">';
    echo '<a class="page-link" href="?page=' . ($current_page + 1) . '" aria-label="Next">';
    echo '<span aria-hidden="true">&raquo;</span>';
    echo '<span class="sr-only">다음 페이지</span>';
    echo '</a>';
    echo '</li>';
}

echo '</ul>';
echo '</nav>';
?>
