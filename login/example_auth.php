<?php
include 'auth.php';

// 회원가입 테스트
if (register_user("new_user", "password123")) {
    echo "회원가입 성공!<br>";
} else {
    echo "회원가입 실패.<br>";
}
 
// 로그인 테스트
if (login_user("new_user", "password123")) {
    echo "로그인 성공! 환영합니다, " . $_SESSION['username'] . ".<br>";
} else {
    echo "로그인 실패. 사용자 이름 또는 비밀번호를 확인하세요.<br>";
}

// 비밀번호 변경 테스트
if (change_password($_SESSION['user_id'], "new_password123")) {
    echo "비밀번호 변경 성공!<br>";
} else {
    echo "비밀번호 변경 실패.<br>";
}

// 사용자 정보 조회 테스트
$user_info = get_user_info($_SESSION['user_id']);
if ($user_info) {
    echo "사용자 정보:<br>";
    echo "ID: " . $user_info['id'] . "<br>";
    echo "Username: " . $user_info['username'] . "<br>";
    echo "가입 날짜: " . $user_info['created_at'] . "<br>";
} else {
    echo "사용자 정보 조회 실패.<br>";
}

// 로그아웃 테스트
logout_user();
echo "로그아웃 완료.<br>";
?>
