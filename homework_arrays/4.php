
<?php
$arr=array('green'=>'зеленый','red'=>'красный','blue'=>'голубой');
foreach ($arr as $key=> $item){
    echo $key. "<br>";
}
foreach ($arr as $item){
    echo $item. "<br>";
}