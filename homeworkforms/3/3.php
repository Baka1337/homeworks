<?php
$text = implode(' ', file('text.txt'));
$str = explode(' ', $text);
$count = count($str);
$form = $_POST['words'];
for ($i=0; $i < $count; $i++) {
if (strlen($str[$i]) > $form) {
unset ($str[$i]);
} else {
$new_text = $str[$i].' ';
echo $new_text;
$file = 'new.txt';
file_put_contents($file, $new_text, FILE_APPEND);
}
    }