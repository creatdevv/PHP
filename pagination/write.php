<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $subject = $_POST['subject'] ?? '';
    $content = $_POST['content'] ?? '';
    $author = $_POST['author'] ?? '';

    try {
        $sql = "INSERT INTO freeboard (subject, content, author, rdate) VALUES (:subject, :content, :author, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':subject', $subject, PDO::PARAM_STR);
        $stmt->bindValue(':content', $content, PDO::PARAM_STR);
        $stmt->bindValue(':author', $author, PDO::PARAM_STR);
        $stmt->execute();
        header("Location: 001.php");
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
    <title>게시물 작성</title>
</head>
<body>
    <form method="post" action="write.php">
        <label>제목: <input type="text" name="subject" required></label><br>
        <label>작성자: <input type="text" name="author" required></label><br>
        <label>내용:<br><textarea name="content" rows="5" required></textarea></label><br>
        <button type="submit">작성하기</button>
    </form>
    <a href="001.php">목록으로 돌아가기</a>
</body>
</html>
