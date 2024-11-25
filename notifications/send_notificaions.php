<?php
include 'db.php';
include 'notification_functions.php';

try {
    // 테스트 알림 데이터 삽입
    notify_user(1, "새로운 댓글이 달렸습니다.");
    notify_user(1, "회원님의 게시글이 좋아요를 받았습니다.");
    notify_user(2, "새로운 메시지가 도착했습니다.");

    echo "테스트 데이터가 성공적으로 추가되었습니다!";
} catch (PDOException $e) {
    echo "에러 발생: " . $e->getMessage();
}
?>
