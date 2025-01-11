<?php
session_start();
include 'db.php';
include 'notification_functions.php';

// 로그 기록 함수
function log_notification_action($user_id, $action) {
    $log_file = 'notification_logs.txt';
    $timestamp = date('Y-m-d H:i:s');
    $log_message = "User ID: $user_id performed action: $action at $timestamp\n";
    file_put_contents($log_file, $log_message, FILE_APPEND);
}

// 요청 처리
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CSRF 토큰 검증
    if (!isset($_POST['csrf_token'], $_SESSION['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("CSRF 토큰 검증 실패. 다시 로그인하거나 요청을 확인해주세요.");
    }

    // 사용자 ID 확인
    if (!isset($_SESSION['user_id'])) {
        die("로그인되지 않은 사용자입니다.");
    }

    $user_id = $_SESSION['user_id'];

    try {
        // 모든 알림 읽음 처리
        update_notifications('all', $user_id, $conn);
        log_notification_action($user_id, 'Marked all notifications as read'); // 로그 기록
        $_SESSION['success_message'] = "모든 알림이 읽음 처리되었습니다.";
        header("Location: notifications.php");
        exit;
    } catch (Exception $e) {
        // 오류 로그 기록 및 메시지 출력
        error_log("알림 읽음 처리 오류: " . $e->getMessage());
        $_SESSION['error_message'] = "알림 처리 중 오류가 발생했습니다. 잠시 후 다시 시도해주세요.";
        header("Location: notifications.php");
        exit;
    }
}
?>
