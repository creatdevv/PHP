<?php 

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://cbtti.or.kr');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);


echo$response;

?>