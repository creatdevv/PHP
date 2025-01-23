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

<?php
// 메시지 출력 부분
foreach ($messages as $message) {
    echo "<div>";
    echo "<p><strong>" . htmlspecialchars($message['username']) . ":</strong> " . htmlspecialchars($message['message']) . "</p>";
    echo "<p><small>" . $message['created_at'] . "</small></p>";
    if ($message['user_id'] === $currentUserId) { // 현재 로그인한 사용자가 작성한 메시지만 삭제 가능
        echo "<form action='delete_message.php' method='POST' onsubmit='return confirm(\"정말 삭제하시겠습니까?\")'>\n";
        echo "    <input type='hidden' name='message_id' value='" . $message['id'] . "'>\n";
        echo "    <input type='hidden' name='user_id' value='" . $currentUserId . "'>\n";
        echo "    <button type='submit'>삭제</button>\n";
        echo "</form>\n";
    }
    echo "</div>";
}
?>

