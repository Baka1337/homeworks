<?php
class Cart{
    private $products;

    public function __construct(){
        $this->products = Cookie::get('products') == null ? array() : unserialize(Cookie::get('products'));
    }

    public function getProducts(){
        return $this->products;
    }

    public function addProduct($id){
        $id = (int)$id;

        if (!in_array($id, $this->products)) {
            array_push($this->products, $id);
        }

        Cookie::set('books', serialize($this->products));
    }

    public function deleteProduct($id){
        $id = (int)$id;
        $key = array_search($id, $this->products);
        if($key !== false){
            unset($this->products[$key]);
        }
        Cookie::set('products', serialize($this->products));
        Router::redirect('/products/cart/');
    }

    public function clear(){
        Cookie::delete('products');
    }

    public function isEmpty(){
        return !$this->products;
    }
}