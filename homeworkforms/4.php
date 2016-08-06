<?php
function getFilesDir($dir) {
    $files = scandir($dir);
    foreach ($files as $item){
        echo $item . "<br>";
    }
}
getFilesDir('7/');
?>