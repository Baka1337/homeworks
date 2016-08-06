<?php

class ContactsController extends Controller{

    public function __construct($data = array()){
        parent::__construct($data);
        $this->model = new Message();
    }

    public function index(){
        if($_POST) {
            if(isset($_POST['name']) && $_POST['name'] != null &&
                isset($_POST['email']) && $_POST['email'] != null &&
                isset($_POST['message']) && $_POST['message'] != null) {
                if($this->model->save($_POST)) {
                    Session::setFlash('Сообщение отправлено');
                }
            }else{
                Session::setFlash('Необходимо заполнить все поля!');
            }
        }
    }

    public function admin_index(){
        $this->data = $this->model->getList();
    }

    public function admin_delete(){
        if (isset($this->params[0])) {
            $result = $this->model->delete($this->params[0]);
            if ($result) {
                Session::setFlash('Сообщение удалено');
        } else {
                Session::setFlash('Ошибка!');
            }
        }
        Router::redirect('/admin/contacts/');
    }
}