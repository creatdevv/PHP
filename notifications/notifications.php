<?php
session_start();
include 'db.php';
include 'notification_functions.php';

// 로그인 여부 확인
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// CSRF 토큰 생성 (세션에 토큰이 없을 경우 생성)
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$user_id = $_SESSION['user_id'];
$notifications = get_notifications($user_id);

// POST 요청 처리
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || !isset($_SESSION['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        session_unset();
        session_destroy();
        die("CSRF 토큰 검증 실패. 다시 로그인하세요.");
    }

    $notification_id = filter_input(INPUT_POST, 'notification_id', FILTER_VALIDATE_INT);
    if ($notification_id) {
        mark_as_read($notification_id);
        header("Location: notifications.php");
        exit;
    }
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
            margin: 20px;
            background-color: #f4f4f4;
        }
        h1 {
            color: #333;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            background-color: #fff;
            margin: 10px 0;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .read {
            color: gray;
            background-color: #e0e0e0;
        }
        .unread {
            font-weight: bold;
            background-color: #fffbcc;
        }
        form {
            display: inline;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .logout {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>알림</h1>
    <?php if (!empty($notifications)): ?>
        <ul>
            <?php foreach ($notifications as $notification): ?>
                <li class="<?= $notification['is_read'] ? 'read' : 'unread' ?>">
                    <?= htmlspecialchars($notification['message'], ENT_QUOTES, 'UTF-8') ?>
                    <small>(<?= htmlspecialchars($notification['created_at'], ENT_QUOTES, 'UTF-8') ?>)</small>
                    <?php if (!$notification['is_read']): ?>
                        <form method="POST" action="">
                            <input type="hidden" name="notification_id" value="<?= htmlspecialchars($notification['id'], ENT_QUOTES, 'UTF-8') ?>">
                            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8') ?>">
                            <button type="submit">읽음 처리</button>
                        </form>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <!-- 모두 읽음 처리 버튼 -->
        <form method="POST" action="mark_all_read.php">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8') ?>">
            <button type="submit">모두 읽음 처리</button>
        </form>
    <?php else: ?>
        <p>알림이 없습니다.</p>
    <?php endif; ?>

    <!-- 로그아웃 버튼 -->
    <div class="logout">
        <form method="POST" action="logout.php">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8') ?>">
            <button type="submit">로그아웃</button>
        </form>
    </div>
</body>
</html>
