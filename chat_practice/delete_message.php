<?php
include 'db.php';

// 메시지 삭제 요청 처리
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $messageId = $_POST['message_id'];
        
        // 로그인 시스템이 있는 경우 사용자 ID 확인 (주석 해제 가능)
        // $userId = $_POST['user_id']; 
        
        // 메시지 삭제 쿼리 실행
        $sql = "DELETE FROM messages WHERE id = :id"; 
        // 로그인 시스템이 있다면 아래 주석 해제
        // $sql .= " AND user_id = :user_id";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $messageId, PDO::PARAM_INT);
        // 로그인 시스템이 있다면 아래 주석 해제
        // $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => '메시지가 삭제되었습니다.']);
        } else {
            echo json_encode(['success' => false, 'message' => '메시지 삭제에 실패했습니다.']);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => '오류 발생: ' . $e->getMessage()]);
    }
    exit;
} else {
    echo json_encode(['success' => false, 'message' => '잘못된 요청입니다.']);
    exit;
}
