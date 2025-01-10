<?php
session_start();

// CSRF 토큰 생성
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>로그아웃 확인</title>
</head>
<body>
    <h1>로그아웃 확인</h1>
    <p>정말 로그아웃하시겠습니까?</p>
    <form method="POST" action="logout.php">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8') ?>">
        <button type="submit">로그아웃</button>
    </form>
    <a href="dashboard.php">취소</a>
</body>
</html>
