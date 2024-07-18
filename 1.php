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

$x = 5;     # 이 x는 바깥쪽에 있는 변수가 되는 것이다!

function myTest() {
    $x =3;
    echo "변수 x의 출력값 $x";
    echo "<br>";
    $x++;
# >> x값 정하고, 증감식 표현 : x는 현재 함수안에서만 사용되는 지역변수가 되어서 여기에서의 x = 3이 나온다!
}

myTest();

echo "변수 x의 출력값 $x";

?>


</body>
</html>

