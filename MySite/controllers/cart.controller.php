<?php

class CartController extends Controller{
    private $cart;

    public function __construct($data = array()){
        parent::__construct($data);
        $this->model = new Products();
        $this->cart = new Cart();
    }

    public function index(){
        $quantity = null;
        $product = null;
        if ($_POST) {
            $quantity = (int)$_POST['quantity'];
            $product = (int)$_POST['product'];
        }

        $this->data['cart'] = $this->cart->getProducts();

        if(isset($this->data['cart'])) {
            if (Cookie::get('products')) {
                $this->data['cart'] = unserialize(Cookie::get('products'));
            } else {
                foreach ($this->data['cart'] as $key => $value) {
                    $this->data['cart'][$key]['quantity'] = 1;
                }
                Cookie::set('products', serialize($this->data['cart']));
            }
            foreach ($this->data['cart'] as $key => $value) {
                if ($value['id'] == $product) {
                    $this->data['cart'][$key]['quantity'] = $quantity;
                }
            }
            Cookie::set('products', serialize($this->data['cart']));
        }
        if ($this->cart->isEmpty()) {
            Session::setFlash('Корзина пуста');
        }
    }

    public function add(){
        if(isset($this->params[0])) {
            $id = (int)$this->params[0];
            $product = $this->model->getById($id);
            $result = $this->cart->addProduct($product);
            if($result) {
                Session::setFlash('Товар добавлен в корзину');
            }else{
                Session::setFlash('Ошибка!');
            }
        }
        Router::redirect('/cart/');
    }

    public function clear(){
        $this->cart->clear();
        Router::redirect('/cart/');
    }

    public function delete(){
        $params = App::getRouter()->getParams();
        if (isset($params[0])){
            $id = (int)$params[0];
            $this->cart->deleteProduct($id);
        }

    }
}