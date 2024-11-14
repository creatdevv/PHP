<?php
include 'db.php';

$comment_id = isset($_GET['comment_id']) ? intval($_GET['comment_id']) : 0;
$post_id = isset($_GET['post_id']) ? intval($_GET['post_id']) : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $sql = "DELETE FROM comments WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$comment_id]);
        header("Location: view.php?idx=" . $post_id);
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>댓글 삭제</title>
</head>
<body>
    <p>정말 댓글을 삭제하시겠습니까?</p>
    <form action="delete_comment.php?comment_id=<?= $comment_id ?>&post_id=<?= $post_id ?>" method="post">
        <button type="submit">삭제</button>
        <a href="view.php?idx=<?= $post_id ?>">취소</a>
    </form>
</body>
</html>
