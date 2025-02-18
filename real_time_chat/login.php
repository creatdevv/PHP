<?php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (empty($email) || empty($password)) {
        echo json_encode(['success' => false, 'message' => '모든 필드를 입력하세요.']);
        exit;
    }
    
    $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user && password_verify($password, $user['password'])) {
        // 세션에 사용자 정보 저장
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        echo json_encode(['success' => true, 'message' => '로그인 성공!']);
        exit;
    } else {
        echo json_encode(['success' => false, 'message' => '로그인 실패! 이메일 또는 비밀번호를 확인하세요.']);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>로그인</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>로그인</h2>
    <form method="post" action="login.php">
        <input type="email" name="email" placeholder="이메일" required><br>
        <input type="password" name="password" placeholder="비밀번호" required><br>
        <button type="submit">로그인</button>
    </form>
    <p>아직 계정이 없으신가요? <a href="register.php">회원가입하기</a></p>
</body>
</html>
