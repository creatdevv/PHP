<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

echo "<h2>환영합니다, " . htmlspecialchars($_SESSION['username']) . "님!</h2>";
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>대시보드</title>
</head>
<body>
    <p><a href="logout.php">로그아웃</a></p>
</body>
</html>
