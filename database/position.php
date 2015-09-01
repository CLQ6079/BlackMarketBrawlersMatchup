<?php
    require_once('lolelf_dbobj.php');
    class position extends lolelf_dbobj {
        function __construct() {
            $this->table_name = 'position';
            $this->all_fields = array('x' => 'int',
                                      'y' => 'int',
                                      'reference_id' => 'reference_id',
                                      'reference_type' => 'reference_type',
                                      'reference_field' => 'reference_field');
            $this->non_empty_fields = array('x', 'y');
            $this->obj_field_map = array();
        }
    }
?>