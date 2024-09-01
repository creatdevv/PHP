<?php 

// # 파일의 확장자 구하는 함수 만들기
// D:\xampp\htdocs\file_gallery

// * explode() 함수
// 지정된 문자로 문자열을 잘라서 배열을 만들게 도와줌.


// $str = "a,b,c,d";

// $arr = explode(',', $str);
// $arr = ['a','b','c','d'];
// $arr = array('a','b','c','d');      // php에서 사용하는 방법
// print_r($arr);



// * count() 함수
// 배열의 크기를 구하는 함수
// echo count($arr);


// * end() 함수     - 많이 사용하진 않지만, 편리한 함수
// 배열의 마지막 값을 리턴, 구해줍니다.

// echo end($arr);

// $file_name = "aaa.bbbb.xlsx";        - return 값에~

// $arr = explode(',' $file_name);      - 결과값
// $ext = end($arr);
// echo $ext;


$str = "abb.ccc.jpg";
// $arr = explode(',', $str);      // , 하면 Array ( [0] => abb.ccc.jpg ) jpg 출력
$arr = explode('.', $str);      //. 하면 Array ( [0] => abb [1] => ccc [2] => jpg ) jpg 출력

$arr_size =  count($arr);   // 3

$ext = $arr[$arr_size -1];      // 인덱스 0부터 시작되니깐 0 - 1로 나옴

// print_r($arr);
echo $ext;          // jpgjpg 출력


// *사용자 정의 함수
function getFileExt2($file_name){
    $arr = explode('.', $file_name);    // *내장함수
    $arr_size = count($arr);    //3
    // $ext = $arr[$arr_size -1];
    return $arr[count($arr) -1];
    // return $ext;
}
$str = "aaa.ccc.jpg";
$ext = getFileExt2($file_nam);
echo $ext;



// ** function 함수이름(매개변수) {
//      return 결과
// }
function getFileExt($file_name){
    $arr = explode('.', $file_name);
    $ext = end($arr);
    return $ext;
}

$file_name = "aaa.bbbb.xlsx";       // xlsx 출력
$file_name = "photo.jpg";           // jpg 출력

$ext = getFileExt($file_name);

echo $ext;
?>
