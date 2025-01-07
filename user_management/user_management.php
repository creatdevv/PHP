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

    try {
        $sql = "INSERT INTO users (name, email) VALUES (:name, :email)";
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
 * 사용자 수정
 *
 * @param int $id 사용자 ID
 * @param string $name 새로운 이름
 * @param string $email 새로운 이메일
 * @return bool 성공 여부
 */
function update_user($id, $name, $email) {
    global $conn;
    if (!is_int($id) || $id <= 0 || empty($name) || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        error_log("유효하지 않은 사용자 데이터: id=$id, name=$name, email=$email");
        return false;
    }

    try {
        $sql = "UPDATE users SET name = :name, email = :email WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        return $stmt->execute();
    } catch (PDOException $e) {
        error_log("사용자 수정 실패: " . $e->getMessage());
        return false;
    }
}

/**
 * 사용자 삭제
 *
 * @param int $id 사용자 ID
 * @return bool 성공 여부
 */
function delete_user($id) {
    global $conn;
    if (!is_int($id) || $id <= 0) {
        error_log("유효하지 않은 사용자 ID: $id");
        return false;
    }

    try {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    } catch (PDOException $e) {
        error_log("사용자 삭제 실패: " . $e->getMessage());
        return false;
    }
}

/**
 * 사용자 조회
 *
 * @param int|null $id 사용자 ID (null이면 모든 사용자 조회)
 * @return array 사용자 데이터 배열
 */
function get_users($id = null) {
    global $conn;

    try {
        if ($id === null) {
            $sql = "SELECT * FROM users";
            $stmt = $conn->prepare($sql);
        } else {
            if (!is_int($id) || $id <= 0) {
                error_log("유효하지 않은 사용자 ID: $id");
                return [];
            }
            $sql = "SELECT * FROM users WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("사용자 조회 실패: " . $e->getMessage());
        return [];
    }
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
        } else {
            $response['message'] = "사용자 추가에 실패했습니다.";
        }
        break;

    case 'update':
        $id = isset($_POST['id']) ? (int)$_POST['id'] : null;
        $name = $_POST['name'] ?? null;
        $email = $_POST['email'] ?? null;
        if (update_user($id, $name, $email)) {
            $response['success'] = true;
            $response['message'] = "사용자가 성공적으로 수정되었습니다.";
        } else {
            $response['message'] = "사용자 수정에 실패했습니다.";
        }
        break;

    case 'delete':
        $id = isset($_POST['id']) ? (int)$_POST['id'] : null;
        if (delete_user($id)) {
            $response['success'] = true;
            $response['message'] = "사용자가 성공적으로 삭제되었습니다.";
        } else {
            $response['message'] = "사용자 삭제에 실패했습니다.";
        }
        break;

    case 'get':
        $id = isset($_GET['id']) ? (int)$_GET['id'] : null;
        $users = get_users($id);
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
?>
