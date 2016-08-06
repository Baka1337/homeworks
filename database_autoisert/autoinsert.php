<?php

set_time_limit (120);

require_once "connect.php";

function getRandomString($length) {
    $chars = array_merge(range('a', 'z'));
    $maxIndex = count($chars) - 1;

    $result = '';
    for ($i = 0; $i < $length; $i++) {
        $index = mt_rand(0, $maxIndex);
        $result .= $chars[$index];
        $result = ucfirst($result);
    }
    return $result;
}

for ($a = 1; $a <= 100000; $a++) {
    $authors_title = getRandomString(18);
    $authors_bio = getRandomString(40);
    $sql = "insert into authors set title = '{$authors_title}', bio = '{$authors_bio}' ";
    mysqli_query($link, $sql);
}

for ($b = 1; $b <= 250000; $b++){
    $book_title = getRandomString(18);
    $book_price = mt_rand(50, 1500);
    $book_category_id = mt_rand(1, 30);
    $sql_b = "insert into books set title = '{$book_title}', price = '{$book_price}', category_id = '{$book_category_id}' ";
    mysqli_query($link, $sql_b);
}

$books_authors_book_id = mt_rand(1, 250000);
$books_authors_author_id = mt_rand(1, 100000);
$sql_ba = "insert into books_authors set book_id = '{$books_authors_book_id}', author_id = '{$books_authors_author_id}' ";
mysqli_query($link, $sql_ba);

for ($c = 1; $c <= 30; $c++){
    $category_parent_id = mt_rand(1, 30);
    $category_title = getRandomString(18);
    $sql_c = "insert into categories set parent_id = '{$category_parent_id}', title = '{$category_title}'";
}