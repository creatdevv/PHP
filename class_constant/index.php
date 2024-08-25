<?php 
// PHP OOP
// 클래스 상수

class Base {
    const AGE = 21;     // 클래스 상수는 대문자로 표현(소문자로 쓴다고 해서 에러 발생하진 않음, 다만 앞에$표시하면 에러발생)
    public $mustOlderThan = 21;

}

// 상수를 출력하려면 self::AGE로 접근
echo Base::AGE;


?>