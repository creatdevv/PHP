<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
// 전역변수
// 로컬변수 (지역변수)

$x = 5;

function myTest() {
    global $x;
    echo "변수 x의 출력값 $x";
    echo "<br>";
}

myTest();

echo "변수 x의 출력값 $x";

?>


</body>
</html>

