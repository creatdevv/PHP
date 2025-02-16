<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 현재 사용자의 ID를 받아, 자신이 보낸 메시지가 아닌 나머지 메시지를 '읽음' 처리
    $user_id = $_POST['user_id'];

    $sql = "UPDATE messages SET is_read = 1 WHERE user_id <> :user_id AND is_read = 0";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    
    if($stmt->execute()){
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => '읽음 상태 업데이트 실패']);
    }
    exit;
}
?>
