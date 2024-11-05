<?php
// 댓글 기능 : 댓글 저장 로직
include 'db.php';

$post_id = $_POST['post_id'];
$author = trim($_POST['author']);
$content = trim($_POST['content']);

// 입력 값 유효성 검사
if (empty($post_id) || empty($author) || empty($content)) {
    echo "모든 필드를 입력해 주세요.";
    exit;
}

try {
    // 특수 문자 처리
    $author = htmlspecialchars($author, ENT_QUOTES, 'UTF-8');
    $content = htmlspecialchars($content, ENT_QUOTES, 'UTF-8');

    // 댓글 저장 SQL 실행
    $sql = "INSERT INTO comments (post_id, author, content) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$post_id, $author, $content]);

    // 댓글 저장 후 게시물 상세 페이지로 리디렉션
    header("Location: view.php?idx=" . urlencode($post_id));
    exit;

} catch (PDOException $e) {
    echo "댓글을 저장하는 동안 오류가 발생했습니다: " . $e->getMessage();
    exit;
}
?>
