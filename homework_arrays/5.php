<?php
$arr = array(
    'Коля'=> '200',
    'Вася'=> '400',
    'Петя'=>'300');
foreach ($arr as $key=> $item){
    echo "{$key} -зарплата {$item} долларов <br>";
}