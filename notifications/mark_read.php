<?php
session_start();
include 'db.php';
include 'notification_functions.php';

// 로그인 여부 확인
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$notifications = get_notifications($user_id);

// CSRF 토큰 생성
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// POST 요청 처리
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("CSRF 토큰 검증 실패.");
    }

    $notification_id = filter_input(INPUT_POST, 'notification_id', FILTER_VALIDATE_INT);
    if ($notification_id) {
        mark_as_read($notification_id);
    }

    header("Location: notifications.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>알림</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #333;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            background-color: #fff;
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 3px;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
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
                        <form method="POST" action="">
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
