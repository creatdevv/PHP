<?php
include 'db.php';
$sql = "SELECT * FROM messages ORDER BY created_at DESC";
$stmt = $conn->query($sql);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>채팅</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="chat-container">
        <div class="chat-box" id="chatMessages">
            <?php foreach ($messages as $message): ?>
                <div class="chat-message">
                    <strong><?= htmlspecialchars($message['username']) ?>:</strong>
                    <?= htmlspecialchars($message['message']) ?>
                    <span class="timestamp">(<?= $message['created_at'] ?>)</span>
                </div>
            <?php endforeach; ?>
        </div>

        <form id="chatForm">
            <input type="text" id="username" name="username" placeholder="이름" required>
            <input type="text" id="message" name="message" placeholder="메시지 입력" required>
            
            <button type="button" id="emojiButton">😀</button>
            <div id="emojiPicker" style="display:none;">
                <?php include 'emoji_list.php'; ?>
            </div>

            <button type="submit">전송</button>
        </form>
    </div>

    <script>
        document.getElementById('emojiButton').addEventListener('click', function() {
            let picker = document.getElementById('emojiPicker');
            picker.style.display = picker.style.display === 'none' ? 'block' : 'none';
        });

        document.querySelectorAll('.emoji').forEach(item => {
            item.addEventListener('click', function() {
                document.getElementById('message').value += this.textContent;
            });
        });
    </script>
</body>
</html>
