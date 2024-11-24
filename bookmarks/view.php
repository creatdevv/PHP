<?php
include 'db.php';
include 'log_activity.php'; // 로그 기록 함수 포함

// 조회할 게시물 ID
$idx = isset($_GET['idx']) ? intval($_GET['idx']) : 0;

// 사용자 활동 로그 기록
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0; // 비회원은 0으로 처리
log_activity($user_id, "게시물 조회", "view.php?idx={$idx}");


try {
    // 조회수 증가
    $update_sql = "UPDATE freeboard SET views = views + 1 WHERE idx = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->execute([$idx]);

    // 게시물 조회
    $sql = "SELECT idx, subject, author, content, rdate, views FROM freeboard WHERE idx = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$idx]);
    $post = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}

if ($post) {
    echo "<h2>" . htmlspecialchars($post['subject']) . "</h2>";
    echo "<p>작성자: " . htmlspecialchars($post['author']) . " | 작성일: " . $post['rdate'] . " | 조회수: " . htmlspecialchars($post['views']) . "</p>";
    echo "<div>" . nl2br(htmlspecialchars($post['content'])) . "</div>";

    // 수정 및 삭제 링크
    echo "<a href='edit.php?idx={$idx}'>수정</a> | <a href='delete.php?idx={$idx}'>삭제</a><br>";

    // 파일 링크 (파일명이 있을 경우만 출력)
    if (!empty($post['filename'])) {
        echo "<a href='uploads/{$post['filename']}'>첨부파일 다운로드</a><br>";
    }

    // ** 즐겨찾기 추가 버튼 **
    echo "<a href='add_favorite.php?item_id={$post['idx']}'>즐겨찾기 추가</a><br>";
} else {
    echo "존재하지 않는 게시물입니다.";
}

// 댓글 목록 표시
$sql = "SELECT * FROM comments WHERE post_id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$idx]);
$comments = $stmt->fetchAll();

foreach ($comments as $comment) {
    echo "<p><strong>" . htmlspecialchars($comment['author']) . "</strong>: " . htmlspecialchars($comment['content']) . " (" . $comment['rdate'] . ")</p>";
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
    작성자: <input type="text" name="author"><br>
    내용: <textarea name="content"></textarea><br>
    <button type="submit">댓글 작성</button>
</form>
</body>
</html>
