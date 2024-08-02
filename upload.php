<?php 

// var_dump($_FILES);
// print_r($_FILES);

// echo "파일명은".$_FILES['utile']
// ['name'];
// echo "이고, ";
// echo "파일 용량은 ";
// echo $_FILES['ufile']['size'] .
// '입니다.';

$tfile = './upload/abc.png';

move_uploaded_file($FILES['ufile']['tmp_name'], $tfile);


?>