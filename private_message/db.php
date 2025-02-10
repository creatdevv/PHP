CREATE TABLE IF NOT EXISTS private_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sender_id INT NOT NULL,
    receiver_id INT NOT NULL,
    message TEXT NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (sender_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (receiver_id) REFERENCES users(id) ON DELETE CASCADE
);


<!-- #테이블 역할:
sender_id: 보낸 사람 ID
receiver_id: 받는 사람 ID
message: 메시지 내용
timestamp: 보낸 시간 -->
