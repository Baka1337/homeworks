<?php

class Comment extends Model {

    protected $table = 'comments';

    public function edit($data, $id = null){
        $id = (int)$id;
        $message = $this->db->escape($data['message']);
            $sql = "
                update into {$this->table}
                   set message = '{$message}',
                       where id = {$id}
            ";
        return $this->db->query($sql);
    }

    public function getComments(){
        $sql = "select comments.*, goods.name as good_name, goods.alias as good_alias from {$this->table} 
                join goods on (goods.id = comments.product_id)order by dt desc";
        return $this->db->query($sql);
    }

    public function getById($comment_id){
        $comment_id = (int)$comment_id;
        $sql = "select * from {$this->table} where id = {$comment_id} limit 1";
        if($result = $this->db->query($sql)){
            return $result[0];
        }
        return null;
    }

    public function getByProductId($product_id){
        $product_id = (int)$product_id;
        $sql = "select * from {$this->table} where product_id = {$product_id}";
        return $this->db->query($sql);
    }

    public function add($product_id, $data){
        if( !isset($data['name']) || !isset($data['message']) || !isset($data['email']) ){
            return null;
        }

        $product_id = (int)$product_id;
        $name = $this->db->escape($data['name']);
        $email = $this->db->escape($data['email']);
        $message = $this->db->escape($data['message']);

        $sql = "
            insert into {$this->table} 
            set product_id = {$product_id},
                name = '{$name}',
                email = '{$email}',
                message = '{$message}'
        ";

        if($this->db->query(strip_tags($sql))){
            return $this->db->insertId();
        } else {
            return false;
        }
    }

    public function delete($id){
        $id = (int)$id;
        $sql = "delete from {$this->table} where id = {$id}";
        return $this->db->query($sql);
    }

}