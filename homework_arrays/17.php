<?php
//17.Сосктавьте массив месяцев. С помощью цикла foreach выведите все месяцы, а текущий месяц выведите жирным. Текущий месяц должен храниться в переменной $month.
$arr = array('Jan','Feb','Mar','Apr','May');
$month = 'Jan';
foreach ($arr as $val){
    echo $val == $month ? '<b>'.$val.'</b>' : $val;
    echo PHP_EOL;
}