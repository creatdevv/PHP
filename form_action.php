<?php 

print_r($_POST);

?>

제목 : <?php echo $_POST['subject']; ?> <br>
암호 : <?php echo $_POST['password']; ?> <br>
내용 : <?php echo nl2br($_POST['content']); ?> <br>

