<?php

class OrdersController extends Controller{

    private $cart;
    private $user;

    public function __construct($data = array()){
        parent::__construct($data);
        $this->model = new Order();
        $this->cart = new Cart();
        $this->user = new User();
    }

    public function sendOrderMail($email, $product){
        $mail = new PHPMailer();
        $mail->setLanguage('ru', ROOT.DS.'lib'.DS.'PHPMailer'.DS.'language'.DS);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->SMTPAuth = 'ssl';
        $mail->Port = 587;
        $mail->CharSet = 'UTF-8';
        $body = file_get_contents(VIEWS_PATH.DS.'mailer'.DS.'order.html');
        $mail->Username = '';
        $mail->Password = '^';
        $mail->setFrom('', 'info');
        $mail->Subject = 'Заказ на сайте Mysitex';
        $mail->addAddress($email);
        $mail->Body = $body;
        $mail->isHTML(true);
        if(!$mail->send()) {
            echo "Ошибка: " . $mail->ErrorInfo;
        } else{
            echo "Сообщение отправлено";
        }
        $mail->clearAddresses();
    }

    public function add(){
        if (Session::get('id')){
            $id = Session::get('id');
            $this->data['user'] = $this->user->getById($id);
        }

        $this->data['order'] = $this->cart->getProducts();
        print_r($this->data['order']);

        if ($this->cart->isEmpty()){
            Session::setFlash('Нету товаров.');
        }

        if ($_POST){
            if (isset($_POST['city'], $_POST['delivery'], $_POST['surname'], $_POST['name'], $_POST['middle_name'], $_POST['phone'], $_POST['payment'])) {
                $result = $this->model->add($_POST, $this->data['order']);
                $result = $this->cart->clear();
                if($result) {
                    Session::setFlash('Вы сделали заказ, ожидайте звонка менеджера');
                    Router::redirect('/cart');
                }
            }else{
                Session::setFlash('Необходимо заполнить все поля!');
            }
        }
    }

    public function admin_index(){
        $this->data['orders'] = $this->model->getOrdersList();
    }

    public function details(){
        $params = App::getRouter()->getParams();

        if ( isset($params[0]) ){
            $id = $params[0];
            $this->data['order_details'] = $this->model->getOrderById($id);
        }
    }

    public function admin_details(){
        $params = App::getRouter()->getParams();

        if ( isset($params[0]) ){
            $id = $params[0];
            $this->data['order_details'] = $this->model->getOrderById($id);
            $this->data['orders'] = $this->model->getOrdersListDetail($id);
        }
    }

    public function admin_status(){
        $params = App::getRouter()->getParams();

        if ( isset($params[0]) ){
            $id = $params[0];
            $this->data['order'] = $id;
        }

        if ($_POST){
            $this->model->status($_POST);
            Router::redirect('/admin/orders/');
        }
    }

    public function admin_delete(){
        if ( isset($this->params[0]) ){
            $result = $this->model->delete($this->params[0]);
            if ( $result ){
                Session::setFlash('Заказ удален');
            } else {
                Session::setFlash('Ошибка!');
            }
        }
        Router::redirect('/admin/orders/');
    }

}