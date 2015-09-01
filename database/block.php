<?php
    require_once('block_item.php');
    require_once('lolelf_dbobj.php');
    class block extends lolelf_dbobj {
        function __construct() {
            $this->table_name = 'static_BlockDto';
            $this->all_fields = array('items' => 'list_lolelf_dbobj',
                                      'recMath' => 'int',
                                      'type' => 'string',
                                      'id' => 'int',
                                      'reference_id' => 'reference_id',
                                      'reference_type' => 'reference_type',
                                      'reference_field' => 'reference_field');
            $this->non_empty_fields = array();
            $this->reference_type = 5;
            $this->id_field = 'id';
            $this->obj_field_map = array('items' => 'block_item');
        }
    }
?>