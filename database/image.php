<?php
    require_once('../../api/constants.php');
    require_once('lolelf_dbobj.php');
    
    class image extends lolelf_dbobj {
        function __construct() {
            $this->table_name = 'static_ImageDto';
            $this->all_fields = array('full' => 'string',
                                      'group' => 'string',
                                      'h' => 'int',
                                      'sprite' => 'string',
                                      'w' => 'int',
                                      'x' => 'int',
                                      'y' => 'int',
                                      'reference_id' => 'reference_id',
                                      'reference_type' => 'reference_type',
                                      'reference_field' => 'reference_field');
            $this->non_empty_fields = array('full', 'group', 'h', 'sprite', 'w', 'x', 'y');
        }
    }
?>