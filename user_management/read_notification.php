<?php
include 'db.php';

/**
 * 알림 읽음 처리 함수
 *
 * @param int $notification_id 알림 ID
 * @return bool 성공 여부
 */
function mark_notification_as_read($notification_id) {
    global $conn;

    // 유효성 검사
    if (!is_int($notification_id) || $notification_id <= 0) {
        error_log("유효하지 않은 알림 ID: " . json_encode($notification_id));
        return false;
    }

    try {
        $sql = "UPDATE notifications SET is_read = 1 WHERE id = :notification_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':notification_id', $notification_id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            error_log("알림이 성공적으로 읽음 처리되었습니다: 알림 ID $notification_id");
            return true;
        } else {
            error_log("알림 읽음 처리 실패: 알림 ID $notification_id가 존재하지 않음");
            return false;
        }
    } catch (PDOException $e) {
        error_log("알림 읽음 처리 중 오류: " . $e->getMessage());
        return false;
    }
}

// 테스트 데이터 삽입 여부
$enable_test = true;

if ($enable_test) {
    $test_notification_id = 1; // 테스트용 알림 ID
    if (mark_notification_as_read($test_notification_id)) {
        echo "알림이 성공적으로 읽음 처리되었습니다.<br>";
    } else {
        echo "알림 읽음 처리 실패.<br>";
    }
}
?>
