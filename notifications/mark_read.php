<?php
session_start();
include 'db.php';
include 'notification_functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("CSRF 토큰 검증 실패.");
    }

    $notification_id = $_POST['notification_id'] ?? 0;
    mark_as_read($notification_id);

    header("Location: notifications.php");
    exit;
}
?>
