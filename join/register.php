<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    if ($password !== $confirm_password) {
        echo "비밀번호가 일치하지 않습니다!";
    } else {
        // 비밀번호 해싱
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        try {
            $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([':username' => $username, ':password' => $hashed_password]);
            echo "회원가입이 완료되었습니다!";
        } catch (PDOException $e) {
            echo "에러: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>회원가입</title>
</head>
<body>
    <h2>회원가입</h2>
    <form method="POST">
        사용자명: <input type="text" name="username" required><br>
        비밀번호: <input type="password" name="password" required><br>
        비밀번호 확인: <input type="password" name="confirm_password" required><br>
        <button type="submit">회원가입</button>
    </form>
</body>
</html>
