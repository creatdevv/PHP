<?php
include 'db.php';

$idx = isset($_GET['idx']) ? intval($_GET['idx']) : 0;

try {
    $sql = "SELECT idx, subject, content, author, rdate FROM freeboard WHERE idx = :idx";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':idx', $idx, PDO::PARAM_INT);
    $stmt->execute();
    $post = $stmt->fetch();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}

if ($post) {
    echo "<h2>" . htmlspecialchars($post['subject']) . "</h2>";
    echo "<p>작성자: " . htmlspecialchars($post['author']) . " | 작성일: " . $post['rdate'] . "</p>";
    echo "<div>" . nl2br(htmlspecialchars($post['content'])) . "</div>";
} else {
    echo "존재하지 않는 게시물입니다.";
}
?>
<a href="001.php">목록으로 돌아가기</a>
