<?php
    require_once('lolelf_dbobj.php');
    class participant_timeline_data extends lolelf_dbobj {
        function __construct() {
            $this->table_name = 'participantTimelineData';
            $this->all_fields = array('tenToTwenty' => 'double',
                                      'thirtyToEnd' => 'double',
                                      'twentyToThirty' => 'double',
                                      'zeroToTen' => 'double',
                                      'reference_id' => 'reference_id',
                                      'reference_type' => 'reference_type',
                                      'reference_field' => 'reference_field');
            $this->non_empty_fields = array();
            $this->obj_field_map = array();
        }
    }
?>