<?php
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'books';

$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
mysqli_select_db($link, "books");
mysqli_query($link, "SET NAMES UTF8");
if (!$link) {
    die('Ошибка подключения (' . mysqli_connect_errno() . ') '
        . mysqli_connect_error());
}