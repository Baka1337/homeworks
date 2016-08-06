<?php
echo "<pre>";
for($i=2; $i<=9; $i++){
    for ($j=2; $j<=9; $j++){
        echo "{$i} * {$j} = ".$i*$j;
        echo PHP_EOL;
    }
    echo PHP_EOL;
}