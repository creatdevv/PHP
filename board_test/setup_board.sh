#!/bin/bash

echo "게시판 프로젝트 초기 설정을 시작합니다."

# 스크립트 오류 발생 시 중단
set -e

# 환경 변수 설정
DB_USER="root"
DB_PASS="yourpassword" # 사용자 비밀번호
DB_NAME="board"
UPLOAD_DIR="board/uploads"

# 1. MySQL 명령어 확인
if ! command -v mysql &> /dev/null; then
    echo "오류: MySQL 명령어를 찾을 수 없습니다. MySQL이 설치되었는지 확인하세요."
    exit 1
fi

# 2. 데이터베이스 초기화
echo "데이터베이스 초기화 중..."
mysql -u "$DB_USER" -p"$DB_PASS" -e "
CREATE DATABASE IF NOT EXISTS $DB_NAME;
USE $DB_NAME;
CREATE TABLE IF NOT EXISTS posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
"
echo "데이터베이스 및 테이블 생성 완료."

# 3. 업로드 디렉토리 생성
if [ -d "$UPLOAD_DIR" ]; then
    echo "업로드 디렉토리가 이미 존재합니다: $UPLOAD_DIR"
else
    echo "업로드 디렉토리 생성 중..."
    mkdir -p "$UPLOAD_DIR"
    echo "업로드 디렉토리 생성 완료."
fi

echo "초기 설정이 완료되었습니다."
