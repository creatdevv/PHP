<?php

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['is_admin'] = $user['is_admin']; // 관리자 여부 저장
    header("Location: dashboard.php");
    exit;
}


?>