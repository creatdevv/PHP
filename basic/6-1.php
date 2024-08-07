<?php 
// # PHP SuperGlobal : $_REQUEST, $_GET, $_POST


// 1) $_Get, $_Request 값 확인 (같은 값 출력됨)
print_r($_GET);

echo "name :" .$_GET['name'];
echo "<br>";
echo "company :" .$GET['company'];

// 1-1) Request 는 <- $_Get, $_Post, $_COOKIE 동시에 사용 가능!(근데 쓸일이 별로 없다!)
echo "name : " .$_REQUEST['name'];
echo "<br>";
echo "company : " .$_REQUEST['company'];
// >> $_GET 과 $_REQUEST는 같은 값이 출력 확인된다.



// 2) $_POST 값 확인 (얘는 폼 만들어서 시도!: 1p.html)

// 폼 데이터 출력
print_r($_POST);


// ** 꼭 아래 주소로 서버 접속후 확인할 것~!!(name, company 소스코드로 확인 가능)
// http://localhost/6-1.php?name=kingchobo&company=google

// *Query string(질문하는 문자열): name=kingchobo&company=google



// >>> 결론1: 우리는 자주쓰이는 $_POST, $_GET 만 알면 된다~!
// 연결된 1p.html 웹페이지에 접속후, post로 하고 넘기면 6-1.php로 넘어옴~!

// *예시
$name =$_POST['name'];
$company = $_POST['company'];

// SQL에 데이터 저장(insert) / 수정(update) / 삭제(delete) // 가입: insert into
$sql="INSERT INTO member(name, company) values (
'{$name}', '{$company}')";

// mysqli_query($sql);     // 저장 명령 (이름과 회사 입력했던 것들이 저장될 것임!)

echo "회원가입을 축하드립니다.";

// send_mail();        // 메일주소 만들어서 날라가게하기


?>