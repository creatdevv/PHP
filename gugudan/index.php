<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>폼 입력을 통한 구구단 출력</title>
</head>
<body>
    <!-- <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>"> -->
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="">출력하고자 하는 단을 입력 바랍니다.</label>
        <input type="text" name="dan">
        <button>구구단 출력</button>
    </form>

    <?php
    // 1.[get방식] echo "구구단 출력을 해야함."; 
    // if(isset($_GET['dan']) and $_GET['dan'] != '') {
    //  // 숫자인지 아닌지 판단하는것 (a 입력할 수도 있으니깐)
    //     if(is_numeric($_GET['dan'])) {
             
    //         // 단
    //         for($i =1; $i <=9; $i++) {
    //         echo $_GET['dan'] . 'x'. $i . '=' . $_GET['dan'] * $i . '<br>';
    //     }

    //     } else {
    //         // 문자 입력시(숫자가 아닐시)
    //         echo "숫자를 입력해야 구구단 출력이 가능합니다. <br>";
    //     }


            // 2.[post방식] echo "구구단 출력을 해야함."; 
    if(isset($_POST['dan']) and $_POST['dan'] != '') {
        // 숫자인지 아닌지 판단하는것 (a 입력할 수도 있으니깐)
           if(is_numeric($_POST['dan'])) {
                
               // 단
               for($i =1; $i <=9; $i++) {
               echo $_POST['dan'] . 'x'. $i . '=' . $_POST['dan'] * $i . '<br>';
           }
   
           } else {
               // 문자 입력시(숫자가 아닐시)
               echo "숫자를 입력해야 구구단 출력이 가능합니다. <br>";
           }
    

       
    }

    ?>


</body>
</html>