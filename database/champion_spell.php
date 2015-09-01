<?php
    require_once('image.php');
    require_once('leveltip.php');
    require_once('spell_vars.php');
    require_once('lolelf_dbobj.php');
    class champion_spell extends lolelf_dbobj {
        function __construct() {
            $this->table_name = 'static_ChampionSpellDto';
            $this->all_fields = array('id' => 'int',
                                      'altimages' => 'list_lolelf_dbobj',
                                      'cooldown' => 'json',
                                      'cooldownBurn' => 'string',
                                      'cost' => 'json',
                                      'costBurn' => 'string',
                                      'costType' => 'string',
                                      'description' => 'string',
                                      'effect' => 'json',
                                      'effectBurn' => 'json',
                                      'image' => 'lolelf_dbobj',
                                      'key' => 'string',
                                      'leveltip' => 'lolelf_dbobj',
                                      'maxrank' => 'int',
                                      'name' => 'string',
                                      'range' => 'json',
                                      'rangeBurn' => 'string',
                                      'resource' => 'string',
                                      'sanitizedDescription' => 'string',
                                      'sanitizedTooltip' => 'string',
                                      'tooltip' => 'string',
                                      'vars' => 'list_lolelf_dbobj',
                                      'reference_id' => 'reference_id',
                                      'reference_type' => 'reference_type',
                                      'reference_field' => 'reference_field');
            $this->non_empty_fields = array();
            $this->reference_type = 6;
            $this->id_field = 'id';
            $this->obj_field_map = array('altimages' => 'image',
                                         'image' => 'image',
                                         'leveltip' => 'leveltip',
                                         'vars' => 'spell_vars');
        }
    }
?>