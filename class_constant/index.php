<?php 
// PHP OOP
// 클래스 상수

class Base {
    const AGE = 22;     // 클래스 상수는 대문자로 표현(소문자로 쓴다고 해서 에러 발생하진 않음, 다만 앞에$표시하면 에러발생)
    public $mustOlderThan = 21;

}

// *상수를 출력하려면 self::AGE로 접근 (클래스상수는 아래처럼 인스턴스 생성 없이 바로 접근 가능하다)
// echo Base::AGE; 
Base::AGE= 3;        // @상수값 변경해보기(안됨,오류발생!!!):상수값은 변경 불가하다!! 


// $base = new Base();     // 인스턴스 생성
// echo $base->mustOlderThan;      
// $base->mustOlderThan =220;      // @프로퍼티값 변경해보기 (바뀐 값으로 같이 출력됨)
// echo $base->mustOlderThan;

?>