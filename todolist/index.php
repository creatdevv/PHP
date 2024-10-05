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

            if($row['status'] == 1) {
                $class = "style='text-decoration:line-through'";
                $btn = "<button onclick='todoUnCheck(".$row['idx'].")'>취소</button>";       //#취소선을 취소 빌드업을 이쪽으로 옮겨서, 통합버튼 만들어주기!
                
            } else {
                $class = "";
                $btn = "<button onclick='todoCheck(".$row['idx'].")'>확인</button>";         //#취소선 빌드업 이쪽으로 옮겨서, 통합버튼 만들어주기!
                
            }

            echo "
            <tr>
                <td $class>".$row['subject'] ."</td>
                // <td><button onclick='todoCheck(".$row['idx'].")'>확인</button></td>        //#취소선 빌드업
                // <td><button onclick='todoUnCheck(".$row['idx'].")'>취소</button></td>     //#취소선을 취소 빌드업
                <td>".$btn."</td>           //#취소선,취소선취소 기능 통합버튼(2기능,1버튼)
                <td><button onclick='todo_del(".$row['idx']."]')>삭제</button></td>     //#삭제버튼 빌드업 
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