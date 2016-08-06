
<?php
$arr = array('html','css','php','js','jq');
foreach ($arr as $val){
    //echo $val."<br>";
    //echo $val.PHP_EOL;
    //echo $val."\n";
}
for ($i=0; $i<count($arr); $i++){
    echo "У ключа {$i} значение {$arr[$i]}".PHP_EOL;
}