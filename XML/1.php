<?php 
// #php로 xml 문서 읽어서 활용하기(지디넷 기사 rss 불러오기 식 만들어보기)


$myxml = file_get_contents('https://feeds.feedburner.com/zdkorea');

// echo $myxml;

$xmldom = simplexml_load_string($myxml);

// print_r($xmldom);
// exit;

echo "<h1>".$xmldom->channel->title."</h1>";        // 언론사명 출력
echo "<h2>".$xmldom->channel->description."</h2>";  // 기사내용 출력

$i = 0;
foreach($xmldom->channel->item AS $row) {
   echo "<a href='".$row->link."'>".$row->title . "</a><br>";
   $i++;
   if($i == 5) {    // 기사 5개만 불러오기  
    exit;
   }
}

?>