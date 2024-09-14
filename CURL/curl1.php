<?php 

echo "curl sample <br>";

$ch = curl_init();

// # URL 설정
// curl_setopt($ch, CURLOPT_URL, 'http://cbtti.or.kr');     //http 통신을 통해 한 것임
curl_setopt($ch, CURLOPT_URL, 'https://phpschool.com/');     //다른사이트(한글꺠져 나옴). 하단 한글 깨지지 않게 변경!

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
    // 문자 인코딩 자동 감지 및 변환(해당사이트의 소스코드 확인후, 헤드밑의 이부분 찾아서 변환하기)
    $response = mb_convert_encoding($response, 'UTF-8', 'EUC-KR');
    echo $response;
}

curl_close($ch);



// echo$response;

?>