<?php
    require_once('player.php');
    require_once('lolelf_dbobj.php');
    class participant_identity extends lolelf_dbobj {
        function __construct() {
            $this->table_name = 'ParticipantIdentity';
            $this->all_fields = array('participantId' => 'int',
                                      'player' => 'lolelf_dbobj',
                                      'reference_id' => 'reference_id',
                                      'reference_type' => 'reference_type',
                                      'reference_field' => 'reference_field');
            $this->non_empty_fields = array('participantId');
            $this->reference_type = 9;
            $this->id_field = 'id';
            $this->obj_field_map = array('player' => 'player');
        }
    }
?>