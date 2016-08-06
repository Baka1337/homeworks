<?php
function getMenu(){
   if(is_readable('menu.dat')){
       $menu = file_get_contents('menu.dat');
       $menu = unserialize($menu);
   }
    return $menu;
}
function addMenu($menu){
    if(isset($_POST['submit'])){
        $newMenu['menuname'] = $_POST['menuname'];
        $newMenu['menulink'] = $_POST['menulink'];
        $menu[]=$newMenu;
        $menuDB = serialize($menu);
        file_put_contents('menu.dat', $menuDB);
    }
    return $menu;
}
function showMenu($menu){
    if(isset($menu)){
        $menu = file_get_contents('menu.dat');
        $menu = unserialize($menu);
        echo "<ul>";
        foreach($menu as $item){
            echo "<li>";
            echo "<a href={$item['menulink']}>{$item['menuname']}</a>";
            echo "</li>";
        }
    }
}
