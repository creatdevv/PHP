<?php
include 'db.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    echo "잘못된 요청입니다.";
    exit;
}

try {
    $sql = "DELETE FROM freeboard WHERE idx = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);

    // 삭제 성공 시 게시판 목록 페이지로 리디렉션
    header("Location: 001.php");
    exit;
    
} catch (PDOException $e) {
    echo "삭제 중 오류가 발생했습니다: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>게시물 삭제</title>
</head>
<body>
    <p>정말 삭제하시겠습니까?</p>
    <form action="delete.php?idx=<?= $idx ?>" method="post">
        <button type="submit">삭제</button>
        <a href="view.php?idx=<?= $idx ?>">취소</a>
    </form>
</body>
</html>
