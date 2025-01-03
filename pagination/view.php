<?php
include 'db.php';

// 조회할 게시물 ID
$idx = isset($_GET['idx']) ? intval($_GET['idx']) : 0;

try {
    // 게시물 조회 및 조회수 증가 (중복 조회 방지)
    $conn->beginTransaction();

    // 조회수 증가 쿼리
    $update_sql = "UPDATE freeboard SET views = views + 1 WHERE idx = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->execute([$idx]);

    // 게시물 조회 쿼리
    $sql = "SELECT idx, subject, author, content, rdate, views, filename FROM freeboard WHERE idx = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$idx]);
    $post = $stmt->fetch(PDO::FETCH_ASSOC);

    $conn->commit();
} catch (PDOException $e) {
    $conn->rollBack();
    echo "Error: " . $e->getMessage();
    exit;
}

if ($post) {
    echo "<h2>" . htmlspecialchars($post['subject']) . "</h2>";
    echo "<p>작성자: " . htmlspecialchars($post['author']) . " | 작성일: " . htmlspecialchars($post['rdate']) . " | 조회수: " . htmlspecialchars($post['views']) . "</p>";
    echo "<div>" . nl2br(htmlspecialchars($post['content'])) . "</div>";

    // 수정 및 삭제 링크
    echo "<a href='edit.php?idx={$idx}'>수정</a> | <a href='delete.php?idx={$idx}'>삭제</a><br>";

    // 파일 링크 (파일명이 있을 경우만 출력)
    if (!empty($post['filename'])) {
        $filename = htmlspecialchars($post['filename']);
        echo "<a href='uploads/{$filename}' download>첨부파일 다운로드</a><br>";
    }
} else {
    echo "존재하지 않는 게시물입니다.";
}

// 댓글 목록 표시
$sql = "SELECT author, content, rdate FROM comments WHERE post_id = ? ORDER BY rdate ASC";
$stmt = $conn->prepare($sql);
$stmt->execute([$idx]);
$comments = $stmt->fetchAll();

echo "<h3>댓글 목록</h3>";
foreach ($comments as $comment) {
    echo "<p><strong>" . htmlspecialchars($comment['author']) . "</strong>: " . nl2br(htmlspecialchars($comment['content'])) . " (" . htmlspecialchars($comment['rdate']) . ")</p>";
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시물 상세보기</title>
</head>
<body>

<a href="001.php">목록으로 돌아가기</a>

<!-- 댓글 작성 폼 -->
<form method="POST" action="comment.php">
    <input type="hidden" name="post_id" value="<?= $idx ?>">
    작성자: <input type="text" name="author" required><br>
    내용: <textarea name="content" required></textarea><br>
    <button type="submit">댓글 작성</button>
</form>

</body>
</html>
