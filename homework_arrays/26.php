<?php
echo "<pre>";
$arr = array();
for ($i = 0; $i < 15; $i++){
    $arr[]=rand(0,15);
}

$nul = 1;

foreach ($arr as $key => $item){
    if($item !=0){
        if($key % 2){
            $nul*=$item;
        }else{
            echo "Непарный индекс, значение: {$item}".PHP_EOL;
        }
    }
}

foreach($arr as $key => $item){
    if ( $item > 0 && $key % 2 == 0 ){
       $nul = $nul * $item;
        $nul *= $item;
   }
}
echo "Результат: {$nul}";
print_r($arr);