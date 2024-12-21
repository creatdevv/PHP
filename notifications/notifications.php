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
    header('Content-Type: application/json; charset=UTF-8');
    $input = json_decode(file_get_contents('php://input'), true);

    if (!isset($input['csrf_token']) || $input['csrf_token'] !== $_SESSION['csrf_token']) {
        http_response_code(403);
        echo json_encode(['status' => 'error', 'message' => 'CSRF 토큰 검증 실패']);
        exit;
    }

    $action = $input['action'] ?? null;

    try {
        if ($action === 'mark_read') {
            $notification_id = filter_var($input['notification_id'], FILTER_VALIDATE_INT);
            if ($notification_id) {
                mark_as_read($notification_id);
                echo json_encode(['status' => 'success', 'message' => '알림이 읽음 처리되었습니다.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => '잘못된 알림 ID']);
            }
        } elseif ($action === 'mark_all_read') {
            mark_all_as_read($user_id);
            echo json_encode(['status' => 'success', 'message' => '모든 알림이 읽음 처리되었습니다.']);
        } elseif ($action === 'delete') {
            $notification_id = filter_var($input['notification_id'], FILTER_VALIDATE_INT);
            if ($notification_id) {
                delete_notification($notification_id);
                echo json_encode(['status' => 'success', 'message' => '알림이 삭제되었습니다.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => '잘못된 알림 ID']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => '잘못된 요청']);
        }
    } catch (Exception $e) {
        error_log("알림 처리 실패: " . $e->getMessage());
        echo json_encode(['status' => 'error', 'message' => '처리 중 오류 발생']);
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
            display: flex;
            justify-content: space-between;
            align-items: center;
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
            margin-left: 5px;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
    <script>
        async function sendRequest(action, data = {}) {
            data.csrf_token = '<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8') ?>';
            data.action = action;

            try {
                const response = await fetch('notifications.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data),
                });
                return await response.json();
            } catch (error) {
                console.error('Error:', error);
                return { status: 'error', message: '요청 실패' };
            }
        }

        async function markAsRead(notificationId) {
            const result = await sendRequest('mark_read', { notification_id: notificationId });
            if (result.status === 'success') {
                document.getElementById(`notification-${notificationId}`).classList.add('read');
            } else {
                alert(result.message);
            }
        }

        async function markAllAsRead() {
            const result = await sendRequest('mark_all_read');
            if (result.status === 'success') {
                document.querySelectorAll('.unread').forEach(item => item.classList.add('read'));
            } else {
                alert(result.message);
            }
        }

        async function deleteNotification(notificationId) {
            const result = await sendRequest('delete', { notification_id: notificationId });
            if (result.status === 'success') {
                document.getElementById(`notification-${notificationId}`).remove();
            } else {
                alert(result.message);
            }
        }
    </script>
</head>
<body>
    <h1>알림</h1>
    <button onclick="markAllAsRead()">모든 알림 읽음 처리</button>
    <?php if (!empty($notifications)): ?>
        <ul>
            <?php foreach ($notifications as $notification): ?>
                <li id="notification-<?= htmlspecialchars($notification['id'], ENT_QUOTES, 'UTF-8') ?>" class="<?= $notification['is_read'] ? 'read' : 'unread' ?>">
                    <?= htmlspecialchars($notification['message'], ENT_QUOTES, 'UTF-8') ?>
                    <small>(<?= htmlspecialchars($notification['created_at'], ENT_QUOTES, 'UTF-8') ?>)</small>
                    <div>
                        <?php if (!$notification['is_read']): ?>
                            <button onclick="markAsRead(<?= htmlspecialchars($notification['id'], ENT_QUOTES, 'UTF-8') ?>)">읽음 처리</button>
                        <?php endif; ?>
                        <button onclick="deleteNotification(<?= htmlspecialchars($notification['id'], ENT_QUOTES, 'UTF-8') ?>)">삭제</button>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>알림이 없습니다.</p>
    <?php endif; ?>
</body>
</html>
