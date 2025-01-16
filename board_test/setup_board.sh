#!/bin/bash

echo "게시판 프로젝트 초기 설정을 시작합니다."

# 1. 데이터베이스 초기화
echo "데이터베이스 초기화 중..."
mysql -u root -p -e "
CREATE DATABASE IF NOT EXISTS board;
USE board;
CREATE TABLE IF NOT EXISTS posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
"
echo "데이터베이스 및 테이블 생성 완료."

# 2. 디렉토리 생성
echo "업로드 디렉토리 생성 중..."
mkdir -p board/uploads
echo "업로드 디렉토리 생성 완료."

echo "초기 설정이 완료되었습니다."
