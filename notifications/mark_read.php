<?php
session_start();
include 'db.php';
include 'notification_functions.php';

// CSRF 토큰 검증
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    if (!isset($input['csrf_token']) || $input['csrf_token'] !== $_SESSION['csrf_token']) {
        http_response_code(403);
        echo json_encode(['status' => 'error', 'message' => 'CSRF 토큰 검증 실패']);
        exit;
    }

    $notification_id = filter_var($input['notification_id'], FILTER_VALIDATE_INT);
    $action = isset($input['action']) ? $input['action'] : 'read'; // 기본 동작은 읽음 처리

    if (!$notification_id) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => '유효하지 않은 알림 ID']);
        exit;
    }

    try {
        global $conn;
        // 알림 존재 여부 확인
        $stmt = $conn->prepare("SELECT * FROM notifications WHERE id = :id AND user_id = :user_id");
        $stmt->bindValue(':id', $notification_id, PDO::PARAM_INT);
        $stmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
        $stmt->execute();
        $notification = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$notification) {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => '알림을 찾을 수 없습니다.']);
            exit;
        }

        if ($action === 'read') {
            // 읽음 처리
            $update_stmt = $conn->prepare("UPDATE notifications SET is_read = 1 WHERE id = :id");
            $update_stmt->bindValue(':id', $notification_id, PDO::PARAM_INT);
            $update_stmt->execute();
            echo json_encode(['status' => 'success', 'message' => '알림이 읽음 처리되었습니다.']);
        } elseif ($action === 'delete') {
            // 삭제 처리
            $delete_stmt = $conn->prepare("DELETE FROM notifications WHERE id = :id");
            $delete_stmt->bindValue(':id', $notification_id, PDO::PARAM_INT);
            $delete_stmt->execute();
            echo json_encode(['status' => 'success', 'message' => '알림이 삭제되었습니다.']);
        } else {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => '유효하지 않은 작업 요청']);
        }
    } catch (Exception $e) {
        error_log("알림 처리 실패: " . $e->getMessage());
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => '알림 처리 중 오류 발생']);
    }
} else {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => '허용되지 않은 요청 방식']);
}
