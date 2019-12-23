<?php



class ExamObject {

 

    // database connection and table name

    private $conn;

    private $table_action = "action_history_cdq";

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

 

	//read action_mon

    public function readActionExamMon($id)

    {

		

		if($id == 2){$exam_mon = "Feb";}

		

		if($id == 6){$exam_mon = "June";}

        

        $stmt = $exam_mon;



        return $stmt;

 

    }



	//read action_amount

    public function readActionAmount($id)

    {

        $content = array(

		    "",

			"1,000.00", //1

			"1,327.50", //2

			"75.00", //3

			"75.00" //4

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

				

				$query = "SELECT * FROM " . $this->table_action . " where action_num < 6 AND id=(select max(id) from " . $this->table_action ." WHERE user_id=". $member['id'] .") AND user_id=". $member['id'];

				

			}



			if(empty($date) == false && $date == 21){

				

				$query = "SELECT * FROM " . $this->table_action . " where action_num < 6 AND id=(select max(id) from " . $this->table_action ." WHERE user_id=". $member['id'] .") AND user_id=". $member['id'] ." AND exam_mon=2 AND exam_year=". ($select_exam_date['year'] + 1);

				

			}

			

			if(empty($date) == false && $date == 61){

				

				$query = "SELECT * FROM " . $this->table_action . " where action_num < 6 AND id=(select max(id) from " . $this->table_action ." WHERE user_id=". $member['id'] .") AND user_id=". $member['id'] ." AND exam_mon=6 AND exam_year=". ($select_exam_date['year'] + 1);

				

			}

			

			if(empty($date) == false && $date == 22){

				

				$query = "SELECT * FROM " . $this->table_action . " where action_num < 6 AND id=(select max(id) from " . $this->table_action ." WHERE user_id=". $member['id'] .") AND user_id=". $member['id'] ." AND exam_mon=2 AND exam_year=". ($select_exam_date['year'] + 2);

				

			}

			

			if(empty($date) == false && $date == 62){

				

				$query = "SELECT * FROM " . $this->table_action . " where action_num < 6 AND id=(select max(id) from " . $this->table_action ." WHERE user_id=". $member['id'] .") AND user_id=". $member['id'] ." AND exam_mon=6 AND exam_year=". ($select_exam_date['year'] + 2);

				

			}

			

			if(empty($date) == false && $date == 23){

				

				$query = "SELECT * FROM " . $this->table_action . " where action_num < 6 AND id=(select max(id) from " . $this->table_action ." WHERE user_id=". $member['id'] .") AND user_id=". $member['id'] ." AND exam_mon=2 AND exam_year=". ($select_exam_date['year'] + 3);

				

			}

			// var_dump($query);
			// die();

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

		

		$max_sql = "SELECT max(id) FROM ". $this->table_action ." WHERE user_id = " . $data['id'];

		

		$max_id = $this->conn->getData($max_sql);

		

		$max_sql_history = "SELECT max(id) FROM ". $this->table_history ." WHERE exam_type = 'CDQ' AND user_id = " . $data['id'];

		

		$max_id_history = $this->conn->getData($max_sql_history);

		

	   //select(default value)

	   if($data['select_id'] == 0){

		   

		   $query  = "UPDATE " . $this->table_action . " SET action_num = 2 WHERE user_id = " . $data['id'] . " AND id = ".$max_id[0]['max(id)'];

		   

		   $query_history  = "UPDATE " . $this->table_history . " SET action_num = 2 WHERE exam_type = 'CDQ' AND user_id = " . $data['id'] . " AND id = ".$max_id_history[0]['max(id)'];

		   

	   }

	   

	   //pass

	   if($data['select_id'] == 1){

		   

		   $query  = "UPDATE " . $this->table_action . " SET action_num = 1 WHERE user_id = " . $data['id'] . " AND id = ".$max_id[0]['max(id)'];

		   

		   $query_history  = "UPDATE " . $this->table_history . " SET action_num = 1 WHERE exam_type = 'CDQ' AND user_id = " . $data['id'] . " AND id = ".$max_id_history[0]['max(id)'];

	   }

	   

	   //fail

	   if($data['select_id']==2){

		   

		   $query  = "UPDATE " . $this->table_action . " SET action_num = 3 WHERE user_id = " . $data['id'] . " AND id = ".$max_id[0]['max(id)'];

		   

		   $query_history  = "UPDATE " . $this->table_history . " SET action_num = 3 WHERE exam_type = 'CDQ' AND user_id = " . $data['id'] . " AND id = ".$max_id_history[0]['max(id)'];

	   }

	   

	    $this->conn->execute($query_history);

		

        if($this->conn->execute($query)){

			

            return true;

			

        }else{

			

            return false;

			

        } 

    }



