<?php
class Excels extends Model {

//    protected $table = 'goods';

    public function import(){
        $name = $this->db->escape($worksheet->getCellByColumnAndRow(0, $row)->getValue());
        $email = $this->db->escape($worksheet->getCellByColumnAndRow(1, $row)->getValue());
        $sql = "INSERT INTO tbl_excel 
                set name = '{$name}', 
                email = '{$email}'";
        print_r($sql);
        return $this->db->query($sql);
    }
}