<?php
// 오류 디스플레이 설정
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 * 파일 생성 함수
 *
 * @param string $file_path 파일 경로
 * @param string $content 파일에 기록할 내용
 * @return bool 성공 여부
 */
function create_file($file_path, $content) {
    try {
        // 파일 존재 여부 확인
        if (file_exists($file_path)) {
            throw new Exception("파일이 이미 존재합니다: $file_path");
        }

        // 파일 생성 및 내용 쓰기
        if (file_put_contents($file_path, $content) === false) {
            throw new Exception("파일 생성 또는 쓰기 실패: $file_path");
        }

        return true;
    } catch (Exception $e) {
        error_log("파일 생성 오류: " . $e->getMessage());
        return false;
    }
}

/**
 * 파일 읽기 함수
 *
 * @param string $file_path 파일 경로
 * @return string|null 파일 내용 (실패 시 null 반환)
 */
function read_file($file_path) {
    if (!file_exists($file_path)) {
        error_log("파일 읽기 실패: 파일이 존재하지 않습니다. 경로: $file_path");
        return null;
    }

    return file_get_contents($file_path);
}

/**
 * 파일 경로와 내용을 사용자 입력으로 받는 함수
 *
 * @return array ['file_path' => string, 'content' => string]
 */
function get_user_input() {
    echo "파일 경로를 입력하세요 (기본값: /Applications/XAMPP/xamppfiles/htdocs/a.txt): ";
    $file_path = trim(fgets(STDIN));
    if (empty($file_path)) {
        $file_path = "/Applications/XAMPP/xamppfiles/htdocs/a.txt";
    }

    echo "파일에 기록할 내용을 입력하세요 (기본값: Hello PHP): ";
    $content = trim(fgets(STDIN));
    if (empty($content)) {
        $content = "Hello PHP";
    }

    return ['file_path' => $file_path, 'content' => $content];
}

// 사용자 입력 받기
$input = get_user_input();
$file_path = $input['file_path'];
$content = $input['content'];

// 파일 생성
if (create_file($file_path, $content)) {
    echo "파일이 성공적으로 생성되었습니다. 경로: $file_path\n";
    echo "내용: " . read_file($file_path) . "\n";
} else {
    echo "파일 생성에 실패했습니다. 자세한 내용은 로그를 확인하세요.\n";
}

// 파일 권한 확인
if (!is_writable(dirname($file_path))) {
    echo "경고: 파일이 위치한 디렉터리에 쓰기 권한이 없습니다. 권한을 확인하세요.\n";
}
?>
