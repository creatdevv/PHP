# Delete.php 관련 기록

## 개요
게시판에서 게시글을 삭제하는 PHP 스크립트.

## 주요 내용
- 게시글 ID를 기준으로 삭제
- SQL 문: DELETE FROM posts WHERE id = ?
- 성공 시: "삭제 완료" 메시지 반환
- 실패 시: 에러 메시지 출력
