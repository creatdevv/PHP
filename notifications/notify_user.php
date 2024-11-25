<?php
include 'db.php';

function notify_user($user_id, $message) {
    global $conn;
    $sql = "INSERT INTO notifications (user_id, message) VALUES (:user_id, :message)";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindValue(':message', $message, PDO::PARAM_STR);
    $stmt->execute();
}
?>
