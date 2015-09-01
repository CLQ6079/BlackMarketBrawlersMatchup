<?php
    require_once('banned_champion.php');
    require_once('lolelf_dbobj.php');
    class team extends lolelf_dbobj {
        function __construct() {
            $this->table_name = 'team';
            $this->all_fields = array('bans' => 'list_lolelf_dbobj',
                                      'baronKills' => 'int',
                                      'dominionVictoryScore' => 'int',
                                      'dragonKills' => 'int',
                                      'firstBaron' => 'boolean',
                                      'firstBlood' => 'boolean',
                                      'firstDragon' => 'boolean',
                                      'firstInhibitor' => 'boolean',
                                      'firstTower' => 'boolean',
                                      'inhibitorKills' => 'int',
                                      'teamId' => 'int',
                                      'towerKills' => 'int',
                                      'vilemawKills' => 'int',
                                      'winner' => 'boolean',
                                      'reference_id' => 'reference_id',
                                      'reference_type' => 'reference_type',
                                      'reference_field' => 'reference_field');
            $this->non_empty_fields = array('teamId');
            $this->reference_type = 13;
            $this->id_field = 'teamId';
            $this->obj_field_map = array('bans' => 'banned_champion');
        }
    }
?>