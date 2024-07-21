<?php 

// 1. if 문, ifElseifElse문, 중첩 if문

/* if (조건문) {
    만족할 떄 처리
} else {
    반대의 경우 처리
}
*/


$a = 90;
$b = "여자";

if($a >=90) {
    if($b == "여자") {
        echo "당신은 A 이고, 여자입니다.";
    }

} else if($a >=80) {
    echo "당신은 B입니다.";

} else if($a >=70) {
    echo "당신은 C입니다.";

} else {
   echo "아쉽군요. 다음 번엔 더 잘 할 수 있을거에요~! "; 

}

// 2. switch 문

// $a = 1;              // 가위입니다 출력됨
$a = rand(1,4);         // 난수 1~4수 나오므로, 랜덤으로 다 나옴~!
// $color = "red";         // case 를 숫자가 아닌 문자열로도 변경해서 설정할 수 있음!

switch($a) {
    case 1 :
        echo "가위입니다";
        break;
    case 2 :
        echo "바위입니다";
        break;
    case 3 :
        echo "보자기 입니다.";
        break;
    default:
        echo "범위를 벗어났습니다.";
} 


?>
