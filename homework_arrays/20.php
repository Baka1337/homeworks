<?php
echo "<pre>";
for($i = 1; $i<=20; $i++){
    echo $i;

    for($x = 0; $x < $i; $x++){
        echo '*';
    }

    echo PHP_EOL;
}
