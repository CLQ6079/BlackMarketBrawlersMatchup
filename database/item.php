<?php
    require_once('lolelf_dbobj.php');
    class item extends lolelf_dbobj {
        function __construct() {
            $this->table_name = 'static_ChampionDto';
            $this->all_fields = array('id' => 'int',
                                      'allytips' => 'json',
                                      'blurb' => 'string',
                                      'enemytips' => 'json',
                                      'image' => 'lolelf_dbobj',
                                      'info' => 'lolelf_dbobj',
                                      'key' => 'string',
                                      'lore' => 'string',
                                      'name' => 'string',
                                      'partype' => 'string',
                                      'passive' => 'lolelf_dbobj',
                                      'recommended' => 'list_lolelf_dbobj',
                                      'skins' => 'list_lolelf_dbobj',
                                      'spells' => 'list_lolelf_dbobj',
                                      'stats' => 'lolelf_dbobj',
                                      'tags' => 'json',
                                      'title' => 'string');
            $this->non_empty_fields = array('id');
            $this->reference_type = 3;
            $this->id_field = 'id';
            $this->obj_field_map = array('image' => 'image',
                                          'info' => 'info',
                                          'passive' => 'passive',
                                          'recommended' => 'recommended',
                                          'skins' => 'skin',
                                          'spells' => 'champion_spell',
                                          'stats' => 'stats');
        }
    }
?>