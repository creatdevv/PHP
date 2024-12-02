<?php
session_start();
include 'db.php';
include 'notification_functions.php';

// 로그인 여부 확인
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// CSRF 토큰 생성 및 저장
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$user_id = $_SESSION['user_id'];
$notifications = get_notifications($user_id);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>알림</title>
</head>
<body>
    <h1>알림</h1>
    <?php if (!empty($notifications)): ?>
        <ul>
            <?php foreach ($notifications as $notification): ?>
                <li style="<?= $notification['is_read'] ? 'color: gray;' : 'font-weight: bold;' ?>">
                    <?= htmlspecialchars($notification['message']) ?>
                    <small>(<?= $notification['created_at'] ?>)</small>
                    <?php if (!$notification['is_read']): ?>
                        <form method="POST" action="mark_read.php" style="display:inline;">
                            <input type="hidden" name="notification_id" value="<?= $notification['id'] ?>">
                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                            <button type="submit">읽음 처리</button>
                        </form>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>알림이 없습니다.</p>
    <?php endif; ?>
</body>
</html>
