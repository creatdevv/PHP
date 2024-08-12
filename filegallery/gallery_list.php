<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>갤러리</title>
    <link rel="stylesheet" href="style.css">
    <!-- <style>            // style.css 로 파일 옮겨놓기(간편하게 수정)
        .wrapper {
            display: flex;
            flex-wrap: wrap;
        }
        .img_div {
            margin: 10px;
        }
        .img_div img {
            border: 1px solid #ccc;
        } -->
    </style>
</head>
<body>
    <?php include 'menu.html'; ?>
    <div class="wrapper">
        <?php 
        // 디렉토리 경로 확인
        $directory = './upload';

        // 디렉토리 열기
        if (is_dir($directory)) {
            $d = dir($directory);

            // 디렉토리 열기 실패 시 에러 메시지
            if (!$d) {
                echo "디렉토리를 열 수 없습니다.";
                exit;
            }

            // 파일 읽기
            while (($file = $d->read()) !== false) {
                if ($file == '.' || $file == '..') {
                    continue;
                }

                $arr = explode('.', $file);
                $ext = strtolower(end($arr));

                // 이미지 파일만 표시
                if ($ext == 'jpg' || $ext == 'png') {
                    echo '
                    <div class="img_div">
                        <img src="' . $directory . '/' . $file . '" width="100">
                    </div>
                    ';
                }
            }

            // 디렉토리 닫기
            $d->close();
        } else {
            echo "디렉토리가 존재하지 않습니다.";
        }
        ?>
    </div>
</body>
</html>
