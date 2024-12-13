<?php
session_start();
include 'db.php';
include 'notification_functions.php';

// 로그인 여부 확인
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// CSRF 토큰 생성
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$user_id = $_SESSION['user_id'];

// 알림 데이터 가져오기
try {
    $notifications = get_notifications($user_id);
} catch (Exception $e) {
    error_log("알림 가져오기 실패: " . $e->getMessage());
    $notifications = [];
}

// POST 요청 처리
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        http_response_code(403);
        die("CSRF 토큰 검증 실패.");
    }

    $notification_id = filter_input(INPUT_POST, 'notification_id', FILTER_VALIDATE_INT);
    if ($notification_id) {
        try {
            mark_as_read($notification_id);
            echo json_encode(['status' => 'success']);
        } catch (Exception $e) {
            error_log("알림 읽음 처리 실패: " . $e->getMessage());
            echo json_encode(['status' => 'error', 'message' => '알림 처리 중 오류 발생.']);
        }
    }
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
        .read {
            color: gray;
        }
        .unread {
            font-weight: bold;
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
    <script>
        async function markAsRead(notificationId, csrfToken) {
            try {
                const response = await fetch('mark_read.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        notification_id: notificationId,
                        csrf_token: csrfToken
                    })
                });
                const result = await response.json();
                if (result.status === 'success') {
                    document.getElementById(`notification-${notificationId}`).classList.add('read');
                } else {
                    alert(result.message || '알림 처리 중 오류가 발생했습니다.');
                }
            } catch (error) {
                console.error('Error:', error);
            }
        }
    </script>
</head>
<body>
    <h1>알림</h1>
    <?php if (!empty($notifications)): ?>
        <ul>
            <?php foreach ($notifications as $notification): ?>
                <li id="notification-<?= htmlspecialchars($notification['id'], ENT_QUOTES, 'UTF-8') ?>" class="<?= $notification['is_read'] ? 'read' : 'unread' ?>">
                    <?= htmlspecialchars($notification['message'], ENT_QUOTES, 'UTF-8') ?>
                    <small>(<?= htmlspecialchars($notification['created_at'], ENT_QUOTES, 'UTF-8') ?>)</small>
                    <?php if (!$notification['is_read']): ?>
                        <button onclick="markAsRead(<?= htmlspecialchars($notification['id'], ENT_QUOTES, 'UTF-8') ?>, '<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8') ?>')">읽음 처리</button>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>알림이 없습니다.</p>
    <?php endif; ?>
</body>
</html>
