<?php
/**
 * 로그를 파일에 기록하는 함수
 *
 * @param string $message 기록할 메시지
 * @param string $log_file 로그 파일 경로 (기본값: logs/app.log)
 * @return void
 */
function write_log($message, $log_file = 'logs/app.log') {
    // 디렉토리 확인 및 생성
    $log_dir = dirname($log_file);
    if (!is_dir($log_dir)) {
        mkdir($log_dir, 0777, true); // 로그 디렉토리가 없으면 생성
    }

    // 로그 포맷: [날짜 시간] 메시지
    $formatted_message = "[" . date('Y-m-d H:i:s') . "] " . $message . PHP_EOL;

    // 파일에 로그 기록
    file_put_contents($log_file, $formatted_message, FILE_APPEND);
}
?>
