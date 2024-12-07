<?php
session_start();
include 'db.php';
include 'notification_functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        session_unset();
        session_destroy();
        die("CSRF 토큰 검증 실패. 다시 로그인하세요.");
    }

    $user_id = $_SESSION['user_id'];
    mark_all_notifications_as_read($user_id); // 이 함수는 모든 알림을 읽음 처리
    header("Location: notifications.php");
    exit;
}
?>
