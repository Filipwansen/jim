<?php

class CertificationExamObject {
 
    // database connection and table name
    private $conn;
    private $action_table_name = "action_history_certification";
    private $table_user = "users";
    // object properties
    public $id;
 
    public function __construct(){
    		global $db;
    		
        //$db = Database::getInstance();
        $this->conn = $db;
        
        //$db = new Database;
        
        //exit(0);
    }
 
	//read action_mon
    public function readActionExamMon($id)
    {
		
		if($id == 2){$exam_mon = "February";}
		
		if($id == 6){$exam_mon = "June";}
		
		if($id == 10){$exam_mon = "October";}
        
        $stmt = $exam_mon;

        return $stmt;
 
    }

	//read action_amount
    public function readActionAmount($id)
    {
        $content = array(
		    "",
			"1,327.50", //1
			"1,593.00", //2
			"150.00", //3
			"150.00", //4
			"150.00", //5
			"150.00", //6
			"150.00" //7
		);
		
		$stmt = $content[$id];
		
		return $stmt;
    }
	
    // read all datas 
    public function readAll($date){
		
		$select_exam_date = getdate();
		
		$users = "SELECT id FROM ". $this->table_user;
		
		$users_id = $this->conn->getData( $users );
		
		foreach($users_id as $member){
			
			if(empty($date) == true){
				
				$query = "SELECT * FROM " . $this->action_table_name . " where action_num < 6 AND id=(select max(id) from " . $this->action_table_name ." WHERE user_id=". $member['id'] .") AND user_id=". $member['id'];
				
			}

			if(empty($date) == false && $date == 21){
				
				$query = "SELECT * FROM " . $this->action_table_name . " where action_num < 6 AND id=(select max(id) from " . $this->action_table_name ." WHERE user_id=". $member['id'] .") AND user_id=". $member['id'] ." AND exam_mon=2 AND exam_year=". ($select_exam_date['year'] + 1);
				
			}
			
			if(empty($date) == false && $date == 61){
				
				$query = "SELECT * FROM " . $this->action_table_name . " where action_num < 6 AND id=(select max(id) from " . $this->action_table_name ." WHERE user_id=". $member['id'] .") AND user_id=". $member['id'] ." AND exam_mon=6 AND exam_year=". ($select_exam_date['year'] + 1);
				
			}
			
			if(empty($date) == false && $date == 22){
				
				$query = "SELECT * FROM " . $this->action_table_name . " where action_num < 6 AND id=(select max(id) from " . $this->action_table_name ." WHERE user_id=". $member['id'] .") AND user_id=". $member['id'] ." AND exam_mon=2 AND exam_year=". ($select_exam_date['year'] + 2);
				
			}
			
			if(empty($date) == false && $date == 62){
				
				$query = "SELECT * FROM " . $this->action_table_name . " where action_num < 6 AND id=(select max(id) from " . $this->action_table_name ." WHERE user_id=". $member['id'] .") AND user_id=". $member['id'] ." AND exam_mon=6 AND exam_year=". ($select_exam_date['year'] + 2);
				
			}
			
			if(empty($date) == false && $date == 23){
				
				$query = "SELECT * FROM " . $this->action_table_name . " where action_num < 6 AND id=(select max(id) from " . $this->action_table_name ." WHERE user_id=". $member['id'] .") AND user_id=". $member['id'] ." AND exam_mon=2 AND exam_year=". ($select_exam_date['year'] + 3);
				
			}
			
			if(empty($this->conn->getData( $query )) == false){
				
				$stmt[$member['id']] = $this->conn->getData( $query );
				
			}
		}
		
		if(empty($stmt) == false){
		    
            return $stmt;
		    
		}
    }
	
	//update action_num
    public function updateActionNum($data){
		
		$max_sql = "SELECT max(id) FROM ". $this->action_table_name ." WHERE user_id = " . $data['student_id'];
		
		$max_id = $this->conn->getData($max_sql);
		
	   //select(default value)
	   if($data['admin_certification_id'] == 0){
		   
		   $query  = "UPDATE " . $this->action_table_name . " SET action_num = 2 WHERE user_id = " . $data['student_id'] . " AND id = ".$max_id[0]['max(id)'];
		   
	   }
	   
	   //pass
	   if($data['admin_certification_id'] == 1){
		   
		   $query  = "UPDATE " . $this->action_table_name . " SET action_num = 1 WHERE user_id = " . $data['student_id'] . " AND id = ".$max_id[0]['max(id)'];
		   
		   $certification_query  = "UPDATE " . $this->table_user . " SET role = 'CAA' WHERE id = " . $data['student_id'];
		   
	   }
	   
	   //fail
	   if($data['admin_certification_id']==2){
		   
		   $query  = "UPDATE " . $this->action_table_name . " SET action_num = 3 WHERE user_id = " . $data['student_id'] . " AND id = ".$max_id[0]['max(id)'];
		   
		   $certification_query  = "UPDATE " . $this->table_user . " SET role = 'Student' WHERE id = " . $data['student_id'];
		   
	   }
	   
		$this->conn->execute($certification_query);
		
        if($this->conn->execute($query)){
			
            return true;
			
        }else{
			
            return false;
			
        } 
    }

	//update show_allow
    public function updateShowAllow($data){
		
		//get admin-label
		$max_admin_sql = "SELECT max(id) FROM ". $this->action_table_name ." WHERE user_id = " . $data['student_id'];
		
		$max_admin_id = $this->conn->getData($max_admin_sql);
		
		//get member label
		$max_member_sql = "SELECT max(id) FROM ". $this->action_table_name ." WHERE user_id = " . $data['student_id'] ." AND action_num > 13";
		
		$max_member_id = $this->conn->getData($max_member_sql);
	   
	   //Select(default value)
	   if($data['show_certification_id'] == 0){
		   
		   $admin_query  = "UPDATE " . $this->action_table_name . " SET show_allow = 0 WHERE user_id = " . $data['student_id'] . " AND id = ".$max_admin_id[0]['max(id)'];
		   
		   $member_query  = "UPDATE " . $this->action_table_name . " SET show_allow = 0 WHERE user_id = " . $data['student_id'] . " AND id = ".$max_member_id[0]['max(id)'];
	   }
	   
	   //show
	   if($data['show_certification_id']==1){
		   
		   $admin_query  = "UPDATE " . $this->action_table_name . " SET show_allow = 1 WHERE user_id = " . $data['student_id'] . " AND id = ".$max_admin_id[0]['max(id)'];
		   
		   $member_query  = "UPDATE " . $this->action_table_name . " SET show_allow = 1 WHERE user_id = " . $data['student_id'] . " AND id = ".$max_member_id[0]['max(id)'];
	   }
	   
	   //No show(default value)
	   if($data['show_certification_id'] == 2){
		   
		   $admin_query  = "UPDATE " . $this->action_table_name . " SET show_allow = 2, action_num = 5 WHERE user_id = " . $data['student_id'] . " AND id = ".$max_admin_id[0]['max(id)'];
		   
		   $member_query  = "UPDATE " . $this->action_table_name . " SET show_allow = 2 WHERE user_id = " . $data['student_id'] . " AND id = ".$max_member_id[0]['max(id)'];
	   }
	   
	   //print_r($member_query);exit;
	   $this->conn->execute($admin_query);
	   
	   if($this->conn->execute($member_query)){
		   
			return true;
			
	   }else{
		   
			return false;
			
	   } 
    }
}
?>