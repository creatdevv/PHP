<?php
include 'db.php';

// GET 파라미터로 현재 사용자와 대화 상대의 ID를 받아옵니다.
// 예시: private_messages.php?sender_id=1&receiver_id=2
$sender_id = isset($_GET['sender_id']) ? $_GET['sender_id'] : 1;
$receiver_id = isset($_GET['receiver_id']) ? $_GET['receiver_id'] : 2;
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <title>쪽지함</title>
  <link rel="stylesheet" href="style.css">
  <style>
    /* 쪽지함 전용 스타일 (필요에 따라 style.css에 추가해도 됩니다.) */
    .pm-container {
      max-width: 600px;
      margin: 20px auto;
      background: #fff;
      padding: 20px;
      border: 1px solid #ddd;
      border-radius: 8px;
    }
    .pm-messages {
      height: 400px;
      overflow-y: auto;
      border: 1px solid #ddd;
      padding: 10px;
      margin-bottom: 10px;
      background-color: #f9f9f9;
    }
    .pm-message {
      margin-bottom: 10px;
      padding: 5px;
      border-bottom: 1px solid #eee;
    }
    .pm-message strong {
      color: #007BFF;
    }
    .pm-message small {
      color: #999;
      margin-left: 10px;
    }
    .pm-form input,
    .pm-form textarea,
    .pm-form button {
      margin: 5px 0;
      padding: 10px;
      width: 100%;
      box-sizing: border-box;
    }
    .pm-form button {
      background-color: #007BFF;
      color: white;
      border: none;
      cursor: pointer;
    }
    .pm-form button:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <div class="pm-container">
    <h2>쪽지함</h2>
    <div class="pm-messages" id="pmMessages">
      <!-- 쪽지 내용이 AJAX로 불러와집니다. -->
    </div>
    <form id="pmForm" class="pm-form">
      <!-- 현재 사용자와 대화 상대 ID를 숨김 필드로 전달 -->
      <input type="hidden" name="sender_id" value="<?= htmlspecialchars($sender_id) ?>">
      <input type="hidden" name="receiver_id" value="<?= htmlspecialchars($receiver_id) ?>">
      <textarea name="message" placeholder="쪽지 내용을 입력하세요" required></textarea>
      <button type="submit">쪽지 전송</button>
    </form>
  </div>

  <script>
    // 쪽지 목록을 불러오는 함수
    function loadPrivateMessages() {
      const senderId = <?= json_encode($sender_id) ?>;
      const receiverId = <?= json_encode($receiver_id) ?>;
      fetch(`get_private_messages.php?user_id=${senderId}&partner_id=${receiverId}`)
        .then(response => response.json())
        .then(data => {
          let output = '';
          data.forEach(msg => {
            // sender_id가 현재 사용자와 같으면 '나', 아니면 '상대방'으로 표시
            const senderLabel = (msg.sender_id == senderId) ? '나' : '상대방';
            output += `<div class="pm-message"><strong>${senderLabel}</strong>: ${msg.message} <small>${msg.timestamp}</small></div>`;
          });
          document.getElementById('pmMessages').innerHTML = output;
          // 쪽지함 스크롤을 맨 아래로 이동
          const pmMessagesDiv = document.getElementById('pmMessages');
          pmMessagesDiv.scrollTop = pmMessagesDiv.scrollHeight;
        });
    }

    // 쪽지 전송 처리
    document.getElementById('pmForm').addEventListener('submit', function(e) {
      e.preventDefault();
      const formData = new FormData(this);
      fetch('send_private_message.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          loadPrivateMessages();
          // 전송 후 입력 필드 초기화
          document.querySelector('textarea[name=\"message\"]').value = '';
        } else {
          alert('쪽지 전송 실패: ' + data.message);
        }
      });
    });

    // 3초마다 쪽지 목록을 갱신
    setInterval(loadPrivateMessages, 3000);
    loadPrivateMessages();
  </script>
</body>
</html>
