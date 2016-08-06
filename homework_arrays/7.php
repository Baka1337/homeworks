<?php
$arr = array(2,5,9,15,0,4);

foreach ($arr as $val) {
    if ($val > 3 && $val < 10) {
        echo $val . PHP_EOL;
    }
}