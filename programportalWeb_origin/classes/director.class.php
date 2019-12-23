<?php

class ProgramDirectorInfo
{

    // database connection and table name
    private $conn;
    private $table_university = "tbl_university";
    private $table_program_director = "tbl_program_director";
    private $table_user = "users";

    public function __construct()
    {
        global $db;

        $this->conn = $db;

    }

    // read university info
    public function readUniversityInfo($id)
    {
        $query = "SELECT * FROM " . $this->table_university . " WHERE id = " . $id; 
		
		$stmt = $this->conn->getData($query);
 
        return $stmt;
    }

    // read program directors and assistant info
    public function readProgramDirectorInfo($id, $title)
    {
        $query = "SELECT * FROM " . $this->table_program_director . " WHERE Title = '" . $title . "' AND University_Id = " . $id; 
                
		$stmt = $this->conn->getData($query);
        
		return $stmt;
    }
}

?>