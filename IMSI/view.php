<?php 
include 'db.php';

$idx = $_GET["idx"];

$sql = "SELECT * FROM board WHERE idx = :idx";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':idx', $idx, PDO::PARAM_INT);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

// #pre : 나와있는 함수 그대로 출력하겠다.
// echo "<pre>";
// print_r($row);
// echo "</pre>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($row['subject']); ?></title>
</head>
<body>
    <p>제목 : <?php echo htmlspecialchars($row['subject']); ?></p>
    <p><?php echo nl2br(htmlspecialchars($row['content'])); ?></p>
</body>
</html>
