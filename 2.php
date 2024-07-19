<?php 

// strlen() 문자열 bytes 반환
// $x_len = strlen("한글");
// echo $x_len;  // 6 만 출력됨!(3바이트*2개=6)

// echo str_word_count("안녕 하세요 반갑 습니다");  // 0으로 출력됨 : 한글 동작안함 
echo str_word_count("Hello World");  //  2로 출력됨 : 영어일떈 스페이스 기준으로 1로 인식?!
echo strrev("Hello World"); // dlroW olleH 로 출력됨! : 단어 거꾸로!(reverse~~)

$a = strpos("Hello world", "world");
echo $a;        // 6 번째로 출력됨 >> 인덱스 0부터 시작되어 첫단어 스페이스 다음번에 것까지의 수?

// 실무 예제(이메일 주소)
// $email = "aaa@gmail.com";

// if(strpos($email)) {
//     echo "이메일 형식에 맞음";

// } else {
//     echo "이메일 형식이 잘못됨";
// }

?>
