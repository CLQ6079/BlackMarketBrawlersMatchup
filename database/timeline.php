<?php
    require_once('frame.php');
    require_once('lolelf_dbobj.php');
    class timeline extends lolelf_dbobj {
        function __construct() {
            $this->table_name = 'timeline';
            $this->all_fields = array('id' => 'int',
                                      'frameInterval' => 'int',
                                      'frames' => 'list_lolelf_dbobj',
                                      'reference_id' => 'reference_id',
                                      'reference_type' => 'reference_type',
                                      'reference_field' => 'reference_field');
            $this->non_empty_fields = array('id');
            $this->reference_type = 14;
            $this->id_field = 'id';
            $this->obj_field_map = array('frames' => 'frame');
        }
    }
?>