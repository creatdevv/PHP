<?php
include 'db.php';

/**
 * 알림 읽음 처리 함수
 *
 * @param int|array $notification_ids 단일 알림 ID 또는 알림 ID 배열
 * @return int 처리된 알림 개수
 */
function mark_notification_as_read($notification_ids) {
    global $conn;

    // 알림 ID 배열로 변환
    if (is_int($notification_ids)) {
        $notification_ids = [$notification_ids];
    }

    // 유효성 검사
    if (!is_array($notification_ids) || empty($notification_ids) || !all_positive_integers($notification_ids)) {
        error_log("유효하지 않은 알림 ID 목록: " . json_encode($notification_ids));
        return 0;
    }

    try {
        // 알림 ID를 플래이스홀더로 변환
        $placeholders = implode(',', array_fill(0, count($notification_ids), '?'));
        $sql = "UPDATE notifications 
                SET is_read = 1 
                WHERE id IN ($placeholders)";
        $stmt = $conn->prepare($sql);

        // ID 바인딩
        foreach ($notification_ids as $index => $id) {
            $stmt->bindValue($index + 1, $id, PDO::PARAM_INT);
        }

        $stmt->execute();

        // 처리된 행 개수 반환
        $affected_rows = $stmt->rowCount();
        if ($affected_rows > 0) {
            error_log("알림 읽음 처리 성공: " . json_encode($notification_ids));
        } else {
            error_log("알림 읽음 처리 실패(해당 알림이 없거나 이미 처리됨): " . json_encode($notification_ids));
        }

        return $affected_rows;
    } catch (PDOException $e) {
        error_log("알림 읽음 처리 중 오류: " . $e->getMessage());
        return 0;
    }
}

/**
 * 배열이 양의 정수로만 구성되었는지 확인
 *
 * @param array $array 검사할 배열
 * @return bool
 */
function all_positive_integers(array $array) {
    foreach ($array as $value) {
        if (!is_int($value) || $value <= 0) {
            return false;
        }
    }
    return true;
}

// 테스트 데이터 처리 여부
$enable_test = true;

if ($enable_test) {
    // 단일 알림 테스트
    $test_notification_id = 1;
    $result = mark_notification_as_read($test_notification_id);
    if ($result > 0) {
        echo "알림 ID $test_notification_id 읽음 처리 성공.<br>";
    } else {
        echo "알림 ID $test_notification_id 읽음 처리 실패.<br>";
    }

    // 여러 알림 테스트
    $test_notification_ids = [2, 3, 4];
    $result = mark_notification_as_read($test_notification_ids);
    echo "알림 ID " . implode(', ', $test_notification_ids) . " 처리된 개수: $result<br>";
}
?>
