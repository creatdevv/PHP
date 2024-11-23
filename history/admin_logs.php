<?php
include 'db.php';

// 모든 로그 가져오기
try {
    $sql = "SELECT * FROM user_logs ORDER BY timestamp DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $logs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>사용자 활동 로그</title>
</head>
<body>
    <h1>사용자 활동 로그</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>사용자 ID</th>
                <th>작업</th>
                <th>페이지</th>
                <th>IP 주소</th>
                <th>시간</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($logs as $log): ?>
                <tr>
                    <td><?= htmlspecialchars($log['id']) ?></td>
                    <td><?= htmlspecialchars($log['user_id']) ?></td>
                    <td><?= htmlspecialchars($log['action']) ?></td>
                    <td><?= htmlspecialchars($log['page']) ?></td>
                    <td><?= htmlspecialchars($log['ip_address']) ?></td>
                    <td><?= htmlspecialchars($log['timestamp']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
