<?php
    require_once('../../api/base.php');
    require_once('../../database/connection.php');  
    require_once('../../database/match.php');
    
    
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
    
    read_matches("../../data/EUW.json.data");
    
    
?>

