<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));
define('VIEWS_PATH', ROOT.DS.'views');

require_once(ROOT.DS.'lib'.DS.'init.php');

session_start();

//$pagination = new Pagination('256', '3', '1');
//echo "<pre>";
//var_dump($pagination);

App::run($_SERVER['REQUEST_URI']);