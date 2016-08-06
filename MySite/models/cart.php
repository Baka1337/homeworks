<?php

class Cart extends Model {

    public function getById($id){
        $id = (int)$id;
        $sql = "select * from {$this->table} where id = '{$id}' limit 1";
        $result = $this->db->query($sql);
        return isset($result[0]) ? $result[0] : null;
    }
}