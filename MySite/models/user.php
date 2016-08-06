<?php

class User extends Model {

    protected $table = 'users';

    public function getById($id){
        $id = (int)$id;
        $sql = "select * from {$this->table} where id = '{$id}' limit 1";
        $result = $this->db->query($sql);
        if ( isset($result[0]) ){
            return $result[0];
        }
        return false;
    }

    public function getByLogin($login){
        $login = $this->db->escape($login);
        $sql = "select * from {$this->table} where login = '{$login}' limit 1";
        $result = $this->db->query($sql);
        if ( isset($result[0]) ){
            return $result[0];
        }
        return false;
    }

    public function update($data, $id=array()){
        $id = (int)$id;
        $surname = $this->db->escape($data['surname']);
        $name = $this->db->escape($data['name']);
        $middlename = $this->db->escape($data['middlename']);
        $city = $this->db->escape($data['city']);
        $street = $this->db->escape($data['street']);
        $house = $this->db->escape($data['house']);
        $flat = $this->db->escape($data['flat']);
        $additionally = $this->db->escape($data['additionally']);
        $phone = $this->db->escape($data['phone']);

        $sql = "update {$this->table}
                   set surname = '{$surname}',
                       name = '{$name}',
                       middlename = '{$middlename}',
                       city = '{$city}',
                       street = '{$street}',
                       house = {$house},
                       flat = {$flat},
                       additionally = '{$additionally}',
                       phone = {$phone}
                   where id = {$id}
        ";
        return $this->db->query($sql);
    }

    public function password($data, $id=array()){
        if (!isset($data['password']) || !isset($data['repeat'])){
            return false;
        }

        $id = (int)$id;
        $password = $data['password'];
        $hash = md5(Config::get('salt').$password);

        $sql = "update {$this->table}
                   set password = '{$hash}'
                   where id = {$id}
        ";
        return $this->db->query($sql);
    }

    public function register($data){
        if (!isset($data['login']) || !isset($data['password'])){
            return false;
        }
        $login = $this->db->escape(strtolower($data['login']));
        $name = $this->db->escape(strtolower($data['name']));
        $surname = $this->db->escape($data['surname']);
        $email = $this->db->escape(strtolower($data['email']));
        $phone = $this->db->escape($data['phone']);

        if ($this->getByLogin($login)){
            return false;
        }

        $password = $data['password'];
        $hash = md5(Config::get('salt').$password);


        $sql = "insert into {$this->table}
                    set login = '{$login}',
                        name = '{$name}',
                        surname = '{$surname}',
                        email = '{$email}',
                        role = 'user',
                        phone = '{$phone}',
                        password = '{$hash}',
                        is_active = '1'
                    ";


        if ($this->db->query($sql)){
            return $this->db->insertId();
        }
        return false;
    }
}