<?php
class ContactForm {
    public $name;
    public $comment;
    public $time;

    public function __construct($name, $comment, $time){
        $this->name = $name;
        $this->comment = $comment;
        $this->time = $time;
    }

    public static function getAllRequests() {
        $messages = file_get_contents("messages.txt");
        $list = unserialize($messages);
        return $list;
    }

    public static function saveAllRequests($list) {
        $messages = serialize($list);
        file_put_contents("messages.txt", $messages);
    }

    public static function addRequest($name, $comment){
        $list = self::getAllRequests();
        $time = date('Y-m-d H:i:s');
        $request = new ContactForm($name,$comment,$time);
        $list[]=$request;
        self::saveAllRequests($list);
    }
}