<?php
function update_notifications($type, $identifier, $conn) {
    $sql = $type === 'all' 
        ? "UPDATE notifications SET is_read = 1 WHERE user_id = :user_id"
        : "UPDATE notifications SET is_read = 1 WHERE id = :id";

    try {
        $stmt = $conn->prepare($sql);
        if ($type === 'all') {
            $stmt->bindValue(':user_id', $identifier, PDO::PARAM_INT);
        } else {
            $stmt->bindValue(':id', $identifier, PDO::PARAM_INT);
        }
        $stmt->execute();
    } catch (PDOException $e) {
        error_log("알림 읽음 처리 실패: " . $e->getMessage());
        throw new Exception("알림 읽음 처리 중 오류가 발생했습니다.");
    }
}
