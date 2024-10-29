<?php
include 'db.php';
include 'lib.php';

$id = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $subject = $_POST['subject'];
    $author = $_POST['author'];
    $content = $_POST['content'];

    $sql = "UPDATE freeboard SET subject = ?, author = ?, content = ? WHERE idx = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$subject, $author, $content, $id]);

    header("Location: view.php?id=$id");
    exit;
}

$sql = "SELECT * FROM freeboard WHERE idx = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$id]);
$post = $stmt->fetch();
?>

<!DOCTYPE html>
<html>
<head><title>Edit Post</title></head>
<body>
    <form method="POST">
        제목: <input type="text" name="subject" value="<?= $post['subject'] ?>"><br>
        작성자: <input type="text" name="author" value="<?= $post['author'] ?>"><br>
        내용: <textarea name="content"><?= $post['content'] ?></textarea><br>
        <button type="submit">수정 완료</button>
    </form>
</body>
</html>
