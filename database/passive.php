<?php
    require_once('image.php');
    require_once('lolelf_dbobj.php');
     class passive extends lolelf_dbobj {
        function __construct() {
            $this->table_name = 'static_PassiveDto';
            $this->all_fields = array('description' => 'string',
                                      'image' => 'lolelf_dbobj',
                                      'name' => 'string',
                                      'sanitizedDescription' => 'string',
                                      'reference_id' => 'reference_id',
                                      'reference_type' => 'reference_type',
                                      'reference_field' => 'reference_field');
            $this->non_empty_fields = array();
            $this->obj_field_map = array('image' => 'image');
            $this->reference_type = 7;
        }
    }
?>