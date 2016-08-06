<?php
$words = $_POST['words'];
$a = explode(" ", $words);
function cmp($a,$b) {
    if (strlen($a) == strlen($b)) {
    }
    return (strlen($a) <strlen( $b)) ? 1 : -1;
}
usort($a, "cmp");
echo "ТОП3 длинных слов в тексте:<br> ";
print_r($a[0]);
echo "<br>";
print_r($a[1]);
echo "<br>";
print_r($a[2]);
?>