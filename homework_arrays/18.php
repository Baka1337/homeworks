<?php
//18. Составьте массив дней недели. С помощью цикла foreach выведите все дни недели,выходные дни следует вывести жирным.
$arr = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat','Sun');
$holidays = array('Sat','Sun');
foreach ($arr as $item) {
    echo in_array($item,$holidays) ? '<b>' . $item . '</b>' : $item;
    echo PHP_EOL;
}