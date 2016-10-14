<?php

class OrdersController extends Controller{

    private $cart;
    private $user;
    private $subject = 'Замовлення з сайту: Чайний-магазин';
    private $template = 'order.html';

    public function __construct($data = array()){
        parent::__construct($data);
        $this->model = new Order();
        $this->cart = new Cart();
        $this->user = new User();
    }

    public function add(){
        if (Session::get('id')){
            $id = (int)Session::get('id');
            $this->data['user'] = $this->user->getById($id);
        } else{
            Session::setFlash('Для замовлення потрібно зареєструватися або увійти в обліковий запис');
            Router::redirect('/users/login');
        }

        $this->data['order'] = $this->cart->getProducts();

        if (empty($this->data['order'])){
            $this->cart->isEmpty();
            Session::setFlash('Немає товарів у кошику');
            Router::redirect('/cart');
        }

        if ($_POST){
            if (isset($_POST['city']) && isset($_POST['delivery']) &&
                isset($_POST['surname']) && isset($_POST['name']) &&
                isset($_POST['phone']) && isset($_POST['payment'])) {
                Mail::send($this->data['user']['email'], $this->subject, $this->data['order'], $this->template, $_POST);
                $result = $this->model->add($_POST, $this->data['order']);
                $this->cart->clear();
                if($result) {
                    Session::setFlash('Ви зробили замовлення, чекайте дзвінка менеджера');
                }
            }else{
                Session::setFlash('Необхідно заповнити всі поля!');
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
            $this->model->delete($this->params[0]);
        }
        Router::redirect('/admin/orders/');
    }

}