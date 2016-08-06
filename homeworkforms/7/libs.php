<?PHP
function getMessages(){
	if (is_readable("messages.txt")){
	$messages=file_get_contents("messages.txt");
	$messages=unserialize($messages);
}
return $messages;
}
function addMessage($messages){
	if (isset($_POST["submit"])){
	$newPost["userName"]=$_POST["userName"];
	$newPost["userMessage"]=$_POST["userMessage"];
	$messages[]=$newPost;
	$messagesDB=serialize($messages);
	file_put_contents("messages.txt",$messagesDB);
}
return $messages;
}
function showMessage($messages){
if (isset($messages)){
	$messages=array_reverse($messages);
	foreach ($messages as $post){
		$post['userName']=htmlspecialchars($post['userName']);
		$post['userMessage']=htmlspecialchars($post['userMessage']);
		echo "<p>Посетитель <b>{$post['userName']}</b> пишет:</p>";
		echo "<p>{$post['userMessage']}</p>";
		echo "<br>";
	}
}
}
?>




