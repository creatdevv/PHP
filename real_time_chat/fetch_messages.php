<?php
include 'db.php';

$sql = "SELECT * FROM messages ORDER BY created_at DESC";
$stmt = $conn->query($sql);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($messages as $message) {
    echo "<div class='chat-message'>";
    echo "<strong>" . htmlspecialchars($message['username']) . ":</strong> ";
    echo htmlspecialchars($message['message']);
    echo "<span class='timestamp'> (" . $message['created_at'] . ")</span>";
    echo "</div>";
}
?>
