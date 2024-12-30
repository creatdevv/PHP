<?php
include 'db.php';

/**
 * 특정 사용자의 읽지 않은 알림 조회 함수
 *
 * @param int $user_id 사용자 ID
 * @return array 읽지 않은 알림 목록
 */
function get_unread_notifications($user_id) {
    global $conn;

    // 유효성 검사
    if (!is_int($user_id) || $user_id <= 0) {
        error_log("유효하지 않은 사용자 ID: " . json_encode($user_id));
        return [];
    }

    try {
        $sql = "SELECT id, message, created_at 
                FROM notifications 
                WHERE user_id = :user_id AND is_read = 0 
                ORDER BY created_at DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $unread_notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($unread_notifications)) {
            error_log("읽지 않은 알림 조회 성공: 사용자 ID $user_id");
        } else {
            error_log("읽지 않은 알림이 없습니다: 사용자 ID $user_id");
        }

        return $unread_notifications;
    } catch (PDOException $e) {
        error_log("읽지 않은 알림 조회 중 오류: " . $e->getMessage());
        return [];
    }
}

// 테스트 데이터 조회 여부
$enable_test = true;

if ($enable_test) {
    $test_user_id = 1; // 테스트용 사용자 ID
    $unread_notifications = get_unread_notifications($test_user_id);

    if (!empty($unread_notifications)) {
        echo "읽지 않은 알림 목록:<br>";
        foreach ($unread_notifications as $notification) {
            echo "알림 ID: {$notification['id']}, 메시지: {$notification['message']}, 생성일: {$notification['created_at']}<br>";
        }
    } else {
        echo "읽지 않은 알림이 없습니다.<br>";
    }
}
?>
