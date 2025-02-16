<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <title>실시간 채팅</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="chat-container">
    <div class="chat-box" id="chatMessages">
      <!-- AJAX로 메시지가 로드됩니다. -->
    </div>
    <form id="chatForm">
      <!-- 사용자 ID를 입력하게 해서 읽음 확인 기능에 사용합니다. -->
      <input type="number" id="user_id" name="user_id" placeholder="사용자 ID (숫자)" required>
      <input type="text" id="username" name="username" placeholder="이름" required>
      <input type="text" id="message" name="message" placeholder="메시지 입력" required>
      <button type="submit">전송</button>
    </form>
  </div>

  <script>
    function loadMessages() {
      fetch('fetch_messages.php')
        .then(response => response.json())
        .then(data => {
          const userId = document.getElementById('user_id').value;
          let output = '';
          data.forEach(msg => {
            output += `<div class="chat-message"><strong>${msg.username}:</strong> ${msg.message}`;
            // 내 메시지이면서 읽음 표시가 되면 '읽음' 표시
            if(userId && msg.user_id == userId && msg.is_read == 1){
              output += ` <span class="read-indicator">(읽음)</span>`;
            }
            output += ` <span class="timestamp">${msg.created_at}</span></div>`;
          });
          document.getElementById('chatMessages').innerHTML = output;
          const chatBox = document.getElementById('chatMessages');
          chatBox.scrollTop = chatBox.scrollHeight;
          
          // 현재 사용자의 메시지를 읽음 상태로 업데이트
          if(userId){
            fetch('mark_read.php', {
              method: 'POST',
              headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
              body: 'user_id=' + encodeURIComponent(userId)
            });
          }
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
