<?php
include 'db.php';

/**
 * 특정 사용자의 읽지 않은 알림 목록 가져오기
 *
 * @param int $user_id 사용자 ID
 * @param int $limit 한 페이지에 표시할 알림 수 (기본값: 10)
 * @param int $offset 시작 지점 (기본값: 0)
 * @param bool $mark_as_read 가져온 알림을 읽음 처리할지 여부 (기본값: false)
 * @return array 알림 목록
 */
function get_unread_notifications($user_id, $limit = 10, $offset = 0, $mark_as_read = false) {
    global $conn;

    // 유효성 검사
    if (!is_int($user_id) || $user_id <= 0) {
        error_log("유효하지 않은 사용자 ID: " . json_encode($user_id));
        return [];
    }

    try {
        // 읽지 않은 알림 조회
        $sql = "SELECT id, user_id, message, created_at 
                FROM notifications 
                WHERE user_id = :user_id AND is_read = 0 
                ORDER BY created_at DESC 
                LIMIT :limit OFFSET :offset";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        $notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // 가져온 알림을 읽음 처리
        if ($mark_as_read && !empty($notifications)) {
            $notification_ids = array_column($notifications, 'id');
            $ids_placeholder = implode(',', array_fill(0, count($notification_ids), '?'));

            $update_sql = "UPDATE notifications SET is_read = 1 WHERE id IN ($ids_placeholder)";
            $update_stmt = $conn->prepare($update_sql);
            foreach ($notification_ids as $index => $id) {
                $update_stmt->bindValue($index + 1, $id, PDO::PARAM_INT);
            }
            $update_stmt->execute();
        }

        return $notifications;
    } catch (PDOException $e) {
        error_log("알림 조회 중 오류: " . $e->getMessage());
        return [];
    }
}

// 테스트 데이터 처리 여부
$enable_test = true;

if ($enable_test) {
    $test_user_id = 1; // 테스트용 사용자 ID
    $limit = 5;        // 한 번에 가져올 알림 수
    $offset = 0;       // 시작 지점

    $notifications = get_unread_notifications($test_user_id, $limit, $offset, true);

    if (!empty($notifications)) {
        echo "사용자 ID $test_user_id의 읽지 않은 알림 목록:<br>";
        foreach ($notifications as $notification) {
            echo "알림 ID: {$notification['id']}<br>";
            echo "메시지: {$notification['message']}<br>";
            echo "생성일: {$notification['created_at']}<br><br>";
        }
    } else {
        echo "읽지 않은 알림이 없습니다.<br>";
    }
}
?>
