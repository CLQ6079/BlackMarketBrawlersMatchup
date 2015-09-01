<?php
  require_once("constants.php");

  
  class db_base {
    public $handle;
    function __construct() {
      $this->handle = new mysqli();
      $this->handle->real_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
      if($this->handle->connect_errno){
          echo 'its over';
          die("Database connection failed: " . $this->handle->connect_error . "(" . $this->handle->connect_errno . ")");
      }
    }
    
    function query($query) {
      $result = $this->handle->query($query);
      if($this->handle->errno!=0){
        echo "Errorcode: " . $this->handle->errno . "<br>";
        echo "error is: " . $this->handle->error . "<br>";
        echo $query . "<br>";
        exit();
      }
      return $result;
    }
    
    function get_insert_id() {
      return $this->handle->insert_id;
    }
    
    function __destruct() {
      $this->handle->close();
    }
  }
?>