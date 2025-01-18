<?php
// 데이터베이스 연결
include 'db.php';

// GET 요청에서 id를 가져오기
$id = $_GET['id'] ?? null;
if (!$id) {
    die('게시글 ID가 필요합니다.');
}

// 게시글 조회 쿼리
$sql = "SELECT * FROM posts WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$post = $stmt->fetch(PDO::FETCH_ASSOC);

// 게시글이 없을 경우
if (!$post) {
    die('게시글을 찾을 수 없습니다.');
}

// POST 요청 처리
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';

    // 입력값 검증
    if (empty($title) || empty($content)) {
        echo '제목과 내용을 모두 입력해주세요.';
    } else {
        // 게시글 업데이트 쿼리
        $sql = "UPDATE posts SET title = :title, content = :content WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':title', $title, PDO::PARAM_STR);
        $stmt->bindValue(':content', $content, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // 업데이트 후 리디렉션
        header('Location: read.php?id=' . $id);
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시글 수정</title>
</head>
<body>
    <h1>게시글 수정</h1>
    <form action="" method="post">
        <label for="title">제목:</label><br>
        <input type="text" id="title" name="title" value="<?= htmlspecialchars($post['title']) ?>" required><br><br>
        <label for="content">내용:</label><br>
        <textarea id="content" name="content" rows="5" required><?= htmlspecialchars($post['content']) ?></textarea><br><br>
        <button type="submit">수정</button>
    </form>
</body>
</html>
