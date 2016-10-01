<?php

class CategoryController extends Controller{

    public function __construct($data = array()){
        parent::__construct($data);
        $this->model = new Categorys();
    }

    public function view(){
        $params = App::getRouter()->getParams();
        $page = Helper::Pagination();
        $limit = Helper::getLimitPagesPagination($page);

        if (isset($params[0])) {
            $alias = strtolower($params[0]);
            $this->data['goods'] = $this->model->getProductsFromCategoryByAlias($alias,$limit);
            $this->data['category'] = $this->model->getCategoryByAlias($alias);
            $count = $this->model->getCountInCategory($alias);
            $count = (int)$count['count'];
            $this->data['pagination'] = new Pagination($count, Config::get('items_per_page'), $page);

            if (empty($this->data['goods'])){
                $this->data['parent'] = $this->model->getParentCategoryByAlias($alias);
                $this->data['goods'] = $this->model->getProductsParentCategory($this->data['parent']['id'], $limit);
                $count = $this->model->getCountParent($this->data['parent']['id']);
                $count = (int)$count['count'];
                $this->data['pagination'] = new Pagination($count, Config::get('items_per_page'), $page);
            }
        } else {
            Router::redirect('/');
        }
    }

    public function parent(){
        $params = App::getRouter()->getParams();
        $page = Helper::Pagination();
        $limit = Helper::getLimitPagesPagination($page);

        if (isset($params[0])) {
            $alias = strtolower($params[0]);
            $this->data['parent'] = $this->model->getParentCategoryByAlias($alias);
            $this->data['goods'] = $this->model->getProductsParentCategory($this->data['parent']['id'], $limit);
            $count = $this->model->getCountParent($this->data['parent']['id']);
            $count = (int)$count['count'];
            $this->data['pagination'] = new Pagination($count, Config::get('items_per_page'), $page);
        } else {
            Router::redirect('/');
        }
    }

    public function admin_index(){
        $this->data['categories'] = $this->model->getCategoriesList();
    }

    public function  admin_add(){
        if ($_POST ) {
            $id = isset($_POST['id']) ? $_POST['id'] : null;
            $result = $this->model->saveCategory($_POST, $id);
            if ($result) {
                Session::setFlash('Категория создана');
            } else {
                Session::setFlash('Ошибка!');
            }
            Router::redirect('/admin/category');
        }

        $this->data['category'] = $this->model->getCategoriesList();
    }

    public function admin_edit(){
        if ( $_POST){
            $id = isset($_POST['id']) ? $_POST['id'] : null;
            $result = $this->model->saveCategory($_POST, $id);
            if ( $result ){
                Session::setFlash('Изменения сохранены');
            } else {
                Session::setFlash('Ошибка!');
            }
            Router::redirect('/admin/category');
        }

        if ( isset($this->params[0]) ){
            $this->data['category'] = $this->model->getCategoryById($this->params[0]);
            $this->data['categories_list'] = $this->model->getCategoriesList();
        } else {
            Session::setFlash('Ошибка!');
            Router::redirect('/admin/category/');
        }
    }

    public function admin_delete(){
        if ( isset($this->params[0]) ){
            $result = $this->model->delete($this->params[0]);
            if ( $result ){
                Session::setFlash('Категория удалена');
            } else {
                Session::setFlash('Ошибка!');
            }
        }
        Router::redirect('/admin/category');
    }
}