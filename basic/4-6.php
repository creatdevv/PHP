<h1>PHP 배열</h1>
<h3>2. 연관 배열</h3>
<p>key와 value인 쌍으로 이루어져 있다 / json 타입과 유사</p>

<?php 
$subject = array(
    "영어" => "English",
    "수학" => "Math",
    "과학" => "Science",
    "음악" => "Music",
);

// echo "영어는" . $subject["영어"] ." 과목이다.";   // 1) 이런식으로 특정문구 출력도 가능

foreach($subject AS $key => $val) {
    // echo "<h2>" .$key. "=". $val."</h2>";  // 2) 각각 출력됨 (영어=English, ...)
    echo "<h2>" .$key. "은/는 " .$val."</h2>";  // 
}


$fruits = array();      // 근데 얘 없어도 무방함, 동일하게 출력됨(아래 $fruits로 배열이 각각 만들어졌기 때문에_연관배열
$fruits["사과"] = "스페인산";
$fruits["배"] = "한국산";
$fruits["포도"] = "칠레산";

print_r($fruits);
echo "<br>";
print_r($subject);

?>