<?php
include 'db.php';
include 'notification_functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $notification_id = $_POST['notification_id'] ?? 0;
    mark_as_read($notification_id);
    header("Location: notifications.php");
    exit;
}
?>
