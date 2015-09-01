<?php
    require_once('lolelf_dbobj.php');
    class info extends lolelf_dbobj {
        function __construct() {
            $this->table_name = 'static_InfoDto';
            $this->all_fields = array('attack' => 'int',
                                      'defense' => 'int',
                                      'difficulty' => 'int',
                                      'magic' => 'int',
                                      'reference_id' => 'reference_id',
                                      'reference_type' => 'reference_type',
                                      'reference_field' => 'reference_field');
            $this->non_empty_fields = array();
        }
    }
?>