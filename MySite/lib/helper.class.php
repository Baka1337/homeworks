<?php

class Helper {

    public static function getNameTranslite($string) {
        $replace=array(
            "'"=>"",
            "`"=>"",
            "а"=>"a","А"=>"a",
            "б"=>"b","Б"=>"b",
            "в"=>"v","В"=>"v",
            "г"=>"g","Г"=>"g",
            "д"=>"d","Д"=>"d",
            "е"=>"e","Е"=>"e",
            "ё"=>"e","Ё"=>"e",
            "ж"=>"zh","Ж"=>"zh",
            "з"=>"z","З"=>"z",
            "и"=>"i","И"=>"i",
            "й"=>"y","Й"=>"y",
            "к"=>"k","К"=>"k",
            "л"=>"l","Л"=>"l",
            "м"=>"m","М"=>"m",
            "н"=>"n","Н"=>"n",
            "о"=>"o","О"=>"o",
            "п"=>"p","П"=>"p",
            "р"=>"r","Р"=>"r",
            "с"=>"s","С"=>"s",
            "т"=>"t","Т"=>"t",
            "у"=>"u","У"=>"u",
            "ф"=>"f","Ф"=>"f",
            "х"=>"h","Х"=>"h",
            "ц"=>"c","Ц"=>"c",
            "ч"=>"ch","Ч"=>"ch",
            "ш"=>"sh","Ш"=>"sh",
            "щ"=>"sch","Щ"=>"sch",
            "ъ"=>"","Ъ"=>"",
            "ы"=>"y","Ы"=>"y",
            "ь"=>"","Ь"=>"",
            "э"=>"e","Э"=>"e",
            "ю"=>"yu","Ю"=>"yu",
            "я"=>"ya","Я"=>"ya",
            "і"=>"i","І"=>"i",
            "ї"=>"yi","Ї"=>"yi",
            "є"=>"e","Є"=>"e"
        );
        $str=iconv("UTF-8","UTF-8//IGNORE",strtr($string,$replace));
        $str = preg_replace ("/[^a-z0-9-]/i"," ",$str);
        $str = preg_replace("/ +/", "-", trim($str));
        return strtolower($str);
    }

    public static function Pagination(){
        if(isset($_GET['page'])){
            $page = $_GET['page'] == 0 ? 1 : (int)$_GET['page'];
        }else{
            $page = 1;
        }
        return $page;
    }

    public static function getLimitPagesPagination($page){
        if ($page == 1){
            $limit = 0;
        } else {
            $limit = ($page * (Config::get('items_per_page')) - Config::get('items_per_page'));
        }
        return $limit;
    }
}