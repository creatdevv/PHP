<?php
session_start();
include 'db.php'; // 데이터베이스 연결

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id']; // 세션에서 사용자 ID 가져오기
    $current_password = $_POST['current_password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
        echo "모든 필드를 입력하세요.";
        exit;
    }

    if ($new_password !== $confirm_password) {
        echo "새 암호와 확인 암호가 일치하지 않습니다.";
        exit;
    }

    try {
        // 사용자 현재 암호 확인
        $sql = "SELECT password FROM users WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user || !password_verify($current_password, $user['password'])) {
            echo "현재 암호가 일치하지 않습니다.";
            exit;
        }

        // 새 암호 해싱 및 업데이트
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
        $update_sql = "UPDATE users SET password = :password WHERE id = :id";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bindValue(':password', $hashed_password, PDO::PARAM_STR);
        $update_stmt->bindValue(':id', $user_id, PDO::PARAM_INT);
        $update_stmt->execute();

        echo "암호가 성공적으로 변경되었습니다.";
    } catch (PDOException $e) {
        echo "오류가 발생했습니다: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>암호 변경</title>
    <script>
        function checkPasswordStrength() {
            const strengthText = document.getElementById('password_strength');
            const password = document.getElementById('new_password').value;
            const regexWeak = /[a-zA-Z]/;
            const regexStrong = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*])/;

            if (password.length < 6) {
                strengthText.textContent = "너무 짧습니다.";
                strengthText.style.color = "red";
            } else if (regexWeak.test(password)) {
                strengthText.textContent = "보통입니다.";
                strengthText.style.color = "orange";
            }
            if (regexStrong.test(password)) {
                strengthText.textContent = "강력합니다!";
                strengthText.style.color = "green";
            }
        }
    </script>
</head>
<body>
    <h1>암호 변경</h1>
    <form method="POST">
        <label for="current_password">현재 암호:</label><br>
        <input type="password" id="current_password" name="current_password" required><br><br>

        <label for="new_password">새 암호:</label><br>
        <input type="password" id="new_password" name="new_password" required onkeyup="checkPasswordStrength()"><br>
        <small id="password_strength"></small><br><br>

        <label for="confirm_password">새 암호 확인:</label><br>
        <input type="password" id="confirm_password" name="confirm_password" required><br><br>

        <button type="submit">암호 변경</button>
    </form>
</body>
</html>
