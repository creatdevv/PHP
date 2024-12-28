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

// 실행 예제
$action = $_GET['action'] ?? null;
$id = $_GET['id'] ?? null;
$name = $_GET['name'] ?? null;
$email = $_GET['email'] ?? null;

if ($action === 'add' && $name && $email) {
    if (add_user($name, $email)) {
        echo "사용자가 성공적으로 추가되었습니다.";
    } else {
        echo "사용자 추가에 실패했습니다.";
    }
} elseif ($action === 'update' && $id && $name && $email) {
    if (update_user($id, $name, $email)) {
        echo "사용자가 성공적으로 수정되었습니다.";
    } else {
        echo "사용자 수정에 실패했습니다.";
    }
} elseif ($action === 'delete' && $id) {
    if (delete_user($id)) {
        echo "사용자가 성공적으로 삭제되었습니다.";
    } else {
        echo "사용자 삭제에 실패했습니다.";
    }
} else {
    echo "올바른 요청을 입력하세요.";
}
?>
