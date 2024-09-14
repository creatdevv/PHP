<?php 

echo "curl sample <br>";

$ch = curl_init();

// # URL 설정
// curl_setopt($ch, CURLOPT_URL, 'http://cbtti.or.kr');     //1-사이트: http 통신을 통해 한 것임
// curl_setopt($ch, CURLOPT_URL, 'https://phpschool.com/');   //2-사이트: 한글꺠져 나옴, 하단 한글 깨지지 않게 변경!
curl_setopt($ch, CURLOPT_URL, 'https://www.daum.net/');   // 3-사이트(얘는 같은 거라 그냥 response로 출력하기)

// 응답을 문자열로 반환받기
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// 인증서 검증을 비활성화
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

$response = curl_exec($ch);

if ($response === false) {
    // curl 오류 출력
    echo 'Curl error: ' . curl_error($ch);
} else {
    // #문자 인코딩 자동 감지 및 변환(해당사이트의 소스코드 확인후, 헤드밑의 이부분 찾아서 변환하기)
    // $response = mb_convert_encoding($response, 'UTF-8', 'EUC-KR'); // 1,2 사이트
    $response = mb_convert_encoding($response, 'UTF-8', 'auto');      // 3 사이트
    echo $response;            

}

curl_close($ch);
 

?>