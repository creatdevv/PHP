<?php
$id = (isset($_POST['id']) and $_POST['id'] != '') ? $_POST['id'] : ''; 
$id = (isset($_POST['pw']) and $_POST['pw'] != '') ? $_POST['pw'] : ''; 

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

?>