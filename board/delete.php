<?php
include 'db.php';

$id = $_GET['id'];
$sql = "DELETE FROM posts WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$id]);

header("Location: list.php");
exit;
?>
