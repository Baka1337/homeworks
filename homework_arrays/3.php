<?php
$result = 0;
$arr = array(26,17,136,12,79,15);
foreach ($arr as $val) {
    $val += $result;
    $result = $val * $val;
}
echo $result;
