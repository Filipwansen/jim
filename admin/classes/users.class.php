<?php

class UsersObject {
 
    // database connection and table name
    private $conn;
    // private $table_action = "users";
    // private $table_history = "action_history";
    private $table_user = "users";
    // object properties
    public $id;
 
    public function __construct($db){
    	
    	// global $db;
        //$db = Database::getInstance();
        $this->conn = $db;
    }
 
	//read action_mon
    public function readActionExamMon($id){
		
    }

    // read all users
    public function readAll(){
		
		$query = "SELECT `full_name`, `id`, `email` FROM ".$this->table_user." where `role`!='admin'";

        $usersLists = $this->conn->getDataArray( $query );
        		
		if(empty($usersLists) == false){
            return $usersLists;		    
		}
    }

    // read users by ids
    public function readByIds($where){
        
        $query = "SELECT `full_name`, `id`, `email` FROM `".$this->table_user."` ".$where;
        $usersLists = $this->conn->getDataArray($query);
        
        if(empty($usersLists) == false){
            return $usersLists;
        }
    }

	
	//update users
    public function updateUser($data){		
		
    }

	//add the new users
    public function addUser($data){		
		
    }
}
?>