<?php
session_start();
include 'db.php';

// 로그인 확인 및 관리자 권한 체크
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    echo "관리자만 접근 가능합니다.";
    exit;
}

echo "<h2>관리자 페이지</h2>";
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>관리자 페이지</title>
</head>
<body>
    <p>환영합니다, 관리자님!</p>
    <ul>
        <li><a href="user_list.php">회원 목록 관리</a></li>
        <li><a href="content_manage.php">게시물 관리</a></li>
    </ul>
    <p><a href="dashboard.php">메인 대시보드로 돌아가기</a></p>
</body>
</html>
