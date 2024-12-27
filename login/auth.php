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
 * 비밀번호 변경 함수
 *
 * @param int $user_id 사용자 ID
 * @param string $new_password 새 비밀번호
 * @return bool 성공 여부
 */
function change_password($user_id, $new_password) {
    global $conn;

    if (empty($user_id) || empty($new_password)) {
        return false;
    }

    try {
        // 비밀번호 해싱
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

        $sql = "UPDATE users SET password = :password WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':password', $hashed_password, PDO::PARAM_STR);
        $stmt->bindValue(':id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        return true;
    } catch (PDOException $e) {
        error_log("비밀번호 변경 실패: " . $e->getMessage());
        return false;
    }
}

/**
 * 사용자 정보 조회 함수
 *
 * @param int $user_id 사용자 ID
 * @return array|null 사용자 정보
 */
function get_user_info($user_id) {
    global $conn;

    if (empty($user_id)) {
        return null;
    }

    try {
        $sql = "SELECT id, username, created_at FROM users WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("사용자 정보 조회 실패: " . $e->getMessage());
        return null;
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
