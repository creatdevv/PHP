<?php
// Define the number of results per page
$results_per_page = 10;

// Get the current page number from the URL, or set it to 1 by default
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calculate the offset (the starting point for the results on the current page)
$offset = ($current_page - 1) * $results_per_page;

// Connect to your database and retrieve the total number of results
// Replace this with your own database query
$total_results = 100;

// Calculate the total number of pages
$total_pages = ceil($total_results / $results_per_page);

// Perform a query to retrieve the results for the current page
// Replace this with your own database query
$results = array_slice(array_fill(0, 100, 'Result'), $offset, $results_per_page);

// Display the results for the current page
foreach ($results as $result) {
    echo $result, '<br>';
}

// Display the pagination links
echo '<nav aria-label="Page navigation example">';
echo '<ul class="pagination">';

// Display the "previous" link
if ($current_page > 1) {
    echo '<li class="page-item">';
    echo '<a class="page-link" href="?page=' . ($current_page - 1) . '" aria-label="Previous">';
    echo '<span aria-hidden="true">&laquo;</span>';
    echo '<span class="sr-only">Previous</span>';
    echo '</a>';
    echo '</li>';
}

// Display the page numbers
for ($i = 1; $i <= $total_pages; $i++) {
    echo '<li class="page-item' . ($i == $current_page ? ' active' : '') . '">';
    echo '<a class="page-link" href="?page=' . $i . '">' . $i . '</a>';
    echo '</li>';
}

// Display the "next" link
if ($current_page < $total_pages) {
    echo '<li class="page-item">';
    echo '<a class="page-link" href="?page=' . ($current_page + 1) . '" aria-label="Next">';
    echo '<span aria-hidden="true">&raquo;</span>';
    echo '<span class="sr-only">Next</span>';
    echo '</a>';
    echo '</li>';
}

echo '</ul>';
echo '</nav>';