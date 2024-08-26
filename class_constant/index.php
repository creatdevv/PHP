<?php 
// PHP OOP
// 클래스 상수

class Base {
    const AGE = 21;     // 클래스 상수는 대문자로 표현(소문자로 쓴다고 해서 에러 발생하진 않음, 다만 앞에$표시하면 에러발생)
    public $mustOlderThan = 21;

}

// 상수를 출력하려면 self::AGE로 접근 (클래스상수는 아래처럼 인스턴스 생성 없이 바로 접근 가능하다)
// echo Base::AGE;

$base = new Base();     // 인스턴스 생성
echo $base->mustOlderThan;


?>