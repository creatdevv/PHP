
<!--자바스크립트와의 배열 차이(비교~~)-->
<!-- <script>
    const arr1 = ["자동차","비행기","요트"];
    // const arr2 = arr1;
    const arr2 = [...arr1];
    arr1.pop();
</script> -->

<?php 

// PHP배열: 인덱스 배열, 연관 배열, 다차원 배열

// $car = array("자동차","비행기","요트");
// $car2 = $car;
$cars = ["자동차1", "비행기", "요트"];       // *PHP 5.4~는 이런 형태를 지원한다

$car2[0] = "비행선";

print_r($car2);
print_r($car);

// 인덱스 출력해보기~~
echo $car[1] . "<br>";      // >> Array ( [0] => 비행선 ) 출력

// 루프문 돌려보기~~
foreach($cars AS $car) {
    echo $car . " ";        // 자동차1 비행기 요트 출력
}

?>