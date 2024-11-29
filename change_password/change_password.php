<?php
session_start();
include 'db.php'; // 데이터베이스 연결 파일

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

        // 이메일 발송
        $user_email = "user@example.com"; // 사용자 이메일 가져오기 (DB에서 조회 가능 시 수정)
        $subject = "암호 변경 알림";
        $message = "안녕하세요, 암호가 성공적으로 변경되었습니다. 문의사항이 있으시면 고객센터에 연락해 주세요.";
        $headers = "From: no-reply@yourwebsite.com";

        mail($user_email, $subject, $message, $headers);

        echo "암호가 성공적으로 변경되었으며, 이메일로 알림을 발송했습니다.";
    } catch (PDOException $e) {
        echo "오류가 발생했습니다: " . $e->getMessage();
    }
}
?>
