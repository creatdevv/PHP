<?php 

// echo "여기";

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
    <form name="todoform" action="todolist_ok.php">
        할일: <input type="text" name="subject" id="subject" autocomplete="off">
        <input type="button" id="todobtn" value="등록">
 

    </form>
</body>
</html>