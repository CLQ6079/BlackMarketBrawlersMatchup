<?php
    require_once('lolelf_dbobj.php');
    class banned_champion extends lolelf_dbobj {
        function __construct() {
            $this->table_name = 'bannedChampion';
            $this->all_fields = array('championId' => 'int',
                                      'pickTurn' => 'int',
                                      'reference_id' => 'reference_id',
                                      'reference_type' => 'reference_type',
                                      'reference_field' => 'reference_field');
            $this->non_empty_fields = array();
            $this->obj_field_map = array();
        }
    }
?>