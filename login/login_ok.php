<?php
$id = (isset($_POST['id']) and $_POST['id'] != '') ? $_POST['id'] : ''; 
$pw = (isset($_POST['pw']) and $_POST['pw'] != '') ? $_POST['pw'] : ''; 

if($id == '') {

    echo "
    <script>
        alert('아이디를 입력바랍니다.')
        history.go(-1)
    </script>
    ";
    exit;
}

if($pw == '') {

    echo "
    <script>
        alert('비밀번호를 입력바랍니다.')
        history.go(-1)
    </script>
    ";
    exit;
}

if($id == 'guest' && $pw == '1234'){       // id와 pw의 가정(정보확정)- 나중에 데이터베이스로 사용시, (아이디,비번을) db에서 쿼리 체크해서!
    session_start();                // 세션 시작 설정해주고~~

    $_SESSION['ss_id'] = $id;

    echo "<script>
        alert('로그인 성공했습니다.');          // 1)로그인 성공시
        self.location.href='member.php';    // *회원전용 페이지로 이동
    </script>"; 

} else {

    echo "<script>
    alert('로그인 실패했습니다. 아이디와 비번을 확인해 주세요.');   // 2)둘 중 하나 잘못입력시
    self.location.href='index.php';  
</script>";


}

?>