<?php
include 'db.php';

/**
 * 사용자 추가
 *
 * @param string $name 사용자 이름
 * @param string $email 사용자 이메일
 * @return bool 성공 여부
 */
function add_user($name, $email) {
    global $conn;
    if (empty($name) || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        error_log("유효하지 않은 사용자 데이터: name=$name, email=$email");
        return false;
    }

    if (is_email_duplicate($email)) {
        error_log("이메일 중복: $email");
        return false;
    }

    try {
        $sql = "INSERT INTO users (name, email, status) VALUES (:name, :email, 'active')";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        return $stmt->execute();
    } catch (PDOException $e) {
        error_log("사용자 추가 실패: " . $e->getMessage());
        return false;
    }
}

/**
 * 사용자 상태 업데이트
 *
 * @param int $id 사용자 ID
 * @param string $status 새로운 상태 (active/inactive)
 * @return bool 성공 여부
 */
function update_user_status($id, $status) {
    global $conn;
    if (!is_int($id) || $id <= 0 || !in_array($status, ['active', 'inactive'])) {
        error_log("유효하지 않은 사용자 상태 업데이트 데이터: id=$id, status=$status");
        return false;
    }

    try {
        $sql = "UPDATE users SET status = :status WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        return $stmt->execute();
    } catch (PDOException $e) {
        error_log("사용자 상태 업데이트 실패: " . $e->getMessage());
        return false;
    }
}

/**
 * 사용자 이메일 중복 확인
 *
 * @param string $email 확인할 이메일
 * @return bool 중복 여부
 */
function is_email_duplicate($email) {
    global $conn;
    try {
        $sql = "SELECT COUNT(*) FROM users WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    } catch (PDOException $e) {
        error_log("이메일 중복 확인 실패: " . $e->getMessage());
        return false;
    }
}

/**
 * 사용자 조회 (페이징 포함)
 *
 * @param int $page 페이지 번호
 * @param int $perPage 페이지당 사용자 수
 * @return array 사용자 데이터 배열
 */
function get_users_paginated($page = 1, $perPage = 10) {
    global $conn;
    $offset = ($page - 1) * $perPage;

    try {
        $sql = "SELECT * FROM users LIMIT :offset, :perPage";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("사용자 조회 실패: " . $e->getMessage());
        return [];
    }
}

/**
 * 로그 기록 함수
 *
 * @param string $message 기록할 메시지
 */
function log_action($message) {
    $logFile = 'user_management.log';
    file_put_contents($logFile, date('Y-m-d H:i:s') . " - " . $message . PHP_EOL, FILE_APPEND);
}

// API 처리 로직
$action = $_GET['action'] ?? null;
$response = ['success' => false, 'data' => null, 'message' => ''];

switch ($action) {
    case 'add':
        $name = $_POST['name'] ?? null;
        $email = $_POST['email'] ?? null;
        if (add_user($name, $email)) {
            $response['success'] = true;
            $response['message'] = "사용자가 성공적으로 추가되었습니다.";
            log_action("사용자 추가: name=$name, email=$email");
        } else {
            $response['message'] = "사용자 추가에 실패했습니다.";
        }
        break;

    case 'update_status':
        $id = isset($_POST['id']) ? (int)$_POST['id'] : null;
        $status = $_POST['status'] ?? null;
        if (update_user_status($id, $status)) {
            $response['success'] = true;
            $response['message'] = "사용자 상태가 성공적으로 업데이트되었습니다.";
            log_action("사용자 상태 업데이트: id=$id, status=$status");
        } else {
            $response['message'] = "사용자 상태 업데이트에 실패했습니다.";
        }
        break;

    case 'get_paginated':
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = isset($_GET['perPage']) ? (int)$_GET['perPage'] : 10;
        $users = get_users_paginated($page, $perPage);
        if (!empty($users)) {
            $response['success'] = true;
            $response['data'] = $users;
        } else {
            $response['message'] = "사용자 정보를 찾을 수 없습니다.";
        }
        break;

    default:
        $response['message'] = "올바른 요청을 입력하세요.";
        break;
}

// JSON 응답 출력
header('Content-Type: application/json');
echo json_encode($response);
