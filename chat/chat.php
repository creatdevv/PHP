<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['username']) && !empty($_POST['message'])) {
    $username = $_POST['username'];
    $message = $_POST['message'];

    try {
        $sql = "INSERT INTO chat_messages (username, message) VALUES (:username, :message)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->bindValue(':message', $message, PDO::PARAM_STR);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// 최신 메시지 20개 불러오기
$sql = "SELECT username, message, created_at FROM chat_messages ORDER BY created_at DESC LIMIT 20";
$stmt = $conn->prepare($sql);
$stmt->execute();
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>채팅방</title>
    <style>
        #chat-box { border: 1px solid #ccc; padding: 10px; width: 300px; height: 400px; overflow-y: scroll; }
        .message { margin-bottom: 10px; }
        .username { font-weight: bold; }
        .timestamp { font-size: small; color: gray; }
    </style>

<script>
    function fetchMessages() {
        fetch('fetch_messages.php')
            .then(response => response.json())
            .then(data => {
                const chatBox = document.getElementById('chat-box');
                chatBox.innerHTML = '';

                data.forEach(msg => {
                    const messageElement = document.createElement('div');
                    messageElement.classList.add('message');
                    messageElement.innerHTML = `
                        <span class="username">${msg.username}</span>:
                        <span>${msg.message}</span>
                        <div class="timestamp">(${msg.created_at})</div>
                    `;
                    chatBox.appendChild(messageElement);
                });

                chatBox.scrollTop = chatBox.scrollHeight; // 자동 스크롤
            });
    }

    setInterval(fetchMessages, 3000); // 3초마다 새 메시지 불러오기
</script>


</head>
<body>

<h2>채팅방</h2>
<div id="chat-box">
    <?php foreach (array_reverse($messages) as $msg): ?>
        <div class="message">
            <span class="username"><?= htmlspecialchars($msg['username']) ?></span>:
            <span><?= htmlspecialchars($msg['message']) ?></span>
            <div class="timestamp">(<?= $msg['created_at'] ?>)</div>
        </div>
    <?php endforeach; ?>
</div>

<form method="POST" action="chat.php">
    <label for="username">사용자 이름:</label><br>
    <input type="text" id="username" name="username" required><br>
    <label for="message">메시지:</label><br>
    <textarea id="message" name="message" rows="3" required></textarea><br>
    <button type="submit">전송</button>
</form>

</body>
</html>
