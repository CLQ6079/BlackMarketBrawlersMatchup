<?php
    require_once('lolelf_dbobj.php');
    class skin extends lolelf_dbobj {
        function __construct() {
            $this->table_name = 'static_SkinDto';
            $this->all_fields = array('id' => 'int',
                                      'name' => 'string',
                                      'num' => 'int',
                                      'reference_type' => 'reference_type',
                                      'reference_id' => 'reference_id',
                                      'reference_field' => 'reference_field');
            $this->non_empty_fields = array();
        }
    }
?>