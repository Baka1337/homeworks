<?php

class Message extends Model {

    protected $table = 'messages';

    public function save($data, $id = null){
        if ( !isset($data['name']) || !isset($data['phone']) || !isset($data['email']) || !isset($data['message']) ){
            return false;
        }

        $id = (int)$id;
        $name = $this->db->escape($data['name']);
        $phone = (int)$data['phone'];
        $email = $this->db->escape($data['email']);
        $message = $this->db->escape($data['message']);

        if ( !$id ){ // Add new record
            $sql = "
                insert into {$this->table}
                   set name = '{$name}',
                       phone = {$phone},
                       email = '{$email}',
                       message = '{$message}'
            ";
        } else { // Update existing record
            $sql = "
                update {$this->table}
                   set name = '{$name}',
                       phone = {$phone},
                       email = '{$email}',
                       message = '{$message}'
                   where id = {$id}
            ";
        }

        return $this->db->query(strip_tags($sql));

    }

    public function getList(){
        $sql = "select * from {$this->table} where 1";
        return $this->db->query($sql);
    }

    public function delete($id){
        $id = (int)$id;
        $sql = "delete from {$this->table} where id = {$id}";
        return $this->db->query($sql);
    }
}