<?php
include 'languages.php';

// 사용자의 언어 설정 (기본값은 영어)
$lang = isset($_GET['lang']) ? $_GET['lang'] : 'en';

// 지원되지 않는 언어가 들어오면 기본값 사용
if (!array_key_exists($lang, $translations)) {
    $lang = 'en';
}

// 언어 번역 변수 설정
$current_lang = $translations[$lang];
?>

<!DOCTYPE html>
<html lang="<?= htmlspecialchars($lang) ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multi-language Support</title>
</head>
<body>
    <h1><?= $current_lang['welcome'] ?></h1>

    <nav>
        <a href="#"><?= $current_lang['login'] ?></a> |
        <a href="#"><?= $current_lang['signup'] ?></a> |
        <a href="#"><?= $current_lang['logout'] ?></a>
    </nav>

    <hr>

    <!-- 언어 변경 링크 -->
    <p>Select Language:</p>
    <a href="?lang=en">English</a> |
    <a href="?lang=ko">한국어</a> |
    <a href="?lang=es">Español</a>
</body>
</html>
