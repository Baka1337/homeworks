<?php

Config::set('site_name', 'Интернет-магазин чая');
Config::set('keywords', 'Чай, китайский, купить, цена, Украина, Киев, интернет-магазин');
Config::set('description', 'Заказывайте китайский чай по самым низким ценам в интернет-магазине. Эксклюзивные сорта китайского чая с быстрой доставкой по Киеву и Украине!');

Config::set('languages', array('en', 'fr', 'ua'));

// Routes. Route name => method prefix
Config::set('routes', array(
    'default' => '',
    'admin'   => 'admin_',
));

Config::set('default_route', 'default');
Config::set('default_language', 'en');
Config::set('default_controller', 'products');
Config::set('default_action', 'index');
Config::set('pagination_action', 'page');
Config::set('items_per_page', '9');

Config::set('db.host', 'localhost');
Config::set('db.user', 'root');
Config::set('db.password', '');
Config::set('db.db_name', 'mvc');

Config::set('salt', 'jhsa179jiof7b');