<?php
  require_once('constants.php');
  
  function query_riot_api($url) {
    $arrContextOptions=array(
      "ssl"=>array(
          "verify_peer"=>false,
          "verify_peer_name"=>false,
      ),
    );  
    $response = file_get_contents($url, false, stream_context_create($arrContextOptions));
    if($response){
      return $response;
    }
    else{
      return -1;//return -1 on failure
    }
  }
  
  function query_all_champions() {
    $result = _query_riot_api(GET_NA_CHAMPION_1_2);
    if($result == -1){
      die('query all champions failed');
    }
    return $result;
  }
  
  function query_all_champions_static() {
    $result = _query_riot_api(GET_NA_STATIC_CHAMPION_1_2);
    if($result == -1){
      die('query all static champions failed');
    }
    return $result;
  }
  
  
?>