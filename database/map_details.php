<?php
    require_once('../../api/constants.php');
    require_once('image.php');
    require_once('lolelf_dbobj.php');
    
    class map_details extends lolelf_dbobj {
        function __construct() {
            $this->table_name = 'map_details';
            $this->all_fields = array('mapId' => 'int',
                                      'mapName' => 'string',
                                      'unpurchasableItemList' => 'json');
            $this->non_empty_fields = array('mapId, mapName');
            $this->reference_type = 2;
            $this->query_url = GET_NA_STATIC_MAP_DETAILS_1_2;
            $this->id_field = 'mapId';
        }
    }

?>