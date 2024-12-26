<?php
session_start();
include 'db.php';

/**
 * 사용자 회원가입 함수
 *
 * @param string $username 사용자 이름
 * @param string $password 비밀번호
 * @return bool 성공 여부
 */

// - register_user: 사용자 이름과 비밀번호를 받아 회원가입 처리.
// - login_user: 사용자 이름과 비밀번호를 받아 로그인 처리. 성공 시 세션에 정보 저장.
// - logout_user: 세션을 정리하여 로그아웃.
 

function register_user($username, $password) {
    global $conn;

    if (empty($username) || empty($password)) {
        return false;
    }

    try {
        // 비밀번호 해싱
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->bindValue(':password', $hashed_password, PDO::PARAM_STR);
        $stmt->execute();

        return true;
    } catch (PDOException $e) {
        error_log("회원가입 실패: " . $e->getMessage());
        return false;
    }
}

/**
 * 사용자 로그인 함수
 *
 * @param string $username 사용자 이름
 * @param string $password 비밀번호
 * @return bool 성공 여부
 */
function login_user($username, $password) {
    global $conn;

    if (empty($username) || empty($password)) {
        return false;
    }

    try {
        $sql = "SELECT id, password FROM users WHERE username = :username";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // 세션에 사용자 정보 저장
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $username;
            return true;
        }

        return false;
    } catch (PDOException $e) {
        error_log("로그인 실패: " . $e->getMessage());
        return false;
    }
}

/**
 * 로그아웃 함수
 *
 * @return void
 */
function logout_user() {
    session_unset();
    session_destroy();
}
?>
