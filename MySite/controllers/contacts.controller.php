<?php

class ContactsController extends Controller{

    protected $title = 'Контакти';

    public function __construct($data = array()){
        parent::__construct($data);
        $this->model = new Message();
    }

    public function index(){
        if($_POST) {
            if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])) {
                if($_POST['code'] == Session::get('captcha')) {
                    $this->model->save($_POST);
                    Session::setFlash('Повідомлення відправлено');
                } else {
                    Session::setFlash('Невірно введений код');
                }
            }else{
                Session::setFlash('Необхідно заповнити всі поля!');
            }
        }
        $this->data['title'] = $this->title;
    }

    public function admin_index(){
        $this->data = $this->model->getList();
    }

    public function admin_delete(){
        if (isset($this->params[0])) {
            $result = $this->model->delete($this->params[0]);
            if ($result) {
                Session::setFlash('Повідомлення видлено');
        } else {
                Session::setFlash('Помилка!');
            }
        }
        Router::redirect('/admin/contacts/');
    }
}