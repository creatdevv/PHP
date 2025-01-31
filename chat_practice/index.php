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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>실시간 채팅</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>실시간 채팅</h1>

    <form id="chatForm">
        <input type="text" id="username" name="username" placeholder="이름" required>
        <input type="text" id="message" name="message" placeholder="메시지 입력" required>
        
        <input type="file" id="image" name="image" accept="image/*">
        <button type="button" id="uploadButton">이미지 업로드</button>
        <input type="hidden" id="image_url" name="image_url">

        <button type="submit">전송</button>
    </form>

    <div id="chatMessages">
        <?php foreach ($messages as $message): ?>
            <div class="message">
                <p><strong><?= htmlspecialchars($message['username']) ?>:</strong> <?= htmlspecialchars($message['message']) ?></p>
                <?php if (!empty($message['image_url'])): ?>
                    <img src="<?= htmlspecialchars($message['image_url']) ?>" alt="첨부 이미지" width="200">
                <?php endif; ?>
                <p><small><?= $message['created_at'] ?></small></p>
            </div>
        <?php endforeach; ?>
    </div>

    <script>
        document.getElementById('uploadButton').addEventListener('click', function () {
            const fileInput = document.getElementById('image');
            if (!fileInput.files.length) {
                alert('이미지를 선택하세요.');
                return;
            }

            const formData = new FormData();
            formData.append('image', fileInput.files[0]);

            fetch('upload.php', { method: 'POST', body: formData })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('image_url').value = data.url;
                        alert('이미지 업로드 성공!');
                    } else {
                        alert('업로드 실패: ' + data.message);
                    }
                });
        });

        document.getElementById('chatForm').addEventListener('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(this);

            fetch('post_message.php', { method: 'POST', body: formData })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('메시지 전송 완료!');
                        location.reload();
                    } else {
                        alert('메시지 전송 실패');
                    }
                });
        });
    </script>
</body>
</html>
