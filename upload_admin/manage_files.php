<?php
include 'db.php';

// 파일 삭제
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    
    // 파일 정보 가져오기
    $sql = "SELECT filepath FROM uploads WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':id' => $id]);
    $file = $stmt->fetch();

    if ($file) {
        // 파일 삭제
        if (unlink($file['filepath'])) {
            // DB에서 삭제
            $sql = "DELETE FROM uploads WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            echo "파일이 삭제되었습니다.";
        } else {
            echo "파일 삭제에 실패했습니다.";
        }
    }
}

// 파일 목록 가져오기
$sql = "SELECT * FROM uploads ORDER BY uploaded_at DESC";
$stmt = $conn->query($sql);
$files = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>파일 관리</title>
</head>
<body>
    <h1>파일 관리</h1>
    <table border="1">
        <tr>
            <th>파일명</th>
            <th>업로드 날짜</th>
            <th>다운로드</th>
            <th>삭제</th>
        </tr>
        <?php foreach ($files as $file): ?>
        <tr>
            <td><?= htmlspecialchars($file['filename']) ?></td>
            <td><?= $file['uploaded_at'] ?></td>
            <td><a href="<?= $file['filepath'] ?>" download>다운로드</a></td>
            <td><a href="manage_files.php?delete=<?= $file['id'] ?>">삭제</a></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
