<?php
/*Вам нужно разработать программу, которая считала бы количество вхождений
какой­нибуть выбранной вами цифры в выбранном вами числе. Например: цифра 5 в числе
442158755745 встречается 4 раза*/
if ($_POST){
    $sum = 0;
    if(isset($_POST)){
        $number=$_POST['numbers'];
    }
    if (isset($_POST)){
        $search=$_POST['search'];
    }
    $elem = str_split($number);
    foreach ($elem as $item){
        if ($item == $search){
            $sum++;
        }
    }
    echo "Символ {$search} найден {$sum} раз";
}
?>


<form method="post" action="">
    <input type="text" name="numbers" placeholder="Введите число" />
    <input type="text" name="search" placeholder="Что будем искать?" />
    <input type="submit" />
</form>