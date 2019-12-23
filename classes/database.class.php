<?php

error_reporting( E_ALL );

/*

* Mysql database class - only one connection alowed

*/

class Database {

    private $_connection;

    private static $_instance; //The single instance

    private $_host = "localhost";

    private $_username = "root";

    private $_password = "123456";

    private $_database = "nccaadb";



    /*

    Get an instance of the Database

    @return Instance

    */

    public static function getInstance() {

        if(!self::$_instance) { // If no instance then make one

            self::$_instance = new self();

        }

        return self::$_instance;
    }



    // Constructor

    public function __construct() {

        global $con;                

        $this->_connection = $con;      

        //$this->_connection = new mysqli($this->_host, $this->_username, $this->_password, $this->_database);

    }



    // Magic method clone is empty to prevent duplication of connection

    private function __clone() { }



    // Get mysqli connection

    public function getConnection() {

        return $this->_connection;

    }



    public function getData($query)
    { 
        $result = $this->_connection->query($query);

        if ($result == false) {
            return false;
        } 

        $rows = array();

        while ($row = $result->fetch_assoc()) {

            $rows[] = $row;

        }        

        return $rows;
    }

    /* Get users tables Data */
    public function getDataArray($query){
        $result = $this->_connection->query($query);
        
        if($result == false){
            return false;
        }

        $rows = array(); $ii = 0;
        while ($row = $result->fetch_array()) {
            array_push($rows, [ $ii++, $row['id'], $row['full_name'], $row['email'] ]);
        }    
        return $rows;
    }
    
    /* Get group tables Data */
    public function getGroupDataArray($query){

        $result = $this->_connection->query($query);
        
        if($result == false){
            return false;
        }

        $rows = array(); $ii = 0;
        while ($row = $result->fetch_array()) {

            // $r_gname = "<a href='javascript:void(0)' userdata='".$row['users_id']."' onclick='view_members('".$row['group_name']."',".$row['id'].")'>".$row['group_name']."</a>";
            $r_gname = "<a href='javascript:void(0)' userdata='".$row['users_id']."' name='group_member$ii' >".$row['group_name']."</a>";
            array_push($rows, [ $ii++, $row['id'], $r_gname, $row['users_id'] ]);
        }    
        return $rows;
    }

    public function getCount($query)

    {        

        $result = $this->_connection->query($query);        

        if ($result == false) {
            return false;
        }                 

        $numRows = mysqli_num_rows($result);            

        return $numRows;
    }

        

    public function execute($query) 

    {

        $result = $this->_connection->query($query);

        

        if ($result == false) {

            echo 'Error: cannot execute the command';

            return false;

        } else {

            return true;

        }        

    }

    

    public function delete($id, $table) 

    { 

        $query = "DELETE FROM $table WHERE id = $id";

        

        $result = $this->_connection->query($query);

    

        if ($result == false) {

            echo 'Error: cannot delete id ' . $id . ' from table ' . $table;

            return false;

        } else {

            return true;

        }

    }

 

    public function escape_string($value)

    {

        return $this->_connection->real_escape_string($value);

    }

    

}

?>