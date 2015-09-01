<?php
    require_once('position.php');
    require_once('lolelf_dbobj.php');
    class event extends lolelf_dbobj {
        function __construct() {
            $this->table_name = 'event';
            $this->all_fields = array('id' => 'int',
                                      'ascendedType' => 'string',
                                      'assistingParticipantIds' => 'json',
                                      'buildingType' => 'string',
                                      'creatorId' => 'int',
                                      'eventType' => 'string',
                                      'itemAfter' => 'int',
                                      'itemBefore' => 'int',
                                      'itemId' => 'int',
                                      'killerId' => 'int',
                                      'laneType' => 'string',
                                      'levelUpType' => 'string',
                                      'monsterType' => 'string',
                                      'participantId' => 'int',
                                      'pointCaptured' => 'string',
                                      'position' => 'lolelf_dbobj',
                                      'skillSlot' => 'int',
                                      'teamId' => 'int',
                                      'timestamp' => 'int',
                                      'towerType' => 'string',
                                      'victimId' => 'int',
                                      'wardType' => 'string',
                                      'reference_id' => 'reference_id',
                                      'reference_type' => 'reference_type',
                                      'reference_field' => 'reference_field');
            $this->non_empty_fields = array('id');
            $this->reference_type = 16;
            $this->id_field = 'id';
            $this->obj_field_map = array('position' => 'position');
        }
    }
?>