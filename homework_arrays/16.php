<?php
$arr = array(1, 2, 3, 4, 5, 6, 7, 8, 9);
$i=0;
foreach ($arr as $val){
    echo $val . ' ';
    $i++;
    if ($i == 3){
        echo "<br>";
        $i=0;
    }
}