<?php 

// strlen() 문자열 bytes 반환
// $x_len = strlen("한글");
// echo $x_len;  // 6 만 출력됨!(3바이트*2개=6)

// echo str_word_count("안녕 하세요 반갑 습니다");  // 0으로 출력됨 : 한글 동작안함 
// echo str_word_count("Hello World");  //  2로 출력됨 : 영어일떈 스페이스 기준으로 1로 인식?!
// echo strrev("Hello World"); // dlroW olleH 로 출력됨! : 단어 거꾸로!(reverse~~)
// $a = strpos("Hello world", "world");
// echo $a;        // 6 번째로 출력됨 >> 인덱스 0부터 시작되어 첫단어 스페이스 다음번에 것까지의 수?

// 실무 예제(이메일 주소)

$email = "aaa@gmail.com";   //aaa.gmail.com >> 2경우) 이메일 형식이 잘못됨으로 출력됨!

if (strpos($email, '@')) {   // 1) $email 만 입력하면, 출력안된다. 이유는, 밑에 설명!
    echo "이메일 형식에 맞음";
} else {
    echo "이메일 형식이 잘못됨";
}

/* >> 1-2) 결과적으로 이메일 형식에 맞음 이 출력된다. email 만 입력하면 출력 안되는 이유는,
strpos 함수는 두 번째 인수로 검색할 문자열을 받는다. strpos 함수는 특정 문자열 내에서 주어진 문자열이 처음 나타나는 위치를 반환한다.
strpos 함수는 일치하는 문자열이 없으면 false를 반환하고, 일치하는 문자열이 있으면 해당 문자열의 시작 위치를 반환한다.
여기서 중요한 점은, strpos 함수가 0을 반환할 수 있다는 것~
*/


?>

