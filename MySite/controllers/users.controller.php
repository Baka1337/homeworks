<?php

class UsersController extends Controller{

    private $order;

    public function __construct($data = array()){
        parent::__construct($data);
        $this->model = new User();
        $this->order = new Order;
    }

    public function index(){
        Router::redirect('/');
    }

    public function confirm(){
        $hash = $this->params[0];
    }

    protected function sendWelcomeMail($email, $login){
        $mail = new PHPMailer();
        $mail->SMTPDebug  = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPAuth = 'ssl';
        $mail->Host = "smtp.mail.ru";
        $mail->Port = 465;
        $mail->isHTML(true);
        $mail->Username = "baka@mail.ua";
        $mail->Password = "";
        $mail->CharSet = 'UTF-8';
        $mail->SetFrom = 'baka@mail.ua';
        $mail->Subject = 'Успешная регистрация!';
        $mail->Body = 'Вы зарегистрировались, ваш логин: '.$login;
        $mail->addAddress('igor.baka@gmail.com');
        if(!$mail->send()) {
            echo "Сообщение не может быть отправлено. <p>";
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else{
            echo "Сообщение отправлено";
        }

        echo "<pre>";
        var_dump($mail);
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
        if ($_POST){
            $result = $this->model->register($_POST);
            if ($result){
                $user = $this->model->getById($result);
                Session::set('login', $user['login']);
                Session::set('role', $user['role']);
                Session::setFlash('Регистрация успешно завершена!');
                $this->sendWelcomeMail($user['email'], $user['login']);
                Router::redirect('/');
            } else {
                Session::setFlash('Ошибка при регистрации!');
                Router::redirect('/users/login/');
            }
        }
    }

    public function profile(){
        $user = (int)Session::get('id');

        $this->data['history'] = $this->order->getOrderById($user);

            if (isset($user)) {
                $this->data['user'] = $this->model->getById($user);
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
        $params = (int)Session::get('id');

        if($_POST){
            if (isset($params) &&
                isset($_POST['password']) && $_POST['password'] != null &&
                isset($_POST['repeat']) && $_POST['repeat'] != null){
                if ($_POST['password'] == $_POST['repeat']) {
                    $this->model->password($_POST, $params);
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

    public function admin_logout(){
        Session::destroy();
        Router::redirect('/admin/');
    }

    public function logout(){
        Session::destroy();
        Router::redirect('/');
    }

}