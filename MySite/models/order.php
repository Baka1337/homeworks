<?php

class Order extends Model {

    protected $table = 'orders';
    protected $table_two = 'order_details';

    public function getOrdersList(){
        $sql = "select orders.*, delivery_types.title as d_type, payment_types.title as p_type, order_statuses.title as o_status from {$this->table}
                      JOIN delivery_types on (orders.delivery_type = delivery_types.id)
                      JOIN payment_types on (orders.payment_type = payment_types.id)
                      JOIN order_statuses on (orders.status = order_statuses.id)";
        return $this->db->query($sql);
    }

    public function getOrdersListDetail($id){
        $id = (int)$id;
        $sql = "select orders.*, delivery_types.title as d_type, payment_types.title as p_type, order_statuses.title as o_status from {$this->table}
                      JOIN delivery_types on (orders.delivery_type = delivery_types.id)
                      JOIN payment_types on (orders.payment_type = payment_types.id)
                      JOIN order_statuses on (orders.status = order_statuses.id) 
                      WHERE orders.id = {$id}";
        return $this->db->query($sql);
    }

    public function getOrdersListByUser($user){
        $user = (int)$user;
        $sql = "select orders.*, order_statuses.title as o_status from {$this->table}  
                       JOIN order_statuses on (orders.status = order_statuses.id)
                       where user_id = '{$user}'";
        return $this->db->query($sql);
    }

    public function status($data){
        $id = (int)$this->db->escape($data['id']);
        $status = (int)$this->db->escape($data['status']);

        $sql = "update {$this->table} set status = '{$status}' where id = '{$id}'";
        return $this->db->query($sql);
    }

    public function add($data, $order){
        $city = $this->db->escape($data['city']);
        $name = $this->db->escape($data['name']);
        $surname = $this->db->escape($data['surname']);
        $phone = $this->db->escape($data['phone']);
        $street = $this->db->escape($data['street']);
        $house = (int)$data['house'];
        $flat = (int)$data['flat'];
        $delivery_type = (int)$data['delivery'];
        $payment_type = (int)$data['payment'];
        $user_id = (int)Session::get('id');

        $sql = "insert into {$this->table}
                      set name = '{$name}',
                          user_id = '{$user_id}',
                          surname = '{$surname}',
                          phone = '{$phone}',
                          payment_type = '{$payment_type}',
                          delivery_type = '{$delivery_type}',
                          city = '{$city}',
                          street = '{$street}',
                          house = '{$house}',
                          flat = '{$flat}',
                          status = 1,
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
        $sql = "select order_details.*, goods.alias, goods.name as g_name from {$this->table_two} 
        join goods on (order_details.goods_id = goods.id) 
        and order_details.order_id = '{$id}' ";
        return $this->db->query($sql);
    }

    public function delete($id){
        $id = (int)$id;
        $sql = "delete from {$this->table} where id = {$id}";
        $this->db->query($sql);
        $sql = "delete from {$this->table_two} where order_id = {$id}";
        $this->db->query($sql);
    }
}