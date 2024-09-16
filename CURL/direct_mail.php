<?php 
// # directsend로 메일 보내기 , post 방식

$ch = curl_init();
$subject = '가입 환영합니다!!';
$body = '메일본문1<br>메일본문2<br>메일본문3';
$sender = DIRECTSEND_SENDERMAIL;
$sender_name = DIRECTSEND_SENDERNAME;
$username = DIRECTSEND_USERNAME;
$key = DIRECTSEND_APIKEY;

$arr = [];
$arr[] = ["email" => "a@a.com"];
$arr[] = ["email" => "b@b.com"];
$receiver = json_encode($arr);

$postarr = [
    "subject" => $subject,
    "body" => $body,
    "sender" => $sender,
    "sender_name" => $sender_name,
    "username" => $username,
    "receiver" => $receiver,
    "key" => $key
];
$postvars = json_encode($postarr);

// URL
$url = "https://directsend.co.kr/index.php/api_v2/mail_change_word";

// 헤더정보
$headers = [];
$headers[] = "cache-control: no-cache";
$headers[] = "content-type: application/json; charset=utf-8";

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);       // JSON epdlxj
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
curl_setopt($ch, CURLOPT_TIMEOUT, 60);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$response = curl_exec($ch);

if(curl_errno($ch)) {
    $arr = ['result' => 'fail'];
    echo json_encode($arr);      // {"result" : "fail"}

} else {
    $arr = ['result' => 'success'];
    echo json_encode($arr);     // {"result" : "success"}
}

curl_close($ch);

?>