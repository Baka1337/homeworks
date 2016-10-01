<?php

class CartController extends Controller{
    private $cart;

    public function __construct($data = array()){
        parent::__construct($data);
        $this->model = new Products();
        $this->cart = new Cart();
    }

    public function index(){

        $this->data['cart'] = $this->cart->getProducts();

        if ($_POST) {
            $quantity = (int)$_POST['quantity'];
            $product = (int)$_POST['product'];

            if (Cookie::get('products')) {
                $this->data['cart'] = unserialize(Cookie::get('products'));

                foreach ($this->data['cart'] as $key => $value) {
                    if ($value['id'] == $product) {
                        $this->data['cart'][$key]['quantity'] = $quantity;
                    }
                }
                Cookie::set('products', serialize($this->data['cart']));
            }

        }
    }

    public function add(){
        if(isset($this->params[0])) {
            $id = (int)$this->params[0];
            $product = $this->model->cart($id);
            $product['quantity'] = 1;
            $this->cart->addProduct($product);
        }
        Router::redirect('/cart');
    }

    public function clear(){
        $this->cart->clear();
        Router::redirect('/cart');
    }

    public function delete(){
        $params = App::getRouter()->getParams();
        if (isset($params[0])){
            $id = (int)$params[0];
            $this->cart->deleteProduct($id);
        }

    }
}