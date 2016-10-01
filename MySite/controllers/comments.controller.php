<?php

class CommentsController extends Controller{

    private $catalog;

    public function __construct($data = array()){
        parent::__construct($data);
        $this->model = new Comment();
        $this->catalog = new Products();
    }

    public function add(){
        if (isset($this->params[0])) {
            $alias = strtolower($this->params[0]);
            $product = $this->catalog->getByAlias($alias);
            if ($_POST) {
                if (isset($_POST['name']) && $_POST['name'] != null &&
                    isset($_POST['email']) && $_POST['email'] != null &&
                    isset($_POST['message']) && $_POST['message'] != null
                ) {
                    $product_id = $product['id'];
                    $comments_model = new Comment();
                    $comments_model->add($product_id, $_POST);
                }
            }
        }
        Router::redirect('/product/view/'.$alias);
    }

    public function admin_index(){
        $this->data = $this->model->getComments();
    }

    public function admin_edit(){
        if ($_POST) {
            $id = isset($_POST['id']) ? $_POST['id'] : null;
            $result = $this->model->edit($_POST, $id);
            if ($result) {
                Session::setFlash('Изменения сохранены');
            } else {
                Session::setFlash('Ошибка!');
            }
            Router::redirect('/admin/comments/');
        }

        if (isset($this->params[0])){
            $this->data['comment'] = $this->model->getById($this->params[0]);
        }
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