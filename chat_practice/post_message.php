<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $message = $_POST['message'];
    $image_url = $_POST['image_url'] ?? null;

    $sql = "INSERT INTO messages (username, message, image_url) VALUES (:username, :message, :image_url)";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    $stmt->bindValue(':message', $message, PDO::PARAM_STR);
    $stmt->bindValue(':image_url', $image_url, PDO::PARAM_STR);
    $stmt->execute();

    echo json_encode(['success' => true]);
    exit;
}

echo json_encode(['success' => false]);
?>
