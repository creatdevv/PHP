<?php
session_start();
include 'db.php'; // 데이터베이스 연결
include 'notification_functions.php'; // 알림 관련 함수

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

// 알림 가져오기 함수
function get_notifications($user_id) {
    global $conn;
    $sql = "SELECT id, message, is_read, created_at FROM notifications WHERE user_id = :user_id ORDER BY created_at DESC";
    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("알림 가져오기 실패: " . $e->getMessage());
        return [];
    }
}

$notifications = get_notifications($user_id);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>알림</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>알림</h1>
    <?php if (!empty($notifications)): ?>
        <ul>
            <?php foreach ($notifications as $notification): ?>
                <li class="<?= $notification['is_read'] ? 'read' : 'unread' ?>">
                    <?= htmlspecialchars($notification['message'], ENT_QUOTES, 'UTF-8') ?>
                    <small>(<?= htmlspecialchars($notification['created_at'], ENT_QUOTES, 'UTF-8') ?>)</small>
                    <div class="actions">
                        <?php if (!$notification['is_read']): ?>
                            <!-- 읽음 처리 -->
                            <form method="POST" action="mark_read.php" style="display:inline;">
                                <input type="hidden" name="notification_id" value="<?= htmlspecialchars($notification['id'], ENT_QUOTES, 'UTF-8') ?>">
                                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                <button type="submit">읽음 처리</button>
                            </form>
                        <?php endif; ?>
                        <!-- 삭제 기능 -->
                        <form method="POST" action="delete_notification.php" style="display:inline;">
                            <input type="hidden" name="notification_id" value="<?= htmlspecialchars($notification['id'], ENT_QUOTES, 'UTF-8') ?>">
                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                            <button type="submit">삭제</button>
                        </form>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>알림이 없습니다.</p>
    <?php endif; ?>

    <!-- 로그아웃 버튼 -->
    <div class="logout">
        <form method="POST" action="logout.php">
            <button type="submit">로그아웃</button>
        </form>
    </div>
</body>
</html>
