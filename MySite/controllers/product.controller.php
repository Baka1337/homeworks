<?php

class ProductController extends Controller{

    private $category;
    public $attachment;
    public function __construct($data = array()){
        parent::__construct($data);
        $this->model = new Products();
        $this->category = new Categorys();
    }

    public function index(){
        $page = Helper::Pagination();
        $limit = Helper::getLimitPagesPagination($page);

        $this->data['goods'] = $this->model->getListLimit($limit);
        $count = $this->model->getCount();
        $count = (int)$count['count'];
        $this->data['pagination'] = new Pagination($count, Config::get('items_per_page'), $page);
    }

    public function view(){
        $params = App::getRouter()->getParams();

        if ( isset($params[0]) ){
            $alias = strtolower($params[0]);
            $this->data['goods'] = $this->model->getByAlias($alias);
            $comments_model = new Comment();
            $this->data['comments'] = $comments_model->getByProductId($this->data['goods']['id']);
        }
    }

    public function admin_index(){
        $page = Helper::Pagination();
        $limit = Helper::getLimitPagesPagination($page);

        $this->data['goods'] = $this->model->getListLimit($limit);
        $this->data['categories_list'] = $this->category->getCategoriesList();
        $count = $this->model->getCount();
        $count = (int)$count['count'];
        $this->data['pagination'] = new Pagination($count, Config::get('items_per_page'), $page);
    }


    public function admin_add(){
        if ( $_POST || $_FILES ){
            $result = $this->model->add($_POST,$_FILES);
            if ( $result ){
                Session::setFlash('Товар сохраненен');
            } else {
                Session::setFlash('Ошибка!');
            }
            Router::redirect('/admin/product/');
        }
        $this->data['categories_list'] = $this->category->getCategoriesList();
    }

    public function admin_edit(){
        if ( $_POST || $_FILES ){
            $id = isset($_POST['id']) ? $_POST['id'] : null;
            $result = $this->model->save($_POST, $_FILES);
            if ( $result ){
                Session::setFlash('Товар сохранен');
            } else {
                Session::setFlash('Ошибка!');
            }
            Router::redirect('/admin/product/');
        }

        if ( isset($this->params[0]) ){
            $this->data['goods'] = $this->model->getById($this->params[0]);
            $this->data['goods']['category'] = $this->category->getCategoryById($this->params[0]);
            $this->data['categories_list'] = $this->category->getCategoriesList();
        } else {
            Session::setFlash('Неправильный id товара!');
            Router::redirect('/admin/product/');
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
        Router::redirect('/admin/product/');
    }

    public function search(){
        $page = Helper::Pagination();
        $limit = Helper::getLimitPagesPagination($page);

        if (isset($_GET['q'])){
            $this->data['search'] = $this->model->search($_GET['q'], $limit);
            $this->data['count'] = $this->model->searchCount($_GET['q']);
        } else {
            Session::setFlash('Ничего не найдено!');
        }

        $count = $this->model->getCount();
        $count = (int)$count['count'];
        $this->data['pagination'] = new Pagination($count, Config::get('items_per_page'), $page);
    }

    public function admin_search(){
        $page = Helper::Pagination();
        $limit = Helper::getLimitPagesPagination($page);

        $this->data['goods'] = $this->model->search($_POST['search'], $limit);
        $this->data['categories_list'] = $this->category->getCategoriesList();

        $count = $this->model->getCount();
        $count = (int)$count['count'];
        $this->data['pagination'] = new Pagination($count, Config::get('items_per_page'), $page);

        return VIEWS_PATH.DS.'catalog'.DS.'admin_index.html';
    }

}