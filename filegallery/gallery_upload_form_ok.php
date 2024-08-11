<?php 

include 'menu.html';

// 업로드된 파일이 있는지 확인
if (isset($_FILES['photo'])) {

    // 파일 이름이 비어있는지 확인
    if ($_FILES['photo']['name'] == '') {
        echo "
        <script>
            alert('파일을 선택하지 않으셨습니다.');
            self.location.href='./gallery_upload_form.php';
        </script>
        ";
        exit;
    }

    // 파일 정보 가져오기
    $file_name = $_FILES['photo']['name'];
    $arr = explode('.', $file_name);    // 파일명과 확장자 분리
    $ext = end($arr);       // 확장자 추출

    // 새로운 파일명 설정 (필요한 경우)
    $new_file_name = "aaabbdkd." .$ext;

    // 이미지 파일인지 확인
    if ($ext == 'jpg' || $ext == 'png' || $ext == 'PNG' || $ext == 'JPG') {
        
        // 업로드 디렉터리 확인 및 생성
        $upload_dir = './upload/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true); // 디렉터리가 없으면 생성
        }

        // 파일을 지정된 경로로 이동
        $upload_success = move_uploaded_file($_FILES['photo']['tmp_name'], $upload_dir . $new_file_name);

        if ($upload_success) {
            // 업로드 성공 시 메시지 표시
            echo "
            <script>
                alert('정상적으로 업로드가 완료되었습니다.');
                self.location.href='./gallery_list.php';
            </script>
            ";
        } else {
            // 업로드 실패 시 오류 메시지 표시
            echo "
            <script>
                alert('파일 업로드에 실패했습니다. 다시 시도해주세요.');
            </script>
            ";
        }

    } else {
        // 유효하지 않은 파일 포맷일 경우 메시지 표시
        echo "
        <script>
            alert('이미지 포맷 (png, jpg)만 업로드 가능합니다.');
            self.location.href='./gallery_upload_form.php';
        </script>
        ";
    }

} else {
    // 파일이 전송되지 않았을 때 오류 메시지
    echo "
    <script>
        alert('파일이 업로드되지 않았습니다.');
        self.location.href='./gallery_upload_form.php';
    </script>
    ";
}

// 추가: 파일 업로드 오류 코드 확인
if ($_FILES['photo']['error'] !== UPLOAD_ERR_OK) {
    echo "
    <script>
        alert('파일 업로드 에러 코드: " . $_FILES['photo']['error'] . "');
        self.location.href='./gallery_upload_form.php';
    </script>
    ";
}

?>
