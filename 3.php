<script>
    const GREETING = "1.안녕하세요."
    document.write(GREETING)
</script>
<br>

<?php 
// abs() 절대값
// sqrt()  루트
// round() 반올림_가장 가까운 수로!!
// rand()  난수_랜덤수(가로 안에 범위 지정 가능!)
// $a = rand(10,12);

define("GREETING", "2.안녕하세요");

// GREETING = "DDD";            // 값을 대입하면 에러 발생!(상수는 변하지 않는 값이므로 또다른 값을 대입할 수 없다.)

echo GREETING;

?>
