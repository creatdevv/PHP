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
