<?php

require_once "libs.php";

if ( $_POST ){
	if ( isset($_POST['name']) && $_POST['comment'] ){
		ContactForm::addRequest($_POST['name'], $_POST['comment']);
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
</head>
<body>
<form action="" method="POST">
	<label for="name"><p>Введите своё имя</p></label>
	<input type="text" name="name" id="name">
	<label for="comment"><p>Оставьте своё сообщение</p></label>
	<textarea name="comment" id="comment" placeholder="...здесь..." cols=20 rows=5></textarea><br/>
	<br/>
	<input type="submit" name="submit" value="Отправить">
</form>
<?php
ob_start();
require_once "view.php";
?>
</body>
</html>