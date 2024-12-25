<?php
include 'log_helper.php';

/**
 * 테스트용 함수: 데이터 처리 시 로그 기록
 */
function process_data() {
    try {
        // 예제 데이터 처리 로직
        $data = ["name" => "John", "age" => 30];
        write_log("데이터 처리 시작: " . json_encode($data));

        // 처리 로직
        if ($data['age'] < 18) {
            throw new Exception("미성년자는 처리할 수 없습니다.");
        }

        write_log("데이터 처리 완료: 성공적으로 처리되었습니다.");
        echo "데이터 처리 완료!";
    } catch (Exception $e) {
        // 에러 발생 시 로그 기록
        write_log("오류 발생: " . $e->getMessage());
        echo "오류가 발생했습니다: " . $e->getMessage();
    }
}

// 함수 호출
process_data();
?>
