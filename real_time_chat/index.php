<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>실시간 채팅</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="chat-container">
        <div class="chat-box" id="chatMessages"></div>

        <form id="chatForm">
            <input type="text" id="username" name="username" placeholder="이름" required>
            <input type="text" id="message" name="message" placeholder="메시지 입력" required>
            <button type="submit">전송</button>
        </form>
    </div>

    <script>
        function loadMessages() {
            fetch('fetch_messages.php')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('chatMessages').innerHTML = data;
                });
        }

        document.getElementById('chatForm').addEventListener('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(this);

            fetch('post_message.php', { method: 'POST', body: formData })
                .then(response => response.text())
                .then(() => {
                    this.reset();
                    loadMessages();
                });
        });

        setInterval(loadMessages, 3000);
        loadMessages();
    </script>
</body>
</html>
