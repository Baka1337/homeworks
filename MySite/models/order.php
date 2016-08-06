<?php

class Order extends Model {

    protected $table = 'orders';
    protected $table_two = 'order_details';

    public function add($data, $order){
        $city = $this->db->escape($data['city']);
        $delivery_method = $this->db->escape($data['delivery']);
        $surname = $this->db->escape($data['surname']);
        $name = $this->db->escape($data['name']);
        $middlename = $this->db->escape($data['middle_name']);
        $phone = $this->db->escape($data['phone']);
        $payment_method = $this->db->escape($data['payment_method']);
        $user_id = (int)Session::get('id');

        $sql = "insert into {$this->table}
                      set name = '{$name}',
                          surname = '{$surname}',
                          middlename = '{$middlename}',
                          phone = {$phone},
                          payment_method = '{$payment_method}',
                          delivery_method = '{$delivery_method}',
                          city = '{$city}',
                          user_id = '{$user_id}',
                          date = NOW()
                          ";

        $this->db->query($sql);
        $id = $this->db->insertId();

        foreach ($order as $item){
            $goods_id = $this->db->escape($item['id']);
            $count = $this->db->escape($item['quantity']);
            $price = $this->db->escape($item['price']);

            $sql = "insert into {$this->table_two} 
                          set user_id = '{$user_id}',
                              order_id = '{$id}',
                              goods_id = '{$goods_id}',
                              count = '{$count}',
                              price = '{$price}' ";
            $this->db->query($sql);
        }
    }

    public function getOrderById($id){
        $id = (int)$id;
        $sql = "select order_details.*, goods.alias, goods.name as g_name from {$this->table_two} join goods on (order_details.goods_id = goods.id) where order_details.user_id = '{$id}'";
        return $this->db->query($sql);
//        if (isset($result[0])){
//            return $result[0];
//        } else {
//            return false;
//        }

    }
}