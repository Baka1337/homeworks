<?php
function uniqueWords($text){
    $words = explode(" ", $text);
    $words = array_unique($words);
    return $words;
}

$text = $_POST['userMessage'];
$s = uniqueWords($text);

echo "В тексте уникальных слов:".count($s);
