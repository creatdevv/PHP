<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>글등록Form</title>
</head>
<body>
    <form method="post" action="input_ok.php">
    <label>글 제목</label>
    <input type="text" name="subject" class="name_input"> <br>
    <label>글 내용</label>
    <textarea name="content" id="content" cols="30" rows="10"></textarea> <br>
    <button>글등록 확인</button>
    </form>
</body>
</html>