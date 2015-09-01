<?php
    require_once('lolelf_dbobj.php');
    class player extends lolelf_dbobj {
        function __construct() {
            $this->table_name = 'player';
            $this->all_fields = array('matchHistoryUri' => 'string',
                                      'profileIcon' => 'int',
                                      'summonerId' => 'int',
                                      'summonerName' => 'string',
                                      'reference_id' => 'reference_id',
                                      'reference_type' => 'reference_type',
                                      'reference_field' => 'reference_field');
            $this->non_empty_fields = array('id');
            $this->id_field = 'id';
            $this->obj_field_map = array();
        }
    }
?>