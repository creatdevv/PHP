<?php
include 'db.php';

$id = $_GET['id'];
$sql = "DELETE FROM freeboard WHERE idx = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$id]);

header("Location: 001.php");
exit;
?>
