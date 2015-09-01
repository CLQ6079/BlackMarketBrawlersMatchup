<?php
    require_once('block.php');
    require_once('lolelf_dbobj.php');
    class recommended extends lolelf_dbobj {
        function __construct() {
            $this->table_name = 'static_RecommendedDto';
            $this->all_fields = array('blocks' => 'list_lolelf_dbobj',
                                      'champion' => 'string',
                                      'map' => 'string',
                                      'mode' => 'string',
                                      'priority' => 'boolean',
                                      'title' => 'string',
                                      'type' => 'string',
                                      'reference_type' => 'reference_type',
                                      'reference_id' => 'reference_id',
                                      'reference_field' => 'reference_field');
            $this->non_empty_fields = array();
            $this->reference_type = 4;
            $this->id_field = 'id';
            $this->obj_field_map = array('blocks' => 'block');
        }
    }
?>