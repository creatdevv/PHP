<?php 

echo "<p>날씨 출력</p>";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://echo.jsontest.com/temperature/-9.3/humidity/0.40/wind/3');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

// #데이터 배열로 바꾸기
$arr = json_decode($response);

//1) 필요한 데이터만 출력
// echo "Temperature: " . $arr->temperature . "<br>";
// echo "Humidity: " . $arr->humidity . "<br>";
// echo "Wind: " . $arr->wind . "<br>";

// 2) 필요한 데이터만 출력(짧은식)
// foreach($arr AS $key => $var) {
//     echo $key .':'. $var;
//     echo "<br>";
// }

?>
<table border="1">
<tr>
    <td>온도</td>
    <td><?= $arr->temperature; ?></td>
</tr>
<tr>
    <td>습도</td>
    <td><?= $arr->humidity; ?></td>
</tr>
<tr>
    <td>풍속</td>
    <td><?= $arr->wind; ?>m/s</td>
</tr>

</table>