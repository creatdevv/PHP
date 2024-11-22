<?php
include 'db.php';

$favorite_id = intval($_GET['favorite_id']); // 즐겨찾기 ID

try {
    // 즐겨찾기 항목 삭제
    $sql = "DELETE FROM favorites WHERE id = :favorite_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':favorite_id' => $favorite_id]);

    echo "즐겨찾기에서 삭제되었습니다.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
