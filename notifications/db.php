<?php
/**
 * 데이터베이스 연결을 설정하고 반환하는 함수
 *
 * @return PDO 데이터베이스 연결 객체
 */
function get_db_connection() {
    // 환경 변수에서 DB 정보 가져오기
    $host = getenv('DB_HOST') ?: 'localhost';
    $dbname = getenv('DB_NAME') ?: 'your_database_name';
    $username = getenv('DB_USER') ?: 'your_username';
    $password = getenv('DB_PASSWORD') ?: 'your_password';

    try {
        // PDO 연결 설정
        $conn = new PDO(
            "mysql:host=$host;dbname=$dbname;charset=utf8mb4", 
            $username, 
            $password, 
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // 에러를 예외로 처리
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // 기본 페치 모드 설정
                PDO::ATTR_EMULATE_PREPARES => false, // 실제 프리페어드 스테이트먼트 사용
                PDO::ATTR_PERSISTENT => true, // 지속 연결 설정
            ]
        );
        return $conn;
    } catch (PDOException $e) {
        // 에러 로깅
        error_log("데이터베이스 연결 실패: " . $e->getMessage());
        // 사용자에게 민감한 정보 숨기기
        die("데이터베이스 연결에 문제가 발생했습니다. 관리자에게 문의하세요.");
    }
}

// 데이터베이스 연결 초기화
$conn = get_db_connection();
?>
