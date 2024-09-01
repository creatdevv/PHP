<?php 

echo date("Y");                // 204
echo "<br>";
echo date("y");               // 24
echo "<br>";
echo date("M");               // Jan~Dec >> Jul
echo "<br>";
echo date("m");               // 01~12  >> 07
echo "<br>";
echo date("n");               // 1~12  >> 7
echo "<br>";
echo date("Y-m-d H:i:s");     // 2024-07-30 06:23:46

echo "<br>";
echo date('D');     // Mon ~ Sun  >> Tue
echo "<br>";
echo date('d');     // 01 ~ 31    >> 30
echo "<br>";
echo date('j');      // 1 ~ 31     >> 30
echo "<br>";
echo date("D");     // Mon ~ Sun   >> Tue
echo "<br>";
// echo date("N");     // 요일 1_월요일 ~ 7_일요일  숫자로 반환  >> 2

echo date("Y년 m월 d일 H시 i분 s초");

switch(date("N")) {
    case 1: $yoil = "월요일"; break;
    case 2: $yoil = "화요일"; break;
    case 3: $yoil = "수요일"; break;
    case 4: $yoil = "목요일"; break;
    case 5: $yoil = "금요일"; break;
    case 6: $yoil = "토요일"; break;
    case 7: $yoil = "일요일"; break;

}

echo "오늘은 $yoil 입니다";

?>
