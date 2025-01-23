<?php
include 'db.php';

// 메시지 삭제 요청 처리
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $messageId = $_POST['message_id'];
    $userId = $_POST['user_id']; // 사용자 ID는 로그인 시스템과 연동되었을 때 사용

    // 메시지 작성자 확인 후 삭제
    $sql = "DELETE FROM messages WHERE id = :id AND user_id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id', $messageId, PDO::PARAM_INT);
    $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => '메시지가 삭제되었습니다.']);
    } else {
        echo json_encode(['success' => false, 'message' => '메시지 삭제에 실패했습니다.']);
    }
    exit;
}
?>
