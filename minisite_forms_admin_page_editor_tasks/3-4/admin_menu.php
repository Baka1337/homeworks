<?php
$str = file_get_contents("menu.dat");
$menu = unserialize($str);
?>

<form action="admin_menu.php" method="get">
    <label for="menu_name"><p>Введите название пункта меню:</p></label>
    <input type="text" name="menu_name" id="menu_name">
    <label for="menu_link"><p>Ссылка на пункт меню:</p></label>
    <input type="text" name="menu_link" id="menu_link">
    <input type="submit" name="submit" value="Создать">
</form>

<?php
if(isset($_GET['']))
$menu['url'][] = '?act=' . $_GET['menu_name'];
$menu['title'][] = $_GET['menu_link'];
$str = serialize($menu);
file_put_contents('menu.dat', $str);
}
?>


<form method="get" action="">
    <select name="del">
        <?php  foreach($menu['url'] as $key_url => $item_url){ ?>
        <?php  foreach($menu['title'] as $key_title => $item_title){ ?>
            <?php ($key_url == $key_title) ?>
            <option value="<?=$item_url?>"><?=$item_title?></option>
        <?php } ?>
        <?php } ?>
    </select> <br>
    <input type="submit" value="Редактировать меню" />
</form>