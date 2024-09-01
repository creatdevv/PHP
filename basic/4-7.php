
<h2>다차원 배열</h2>

<?php 
// 3. 2차원 배열 (다차원 배열)

// 1) 내용 출력
$cars = array(
    array("볼보", 22, 10),
    array("산타페", 25, 4),
    array("아우디", 12, 11),
);

// print_r($cars);     // 소스보기로 해서 배열의 순서, 내용 조회 가능

// echo "산타페의 재고는", $cars[1][1], "<br>";   // >> 산타페의 재고는 25 출력, 특정정보 불러오기 완료
// echo $cars[1][0] . "의 재고는", $cars[1][1];  // 위와 같은 값 출력, 동일 다른 표현방법

// # 머리말 양식(표 생성)
echo '<table border="1">
<tr>
        <th>차종</th>
        <th>재고량</th>
        <th>판매량</th>
    </tr>
';


// 2) loop 반복문 돌려보기~
for($row = 0; $row < 3; $row++) {
    // echo "<ul>";
    echo "<tr>";

    for($col =0; $col < 3; $col++) {
        // echo "<li>" .$cars[$row][$col]."</li>";
        echo "<td>" .$cars[$row][$col]."</td>";
    }
    // echo "</ul>";
    echo "</tr>";
}

echo '</table>';

// >> 표 생성해서 표현 완료. 보통 2차원 배열을 많이 사용한다. 3차원도 드물고, 그 이상은 보기도 힘들기 떄문에 2차원이 주로 사용됨


?>