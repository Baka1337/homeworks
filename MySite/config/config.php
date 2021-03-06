<?php

Config::set('site_name', 'Інтернет-магазин чаю');
Config::set('keywords', 'Чай, китайський, купити, ціна, Україна, Київ, інтернет-магазин');
Config::set('description', 'Замовляйте китайський чай по Найнижчим цінами в інтернет-магазині. Ексклюзивні сорти китайського чаю з швидкою доставкою по Києву та Україні!');

Config::set('languages', array('en', 'fr', 'ua'));

// Routes. Route name => method prefix
Config::set('routes', array(
    'default' => '',
    'admin'   => 'admin_',
    'captcha' => 'captcha_',
));

Config::set('default_route', 'default');
Config::set('default_language', 'en');
Config::set('default_controller', 'product');
Config::set('default_action', 'index');
Config::set('items_per_page', 9);

Config::set('db.host', 'localhost');
Config::set('db.user', 'root');
Config::set('db.password', '');
Config::set('db.db_name', 'mvc');

Config::set('salt', 'jhsa179jiof7b');
