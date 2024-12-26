<?php
include 'auth.php';

// 테스트: 회원가입
if (register_user("test_user", "password123")) {
    echo "회원가입 성공!<br>";
} else {
    echo "회원가입 실패.<br>";
}

// 테스트: 로그인
if (login_user("test_user", "password123")) {
    echo "로그인 성공! 환영합니다, " . $_SESSION['username'] . ".<br>";
} else {
    echo "로그인 실패. 사용자 이름 또는 비밀번호를 확인하세요.<br>";
}

// 테스트: 로그아웃
logout_user();
echo "로그아웃 완료.<br>";
?>

<!--[보안] 비밀번호는 password_hash를 사용하여 안전하게 저장.
          비밀번호 검증은 password_verify를 사용. -->
