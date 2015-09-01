<?php
    require_once('lolelf_dbobj.php');
    class match_mastery extends lolelf_dbobj {
        function __construct() {
            $this->table_name = 'match_mastery';
            $this->all_fields = array('masteryId' => 'int',
                                      'rank' => 'int',
                                      'reference_id' => 'reference_id',
                                      'reference_type' => 'reference_type',
                                      'reference_field' => 'reference_field');
            $this->non_empty_fields = array('masteryId');
            $this->id_field = 'masteryId';
            $this->obj_field_map = array();
        }
    }
?>