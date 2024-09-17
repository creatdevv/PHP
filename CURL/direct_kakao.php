<?php 
//# directsend 로 카카오톡 알림톡 연동하기, POST형식
define('DIRECTSEND_USERNAME', 'dkdkdkdk'      );
define('DIRECTSEND_APIKEY', 'dkdkdkdkdkdkdkkd');

$ch = curl_init();

$username           = DIRECTSEND_USERNAME;
$key                = DIRECTSEND_APIKEY;
$kakao_plus_id      = "왕초보홈페이지만들기";
$user_template_no   = "5";      //템플릿 번호 승인되면 여기에 입력

$arr = [];
$arr[] = array('mobile' =>  '01012341234');
$arr[] = array('mobile' =>  '01012341111');

$receiver = json_encode($arr);

$postarr = [
    "username"  => $username,
    "kakao_plus_id" => $kakao_plus_id,
    "user_template_no" => $user_template_no,
    "receiver" => $receiver,
    "key" => $key
];
$postvars = json_encode($postarr);

//URL
$url = "https://directsend.co.kr/index.php/api_v2/kakao_notice";

//헤더정보
$header = [];
$header[] = "cache-control: noo-cache";
$header[] = "content-type: application/json; charset=utf-8";

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);      // JSON 데이터
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
curl_setopt($ch, CURLOPT_TIMEOUT, 60);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
$respose = curl_exec($ch);

if(curl_errno($ch)) {
    $arr = ['result' => 'fail'];
    echo json_encode($arr);     // {"result": "fail"}
} else {
    $arr = ['result' => 'success'];
    echo json_encode($arr);     // {"result": "success"}
}

curl_close($ch);


?>