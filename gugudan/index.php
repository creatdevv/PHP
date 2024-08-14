<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>폼 입력을 통한 구구단 출력</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="">출력하고자 하는 단을 입력 바랍니다.</label>
        <input type="text" name="dan">
        <button>구구단 출력</button>
    </form>

    <?php 
    if(isset($_GET['dan']) and $_GET['dan'] != '') {
        // echo "구구단 출력을 해야함.";

        // 단
        for($i =1; $i <=9; $i++) {
            echo $_GET['dan'] . 'x'. $i . '=' . $_GET['dan'] * $i . '<br>';
        }
    }

    ?>


</body>
</html>