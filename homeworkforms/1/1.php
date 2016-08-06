<?php
    $name = ($_POST['userName']);
    $a = explode(" ", $name);
    $message = ($_POST['userMessage']);
    $b = explode(" ", $message);
    $getCommonWords = array_intersect($a, $b);
    echo "<pre>";
    print_r($getCommonWords);