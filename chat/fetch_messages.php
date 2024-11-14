<?php
include 'db.php';

$sql = "SELECT username, message, created_at FROM chat_messages ORDER BY created_at DESC LIMIT 20";
$stmt = $conn->prepare($sql);
$stmt->execute();
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode(array_reverse($messages));
?>
