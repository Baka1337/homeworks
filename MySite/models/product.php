<?php

class Product extends Model {

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

    public function getCount(){
        $sql = "select count(*) as count from {$this->table}";
        return $this->db->query($sql);
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

    public function save($data, $file, $id = array()){
        if (!isset($data['name']) || !isset($data['price']) || !isset($data['description']) || !isset($data['category'])) {
            return false;
        }

        $id = $this->db->escape($data['id']);
        $alias = $this->db->escape($data['name']);
        $name = $this->db->escape($data['name']);
        $price = $this->db->escape($data['price']);
        $description = $this->db->escape($data['description']);
        $category = $this->db->escape($data['category']);
        $is_published = isset($data['is_published']) ? 1 : 0;

        if (!$id) { // Add new record
            $sql = "
                insert into {$this->table}
                   set alias = '{$alias}',
                       name = '{$name}',
                       price = '{$price}',
                       description = '{$description}',
                       category_id = '{$category}',
                       views = 0,
                       is_published = {$is_published}
            ";

        } else { // Update existing record
            $sql = "
                update {$this->table}
                   set alias = '{$alias}',
                       name = '{$name}',
                       price = '{$price}',
                       description = '{$description}',
                       category_id = '{$category}',
                       is_published = {$is_published}
                   where id = {$id}
            ";
            return $this->db->query($sql);
        }
        $this->db->query($sql);
        $uploaddir = IMG_PATH;
        $newfile = $this->db->insertId();
        $uploadfile = $newfile .'.'. basename($file['photo']['type']);
        $uploadfile = $uploaddir . $uploadfile;

        if (move_uploaded_file($file['photo']['tmp_name'], $uploadfile)) {
            return true;
        } else {
            echo "Не удалось загрузить картинку!\n";
        }
    }

    public function delete($id){
        $id = (int)$id;
        $sql = "delete from {$this->table} where id = {$id}";
        unlink(IMG_PATH.$id.'.jpeg');
        return $this->db->query($sql);
    }

    public function search($search){
        $search = $this->db->escape($search);
        $sql = "select * from {$this->table} where name like '%{$search}%' ";
        return $this->db->query($sql);
    }

    public function searchCount($search){
        $search = $this->db->escape($search);
        $sql = "select count(*) as count from {$this->table} where name like '%{$search}%' ";
        return $this->db->query($sql);
    }

    public function views($alias){
        $alias = $this->db->escape($alias);
        $sql = "update {$this->table} set views = views + 1 where alias = '{$alias}' limit 1";
        return $this->db->query($sql);
    }
}