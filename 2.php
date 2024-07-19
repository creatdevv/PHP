<?php 

// strlen() 문자열 bytes 반환
// $x_len = strlen("한글");
// echo $x_len;  // 6 만 출력됨!(3바이트*2개=6)

echo str_word_count("안녕 하세요 반갑 습니다");   // 0으로 출력됨 : 한글 동작 안함!

?>
