<?php 

// echo "여기";
require "db.php";

$sql = "SELECT * FROM `todolist` order by idx desc";
$stmt = $conn->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$rs = $stmt->fetchAll();

print_r($rs);
exit;

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>할일 관리</title>
    <script src="todolist.js"></script>

</head>
<body>
    <form name="todoform" method="POST" action="todolist_ok.php" autocomplete="off">
        <input type="hidden" name="mode" value="input">
        할일: <input type="text" name="subject" id="subject" autocomplete="off">
        <input type="button" id="todobtn" value="등록">
    </form>
    <table border="1" width="600">
    <?php 
        foreach($rs AS $row) {
            // print_r($row);       //확인
            echo "
            <tr>
                <td>".$row['subject'] ."</td>
                <td><button onclick='todoCheck(".$row['idx'].")'>확인</button></td>
            </tr>
            ";
        }
    ?>
    </table>
        <form method="POST" id="multiform" action="todolist_ok.php">
            <input type="hidden" name="idx" value="">
            <input type="hidden" name="mode">
        </form>

</body>
</html>