<?php
session_start();
include 'db.php';
include 'notification_functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("CSRF 토큰 검증 실패. 다시 로그인하세요.");
    }

    $user_id = $_SESSION['user_id'];
    try {
        update_notifications('all', $user_id, $conn); // 모든 알림 읽음 처리
        header("Location: notifications.php");
        exit;
    } catch (Exception $e) {
        die("알림 처리 중 오류가 발생했습니다.");
    }
}
?>
