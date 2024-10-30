<?php
// 게시물 상세 보기 페이지
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

    // view.php 파일에서 하단에 수정 및 삭제 링크 추가
echo "<a href='edit.php?id={$id}'>수정</a> | <a href='delete.php?id={$id}'>삭제</a>";
}

// 파일 링크 추가
echo "<a href='uploads/{$filename}'>첨부파일 다운로드</a>";



// 댓글 목록 표시
$sql = "SELECT * FROM comments WHERE post_id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$id]);
$comments = $stmt->fetchAll();

foreach ($comments as $comment) {
    echo "<p><strong>{$comment['author']}</strong>: {$comment['content']} ({$comment['rdate']})</p>";
}

?>

<a href="001.php">목록으로 돌아가기</a>

<!-- 댓글 기능: 댓글 입력 및 표시 -->
<form method="POST" action="comment.php">
    <input type="hidden" name="post_id" value="<?= $id ?>">
    작성자: <input type="text" name="author"><br>
    내용: <textarea name="content"></textarea><br>
    <button type="submit">댓글 작성</button>
</form>