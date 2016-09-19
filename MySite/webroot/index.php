<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));
define('VIEWS_PATH', ROOT.DS.'views');
define('IMG_PATH', ROOT.DS.'webroot'.DS.'uploads'.DS.'pics'.DS.'goods'.DS);
define('IMG_PATH_ASSET', DS.'uploads'.DS.'pics'.DS.'goods'.DS);
define('FILES_PATH', ROOT.DS.'webroot'.DS.'uploads'.DS.'files'.DS);

require_once(ROOT.DS.'lib'.DS.'init.php');

session_start();

App::run($_SERVER['REQUEST_URI']);





