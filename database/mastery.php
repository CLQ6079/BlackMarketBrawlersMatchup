<?php
    require_once('../../api/constants.php');
    require_once('image.php');
    require_once('lolelf_dbobj.php');
    
    class mastery extends lolelf_dbobj {
        function __construct() {
            $this->table_name = 'mastery';
            $this->all_fields = array('id' => 'int',
                                      'description' => 'json',
                                      'image' => 'lolelf_dbobj',
                                      'masteryTree' => 'string',
                                      'name' => 'string',
                                      'prereq' => 'string',
                                      'ranks' => 'int',
                                      'sanitizedDescription' => 'json');
            $this->non_empty_fields = array('id');
            $this->reference_type = 1;
            $this->id_field = 'id';
            $this->obj_field_map = array('image' => 'image');
        }
    }
?>