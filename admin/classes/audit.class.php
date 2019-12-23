<?php

class AuditObject {
 
    // database connection and table name
    private $conn;
    private $table_action = "action_history_cme";
    private $table_history = "action_history";
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
 
	//read action_amount
    public function readActionAmount($id)
    {
        $content = array(
		    "",
			"235.00", //1
			"735.00", //2
		);
		
		$stmt = $content[$id];
		
		return $stmt;
    }
	
    // read all datas 
    public function readAll($cycle){
		
		if(empty($cycle) == true){

			$cycle = $this->readCMECyclePayButton();

		}

		$users = "SELECT id FROM ". $this->table_user . " WHERE role='CAA' ";
		
		$users_id = $this->conn->getData( $users );
		
		for($i = 0; $i < count($users_id); $i++){
			
				
			$query = "SELECT * FROM " . $this->table_action . " WHERE action_num < 5 AND id=(select max(id) from " . $this->table_action ." WHERE user_id=". $users_id[$i]['id'] .") AND cme_cycle_start = ".$cycle;
			
			$j = 0;	
		    
			if(empty($this->conn->getData( $query )) == false && ($this->conn->getCount( $query )) > 0){
				
				$stmt[$j] = $this->conn->getData( $query );
				
				$j++;
				
			}
		}
		
		if(empty($stmt) == false){
		    
            return $stmt;
		    
		}
    }
	
	//update action_num
    public function updateActionNum($data){
		
		$max_sql = "SELECT max(id) FROM ". $this->table_action ." WHERE user_id = " . $data['id'];
		
		$max_id = $this->conn->getData($max_sql);
		
		$history_sql = "SELECT max(id) FROM ". $this->table_history ." WHERE exam_type = 'CME' AND user_id = " . $data['id'];
		
		$history_id = $this->conn->getData($history_sql);
		
	   //select(default value)
	   if($data['audit_result_id'] == 0){
		   
		   $query  = "UPDATE " . $this->table_action . " SET action_num = 2 WHERE user_id = " . $data['id'] . " AND id = ".$max_id[0]['max(id)'];
		   
		   $query_history  = "UPDATE " . $this->table_history . " SET action_num = 2 WHERE exam_type = 'CME' AND user_id = " . $data['id'] . " AND id = ".$history_id[0]['max(id)'];
		   
	   }
	   
	   //pass
	   if($data['audit_result_id'] == 1){
		   
		   $query  = "UPDATE " . $this->table_action . " SET action_num = 1 WHERE user_id = " . $data['id'] . " AND id = ".$max_id[0]['max(id)'];
		   
		   $query_history  = "UPDATE " . $this->table_history . " SET action_num = 1 WHERE exam_type = 'CME' AND user_id = " . $data['id'] . " AND id = ".$history_id[0]['max(id)'];
	   }
	   
	   //fail
	   if($data['audit_result_id']==2){
		   
		   $query  = "UPDATE " . $this->table_action . " SET action_num = 3 WHERE user_id = " . $data['id'] . " AND id = ".$max_id[0]['max(id)'];
		   
		   $query_history  = "UPDATE " . $this->table_history . " SET action_num = 3 WHERE exam_type = 'CME' AND user_id = " . $data['id'] . " AND id = ".$history_id[0]['max(id)'];
	   }
	   
		$this->conn->execute($query_history);
	   
		if($this->conn->execute($query)){
			
			return true;
			
		}else{
			
			return false;
			
		} 
    }
	//update action_num
    public function saveIssuesText($data){
		$id = $data['id'];
		$issues = $data['issues_text'];
		$num = 0;
		for($i = 1; $i < count($id); $i++){
			$query  = "UPDATE " . $this->table_action . " SET issues_text = '". $issues[$i] ."' WHERE id = " . $id[$i];
			
			if($this->conn->execute($query)){
			
                $num = $num + 1;
			
			}
			
		}
        
		if($num == (count($id) - 1)){
			
            return true;
			
        }else{
			
            return false;
			
        }

		// $query  = "UPDATE " . $this->table_action . " SET issues_text = '". $issues[1] ."' WHERE id = " . $id[1] . ";";
		// if(count($id) > 2){
			// for($i = 2; $i < count($id); $i++){
				// $query  .= "UPDATE " . $this->table_action . " SET issues_text = '". $issues[$i] ."' WHERE id = " . $id[$i] . ";";
				
			// }
		// }
    }



