<?php

class ProductsController extends Controller{

    private $comments;
    private $category;

    public function __construct($data = array()){
        parent::__construct($data);
        $this->model = new Product();
        $this->comments = new Comment();
        $this->category = new Category();
    }

    public function index(){
        $page = Helper::Pagination();
        $limit = Helper::getLimitPagesPagination($page);

        $this->data['goods'] = $this->model->getListLimit($limit);
        $count = $this->model->getCount();
        $count = (int)$count[0]['count'];
        $this->data['pagination'] = new Pagination($count, Config::get('items_per_page'), $page);
    }

    public function category(){
        $params = App::getRouter()->getParams();
        $page = Helper::Pagination();
        $limit = Helper::getLimitPagesPagination($page);

        if (isset($params[0])) {
            $alias = $params[0];
            $this->data['goods'] = $this->category->getProductsFromCategoryByAlias($alias,$limit);
            }

        $this->data['parent'] = $this->category->getCategoriesList();
        $this->data['category'] = $this->category->getCategoryByAlias($alias);
        $count = $this->category->getCountInCategory($alias);
        $count = (int)$count[0]['count'];
        $this->data['pagination'] = new Pagination($count, Config::get('items_per_page'), $page);
    }

    public function parent(){
        $params = App::getRouter()->getParams();
        $page = Helper::Pagination();
        $limit = Helper::getLimitPagesPagination($page);

        if (isset($params[0])) {
            $alias = strtolower($params[0]);
            $this->data['parent'] = $this->category->getParentCategoryByAlias($alias);
            $this->data['goods'] = $this->category->getProductsParentCategory($this->data['parent']['id'], $limit);
            $count = $this->category->getCountParent($this->data['parent']['id']);
            $count = (int)$count[0]['count'];
            $this->data['pagination'] = new Pagination($count, Config::get('items_per_page'), $page);
        } else {
            Router::redirect('/');
        }
    }

    public function addComment(){
        if ( isset($this->params[0]) ){
            $alias = strtolower($this->params[0]);
            $page = $this->model->getByAlias($alias);
        } else {
            Router::redirect('/');
        }
        $page_id = $page['id'];
        $page_name = $page['name'];
        $page_alias = $this->params[0];
        $comments_model = new Comment();
        $comment_id = $comments_model->add($page_id,$page_alias,$page_name, $_POST);
        if($comment_id){
            // Выводим обратно блок с комментарием
            ob_start();
            $comment = $comments_model->getById($comment_id);
            include VIEWS_PATH.DS.'helpers'.DS.'comment.html';
            $result = ob_get_clean();
            echo $result;
        } else {
            echo "Ошибка!!!";
        }
        exit;
    }


    public function view(){
        $params = App::getRouter()->getParams();

        if ( isset($params[0]) ){
            $alias = strtolower($params[0]);
            $this->model->views($alias);
            $this->data['goods'] = $this->model->getByAlias($alias);
            $this->data['category'] = $this->category->getProductCategory($alias);
            $this->data['parent'] = $this->category->getCategoriesList();
            $comments_model = new Comment();
            $this->data['comments'] = $comments_model->getByProductId($this->data['goods']['id']);
//            $id = strtolower($params[0]);
//            $this->data['goods'] = $this->model->getById($id);
        }
    }

    public function admin_index(){
        $page = Helper::Pagination();
        $limit = Helper::getLimitPagesPagination($page);

        $this->data['goods'] = $this->model->getListLimit($limit);
        $count = $this->model->getCount();
        $count = (int)$count[0]['count'];
        $this->data['pagination'] = new Pagination($count, Config::get('items_per_page'), $page);
    }


    public function admin_add(){
        if ( $_POST || $_FILES ){
            $result = $this->model->save($_POST,$_FILES);
            if ( $result ){
                Session::setFlash('Товар сохраненен');
            } else {
                Session::setFlash('Ошибка!');
            }
            Router::redirect('/admin/products/');
        }
        $this->data['categories_list'] = $this->category->getCategoriesList();
    }

    public function admin_edit(){
        if ( $_POST || $_FILES ){
            $id = isset($_POST['id']) ? $_POST['id'] : null;
            $result = $this->model->save($_POST, $id, $_FILES);
            if ( $result ){
                Session::setFlash('Товар сохранен');
            } else {
                Session::setFlash('Ошибка!');
            }
            Router::redirect('/admin/products/');
        }

        if ( isset($this->params[0]) ){
            $this->data['goods'] = $this->model->getById($this->params[0]);
            $this->data['goods']['category'] = $this->category->getCategoryById($this->params[0]);
            $this->data['categories_list'] = $this->category->getCategoriesList();
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

    public function admin_category(){
        $this->data['categories'] = $this->category->getCategoriesList();
    }

    public function  admin_add_category(){
        if ($_POST) {
            $id = isset($_POST['id']) ? $_POST['id'] : null;
            $result = $this->category->saveCategory($_POST, $id);
            if ($result) {
                Session::setFlash('Категория создана');
            } else {
                Session::setFlash('Ошибка!');
            }
            Router::redirect('/admin/products/category');
        }

        $this->data['category'] = $this->category->getCategoriesList();
    }

    public function admin_edit_category(){
        if ( $_POST){
            $id = isset($_POST['id']) ? $_POST['id'] : null;
            $result = $this->category->saveCategory($_POST, $id);
            if ( $result ){
                Session::setFlash('Изменения сохранены');
            } else {
                Session::setFlash('Ошибка!');
            }
            Router::redirect('/admin/products/category');
        }

        if ( isset($this->params[0]) ){
            $this->data['category'] = $this->category->getCategoryById($this->params[0]);
            $this->data['categories_list'] = $this->category->getCategoriesList();
        } else {
            Session::setFlash('Неправильный id товара!');
            Router::redirect('/admin/products/');
        }
    }

    public function admin_delete_category(){
        if ( isset($this->params[0]) ){
            $result = $this->category->delete($this->params[0]);
            if ( $result ){
                Session::setFlash('Категория удалена');
            } else {
                Session::setFlash('Ошибка!');
            }
        }
        Router::redirect('/admin/products/category');
    }

    public function search(){
        if (isset($_GET['search'])){
            $this->data['search'] = $this->model->search($_GET['search']);
            $this->data['count'] = $this->model->searchCount($_GET['search']);
        } else {
            Session::setFlash('Ничего не найдено!');
        }
    }

}