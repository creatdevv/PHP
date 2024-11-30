<?php
session_start(); // 세션이 필요하다면 추가
include 'db.php';
include 'notification_functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $notification_id = $_POST['notification_id'] ?? 0;

    if ($notification_id > 0) {
        mark_as_read($notification_id);
        header("Location: notifications.php");
        exit;
    } else {
        echo "유효하지 않은 알림 ID입니다.";
    }
}
?>
