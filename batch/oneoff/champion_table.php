<?php
  require_once('../../api/base.php');
  require_once('../../database/connection.php');
  
  $db = new db_base();
  
  $champions = json_decode(query_all_champions());
  foreach($champions->champions as $champion){
    $id = (int)$champion->id;
    $active = (int)$champion->active;
    $botEnabled = (int)$champion->botEnabled;
    $freeToPlay = (int)$champion->freeToPlay;
    $botMmEnabled = (int)$champion->botMmEnabled;
    $rankedPlayEnabled = (int)$champion->rankedPlayEnabled;
    
    $query = "INSERT INTO champions (id, active, botEnabled, freeToPlay, botMmEnabled, rankedPlayEnabled) VALUES ";
    $query .= "({$id}, {$active}, {$botEnabled}, {$freeToPlay}, {$botMmEnabled}, {$rankedPlayEnabled})";
    #$result = $db->query($query);
    echo "$query";
    echo "<br>";
  }
?>