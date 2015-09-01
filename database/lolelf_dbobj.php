<?php

require_once('connection.php');
$db_schema = "lolelf_kr";

abstract class lolelf_dbobj
{
    public $table_name;
    // A dict of all fields in this table(field_name->type).
    // Possible types are: string, int, double, boolean, json, lolelf_dbobj, list_lolelf_dbobj, reference_type, reference_id, reference_field
    public $all_fields;
    public $non_empty_fields;
    public $obj_field_map;
    public $reference_type;
    // sometimes the id field has a different name
    public $id_field;

    public function get_next_insert_id($db){
        $query = "SELECT Auto_increment FROM information_schema.tables WHERE table_name='{$this->table_name}' and table_schema='lolelf'";
        $result = $db->query($query);
        $next_id = (int)$result->fetch_assoc()['Auto_increment'];
        return $next_id;
    }
    
    public function insert_json($db, $row, $parent_reference_id, $parent_reference_type, $parent_reference_field){
            foreach($this->all_fields as $column => $column_type)
            {
                // initialize all db fields to NULL
                $$column = 'NULL';
            }
            foreach($this->all_fields as $column => $column_type)
            {
                if(property_exists($row, $column)||$column_type=='reference_id'||$column_type=='reference_type'||$column_type=='reference_field'){
                    switch($column_type){
                        case 'string':
                            $$column = addslashes($row->$column);
                            break;
                        case 'int':
                            $$column = (int)($row->$column);
                            break;
                        case 'double':
                            $$column = (double)($row->$column);
                            break;
                        case 'boolean':
                            $$column = (int)($row->$column);
                            break;
                        case 'json':
                            $$column = addslashes(json_encode($row->$column));
                            break;
                        case 'reference_type':
                            if($parent_reference_type!=null){
                                $$column = $parent_reference_type;
                            }
                            else{
                                echo "table {$this->table_name} has reference type field but no reference type provided";
                                exit();
                            }
                            break;
                        case 'reference_id':
                            if($parent_reference_id!=null){
                                $$column = $parent_reference_id;
                            }
                            else{
                                echo "table {$this->table_name} has reference id field but no reference id provided";
                                exit();
                            }
                            break;
                        case 'reference_field':
                            if($parent_reference_field!=null){
                                $$column = $parent_reference_field;
                            }
                            else{
                                echo "table {$this->table_name} has reference field field but no reference field provided";
                                exit();
                            }
                            break;
                        case 'lolelf_dbobj':
                            $child_obj = new $this->obj_field_map[$column]();
                            $id_field = $this->id_field;
                            $ref_id = null;
                            if(!property_exists($row, $id_field)){
                                $ref_id = $this->get_next_insert_id($db);
                            }
                            else{
                                $ref_id = $row->$id_field;
                            }                          
                            $child_obj->insert_json($db, $row->$column, $ref_id, $this->reference_type, "'{$column}'");
                            break;
                        case 'list_lolelf_dbobj':
                            foreach($row->$column as $child){
                                $child_obj = new $this->obj_field_map[$column]();
                                $id_field = $this->id_field;
                                $ref_id = null;
                                if(!property_exists($row, $id_field)){
                                    $ref_id = $this->get_next_insert_id($db);
                                }
                                else{
                                    $ref_id = $row->$id_field;
                                }
                                $child_obj->insert_json($db, $child, $ref_id, $this->reference_type, "'{$column}'");
                            }
                            break;
                        default:
                            echo $this->table_name;
                            echo "<br>";
                            echo "type {$column_type} is undefined";
                            exit();
                    }
                }
                else{
                    if(array_key_exists($column, $this->non_empty_fields)){
                        echo 'non-empty field {$column} can not be empty';
                        exit();
                    }
                }
            }
            
            $db_columns = array();
            foreach(array_keys($this->all_fields) as $array_key){
                if($this->all_fields[$array_key]!='lolelf_dbobj' && $this->all_fields[$array_key]!='list_lolelf_dbobj'){
                    array_push($db_columns, "`$array_key`");
                }
            }
            $query = "INSERT INTO {$this->table_name} (";
            $query .= join($db_columns, ',');
            $query .= ") VALUES (";
            $arr = array();
            foreach(array_keys($this->all_fields) as $array_key){
                if($this->all_fields[$array_key]!='lolelf_dbobj' && $this->all_fields[$array_key]!='list_lolelf_dbobj'){
                    if($$array_key=="NULL"){
                        if($array_key==$this->id_field){
                            $$array_key=$this->get_next_insert_id($db);
                        }
                        array_push($arr, $$array_key);
                    }
                    else if($this->all_fields[$array_key]=='string' || $this->all_fields[$array_key]=='json'){
                        array_push($arr, "\"${$array_key}\"");
                    }
                    else{
                        array_push($arr, $$array_key);
                    }
                }
            }
            $query .= join($arr, ',');
            $query .= ")";
            $result = $db->query($query);
    }
    
    function __construct() {}
}

?>