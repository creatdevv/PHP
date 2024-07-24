<?php 
// #수퍼 전역

$GLOBALS['aaa'] = "안녕";

function aabb() {
    echo $GLOBALS['aaa'];
}
aabb();
// >> 안녕 출력




?>