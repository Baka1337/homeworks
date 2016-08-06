<?php
//19. Составьте массив дней недели. С помощью цикла foreach выведите все дни недели, атекущий день выведите курсивом. Текущий день должен храниться в переменной $day.

$arr = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat','Sun');
$day = date('D');

foreach ($arr as $item){
    echo $item == $day ? '<b>'.$item.'</b>' : $item;
    echo PHP_EOL;
}