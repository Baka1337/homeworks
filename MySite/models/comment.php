<?php

class Comment extends Model {

    protected $table = 'comments';

    public function save($data, $id = null){
        if (!isset($data['name']) || !isset($data['email']) || !isset($data['message'])) {
            return false;
        }

        $id = (int)$id;
        $name = $this->db->escape($data['name']);
        $email = $this->db->escape($data['email']);
        $message = $this->db->escape($data['message']);
        if ( !$id ) {
            $sql = "
                insert into {$this->table}
                   set name = '{$name}',
                       email = '{$email}',
                       message = '{$message}',
                       date_add = NOW()
            ";
        } else {
            $sql = "
                update into {$this->table}
                   set name = '{$name}',
                       email = '{$email}',
                       message = '{$message}',
                       date_add = NOW()
                       where id = {$id}
            ";
        }
        return $this->db->query(strip_tags($sql));
    }

    public function getComments(){
        $sql = "select * from {$this->table} order by dt desc";
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

    public function add($page_id, $page_alias, $page_name, $data){
        if( !isset($data['message']) || !isset($data['email']) ){
            return null;
        }
        $page_id = (int)$page_id;
        $page_name = $this->db->escape($page_name);
        $page_alias = $this->db->escape($page_alias);
        $name = $this->db->escape($data['name']);
        $email = $this->db->escape($data['email']);
        $message = $this->db->escape($data['message']);
        $reply_to = 0;
        if(isset($data['reply_to'])){
            $reply_to = $this->db->escape($data['reply_to']);
        }
        $sql = "
          insert into comments 
            set product_id = {$page_id},
                product_name = '{$page_name}',
                product_alias = '{$page_alias}',
                reply_to = {$reply_to},
                name = '{$name}',
                email = '{$email}',
                message = '{$message}'
        ";
        if($this->db->query($sql)){
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