<?php

class UsersController extends Controller{

    private $order;
    private $subject = 'Реєстрація на сайті: Чайний-магазин';
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
            if (isset($_POST['name']) && isset($_POST['surname']) &&
                isset($_POST['city']) && isset($_POST['street']) &&
                isset($_POST['phone']) && isset($_POST['login']) &&
                isset($_POST['email']) && isset($_POST['password'])) {
                $result = $this->model->register($_POST);
                if ($result) {
                    $user = $this->model->getById($result);
                    $user = Mail::send($user['email'], $this->subject, $user, $this->template, $_POST);
                    Session::set('login', $user['login']);
                    Session::set('email', $user['email']);
                    Session::set('role', $user['role']);
                    Session::setFlash('Реєстрація успішно завершена!');
                    Router::redirect('/');
                } else {
                    Session::setFlash('Помилка при реєстрації!');
                    Router::redirect('/users/login/');
                }
            }
        }
    }

    public function profile(){
        if (Session::has('login')){
        $user = (int)Session::get('id');

            if (isset($user)) {
                $this->data['user'] = $this->model->getById($user);
                $this->data['orders'] = $this->order->getOrdersListByUser($user);
            } else {
                Session::setFlash('Помилка, такого користувача не існує!');
            }
        } else {
                Session::setFlash('Профіль користувача можуть переглядати тільки зареєстровані або авторизовані користувачі!');
                Router::redirect('/users/login');
        }

            if ($_POST) {
                if (isset($_POST['name']) && isset($_POST['phone'])) {
                    if ($this->model->update($_POST, $user)) {
                        Session::setFlash('Зміни збережені');
                        Router::redirect('/users/profile');
                    }
                } else {
                    Session::setFlash('Необхідно заповнити всі поля!');
                }
            }
        }

    public function password(){
        $user = (int)Session::get('id');

        if($_POST){
            if (isset($_POST['password']) && isset($_POST['repeat'])){
                if ($_POST['password'] == $_POST['repeat']) {
                    $this->model->password($_POST, $user);
                    Session::setFlash('Пароль успішно змінений!');
                    Router::redirect('/users/profile');
                } else {
                    Session::setFlash('Помилка, паролі не співпадають!');
                    Router::redirect('/users/profile');
                }
            } else {
                Session::setFlash('Необхідно заповнити всі поля!');
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
                Session::setFlash('Пароль успішно змінений!');
            } else {
                Session::setFlash('Помилка!');
            }
            Router::redirect('/admin/users/');
        }

        if ( isset($this->params[0]) ){
            $this->data = $this->model->getById($this->params[0]);
            $this->data['users'] = $this->model->getUsers();
        } else {
            Session::setFlash('Неправильний id користувача!');
            Router::redirect('/admin/users/');
        }
    }

    public function admin_delete(){
        if ( isset($this->params[0]) ){
            $result = $this->model->delete($this->params[0]);
            if ( $result ){
                Session::setFlash('Користувач вилучений');
            } else {
                Session::setFlash('Помилка!');
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