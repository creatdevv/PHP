<?php
include 'db.php';

/**
 * 알림 읽음 처리 함수
 *
 * @param int|array $notification_ids 단일 알림 ID 또는 알림 ID 배열
 * @return array 처리된 알림 세부 정보 목록
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
        return [];
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

        // 처리된 알림 세부 정보 가져오기
        if ($stmt->rowCount() > 0) {
            $details_sql = "SELECT * FROM notifications WHERE id IN ($placeholders)";
            $details_stmt = $conn->prepare($details_sql);

            foreach ($notification_ids as $index => $id) {
                $details_stmt->bindValue($index + 1, $id, PDO::PARAM_INT);
            }

            $details_stmt->execute();
            $details = $details_stmt->fetchAll(PDO::FETCH_ASSOC);

            error_log("알림 읽음 처리 성공: " . json_encode($details));
            return $details;
        } else {
            error_log("알림 읽음 처리 실패(해당 알림이 없거나 이미 처리됨): " . json_encode($notification_ids));
            return [];
        }
    } catch (PDOException $e) {
        error_log("알림 읽음 처리 중 오류: " . $e->getMessage());
        return [];
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

// 테스트 데이터 삽입 여부
$enable_test = true;

if ($enable_test) {
    // 단일 알림 테스트
    $test_notification_id = 1;
    $result = mark_notification_as_read($test_notification_id);
    if (!empty($result)) {
        echo "알림 ID $test_notification_id 읽음 처리 성공: <br>";
        echo json_encode($result, JSON_PRETTY_PRINT) . "<br>";
    } else {
        echo "알림 ID $test_notification_id 읽음 처리 실패.<br>";
    }

    // 여러 알림 테스트
    $test_notification_ids = [2, 3, 4];
    $result = mark_notification_as_read($test_notification_ids);
    if (!empty($result)) {
        echo "알림 ID " . implode(', ', $test_notification_ids) . " 읽음 처리 성공: <br>";
        echo json_encode($result, JSON_PRETTY_PRINT) . "<br>";
    } else {
        echo "알림 ID " . implode(', ', $test_notification_ids) . " 읽음 처리 실패.<br>";
    }
}
?>
