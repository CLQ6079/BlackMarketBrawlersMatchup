<?php
    require_once('lolelf_dbobj.php');
    class block_item extends lolelf_dbobj {
        function __construct() {
            $this->table_name = 'static_BlockItemDto';
            $this->all_fields = array('count' => 'int',
                                      'id' => 'int',
                                      'reference_id' => 'reference_id',
                                      'reference_type' => 'reference_type',
                                      'reference_field' => 'reference_field');
            $this->non_empty_fields = array();
        }
    }
?>