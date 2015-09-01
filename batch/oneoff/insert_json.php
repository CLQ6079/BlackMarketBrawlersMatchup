<?php
    require_once('../../api/base.php');
    require_once('../../database/champion.php');
    require_once('../../database/connection.php');  
    require_once('../../database/map_details.php');
    require_once('../../database/mastery.php');
    require_once('../../database/match.php');
    
    function insert_mastery(){
        $json_result = query_riot_api(GET_NA_STATIC_MASTERY_1_2);
        if($json_result == -1){
            die('query all masteries failed');
        }
        $result = json_decode($json_result);
        
        foreach($result->data as $mastery_data) {
            $mastery = new mastery();
            $mastery->insert_json($mastery_data, null, null, null);
        }
        
    }
    
    function insert_champions($db){
        $json_result = query_riot_api(GET_NA_STATIC_CHAMPION_1_2);
        if($json_result == -1){
            die('query all champions failed');
        }
        $result = json_decode($json_result);
        
        foreach($result->data as $mastery_data) {
            $mastery = new champion();
            $mastery->insert_json($db, $mastery_data, null, null, null);
        }
        
    }
    
    function insert_items(){
        $json_result = query_riot_api(GET_NA_STATIC_CHAMPION_1_2);
        if($json_result == -1){
            die('query all items failed');
        }
        $result = json_decode($json_result);
        
        foreach($result->data as $mastery_data) {
            $mastery = new champion();
            $mastery->insert_json($mastery_data, null, null, null);
        }
        
    }
    
    function insert_match_by_id($db, $id){
        $json_result = query_riot_api("https://na.api.pvp.net/api/lol/na/v2.2/match/{$id}?includeTimeline=true&api_key=b7190b84-484d-4cc7-88ca-8e2b90fb7f56");
        if($json_result == -1){
            die("query match id {$id} failed");
        }
        $result = json_decode($json_result);
        
        $match = new match();
        $match->insert_json($db, $result, null, null, null);
    }
    
    function read_matches($file_name){
        $db = new db_base();
        $handle = fopen($file_name, "r");
        if ($handle) {
        while (($line = fgets($handle)) !== false) {
            $result = json_decode($line);
            $match = new match();
            $match->insert_json($db, $result, null, null, null);
        }
        fclose($handle);
        } else {
            echo "cant open this fucking file";
        }
    }
    
    $db = new db_base();
    //insert_champions($db);
    read_matches('../../data/RU.json.data');
    
    
?>

