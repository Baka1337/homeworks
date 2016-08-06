<?php

class CommentsController extends Controller{

    private $product;

    public function __construct($data = array()){
        parent::__construct($data);
        $this->model = new Comment();
        $this->product = new Product();
    }

    public function add(){
        $params = App::getRouter()->getParams();
        if ($_POST) {
            if (isset($params[0]) &&
                isset($_POST['name']) && $_POST['name'] != null &&
                isset($_POST['email']) && $_POST['email'] != null &&
                isset($_POST['message']) && $_POST['message'] != null) {
                $goods = $this->product->getByAlias($params[0]);
                if ($this->model->save($_POST, $goods)) {
                    Session::setFlash('Ваш комментрарий опубликован!');
                } else {
                    Session::setFlash('Необходимо заполнить все поля!');
                }
            }
            Router::redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function delete(){
        if ( isset($this->params[0]) ){
            $result = $this->model->delete($this->params[0]);
            if ( $result ){
                Session::setFlash('Комментарий удален');
            } else {
                Session::setFlash('Ошибка!');
            }
        }
        Router::redirect($_SERVER['HTTP_REFERER']);
    }

    public function admin_index(){
        $this->data = $this->model->getComments();
    }

    public function admin_delete(){
        if (isset($this->params[0])) {
            $result = $this->model->delete($this->params[0]);
            if ($result) {
                Session::setFlash('Комментарий удален');
            } else {
                Session::setFlash('Ошибка!');
            }
        }
        Router::redirect('/admin/comments/');
    }
}