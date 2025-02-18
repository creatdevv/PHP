<?php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (empty($username) || empty($email) || empty($password)) {
        echo json_encode(['success' => false, 'message' => '모든 필드를 입력하세요.']);
        exit;
    }
    
    // 비밀번호 암호화
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':password', $hashedPassword, PDO::PARAM_STR);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => '회원가입 성공!']);
    } else {
        echo json_encode(['success' => false, 'message' => '회원가입 실패!']);
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>회원가입</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>회원가입</h2>
    <form method="post" action="register.php">
        <input type="text" name="username" placeholder="이름" required><br>
        <input type="email" name="email" placeholder="이메일" required><br>
        <input type="password" name="password" placeholder="비밀번호" required><br>
        <button type="submit">가입하기</button>
    </form>
    <p>이미 계정이 있으신가요? <a href="login.php">로그인하기</a></p>
</body>
</html>
