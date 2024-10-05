<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kingchobo";

try {
    $conn = new PDO("mysql:host=localhost;dbname=yourdbname", "username", "password");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "DB connection successful!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}

?>