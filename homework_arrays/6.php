<?php
$arr=array(
    'green'=>'зеленый',
    'red'=>'красный',
    'blue'=>'голубой');
$en[]=array();
$ru[]=array();
foreach ($arr as $key=> $item){
    $en[]=$key;
    $ru[]=$item;
}
echo "<pre>";
print_r($en);
print_r($ru);
