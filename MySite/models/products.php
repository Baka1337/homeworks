<?php

class Products extends Model {

    protected $table = 'goods';

    public function getList(){
        $sql = "select * from {$this->table} ";
        return $this->db->query($sql);
    }

    public function getListLimit($limit){
        $count = (int)Config::get('items_per_page');
        $sql = "select * from {$this->table} limit {$limit},{$count}";
        return $this->db->query($sql);
    }

    public function getBestsellers(){
        $sql = "select * from {$this->table} where bestseller = 1";
        return $this->db->query($sql);
    }

    public function getCount(){
        $sql = "select count(*) as count from {$this->table}";
        $result = $this->db->query($sql);
        return isset($result[0]) ? $result[0] : null;
    }

    public function getById($id){
        $id = (int)$id;
        $sql = "select * from {$this->table} where id = '{$id}' limit 1";
        $result = $this->db->query($sql);
        return isset($result[0]) ? $result[0] : null;
    }

    public function getByAlias($alias){
        $alias = $this->db->escape($alias);
        $sql = "select * from {$this->table} where alias = '{$alias}' limit 1";
        $result = $this->db->query($sql);
        return isset($result[0]) ? $result[0] : null;
    }

    public function cart($id){
        $id = (int)$id;
        $sql = "select id, name, alias, price, img from {$this->table} where id = '{$id}' limit 1";
        $result = $this->db->query($sql);
        return isset($result[0]) ? $result[0] : null;
    }

    public function save($data, $file){
        if (!isset($data['id']) || !isset($data['name']) || !isset($data['price']) || !isset($data['description']) || !isset($data['category'])) {
            return false;
        }
        $id = (int)$this->db->escape($data['id']);
        $name = $this->db->escape($data['name']);
        $alias = $this->db->escape($data['alias']);
        $price = $this->db->escape($data['price']);
        $description = $this->db->escape($data['description']);
        $category = $this->db->escape($data['category']);
        $is_published = isset($data['is_published']) ? 1 : 0;

        $uploaddir = IMG_PATH;
        $newfile = 'img-'.$id.'.jpg';
        $uploadfile = $uploaddir . $newfile;

        $sql = "update {$this->table}
                   set name = '{$name}',
                       alias = '{$alias}',
                       price = '{$price}',
                       description = '{$description}',
                       category_id = '{$category}',
                       is_published = {$is_published},
                       img = '{$newfile}'
                 where id = '{$id}'
                            ";

        $this->db->query($sql);

        if (move_uploaded_file($file['photo']['tmp_name'], $uploadfile)) {
            return true;
        } else {
            echo "Не удалось загрузить картинку!";
        }

    }


    public function add($data, $file){
        if (!isset($data['name']) || !isset($data['price']) || !isset($data['description']) || !isset($data['category'])) {
            return false;
        }

        $alias = $this->db->escape($data['alias']);
        $name = $this->db->escape($data['name']);
        $price = $this->db->escape($data['price']);
        $description = $this->db->escape($data['description']);
        $category = $this->db->escape($data['category']);
        $is_published = isset($data['is_published']) ? 1 : 0;

        $sql = "insert into {$this->table}
                   set name = '{$name}',
                       alias = '{$alias}',
                       price = {$price},
                       description = '{$description}',
                       category_id = {$category},
                       is_published = {$is_published}
                            ";

        $this->db->query($sql);

        $id = (int)$this->db->insertId();

        $uploaddir = IMG_PATH;
        $newfile = 'img-'.$id.'.jpg';
        $uploadfile = $uploaddir . $newfile;

        $sql = "update {$this->table}
                    set img = '{$newfile}'
                    where id = {$id}
                            ";
        $this->db->query($sql);

        if (move_uploaded_file($file['photo']['tmp_name'], $uploadfile)) {
            return true;
        } else {
            echo "Не удалось загрузить картинку!";
        }
    }

    public function delete($id){
        $id = (int)$id;
        $sql = "delete from {$this->table} where id = {$id}";
        unlink(IMG_PATH.'img-'.$id.'.jpg');
        return $this->db->query($sql);
    }

    public function search($search){
        $search = $this->db->escape($search);
        $sql = "select goods.*, category.name as cat_name from {$this->table} 
                        join category on (goods.category_id = category.id)
                        where goods.name like '%{$search}%' 
                        or category.name like '%{$search}%' 
                        order by goods.id asc";
        return $this->db->query($sql);
    }

}