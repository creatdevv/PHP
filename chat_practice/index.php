<form id="chatForm">
    <input type="text" id="username" name="username" placeholder="이름" required>
    <input type="text" id="message" name="message" placeholder="메시지 입력" required>
    
    <input type="file" id="image" name="image" accept="image/*">
    <button type="button" id="uploadButton">이미지 업로드</button>
    
    <input type="hidden" id="image_url" name="image_url">
    
    <button type="submit">전송</button>
</form>

<div id="chatMessages"></div>

<script>
    document.getElementById('uploadButton').addEventListener('click', function () {
        const fileInput = document.getElementById('image');
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

<?php
include 'db.php';

$sql = "SELECT * FROM messages ORDER BY created_at DESC";
$stmt = $conn->query($sql);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div id="chatMessages">
    <?php foreach ($messages as $message): ?>
        <div>
            <p><strong><?= htmlspecialchars($message['username']) ?>:</strong> <?= htmlspecialchars($message['message']) ?></p>
            <?php if (!empty($message['image_url'])): ?>
                <img src="<?= htmlspecialchars($message['image_url']) ?>" alt="첨부 이미지" width="200">
            <?php endif; ?>
            <p><small><?= $message['created_at'] ?></small></p>
        </div>
    <?php endforeach; ?>
</div>
