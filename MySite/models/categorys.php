<?php

class Categorys extends Model {

    protected $table = 'category';

    public function getCategoriesList(){
        $sql = "select * from {$this->table}";
         return $this->db->query($sql);
    }

    public function getProductCategory($alias){
        $alias = $this->db->escape($alias);
        $sql = "select cat.name as name, cat.parent_id, cat.alias from {$this->table} as cat 
                inner join goods as g on (cat.id=g.category_id) 
                where g.alias = '{$alias}'";
        if($result = $this->db->query($sql)){
            return $result[0];
        }
        return null;
    }

    public function getCategoryById($id){
        $id = (int)$id;
        $sql = "select * from {$this->table} where category.id = '{$id}'";
        return $this->db->query($sql);
    }

    public function getCategoryByAlias($alias){
        $alias = $this->db->escape($alias);
        $sql = "select * from {$this->table} where category.alias = '{$alias}'";
        if($result = $this->db->query($sql)){
            return $result[0];
        }
        return null;
    }

    public function getParentCategoryByAlias($alias){
        $alias = $this->db->escape($alias);
        $sql = "select * from {$this->table} where alias = '{$alias}' and parent_id = '0'";
        if($result = $this->db->query($sql)){
            return $result[0];
        }
        return null;
    }

    public function getProductsParentCategory($id, $limit){
        $count = (int)Config::get('items_per_page');
        $id = (int)$id;
        $sql = "select goods.*, category.name as category_name, 
                category.parent_id as parent from goods
                join {$this->table} on goods.category_id = category.id 
                where category.parent_id = '{$id}' limit {$limit}, {$count}";
        return $this->db->query($sql);
    }

    public function getProductsFromCategoryByAlias($alias, $limit){
        $count = (int)Config::get('items_per_page');
        $alias = $this->db->escape($alias);
        $sql = "select goods.id, goods.name as g_name, goods.price, goods.img, goods.alias as g_alias, 
                category.name as c_name, category.alias as c_alias from goods 
                join {$this->table} on goods.category_id = category.id 
                where category.alias = '{$alias}' limit {$limit}, {$count}";
        return $this->db->query($sql);
    }

    public function getCountParent($id){
        $id = (int)$id;
        $sql = "select count(*) as `count` from goods 
                join category on goods.category_id = category.id 
                where category.parent_id = '{$id}' ";
        $result = $this->db->query($sql);
        return isset($result[0]) ? $result[0] : null;
    }

    public function getCountInCategory($alias){
        $alias = $this->db->escape($alias);
        $sql = "select count(*) as `count` from goods 
                join category on goods.category_id = category.id 
                where category.alias = '{$alias}'";
        $result = $this->db->query($sql);
        return isset($result[0]) ? $result[0] : null;
    }

    public function saveCategory($data, $id=array()){
        $id = (int)$id;
        $name = $this->db->escape($data['name']);
        $alias = $this->db->escape($data['alias']);
        $parent_id = $this->db->escape($data['parent']);

        if (!$id) {
            $sql = "insert into {$this->table} set name = '{$name}', 
            alias = '{$alias}', 
            parent_id = '{$parent_id}'";
        } else {
            $sql = "update {$this->table} set name = '{$name}', 
                    alias = '{$alias}', 
                    parent_id = '{$parent_id}'
                    where id = '{$id}'";
        }
        return $this->db->query($sql);
    }

    public function delete($id){
        $id = (int)$id;
        $sql = "delete from {$this->table} where id = '{$id}'";
        return $this->db->query($sql);
    }
}