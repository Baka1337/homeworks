<?php
$arr = array(1,2,3,4,5,6,7,8,9);
$str='-';
foreach ($arr as $val){
    $str .= $val . '-';
}
echo $str;