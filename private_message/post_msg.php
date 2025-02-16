<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 사용자 ID, 이름, 메시지 등을 받아서 저장 (사용자 ID는 채팅 읽음 확인에 필요)
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $message = $_POST['message'];

    if(empty($user_id) || empty($username) || empty($message)){
        echo json_encode(['success' => false, 'message' => '모든 필드를 입력하세요.']);
        exit;
    }

    $sql = "INSERT INTO messages (user_id, username, message) VALUES (:user_id, :username, :message)";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    $stmt->bindValue(':message', $message, PDO::PARAM_STR);
    $stmt->execute();

    echo json_encode(['success' => true]);
    exit;
}
?>
