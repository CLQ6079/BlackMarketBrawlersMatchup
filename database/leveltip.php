<?php
    require_once('lolelf_dbobj.php');
    class leveltip extends lolelf_dbobj {
        function __construct() {
            $this->table_name = 'static_LevelTipDto';
            $this->all_fields = array('effect' => 'json',
                                      'label' => 'json',
                                      'id' => 'int',
                                      'reference_id' => 'reference_id',
                                      'reference_type' => 'reference_type',
                                      'reference_field' => 'reference_field');
            $this->non_empty_fields = array();
            $this->id_field = 'id';
            $this->obj_field_map = array();
        }
    }
?>