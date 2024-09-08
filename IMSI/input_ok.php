<?php 
// input에서 작성하면, input_ok로 내용과 함께 넘어감
include 'db.php';

print_r($_POST);

$subject = $_POST['subject'];
$content = $_POST['content'];

$date = date("Y-m-d H:i:s");

try {
$sql = "INSERT INTO board(subject, content, rdate) 
VALUES( '{$subject}', '{$content}', NOW())";

$conn->exec($sql);
// echo $sql;
echo "게시물 등록에 성공했습니다.";

} catch(PDOException $e) {
    echo $e->getMessage();
}

$conn = null;

// // DB 연결 파일 포함
// include 'db.php';

// // POST 데이터 출력 (디버깅용)
// print_r($_POST);

// $subject = $_POST['subject'] ?? '';  // null 방지
// $content = $_POST['content'] ?? '';

// // 데이터베이스에 삽입
// try {
//     // SQL 실행 전 디버깅용 출력
//     echo "입력할 데이터: 제목 - {$subject}, 내용 - {$content}";

//     $sql = "INSERT INTO board(subject, content) VALUES(:subject, :content)";
//     $stmt = $conn->prepare($sql);
//     $stmt->bindParam(':subject', $subject);
//     $stmt->bindParam(':content', $content);
    
//     // 실행 후 성공 여부 확인
//     if($stmt->execute()) {
//         echo "게시물 등록에 성공했습니다.";
//     } else {
//         echo "게시물 등록에 실패했습니다.";
//     }
// } catch(PDOException $e) {
//     echo "에러 발생: " . $e->getMessage();
// }


?>
