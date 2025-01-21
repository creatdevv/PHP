<?php
include 'db.php';

// 세션 시작 (CSRF 토큰 생성을 위해 필요)
session_start();

// CSRF 토큰 생성
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// POST 요청 처리
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CSRF 토큰 검증
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die('잘못된 요청입니다.');
    }

    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    // 필수 입력값 확인
    if (empty($title) || empty($content)) {
        $error = '모든 필드를 채워주세요.';
    } else {
        try {
            $sql = "INSERT INTO posts (title, content, created_at) VALUES (:title, :content, NOW())";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':title', $title, PDO::PARAM_STR);
            $stmt->bindValue(':content', $content, PDO::PARAM_STR);
            $stmt->execute();

            header('Location: index.php');
            exit;
        } catch (PDOException $e) {
            $error = '데이터베이스 오류: ' . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>새 글 작성</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            line-height: 1.6;
        }
        h1 {
            color: #333;
        }
        form {
            max-width: 500px;
            margin: auto;
        }
        input, textarea, button {
            display: block;
            width: 100%;
            margin-bottom: 15px;
            padding: 10px;
            font-size: 16px;
        }
        button {
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .error {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <h1>새 글 작성</h1>
    <?php if (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form action="" method="post">
        <label for="title">제목:</label>
        <input type="text" id="title" name="title" value="<?= htmlspecialchars($_POST['title'] ?? '') ?>" required>
        <label for="content">내용:</label>
        <textarea id="content" name="content" rows="5" required><?= htmlspecialchars($_POST['content'] ?? '') ?></textarea>
        <!-- CSRF 토큰 추가 -->
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
        <button type="submit">작성</button>
    </form>
</body>
</html>
