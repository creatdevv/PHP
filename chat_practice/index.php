<?php
include 'db.php';

// 메시지 가져오기
$sql = "SELECT * FROM messages ORDER BY created_at ASC";
$stmt = $conn->query($sql);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>채팅</title>
    <link rel="stylesheet" href="style.css"> <!-- 스타일 시트 연결 -->
</head>
<body>
    <div class="chat-container">
        <div class="chat-box">
            <?php foreach ($messages as $message): ?>
                <div class="chat-message">
                    <strong><?= htmlspecialchars($message['username']) ?>:</strong>
                    <?= nl2br(htmlspecialchars($message['message'])) ?>
                    <span class="timestamp"><?= $message['created_at'] ?></span>
                </div>
            <?php endforeach; ?>
        </div>
        <form action="post_message.php" method="post" class="chat-form">
            <input type="text" name="username" placeholder="이름" required>
            <textarea name="message" placeholder="메시지를 입력하세요" required></textarea>
            <button type="submit">전송</button>
        </form>
    </div>
</body>
</html>
