<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>로그인 폼</title>
    <script src="login.js"></script>
</head>
<body>
    <h1>로그인</h1>
    <form method="post" name="login_form" action="login_ok.php"
    autocomplete="off">
        <label for="">아이디</label>
        <input type="text" name="id" id="id" placeholder="아이디 입력">
        <br>
        <label for="">비밀번호</label>
        <input type="password" name="pw" id="pw" placeholder="비번 입력">
        <br>
        <button id="login_btn">확인</button>
    </form>

    <a href="member.php">회원 전용 페이지</a>
</body>
</html>