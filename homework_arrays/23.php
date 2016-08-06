<?php
/*Вам нужно разработать программу, которая считала бы сумму цифр числа введенного пользователем. Например: есть число 123, то программа должна вычислить сумму цифр 1,2, 3, т. е. 6.
По желанию можете сделать проверку на корректность введения данных пользователем.*/
if ($_POST){
    $sum = 0;
    if (isset($_POST)){
        $number=$_POST['numbers'];
    }
    for ($i=0; $i<strlen($number); $i++){
        echo $number[$i];
        $sum = $sum + $number[$i];
    }
    echo "Сумма: {$sum}";
}

?>

<form method="post" action="">
    <input type="text" name="numbers" placeholder="Введите число" />
    <input type="submit" />
</form>