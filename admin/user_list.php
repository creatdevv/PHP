<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    echo "관리자만 접근 가능합니다.";
    exit;
}

try {
    $sql = "SELECT id, username, is_admin, created_at FROM users";
    $stmt = $conn->query($sql);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "에러: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>회원 목록 관리</title>
</head>
<body>
    <h2>회원 목록</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>사용자명</th>
            <th>관리자 여부</th>
            <th>가입일</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?= htmlspecialchars($user['id']) ?></td>
            <td><?= htmlspecialchars($user['username']) ?></td>
            <td><?= $user['is_admin'] ? '관리자' : '일반 사용자' ?></td>
            <td><?= $user['created_at'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <p><a href="admin.php">관리자 페이지로 돌아가기</a></p>
</body>
</html>
