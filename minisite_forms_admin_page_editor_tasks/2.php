<?php
require_once "lib.php";
$arr = array('red', 'green', 'blue', 'yellow', 'orange');
$rand_key = array_rand($arr);
$color = $arr[$rand_key];
$arr = array(
    'param' => array('url' => '?act=main', 'title' => 'Главная'),
    'param1' => array('url' => '?act=products', 'title' => 'Товары'),
    'param2' => array('url' => '?act=about', 'title' => 'О компании'),
    'param3' => array('url' => '?act=contact', 'title' => 'Контакты'),
);
?>
<h1>Главное меню</h1><br>
<?php
foreach ($arr as $key => $item) {
    foreach ($item as $key_1 => $item_1) {
        if ($key_1 === 'url') {?>
            <a href="<?=$item_1 ;?>"> <?php }; ?>
        <?php if ($key_1 === 'title') {?>
            <?=$item_1; ?></a> <?php }; ?>
    <?php }; ?>
<?php }; ?>

<br>


<?php
$filename = 'main.php';
if ( isset($_GET['act']) ){
    $filename = $_GET['act'].'.php';
}

$filename = 'pages' . DIRECTORY_SEPARATOR . $filename;

//include_once($filename);
//include_once $filename;
require $filename;
?>

<br>
<h1>Подвал сайта</h1>