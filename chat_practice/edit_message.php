<?php
include 'db.php';

// 메시지 수정 요청 처리
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $messageId = $_POST['message_id'];
    $userId = $_POST['user_id']; // 로그인 시스템과 연동 시 필요
    $newMessage = $_POST['new_message'];
    
    // 메시지 작성자 확인 후 수정
    $sql = "UPDATE messages SET message = :new_message WHERE id = :id AND user_id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':new_message', $newMessage, PDO::PARAM_STR);
    $stmt->bindValue(':id', $messageId, PDO::PARAM_INT);
    $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => '메시지가 수정되었습니다.']);
    } else {
        echo json_encode(['success' => false, 'message' => '메시지 수정에 실패했습니다.']);
    }
    exit;
}
?>