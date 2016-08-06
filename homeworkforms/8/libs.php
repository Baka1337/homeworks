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
	$cens=["бля","дурак","идиот","козел"];
if (isset($messages)){
	$messages=array_reverse($messages);
	foreach ($messages as $post){
		foreach ($cens as $item){
			$post['userMessage']=str_replace($item,"Некорректный комментарий",$post['userMessage']);
		}
		$post['userName']=htmlspecialchars($post['userName']);
		$post['userMessage']=htmlspecialchars($post['userMessage']); 
		echo "<p><b>Посетитель {$post['userName']} пишет:</b></p>";
		echo "<p>{$post['userMessage']}</p>";
		echo "<br>";
	}
}
}
?>




