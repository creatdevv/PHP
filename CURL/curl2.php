<?php 

echo "<p>날씨 출력</p>";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://echo.jsontest.com/temperature/-9.3/humidity/0.40/wind/3');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

// #데이터 배열로 바꾸기
$arr = json_decode($response);

// 필요한 데이터만 출력
echo "Temperature: " . $arr->temperature . "<br>";
echo "Humidity: " . $arr->humidity . "<br>";
echo "Wind: " . $arr->wind . "<br>";

?>
