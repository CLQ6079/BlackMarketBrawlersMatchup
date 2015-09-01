<?php
    require_once('event.php');
    require_once('lolelf_dbobj.php');
    class frame extends lolelf_dbobj {
        function __construct() {
            $this->table_name = 'frame';
            $this->all_fields = array('id' => 'int',
                                      'events' => 'list_lolelf_dbobj',
                                      'participantFrames' => 'json',
                                      'timestamp' => 'int',
                                      'reference_id' => 'reference_id',
                                      'reference_type' => 'reference_type',
                                      'reference_field' => 'reference_field');
            $this->non_empty_fields = array('id');
            $this->reference_type = 15;
            $this->id_field = 'id';
            $this->obj_field_map = array('events' => 'event');
        }
    }
?>