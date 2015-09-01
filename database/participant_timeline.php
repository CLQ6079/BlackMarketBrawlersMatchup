<?php
    require_once('participant_timeline_data.php');
    require_once('lolelf_dbobj.php');
    class participant_timeline extends lolelf_dbobj {
        function __construct() {
            $this->table_name = 'participantTimeline';
            $this->all_fields = array('id' => 'int',
                                      'ancientGolemAssistsPerMinCounts' => 'lolelf_dbobj',
                                      'ancientGolemKillsPerMinCounts' => 'lolelf_dbobj',
                                      'assistedLaneDeathsPerMinDeltas' => 'lolelf_dbobj',
                                      'assistedLaneKillsPerMinDeltas' => 'lolelf_dbobj',
                                      'baronAssistsPerMinCounts' => 'lolelf_dbobj',
                                      'baronKillsPerMinCounts' => 'lolelf_dbobj',
                                      'creepsPerMinDeltas' => 'lolelf_dbobj',
                                      'csDiffPerMinDeltas' => 'lolelf_dbobj',
                                      'damageTakenDiffPerMinDeltas' => 'lolelf_dbobj',
                                      'damageTakenPerMinDeltas' => 'lolelf_dbobj',
                                      'dragonAssistsPerMinCounts' => 'lolelf_dbobj',
                                      'dragonKillsPerMinCounts' => 'lolelf_dbobj',
                                      'elderLizardAssistsPerMinCounts' => 'lolelf_dbobj',
                                      'elderLizardKillsPerMinCounts' => 'lolelf_dbobj',
                                      'goldPerMinDeltas' => 'lolelf_dbobj',
                                      'inhibitorAssistsPerMinCounts' => 'lolelf_dbobj',
                                      'inhibitorKillsPerMinCounts' => 'lolelf_dbobj',
                                      'lane' => 'string',
                                      'role' => 'string',
                                      'towerAssistsPerMinCounts' => 'lolelf_dbobj',
                                      'towerKillsPerMinCounts' => 'lolelf_dbobj',
                                      'towerKillsPerMinDeltas' => 'lolelf_dbobj',
                                      'vilemawAssistsPerMinCounts' => 'lolelf_dbobj',
                                      'vilemawKillsPerMinCounts' => 'lolelf_dbobj',
                                      'wardsPerMinDeltas' => 'lolelf_dbobj',
                                      'xpDiffPerMinDeltas' => 'lolelf_dbobj',
                                      'xpPerMinDeltas' => 'lolelf_dbobj',
                                      'reference_id' => 'reference_id',
                                      'reference_type' => 'reference_type',
                                      'reference_field' => 'reference_field');
            $this->non_empty_fields = array('id');
            $this->reference_type = 12;
            $this->id_field = 'id';
            $this->obj_field_map = array('id' => 'int',
                                        'ancientGolemAssistsPerMinCounts' => 'participant_timeline_data',
                                        'ancientGolemKillsPerMinCounts' => 'participant_timeline_data',
                                        'assistedLaneDeathsPerMinDeltas' => 'participant_timeline_data',
                                        'assistedLaneKillsPerMinDeltas' => 'participant_timeline_data',
                                        'baronAssistsPerMinCounts' => 'participant_timeline_data',
                                        'baronKillsPerMinCounts' => 'participant_timeline_data',
                                        'creepsPerMinDeltas' => 'participant_timeline_data',
                                        'csDiffPerMinDeltas' => 'participant_timeline_data',
                                        'damageTakenDiffPerMinDeltas' => 'participant_timeline_data',
                                        'damageTakenPerMinDeltas' => 'participant_timeline_data',
                                        'dragonAssistsPerMinCounts' => 'participant_timeline_data',
                                        'dragonKillsPerMinCounts' => 'participant_timeline_data',
                                        'elderLizardAssistsPerMinCounts' => 'participant_timeline_data',
                                        'elderLizardKillsPerMinCounts' => 'participant_timeline_data',
                                        'goldPerMinDeltas' => 'participant_timeline_data',
                                        'inhibitorAssistsPerMinCounts' => 'participant_timeline_data',
                                        'inhibitorKillsPerMinCounts' => 'participant_timeline_data',
                                        'lane' => 'string',
                                        'role' => 'string',
                                        'towerAssistsPerMinCounts' => 'participant_timeline_data',
                                        'towerKillsPerMinCounts' => 'participant_timeline_data',
                                        'towerKillsPerMinDeltas' => 'participant_timeline_data',
                                        'vilemawAssistsPerMinCounts' => 'participant_timeline_data',
                                        'vilemawKillsPerMinCounts' => 'participant_timeline_data',
                                        'wardsPerMinDeltas' => 'participant_timeline_data',
                                        'xpDiffPerMinDeltas' => 'participant_timeline_data',
                                        'xpPerMinDeltas' => 'participant_timeline_data');
        }
    }
?>