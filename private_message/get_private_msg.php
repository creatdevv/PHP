복붙하기~<?php
include 'db.php';

// GET 파라미터로 현재 사용자와 대화 상대의 ID를 받아옴
if (isset($_GET['user_id']) && isset($_GET['partner_id'])) {
    $user_id = $_GET['user_id'];
    $partner_id = $_GET['partner_id'];

    // 두 사용자 간의 대화 내용을 가져오는 쿼리
    $sql = "SELECT * FROM private_messages 
            WHERE (sender_id = :user_id AND receiver_id = :partner_id)
               OR (sender_id = :partner_id AND receiver_id = :user_id)
            ORDER BY timestamp ASC";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindValue(':partner_id', $partner_id, PDO::PARAM_INT);
    $stmt->execute();
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 결과를 JSON 형식으로 출력
    echo json_encode($messages);
} else {
    // 필요한 매개변수가 없을 경우 오류 메시지 반환
    echo json_encode(['success' => false, 'message' => '필요한 매개변수가 없습니다.']);
}
?>
