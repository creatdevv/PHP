<?php 
// #수퍼 전역($Globals)

// $GLOBALS['aaa'] = "안녕";

function aabb() {
    $GLOBALS['aaa'] = "값!!!";
}
aabb();
// >> 안녕 출력

// echo $GLOBALS['aaa'];
echo $aaa;



?>