<?php 
session_start();

if( !isset($_SESSION['ss_id']) or $_SESSION['ss_id'] == '')  
// session id가 세팅이 되어있거나(true), 비어있거나(false)

{
    echo "
    <script>
    alert('여기는 회원 전용 페이지 입니다. 로그인 후 접근이 가능합니다.');
    self.location.href='index.php';             //로그인페이지로 보내기      
    </script>
    ";
    exit;

 }

?>

1. 여기는 회원전용 페이지입니다.

<a href="logout.php">로그아웃</a>