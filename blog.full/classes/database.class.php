<?php

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

	private function __construct() {

		

		include_once 'config.php';

		

		$this->_host=$host;

		$this->_username=$user;

		$this->_password=$pass;

		$this->_database=$db;

		

		$this->_connection = new mysqli($this->_host, $this->_username, $this->_password, $this->_database);

	

		// Error handling

		if(mysqli_connect_error()) {

			trigger_error("Failed to conencto to MySQL: " . mysql_connect_error(),

				 E_USER_ERROR);

		}

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