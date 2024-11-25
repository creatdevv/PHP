<?php
session_start();
include 'db.php';
include 'notification_functions.php';

$user_id = $_SESSION['user_id']; // 로그인한 사용자 ID 가져오기
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
    <?php if (count($notifications) > 0): ?>
        <ul>
            <?php foreach ($notifications as $notification): ?>
                <li style="<?= $notification['is_read'] ? 'color: gray;' : 'font-weight: bold;' ?>">
                    <?= htmlspecialchars($notification['message']) ?>
                    <small>(<?= $notification['created_at'] ?>)</small>
                    <?php if (!$notification['is_read']): ?>
                        <form method="POST" action="mark_read.php" style="display:inline;">
                            <input type="hidden" name="notification_id" value="<?= $notification['id'] ?>">
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
