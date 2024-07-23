
<h2>다차원 배열</h2>

<?php 
// 3. 2차원 배열 (다차원 배열)

$cars = array(
    array("볼보", 22, 10),
    array("산타페", 25, 4),
    array("아우디", 12, 11),
);

// print_r($cars);     // 소스보기로 해서 배열의 순서, 내용 조회 가능
echo "산타페의 재고는", $cars[1][1], "<br>";   // >> 산타페의 재고는 25 출력, 특정정보 불러오기 완료
echo $cars[1][0] . "의 재고는", $cars[1][1];  // 위와 같은 값 출력, 동일 다른 표현방법

// loop 반복문 돌려보기~
for($row = 0; $row < 3; $row++) {
    echo "<ul>";

    for($col =0; $col < 3; $col++) {
        echo "<li>" .$cars[$row][$col]."</li>";
    }
    echo "</ul>";
}


?>