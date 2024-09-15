<?php 
// #sms 보내기
include 'direct_config.php';

define('DIRECTSEND_SMSURL', 'https://directsend.co.kr/index.php/api_v2/sms_change_world');

$message = "가입을 축하드립니다.";
$sender = DIRECTSEND_SENDER;    // 다이렉트센드에 등록한 발신자 번호
$username = DIRECTSEND_USERNAMME;   // 다이렉트센드 id
$key = DIRECTSEND_APIKEY;   // 발급받은 API KEY

// # 수신자 번호
$r_array = [];
$r_array[] = ['mobile' => '01011112222', 'name' => '홍길동'];       // *실제 해당되는 번호들 넣으면 발송된다.(실제로 사업자번호 등록하고, 5천원정도 충전하면 몇만명 정도 보낼 수 있음-Post 방식)
$r_array[] = ['mobile' => '01011112223', 'name' => '김영희'];
$receiver = json_encode($r_array);  // [{'mobile' : '01011112222'}, {'mobile' : "010111112223'}];

$postarr = [
    "message" => $message,
    "sender" => $sender,
    "receiver" => $receiver,
    "key" => $key
];

$postvars = json_encode($postarr);

$headers = [];
$headers[] = "cache-control: no-cache";
$headers[] = "content-type: application/json; charset:utf-8";

// $headers = array("cache-control: no-cache", "content-type: application/json; charset:utf-8");

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, DIRECTSEND_SMSURL );
curl_setopt($ch, CURLOPT_POST, true             );   // get/post 방식 중 선택
curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars  );
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true   );
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3      );
curl_setopt($ch, CURLOPT_TIMEOUT, 60            );
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers   );

$response = curl_exec($ch);

if(curl_errno($ch)) {
    // echo "Curl error : ". curl_error($ch);
    $arr = ['result' => 'faile'];
    echo json_encode($arr);     // {"result": "fail"}

} else {
    $arr = ['result'=> 'success'];
    echo json_encode($arr);     // {"result": "success"}
}

curl_close($ch);


?>