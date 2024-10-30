<?php
// 댓글 기능 : 댓글 저장 로직
include 'db.php';

$post_id = $_POST['post_id'];
$author = $_POST['author'];
$content = $_POST['content'];

$sql = "INSERT INTO comments (post_id, author, content) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->execute([$post_id, $author, $content]);

header("Location: view.php?id=$post_id");
exit;

?>
