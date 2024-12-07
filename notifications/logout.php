<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
} else {
    die("잘못된 요청입니다.");
}
?>
