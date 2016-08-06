<?php

$list = ContactForm::getAllRequests();

if(!empty($list)) {
    foreach ($list as $key => $item){
        echo "Посетитель: <b>".$item->name. "</b>(" . $item->time.")";
        echo "<br/>";
        echo $item->comment;
        echo "<br/>";
        echo "<br/>";
    }
} else {
    echo "Список пуст.";
}
?>