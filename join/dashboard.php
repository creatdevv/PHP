<?php
session_start();

// 로그인 여부 확인
if (!isset($_SESSION['user_id'])) {
    echo "로그인 후 이용해 주세요.";
    exit;
}

echo "<h1>환영합니다, " . htmlspecialchars($_SESSION['username']) . "님!</h1>";

// 관리자일 경우 관리자 페이지 링크 표시
if ($_SESSION['is_admin'] == 1) {
    echo "<a href='admin.php'>관리자 페이지</a><br>";
}

echo "<a href='logout.php'>로그아웃</a>";
?>
