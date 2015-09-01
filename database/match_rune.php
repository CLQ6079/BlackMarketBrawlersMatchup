<?php
    require_once('lolelf_dbobj.php');
    class match_rune extends lolelf_dbobj {
        function __construct() {
            $this->table_name = 'match_rune';
            $this->all_fields = array('runeId' => 'int',
                                      'rank' => 'int',
                                      'reference_id' => 'reference_id',
                                      'reference_type' => 'reference_type',
                                      'reference_field' => 'reference_field');
            $this->non_empty_fields = array('runeId');
            $this->id_field = 'runeId';
            $this->obj_field_map = array();
        }
    }
?>