	//update show_allow

    public function updateShowAllow($data){

		

		//get admin-label

		$max_admin_sql = "SELECT max(id) FROM ". $this->table_action ." WHERE user_id = " . $data['id'];

		

		$max_admin_id = $this->conn->getData($max_admin_sql);

		

		//get member label

		$max_member_sql = "SELECT max(id) FROM ". $this->table_action ." WHERE user_id = " . $data['id'] ." AND action_num > 5";

		

		$max_member_id = $this->conn->getData($max_member_sql);

	   

		//get admin-label_history

		$admin_sql_history = "SELECT max(id) FROM ". $this->table_history ." WHERE exam_type = 'CDQ' AND user_id = " . $data['id'];

		

		$admin_history = $this->conn->getData($admin_sql_history);

		

		//get member label_history

		$member_sql_history = "SELECT max(id) FROM ". $this->table_history ." WHERE exam_type = 'CDQ' AND user_id = " . $data['id'] ." AND action_num > 5";

		

		$member_history = $this->conn->getData($member_sql_history);

		

	   //Select(default value)

	   if($data['show_id'] == 0){

		   

		   $admin_query  = "UPDATE " . $this->table_action . " SET show_allow = 0 WHERE user_id = " . $data['id'] . " AND id = ".$max_admin_id[0]['max(id)'];

		   

		   $member_query  = "UPDATE " . $this->table_action . " SET show_allow = 0 WHERE user_id = " . $data['id'] . " AND id = ".$max_member_id[0]['max(id)'];

		   

		   $admin_query_history  = "UPDATE " . $this->table_history . " SET show_allow = 0 WHERE exam_type = 'CDQ' AND user_id = " . $data['id'] . " AND id = ".$admin_history[0]['max(id)'];

		   

		   $member_query_history  = "UPDATE " . $this->table_history . " SET show_allow = 0 WHERE exam_type = 'CDQ' AND user_id = " . $data['id'] . " AND id = ".$member_history[0]['max(id)'];

	   

	   }

	   

	   //show

	   if($data['show_id']==1){

		   

		   $admin_query  = "UPDATE " . $this->table_action . " SET show_allow = 1 WHERE user_id = " . $data['id'] . " AND id = ".$max_admin_id[0]['max(id)'];

		   

		   $member_query  = "UPDATE " . $this->table_action . " SET show_allow = 1 WHERE user_id = " . $data['id'] . " AND id = ".$max_member_id[0]['max(id)'];

		   

		   $admin_query_history  = "UPDATE " . $this->table_history . " SET show_allow = 1 WHERE exam_type = 'CDQ' AND user_id = " . $data['id'] . " AND id = ".$admin_history[0]['max(id)'];

		   

		   $member_query_history  = "UPDATE " . $this->table_history . " SET show_allow = 1 WHERE exam_type = 'CDQ' AND user_id = " . $data['id'] . " AND id = ".$member_history[0]['max(id)'];

	   

	   }

	   

	   //No show(default value)

	   if($data['show_id'] == 2){

		   

		   $admin_query  = "UPDATE " . $this->table_action . " SET show_allow = 2, action_num = 5 WHERE user_id = " . $data['id'] . " AND id = ".$max_admin_id[0]['max(id)'];

		   

		   $member_query  = "UPDATE " . $this->table_action . " SET show_allow = 2 WHERE user_id = " . $data['id'] . " AND id = ".$max_member_id[0]['max(id)'];

		   

		   $admin_query_history  = "UPDATE " . $this->table_history . " SET show_allow = 2 WHERE exam_type = 'CDQ' AND user_id = " . $data['id'] . " AND id = ".$admin_history[0]['max(id)'];

		   

		   $member_query_history  = "UPDATE " . $this->table_history . " SET show_allow = 2 WHERE exam_type = 'CDQ' AND user_id = " . $data['id'] . " AND id = ".$member_history[0]['max(id)'];

	   

	   }

	   

	   $this->conn->execute($admin_query_history);

	   

	   $this->conn->execute($member_query_history);

	   

	   $this->conn->execute($admin_query);

	   

	   if($this->conn->execute($member_query)){

		   

			return true;

			

	   }else{

		   

			return false;

			

	   } 

    }

}

?>