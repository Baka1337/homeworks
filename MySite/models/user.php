<?php

class User extends Model {

    protected $table = 'users';

    public function getByLogin($login){
        $login = $this->db->escape($login);
        $sql = "select * from {$this->table} where login = '{$login}' limit 1";
        $result = $this->db->query($sql);
        if ( isset($result[0]) ){
            return $result[0];
        }
        return false;
    }

}