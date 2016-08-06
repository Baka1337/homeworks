<?php
define('DS', DIRECTORY_SEPARATOR);
$dir = __DIR__ . DS . 'gallery' ;
if ( !is_dir($dir) ){
    mkdir($dir);
}
if ( $_FILES && isset($_FILES['photo']) ){
    foreach($_FILES['photo']['tmp_name'] as $key => $tmp_name){
        move_uploaded_file($tmp_name, $dir . DS . $_FILES['photo']['name'][$key]);
    }
    echo "<img src='gallery/{$_FILES['photo']['name'][$key]}' />";
}
echo "<a href=\"index.php\" target=\"_self\" title=\"На главную страницу\">Назад</a>";