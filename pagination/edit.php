<?php
include 'db.php';
include 'lib.php';

// 게시물 ID 유효성 검사
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    echo "잘못된 요청입니다.";
    exit;
}

// 게시물 데이터 가져오기
$sql = "SELECT * FROM freeboard WHERE idx = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$id]);
$post = $stmt->fetch();

// 게시물 존재 여부 확인
if (!$post) {
    echo "존재하지 않는 게시물입니다.";
    exit;
}

// POST 요청 처리 (게시물 업데이트)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $subject = trim($_POST['subject']);
    $author = trim($_POST['author']);
    $content = trim($_POST['content']);

    // 빈 필드 검증
    if ($subject === '' || $author === '' || $content === '') {
        echo "모든 필드를 채워주세요.";
    } else {
        try {
            $sql = "UPDATE freeboard SET subject = ?, author = ?, content = ? WHERE idx = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$subject, $author, $content, $id]);

            header("Location: view.php?id=$id");
            exit;
        } catch (PDOException $e) {
            echo "수정 중 오류가 발생했습니다: " . $e->getMessage();
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>Edit Post</title>
</head>
<body>
    <form method="POST">
        제목: <input type="text" name="subject" value="<?= htmlspecialchars($post['subject']) ?>"><br>
        작성자: <input type="text" name="author" value="<?= htmlspecialchars($post['author']) ?>"><br>
        내용: <textarea name="content"><?= htmlspecialchars($post['content']) ?></textarea><br>
        <button type="submit">수정 완료</button>
    </form>
    <a href="view.php?id=<?= $id ?>">취소</a>
</body>
</html>
