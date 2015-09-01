<?php
    require_once('lolelf_dbobj.php');
    class stats extends lolelf_dbobj {
        function __construct() {
            $this->table_name = 'static_StatsDto';
            $this->all_fields = array('id' => 'int',
                                      'armor' => 'double',
                                      'armorperlevel' => 'double',
                                      'attackdamage' => 'double',
                                      'attackdamageperlevel' => 'double',
                                      'attackrange' => 'double',
                                      'attackspeedoffset' => 'double',
                                      'attackspeedperlevel' => 'double',
                                      'crit' => 'double',
                                      'critperlevel' => 'double',
                                      'hp' => 'double',
                                      'hpperlevel' => 'double',
                                      'hpregen' => 'double',
                                      'hpregenperlevel' => 'double',
                                      'movespeed' => 'double',
                                      'mp' => 'double',
                                      'mpperlevel' => 'double',
                                      'mpregen' => 'double',
                                      'mpregenperlevel' => 'double',
                                      'spellblock' => 'double',
                                      'spellblockperlevel' => 'double',
                                      'reference_id' => 'reference_id',
                                      'reference_type' => 'reference_type',
                                      'reference_field' => 'reference_field');
            $this->non_empty_fields = array();
        }
    }
?>