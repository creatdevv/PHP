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
$filter_type = $_GET['type'] ?? 'all'; // 알림 유형 필터
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1; // 현재 페이지
$per_page = 10; // 페이지당 알림 수

/**
 * 알림 가져오기 함수 (페이징 및 필터링 포함)
 *
 * @param int $user_id 사용자 ID
 * @param string $filter_type 알림 유형
 * @param int $page 현재 페이지
 * @param int $per_page 페이지당 알림 수
 * @return array 알림 데이터
 */
function get_notifications($user_id, $filter_type, $page, $per_page) {
    global $conn;

    $offset = ($page - 1) * $per_page;
    $sql = "SELECT id, message, type, is_read, created_at FROM notifications WHERE user_id = :user_id";
    
    if ($filter_type !== 'all') {
        $sql .= " AND type = :type";
    }
    $sql .= " ORDER BY created_at DESC LIMIT :offset, :per_page";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        if ($filter_type !== 'all') {
            $stmt->bindValue(':type', $filter_type, PDO::PARAM_STR);
        }
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':per_page', $per_page, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("알림 가져오기 실패: " . $e->getMessage());
        return [];
    }
}

/**
 * 전체 알림 수 가져오기 함수 (필터링 포함)
 *
 * @param int $user_id 사용자 ID
 * @param string $filter_type 알림 유형
 * @return int 전체 알림 수
 */
function get_notification_count($user_id, $filter_type) {
    global $conn;

    $sql = "SELECT COUNT(*) FROM notifications WHERE user_id = :user_id";
    if ($filter_type !== 'all') {
        $sql .= " AND type = :type";
    }

    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        if ($filter_type !== 'all') {
            $stmt->bindValue(':type', $filter_type, PDO::PARAM_STR);
        }
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    } catch (PDOException $e) {
        error_log("알림 수 가져오기 실패: " . $e->getMessage());
        return 0;
    }
}

// 알림 데이터 및 전체 알림 수 가져오기
$notifications = get_notifications($user_id, $filter_type, $page, $per_page);
$total_notifications = get_notification_count($user_id, $filter_type);
$total_pages = ceil($total_notifications / $per_page);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>알림</title>
    <link rel="stylesheet" href="styles.css">
    <script src="script.js"></script>
</head>
<body>
    <h1>알림</h1>
    <!-- 알림 필터 -->
    <form method="GET" action="">
        <label for="type">알림 유형:</label>
        <select name="type" id="type">
            <option value="all" <?= $filter_type === 'all' ? 'selected' : '' ?>>전체</option>
            <option value="info" <?= $filter_type === 'info' ? 'selected' : '' ?>>정보</option>
            <option value="warning" <?= $filter_type === 'warning' ? 'selected' : '' ?>>경고</option>
            <option value="error" <?= $filter_type === 'error' ? 'selected' : '' ?>>오류</option>
        </select>
        <button type="submit">필터 적용</button>
    </form>

    <?php if (!empty($notifications)): ?>
        <ul>
            <?php foreach ($notifications as $notification): ?>
                <li class="<?= $notification['is_read'] ? 'read' : 'unread' ?>">
                    <?= htmlspecialchars($notification['message'], ENT_QUOTES, 'UTF-8') ?>
                    <small>(<?= htmlspecialchars($notification['created_at'], ENT_QUOTES, 'UTF-8') ?>)</small>
                    <div class="actions">
                        <?php if (!$notification['is_read']): ?>
                            <button class="mark-read" data-id="<?= $notification['id'] ?>">읽음 처리</button>
                        <?php endif; ?>
                        <button class="delete-notification" data-id="<?= $notification['id'] ?>">삭제</button>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>

        <!-- 페이지 네비게이션 -->
        <div class="pagination">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="?page=<?= $i ?>&type=<?= htmlspecialchars($filter_type) ?>" <?= $i === $page ? 'class="active"' : '' ?>><?= $i ?></a>
            <?php endfor; ?>
        </div>
    <?php else: ?>
        <p>알림이 없습니다.</p>
    <?php endif; ?>
</body>
</html>
