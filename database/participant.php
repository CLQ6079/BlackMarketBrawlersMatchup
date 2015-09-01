<?php
    require_once('match_mastery.php');
    require_once('match_rune.php');
    require_once('participant_stats.php');
    require_once('participant_timeline.php');
    require_once('lolelf_dbobj.php');
    class participant extends lolelf_dbobj {
        function __construct() {
            $this->table_name = 'participant';
            $this->all_fields = array('championId' => 'int',
                                      'highestAchievedSeasonTier' => 'string',
                                      'masteries' => 'list_lolelf_dbobj',
                                      'participantId' => 'int',
                                      'runes' => 'list_lolelf_dbobj',
                                      'spell1Id' => 'int',
                                      'spell2Id' => 'int',
                                      'stats' => 'lolelf_dbobj',
                                      'teamId' => 'int',
                                      'timeline' => 'lolelf_dbobj',
                                      'reference_type' => 'reference_type',
                                      'reference_id' => 'reference_id',
                                      'reference_field' => 'reference_field');
            $this->non_empty_fields = array('matchId');
            $this->reference_type = 10;
            $this->id_field = 'id';
            $this->obj_field_map = array('masteries' => 'match_mastery',
                                          'runes' => 'match_rune',
                                          'stats' => 'participant_stats',
                                          'timeline' => 'participant_timeline');
        }
    }
?>