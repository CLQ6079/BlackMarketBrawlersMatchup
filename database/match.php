<?php
    require_once('participant_identity.php');
    require_once('participant.php');
    require_once('team.php');
    require_once('timeline.php');
    require_once('lolelf_dbobj.php');
    class match extends lolelf_dbobj {
        function __construct() {
            $this->table_name = 'MatchDetail';
            $this->all_fields = array('mapId' => 'int',
                                      'matchCreation' => 'int',
                                      'matchDuration' => 'int',
                                      'matchId' => 'int',
                                      'matchMode' => 'string',
                                      'matchType' => 'string',
                                      'matchVersion' => 'string',
                                      'participantIdentities' => 'list_lolelf_dbobj',
                                      'participants' => 'list_lolelf_dbobj',
                                      'platformId' => 'string',
                                      'queueType' => 'string',
                                      'region' => 'string',
                                      'season' => 'string',
                                      'teams' => 'list_lolelf_dbobj',
                                      'timeline' => 'lolelf_dbobj');
            $this->non_empty_fields = array('matchId');
            $this->reference_type = 8;
            $this->id_field = 'matchId';
            $this->obj_field_map = array('participantIdentities' => 'participant_identity',
                                          'participants' => 'participant',
                                          'teams' => 'team',
                                          'timeline' => 'timeline');
        }
    }
?>