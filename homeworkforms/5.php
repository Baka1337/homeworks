<?php
function getFilesDir($dir,$search) {
foreach (glob("{$dir}/{$search}*.txt") as $item) {
    echo $item . "\n";
}
}
getFilesDir('7', 'messages');
?>