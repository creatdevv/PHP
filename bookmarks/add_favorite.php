<?php
include 'db.php';

$user_id = 1; // 임시 사용자 ID (로그인 기능과 연동 시 변경)
$item_id = intval($_GET['item_id']); // 즐겨찾기 대상 ID

try {
    // 중복 확인 및 추가
    $sql = "INSERT INTO favorites (user_id, item_id) VALUES (:user_id, :item_id)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':user_id' => $user_id,
        ':item_id' => $item_id
    ]);

    echo "즐겨찾기에 추가되었습니다.";
} catch (PDOException $e) {
    // 중복된 경우
    if ($e->getCode() == 23000) {
        echo "이미 즐겨찾기에 추가된 항목입니다.";
    } else {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!-- #데이터 베이스 테이블 생성: SQL
CREATE TABLE favorites (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL, -- 사용자 ID
    item_id INT NOT NULL, -- 즐겨찾기 대상 ID (게시글 ID 등)
    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- 추가 날짜
    UNIQUE (user_id, item_id) -- 중복 방지
);
 

-->