	//update show_allow
    public function updateShowAllow($data){
		
		//get admin-label
		$max_admin_sql = "SELECT max(id) FROM ". $this->table_action ." WHERE user_id = " . $data['id'];
		
		$max_admin_id = $this->conn->getData($max_admin_sql);
		
		//get member label
		$max_member_sql = "SELECT max(id) FROM ". $this->table_action ." WHERE user_id = " . $data['id'] ." AND action_num > 4";
		
		$max_member_id = $this->conn->getData($max_member_sql);
		
		//get admin-label history
		$admin_sql_history = "SELECT max(id) FROM ". $this->table_history ." WHERE exam_type = 'CME' AND user_id = " . $data['id'];
		
		$admin_history = $this->conn->getData($admin_sql_history);
		
		//get member label history
		$member_sql_history = "SELECT max(id) FROM ". $this->table_history ." WHERE exam_type = 'CME' AND user_id = " . $data['id'] ." AND action_num > 5";
		
		$member_history = $this->conn->getData($member_sql_history);
	   
	   //Select(default value)
	   if($data['show_id'] == 0){
		   
		   $admin_query  = "UPDATE " . $this->table_action . " SET show_allow = 0 WHERE user_id = " . $data['id'] . " AND id = ".$max_admin_id[0]['max(id)'];
		   
		   $member_query  = "UPDATE " . $this->table_action . " SET show_allow = 0 WHERE user_id = " . $data['id'] . " AND id = ".$max_member_id[0]['max(id)'];
		   
		   $admin_query_history  = "UPDATE " . $this->table_history . " SET show_allow = 0 WHERE exam_type = 'CME' AND user_id = " . $data['id'] . " AND id = ".$admin_history[0]['max(id)'];
		   
		   $member_query_history  = "UPDATE " . $this->table_history . " SET show_allow = 0 WHERE exam_type = 'CME' AND user_id = " . $data['id'] . " AND id = ".$member_history[0]['max(id)'];
	   }
	   
	   //show
	   if($data['show_id']==1){
		   
		   $admin_query  = "UPDATE " . $this->table_action . " SET show_allow = 1 WHERE user_id = " . $data['id'] . " AND id = ".$max_admin_id[0]['max(id)'];
		   
		   $member_query  = "UPDATE " . $this->table_action . " SET show_allow = 1 WHERE user_id = " . $data['id'] . " AND id = ".$max_member_id[0]['max(id)'];
		   
		   $admin_query_history  = "UPDATE " . $this->table_history . " SET show_allow = 1 WHERE exam_type = 'CME' AND user_id = " . $data['id'] . " AND id = ".$admin_history[0]['max(id)'];
		   
		   $member_query_history  = "UPDATE " . $this->table_history . " SET show_allow = 1 WHERE exam_type = 'CME' AND user_id = " . $data['id'] . " AND id = ".$member_history[0]['max(id)'];
	   }
	   
	   //No show(default value)
	   if($data['show_id'] == 2){
		   
		   $admin_query  = "UPDATE " . $this->table_action . " SET show_allow = 2, action_num = 3 WHERE user_id = " . $data['id'] . " AND id = ".$max_admin_id[0]['max(id)'];
		   
		   $member_query  = "UPDATE " . $this->table_action . " SET show_allow = 2 WHERE user_id = " . $data['id'] . " AND id = ".$max_member_id[0]['max(id)'];
		   
		   $admin_query_history  = "UPDATE " . $this->table_history . " SET show_allow = 2, action_num = 3 WHERE exam_type = 'CME' AND user_id = " . $data['id'] . " AND id = ".$admin_history[0]['max(id)'];
		   
		   $member_query_history  = "UPDATE " . $this->table_history . " SET show_allow = 2 WHERE exam_type = 'CME' AND user_id = " . $data['id'] . " AND id = ".$member_history[0]['max(id)'];
	   }
	   
	   //print_r($member_query);exit;
	   $this->conn->execute($admin_query_history);
	   
	   $this->conn->execute($member_query_history);
	   
	   $this->conn->execute($admin_query);
	   
	   if($this->conn->execute($member_query)){
		   
			return true;
			
	   }else{
		   
			return false;
			
	   } 
    }

   //get current CME cycle exactly. This is for pay_now button. 
	public function readCMECyclePayButton(){
		
		global $userObject;
		
		$cme_first_year = $userObject->vitals["first_year"];
        
		$date = getdate();
		
		$date_june = mktime(0,0,0,6,1,$date['year']);// june.1 of this year
		
		$this_year = $date['year'];
		
		if($cme_first_year % 2 == 0){ //even member
			
			if($this_year % 2 == 0){ //even year
				
				//before june.1
				if($date[0] < $date_june){
					
					$cme_cycle_start = $this_year - 2;	
				//after june.1	
				}else if($date[0] > $date_june){
					
					$cme_cycle_start = $this_year;
					
				}
				
			}else{//odd year 
			
				$cme_cycle_start = $this_year - 1;
							
			}
			
		}else{//odd member
			
			if($this_year % 2 == 0){ //even year
			
				$cme_cycle_start = $this_year - 1;
						
			}else{//odd year
			
				//before june.1
				if($date[0] < $date_june){
					
					$cme_cycle_start = $this_year - 2;	
				//after june.1	
				}else if($date[0] > $date_june){
					
					$cme_cycle_start = $this_year;
					
				}
						
			}
		
		}

		$make_sure_cycle = $this_year - $cme_cycle_start;
		
		if($make_sure_cycle == 0){
			
			$cme_cycle_start = $cme_cycle_start - 2;
		
		}

		return $cme_cycle_start;
		
	}
    
	


}

?>