<?php
class Excels extends Model {

    protected $table = 'goods';

    public function import($cell1, $cell2, $cell3){
        $sql = "insert into {$this->table} 
                    set name = '{$cell1}',
                    description = '{$cell2}',
                    price = '{$cell3}'
                    ";

        return $this->db->query($sql);
    }
}