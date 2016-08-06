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

    public function add(){
        if (Session::get('id')){
            $id = Session::get('id');
            $this->data['user'] = $this->user->getById($id);
        }

        $this->data['order'] = $this->cart->getProducts();

        if ($this->cart->isEmpty()){
            Session::setFlash('Нету товаров.');
        }

        if ($_POST){
            if (isset($_POST['city'], $_POST['delivery'], $_POST['surname'],
                $_POST['name'], $_POST['middle_name'],
                $_POST['phone'], $_POST['payment_method']))
            {   $result = $this->model->add($_POST, $this->data['order']);
                if($result) {
                    Session::setFlash('Вы сделали заказ, ожидайте звонка менеджера');
                }
            }else{
                Session::setFlash('Необходимо заполнить все поля!');
            }
        }
    }

    public function admin_index(){

    }

}