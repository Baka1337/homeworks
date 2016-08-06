<?php

class Product extends Model {

    protected $table = 'goods';

    public function getList(){
        $sql = "select * from {$this->table}";
        return $this->db->query($sql);
    }

    public function getCount(){
        $sql = "select count(*) as count from {$this->table}";
        return $this->db->query($sql);
    }

    public function getById($id){
        $id = (int)$id;
        $sql = "select * from goods where id = '{$id}' limit 1";
        $result = $this->db->query($sql);
        return isset($result[0]) ? $result[0] : null;
    }

    public function getByAlias($alias){
        $alias = $this->db->escape($alias);
        $sql = "select * from {$this->table} where alias = '{$alias}' limit 1";
        $result = $this->db->query($sql);
        return isset($result[0]) ? $result[0] : null;
    }

    public function save($data, $id=array()){
        if ( !isset($data['alias']) || !isset($data['name']) || !isset($data['price']) || !isset($data['description']) ){
            return false;
        }

        $alias = $this->db->escape(App::getNameTranslite($data['alias']));
        $name = $this->db->escape($data['name']);
        $price = $this->db->escape($data['price']);
        $description = $this->db->escape($data['description']);
        $is_published = isset($data['is_published']) ? 1 : 0;

        if ( !$id ){ // Add new record
            $sql = "
                insert into {$this->table}
                   set alias = '{$alias}',
                       name = '{$name}',
                       price = '{$price}',
                       description = '{$description}',
                       is_published = {$is_published}
            ";
        } else { // Update existing record
            $sql = "
                update {$this->table}
                   set alias = '{$alias}',
                       name = '{$name}',
                       price = '{$price}',
                       description = '{$description}',
                       is_published = {$is_published}
                   where id = {$id}
            ";
        }

        return $this->db->query($sql);
    }

    public function delete($id){
        $id = (int)$id;
        $sql = "delete from {$this->table} where id = {$id}";
        return $this->db->query($sql);
    }
}