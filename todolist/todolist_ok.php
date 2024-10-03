<?php 

// print_r($_POST);   // post 방식으로 넘겼을때 주소값 표시 안되는지 결과값 확인 >> 정상적으로 넘어가고 페이지 내용에 표시 확인완료(제대로 받아진 것 확인!)

require "db.php";               //반드시 필요하다~!! (db.php 연결)

$subject = $_POST['subject'];


?>