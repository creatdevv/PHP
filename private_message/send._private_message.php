<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sender_id = $_POST['sender_id'];
    $receiver_id = $_POST['receiver_id'];
    $message = $_POST['message'];
    
    if (empty($sender_id) || empty($receiver_id) || empty($message)) {
        echo json_encode(['success' => false, 'message' => '모든 필드를 입력해주세요.']);
        exit;
    }
    
    $sql = "INSERT INTO private_messages (sender_id, receiver_id, message) VALUES (:sender_id, :receiver_id, :message)";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':sender_id', $sender_id, PDO::PARAM_INT);
    $stmt->bindValue(':receiver_id', $receiver_id, PDO::PARAM_INT);
    $stmt->bindValue(':message', $message, PDO::PARAM_STR);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => '쪽지가 성공적으로 전송되었습니다.']);
    } else {
        echo json_encode(['success' => false, 'message' => '쪽지 전송에 실패했습니다.']);
    }
    exit;
}
