<?PHP
include_once "libs.php";

echo "<pre>";
$messages=getMessages();
$messages=addMessage($messages);
showMessage($messages);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
</head>
<body>

<form action="index.php" method="POST">
	<label for="userName"><p>Введите имя</p></label>
	<input type="text" name="userName" id="userName">
	<label for="userMessage"><p>Оставьте сообщение</p></label>
	<textarea name="userMessage" id="userMessage"></textarea>
	<br/>
	<input type="submit" name="submit" value="Отправить">
</form>
</body>
</html>