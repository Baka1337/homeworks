<?php

class ProductsController extends Controller{

    public function __construct($data = array()){
        parent::__construct($data);
        $this->model = new Product();
    }

    public function index()    {
        $this->data['goods'] =  $this->model->getList();
    }

    public function view(){
        $params = App::getRouter()->getParams();

        if ( isset($params[0]) ){
            $alias = strtolower($params[0]);
            $this->data['goods'] = $this->model->getByAlias($alias);
//            $id = strtolower($params[0]);
//            $this->data['goods'] = $this->model->getById($id);
        }
    }

    public function admin_index(){
        $this->data['goods'] = $this->model->getList();
    }


    public function admin_add(){
        if ( $_POST ){
            $result = $this->model->save($_POST);
            if ( $result ){
                Session::setFlash('Товар сохраненен');
            } else {
                Session::setFlash('Ошибка!');
            }
            Router::redirect('/admin/products/');
        }
    }

    public function admin_edit(){

        if ( $_POST || $_FILES ){
            $id = isset($_POST['id']) ? $_POST['id'] : null;
            $result = $this->model->save($_POST, $id);
            if ( $result ){
                Session::setFlash('Товар сохранен');
            } else {
                Session::setFlash('Ошибка!');
            }
            Router::redirect('/admin/products/');
        }

        if ( isset($this->params[0]) ){
            $this->data['goods'] = $this->model->getById($this->params[0]);
        } else {
            Session::setFlash('Неправильный id товара!');
            Router::redirect('/admin/products/');
        }
    }

    public function admin_delete(){
        if ( isset($this->params[0]) ){
            $result = $this->model->delete($this->params[0]);
            if ( $result ){
                Session::setFlash('Товар удален');
            } else {
                Session::setFlash('Ошибка!');
            }
        }
        Router::redirect('/admin/products/');
    }
}