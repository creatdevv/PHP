<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $message = $_POST['message'];
    $imageUrl = isset($_POST['image_url']) ? $_POST['image_url'] : null;

    $sql = "INSERT INTO messages (username, message, image_url, created_at) VALUES (:username, :message, :image_url, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    $stmt->bindValue(':message', $message, PDO::PARAM_STR);
    $stmt->bindValue(':image_url', $imageUrl, PDO::PARAM_STR);
    $stmt->execute();

    echo json_encode(['success' => true]);
    exit;
}
?>
