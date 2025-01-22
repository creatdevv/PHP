<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $message = trim($_POST['message']);

    if (!empty($username) && !empty($message)) {
        $sql = "INSERT INTO messages (username, message, created_at) VALUES (:username, :message, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->bindValue(':message', $message, PDO::PARAM_STR);
        $stmt->execute();
    }
}

header('Location: index.php');
exit;
?>
