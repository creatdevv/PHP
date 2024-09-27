<?php 

$vote = (isset($_GET['vote']) && $_GET['vote'] != '') ? $_GET['vote'] : '';

// echo $vote;

if($vote == '') {
    exit;
}

$filename = 'data/ajax_poll.txt';           // 테스트 결과값 생성될 것임(data폴더의 txt 안에~!)

if(file_exists($filename)) {
    file_put_contents($filename,"0,0");     // 결과값 생성식
} 

$content = file_get_contents($filename);            // 위의 0,0이 이 변수에 담아질 것~~
list($yes, $no) = explode(',', $content);           // txt에 미리 값 생성(2개)하면 밑의 결과값에 따라 숫자 보임!

// echo 'yes'. $yes ."<br>";
// echo 'no'. $no ."<br>";

if($vote == 0 ) {
    $yes = $yes +1;
} elseif($vote == 1 ) {
    $no = $no +1;
}

file_get_contents($filename, "$yes,$no");           // 찍힌걸 기록을 해줌(계속 축적됨) 
// echo $yes . ' '. $no;

$yes_width = round(($yes / ($yes + $no)) * 100);    // 반올림해서 투표결과 수치 보여줌 (소수점까지 보여주기 원할시-> 1,2 단위로..: $yes_width = round(($yes / ($yes + $no)) * 100, 1);)
$no_width = round(($yes / ($yes + $no)) * 100);

// echo $yes_width . ' '. $no_width;        // 출력 확인값

?>
<!-- #이미지로 표 보이기(투표결과) -->
<h2>투표결과 : </h2>

<table>
<tr>
<td>예</td>
<td width="100"><img src="https://www.w3schools.com/php/poll.gif" height="20" width="<?=$yes_width?>%"></td>
<td><?= $yes_width ?>%</td>
</tr>
<tr>
<td>아니오</td>
<td><img src="https://www.w3schools.com/php/poll.gif" height="20" width="<?=$no_width?>%"></td>
<td><?= $no_width ?>%</td>
</tr>
</table>