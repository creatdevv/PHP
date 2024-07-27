<!--# 정규표현식(특정문자로 시작하는, 특정문자로 끝나는)-->

<style>
    span {color: white; background-color: red;}
    * {line-height: 1; margin: 0;}
    h3 {color: lightgray;}
</style>

<?php 

// *예시1
$string = "Hello Wolrd!";
$pattern = '/hel lo/i';         // i 는 대소문자, 공백 등을 구분해준다(글자수)

// preg_match($pattern, $string, $result);
$cnt = preg_match($pattern, $string, $result);

// var_dump($result);
echo $cnt;

// *예시2
$string = "who is who";         // target string!!(기준)
$pattern = '/^who/';            //^로 시작하는 문자열   
$pattern = '/o$/';             // $앞으로 끝내는 문자열        
// **의미: / / 는 문자열의 시작과 끝을 알리는 것이고, ^ 뒤에 나오는 문자열로 시작할때를 표시할때 쓰임, $는 특정문자로 끝나는 문자열 마감 표시
// 예를 들어, ^A : A로 시작하는 문자열 찾기
// 예를 들어, A$ : A로 끝나는 문자열 찾기

$string = "$12$ \-\ $25$";  // target string
$pattern = "/^$/";      // >> $12$ \-\ $25$ 출력됨(문자열 자체)
$pattern = '/^\$12/';      // '\/' 앞에 있는거 찾아준다.
$pattern = '/\$$/';      // $찾기


// * any . : . 개수만큼 문자열 선택되고, replacement의 문자열로 개수만큼 대체되고 나머지 문자 나열됨
// * [] : 브라켓, 브라켓 안에 있는 글자 사이 문자열은 다 찾아냄(중복 브라켓 가능)
$string = "Regualr expressions4";   // target string
$pattern = '/...../';       // 1개의 문자씩 대체
$pattern = '^R.q/';       // R로 시작되고, 1문자씩 대체

$string = "How do you do?";     // target string
$pattern = '/[oyu][yow]/';



echo "<h3>before:</h3>";
echo $string;

echo "<p> &nbsp; </p>";

echo "<h3>after:</h3>";

// replace 변경할것임~!! 마지막 $찾기 부분이 여기있네 로 변경됨
// $replacement = "!!";
// $replacement = "<span>여기있네</span>";
$replacement = "<span>=</span>";

echo preg_replace($pattern, $replacement, $string);



?>