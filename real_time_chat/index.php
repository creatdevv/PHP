<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
include 'db.php';
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>실시간 채팅</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <p>안녕하세요, <?php echo htmlspecialchars($_SESSION['username']); ?>님! <a href="logout.php">로그아웃</a></p>
    <div class="chat-container">
        <div class="chat-box" id="chatMessages">
            <!-- AJAX로 메시지 불러오기 -->
        </div>
        <form id="chatForm">
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
            <input type="hidden" name="username" value="<?php echo htmlspecialchars($_SESSION['username']); ?>">
            <input type="text" name="message" placeholder="메시지 입력" required>
            <button type="submit">전송</button>
        </form>
    </div>
    <script>
        function loadMessages() {
            fetch('fetch_messages.php')
                .then(response => response.json())
                .then(data => {
                    let output = '';
                    data.forEach(msg => {
                        output += `<div class="chat-message"><strong>${msg.username}:</strong> ${msg.message} <span class="timestamp">${msg.created_at}</span></div>`;
                    });
                    document.getElementById('chatMessages').innerHTML = output;
                    const chatBox = document.getElementById('chatMessages');
                    chatBox.scrollTop = chatBox.scrollHeight;
                });
        }
        document.getElementById('chatForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            fetch('post_message.php', { method: 'POST', body: formData })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        this.reset();
                        loadMessages();
                    }
                });
        });
        setInterval(loadMessages, 3000);
        loadMessages();
    </script>
</body>
</html>
