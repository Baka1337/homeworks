<?php
class Pagination {
    public $buttons = array();
    public function __construct($items_count, $items_per_page, $current_page){
        if (!$current_page) {
            return;
        }
        $pages_count = ceil($items_count / $items_per_page);
        if ($pages_count == 1) {
            return;
        }
        if ($current_page > $pages_count) {
            $current_page = $pages_count;
        }
        $this->buttons[] = new Button($current_page - 1, $current_page > 1, 'Назад');
        for ($i = 1; $i <= $pages_count; $i++) {
            $active = $current_page != $i;
            $this->buttons[] = new Button($i, $active);
        }
        $this->buttons[] = new Button($current_page + 1, $current_page < $pages_count, 'Вперед');
    }
}