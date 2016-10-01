<?php

class UsersController extends Controller{

    private $order;
    private $subject = 'Регистрация на сайте: Чайный-магазин';
    private $template = 'mail.html';

    public function __construct($data = array()){
        parent::__construct($data);
        $this->model = new User();
        $this->order = new Order;
    }

    public function index(){
        Router::redirect('/');
    }

    public function login(){
        if ( $_POST && isset($_POST['login']) && isset($_POST['password']) ){
            $user = $this->model->getByLogin($_POST['login']);
            $hash = md5(Config::get('salt').$_POST['password']);
            if ( $user && $user['is_active'] && $hash == $user['password'] ){
                Session::set('login', $user['login']);
                Session::set('id', $user['id']);
                Session::set('name', $user['name']);
                Session::set('email', $user['email']);
                Session::set('role', $user['role']);
            }
            if ($user['role'] == 'admin'){
                Router::redirect('/admin/');
            }
            Router::redirect('/');
        }
    }

    public function register(){
        if ($_POST) {
            if (isset($_POST['name']) && $_POST['name'] != null &&
                isset($_POST['surname']) && $_POST['surname'] != null &&
                isset($_POST['city']) && $_POST['city'] != null &&
                isset($_POST['street']) && $_POST['street'] != null &&
                isset($_POST['phone']) && $_POST['phone'] != null &&
                isset($_POST['login']) && $_POST['login'] != null &&
                isset($_POST['email']) && $_POST['email'] != null &&
                isset($_POST['password']) && $_POST['password'] != null
            ) {
                $result = $this->model->register($_POST);
                if ($result) {
                    $user = $this->model->getById($result);
                    $user = Mail::send($user['email'], $this->subject, $user, $this->template, $_POST);
                    Session::set('login', $user['login']);
                    Session::set('email', $user['email']);
                    Session::set('role', $user['role']);
                    Session::setFlash('Регистрация успешно завершена!');
                    Router::redirect('/');
                } else {
                    Session::setFlash('Ошибка при регистрации!');
                    Router::redirect('/users/login/');
                }
            }
        }
    }

    public function profile(){
        $user = (int)Session::get('id');

            if (isset($user)) {
                $this->data['user'] = $this->model->getById($user);
                $this->data['orders'] = $this->order->getOrdersListByUser($user);
            } else {
                Session::setFlash('Ошибка, такого пользователя не существует!');
            }


            if ($_POST) {
                if (isset($_POST['name']) && $_POST['name'] != null &&
                    isset($_POST['phone']) && $_POST['phone'] != null
                ) {
                    if ($this->model->update($_POST, $user)) {
                        Session::setFlash('Информация изменена');
                        Router::redirect('/users/profile');
                    }
                } else {
                    Session::setFlash('Необходимо заполнить все поля!');
                }
            }
        }

    public function password(){
        $user = (int)Session::get('id');

        if($_POST){
            if (isset($params) &&
                isset($_POST['password']) && $_POST['password'] != null &&
                isset($_POST['repeat']) && $_POST['repeat'] != null){
                if ($_POST['password'] == $_POST['repeat']) {
                    $this->model->password($_POST, $user);
                    Session::setFlash('Пароль успешно изменен!');
                    Router::redirect('/users/profile');
                } else {
                    Session::setFlash('Ошибка, пароли не совподают!');
                    Router::redirect('/users/profile');
                }
            } else {
                Session::setFlash('Ошибка, Вы не заполнили все поля!');
            }
        }
    }

    public function admin_index(){
        $this->data = $this->model->getUsers();
    }

    public function admin_edit(){
        if ( $_POST ){
            $id = isset($_POST['id']) ? $_POST['id'] : null;
            $result = $this->model->editUser($_POST, $id);
            if ( $result ){
                Session::setFlash('Пользователь изменен');
            } else {
                Session::setFlash('Ошибка!');
            }
            Router::redirect('/admin/users/');
        }

        if ( isset($this->params[0]) ){
            $this->data = $this->model->getById($this->params[0]);
            $this->data['users'] = $this->model->getUsers();
        } else {
            Session::setFlash('Неправильный id пользователя!');
            Router::redirect('/admin/users/');
        }
    }

    public function admin_delete(){
        if ( isset($this->params[0]) ){
            $result = $this->model->delete($this->params[0]);
            if ( $result ){
                Session::setFlash('Пользователь удален');
            } else {
                Session::setFlash('Ошибка!');
            }
        }
        Router::redirect('/admin/users/');
    }

    public function admin_logout(){
        Session::destroy();
        Router::redirect('/admin/');
    }

    public function logout(){
        Session::destroy();
        Router::redirect('/');
    }

}