<?php 
include 'db.php';

$sql = "SELECT * FROM myguests";
$stmtt = $conn->prepare($sql);
$stmt->execute();           // 실행
// $rs = $stmt->fetchAll();    // 가져오기
$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);    // 필드명 기준으로 가져오기
$rs = $stmt->fetchAll(PDO::FETCH_NUM);    // [ ]번호 순서대로 가져오기
$rs = $stmt->fetchAll(PDO::FETCH_BOTH);    // 디폴트 기준값 으로 가져오기

// var_dump($rs);
// print_r($rs);
echo "<table border='1'>";

foreach($rs AS $row) {
    echo "<tr>
    <td>".$row['firstname']."</td>
    </tr>";
}

echo "</table>";


?>