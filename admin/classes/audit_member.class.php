<?php

class MemberCMEObject {
 
    // database connection and table name
    private $conn;
    private $table_name = "tbl_add_cme";
	private $table_user = "users";

	
    public function __construct(){


        global $db;

        $this->conn = $db;

    }

    // get rows count
    public function countAll($id){
		
        $query = "SELECT * FROM " . $this->table_name . " WHERE user_id = ".$id;
        $stmt = $this->conn->getCount( $query );

        return $stmt;
    }

    public function readPaging($from_record_num, $records_per_page){
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY created ASC LIMIT {$from_record_num}, {$records_per_page}";
//    		print "query:$query<br>\n";
        $stmt = $this->conn->getData( $query );

        return $stmt;
    }

    // read all datas
    public function readAll(){
        $query = "SELECT * FROM " . $this->table_name;
        //print "query:$query<br>\n";
        $stmt = $this->conn->getData( $query );

        return $stmt;
    }


    // read data by id
    public function readAllById($id, $cme_cycle) {
		
        if ( $id!="" ) $this->id=$id;
		
        $query = "SELECT * FROM " . $this->table_name . " WHERE user_id = ". $this->id ." AND cme_cycle_start = ". $cme_cycle ." ORDER BY id DESC";
        //print_r($query);exit;
        $stmt = $this->conn->getData( $query );

        return $stmt;
		
    }
	
	    //read CME category or type
    public function readCMEType($num){
		
		$cme_type = array("", "Anesthesia", "Other"); 
		
		return $cme_type[$num];
		
	}

	public function readMemberName($id){
		
		$query = "SELECT full_name FROM " . $this->table_user . " WHERE id = ". $id;
		
        $stmt = $this->conn->getData( $query );
		
        return $stmt[0]['full_name'];

	}
}
?>