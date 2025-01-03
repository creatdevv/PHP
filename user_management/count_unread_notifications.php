<?php
include 'db.php';

/**
 * 특정 사용자의 읽지 않은 알림 갯수 확인
 *
 * @param int $user_id 사용자 ID
 * @return int 읽지 않은 알림 갯수
 */
function count_unread_notifications($user_id) {
    global $conn;

    // 유효성 검사: 정수로 강제 변환 및 유효 범위 확인
    $user_id = filter_var($user_id, FILTER_VALIDATE_INT, [
        'options' => ['min_range' => 1]
    ]);

    if (!$user_id) {
        error_log("유효하지 않은 사용자 ID: " . json_encode($user_id));
        return 0;
    }

    try {
        $sql = "SELECT COUNT(*) as unread_count 
                FROM notifications 
                WHERE user_id = :user_id AND is_read = 0";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $unread_count = (int)$result['unread_count'];
            error_log("사용자 ID $user_id의 읽지 않은 알림 갯수: $unread_count");
            return $unread_count;
        } else {
            error_log("알림 갯수 조회 실패: 사용자 ID $user_id");
            return 0;
        }
    } catch (PDOException $e) {
        error_log("읽지 않은 알림 갯수 조회 중 오류: " . $e->getMessage());
        return 0;
    }
}

// 테스트 데이터 처리 여부
$enable_test = true;

if ($enable_test) {
    try {
        $test_user_id = 1; // 테스트용 사용자 ID
        $unread_count = count_unread_notifications($test_user_id);
        echo "사용자 ID $test_user_id의 읽지 않은 알림 갯수: $unread_count<br>";
    } catch (Exception $e) {
        error_log("테스트 알림 갯수 조회 중 오류: " . $e->getMessage());
        echo "테스트 알림 갯수 조회 중 오류가 발생했습니다.<br>";
    }
}
?>
