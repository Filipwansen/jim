<?php

class SurveyObject {
 
    // database connection and table name
    private $conn;
    private $table_users = "users";
    private $table_generalinform = "final_generalinform";
    private $table_surveys = "surveys";
    private $table_questions = "survey_questions";
    private $table_question_choices = "survey_question_choices";
    private $table_answers = "survey_answers";
    // object properties
    public $id;
 
    public function __construct(){
    		global $db;
    		
        //$db = Database::getInstance();
        $this->conn = $db;
        
        //$db = new Database;
        
        //exit(0);
    }
	
    // read all surveys 
    public function readAllSurvey(){
		
        $query = "SELECT * FROM " . $this->table_surveys . " ORDER BY id";
        
        $stmt = $this->conn->getData( $query );
 
        return $stmt;
    }
	
    // read all question 
    public function readAllQuestions($survey_id){
		
        $query = "SELECT * FROM " . $this->table_questions . " WHERE survey_id = '". $survey_id ."' ORDER BY id";
        //print "query:$query<br>\n";
        $stmt = $this->conn->getData( $query );
 
        return $stmt;
    }
	
    // read question info by question id  
    public function readQuestionInfo($ques_id){
		
        $query = "SELECT * FROM " . $this->table_questions . " WHERE id = '". $ques_id ."'";
        
        $stmt = $this->conn->getData( $query );
 
        return $stmt[0];
    }
	
    // read Answer by choice_id 
    public function readAnswerById($survey_id, $ques_id, $choice_id){
		
        $query = "SELECT choice_answer FROM " . $this->table_question_choices . " WHERE survey_id = '". $survey_id ."' AND question_id = '". $ques_id ."' AND choice_id = '". $choice_id ."'";
      
		
        if($stmt = $this->conn->getData( $query )){
			
			return $stmt[0]['choice_answer'];
			
		}else{
			
			$stmt[0]['choice_answer'] = "";
			
			return $stmt[0]['choice_answer'];
			
		}
 
    }
	
    // read choice  list by question_id 
    public function readChoiceList($ques_id){
		
        $query = "SELECT * FROM " . $this->table_question_choices . " WHERE question_id = '". $ques_id ."'";
      
		
        $stmt = $this->conn->getData( $query );
			
		return $stmt;
			
    }
	
    // read report list by question_id 
    public function readReportList($type, $ques_id){
		
        $query = "SELECT * FROM " . $this->table_answers . " WHERE question_id = '". $ques_id ."'";
      
		
        $stmt = $this->conn->getData( $query );
			
		return $stmt;
			
    }
	
    // read fullname by user_id 
    public function readFullName($user_id){
		
        $query = "SELECT * FROM " . $this->table_generalinform . " WHERE user_id = '". $user_id ."'";
      
        $stmt = $this->conn->getData( $query );
			
		return $stmt[0];
			
    }
	
    // read Answers info by question_id 
    public function readAnswersInfo($type, $ques_id){
		
        $query_caa = "SELECT * FROM " . $this->table_users . " WHERE role = 'CAA' AND is_certified = '1'";
		
		$total_members = $this->conn->getCount( $query_caa );
        
		
		$query_answers = "SELECT * FROM " . $this->table_answers . " WHERE question_id = '". $ques_id ."'";
      
		$answered_members = $this->conn->getCount( $query_answers );
		
		if($total_members > 0 && $answered_members > 0){
			
			$answer_p = number_format(($answered_members/$total_members) * 100, 2);
			
			if($type == 'Radio'){
				
				$query_correct = "SELECT * FROM " . $this->table_answers . " WHERE question_id = '". $ques_id ."' AND choice_id = (SELECT key_id FROM ". $this->table_questions ." WHERE id = '". $ques_id ."')";
				
				$members_correct = $this->conn->getCount( $query_correct );
				
				$correct_members = number_format($members_correct);
				
				$incorrect_members = number_format($answered_members - $members_correct);

				$correct_p = (int)(($members_correct/$answered_members) * 100);
				
				$incorrect_p = (100 - $correct_p);
				
			}else{
				
				$correct_members = 0;
				
				$incorrect_members = 0;
				
				$correct_p = 0;
				
				$incorrect_p = 0;
				
			}
			
			
		}else{
			
			$answered_members = 0;
			
			$answer_p =0;
			
			$correct_members = 0;
			
			$incorrect_members = 0;
			
			$correct_p = 0;
			
			$incorrect_p = 0;
			
		}
		
		$answers_info = array('members_answered' => number_format($answered_members), 'answer_p' => $answer_p, 'correct_members' => $correct_members, 'incorrect_members' => $incorrect_members, 'correct_p' => $correct_p, 'incorrect_p' => $incorrect_p);
		
		return $answers_info;
 
    }
 
    // add new survey 
    public function addNewSurvey($add_title){
		
		$query = "INSERT INTO " . $this->table_surveys . " (survey_title, created) VALUES ('" . $add_title . "', '" . date('m/d/Y') . "') ";
  
        if($this->conn->execute($query)){
            return true;
        }else{
            return false;
        } 
    }
	
    // edit survey 
    public function editSurvey($edit_title, $survey_id){
		
		$query = "UPDATE " . $this->table_surveys . " SET survey_title = '" . $edit_title . "', created = '" . date('m/d/Y') . "' WHERE id = '" . $survey_id . "'";
  
        if($this->conn->execute($query)){
            return true;
        }else{
            return false;
        } 
    }
	
    // edit question 
    public function editQuestion($survey_id, $ques_id, $type, $data){
		
		if($type == 'Text'){
			
			$query_text = "UPDATE " . $this->table_questions . " SET question = '" . $data['text_question_'.$ques_id] . "', key_id = '1', key_answer = '" . $data['text_answer_'.$ques_id] . "', created = '" . date('m/d/Y') . "' WHERE id = '". $ques_id ."' AND survey_id = '" . $survey_id . "'";
			
			if($this->conn->execute($query_text)){
				return true;
			}else{
				return false;
			} 
		
		}else{
			
			$query_Radio = "UPDATE " . $this->table_questions . " SET question = '" . $data['radio_question_'.$ques_id] . "', key_id = '". $data['radio_key_'.$ques_id] ."', key_answer = '" . $data['radio_answer_'.$ques_id] . "', created = '" . date('m/d/Y') . "' WHERE id = '". $ques_id ."' AND survey_id = '" . $survey_id . "'";
			
			$this->conn->execute($query_Radio);
			
			for($i = 1; $i < 6; $i++){
				
				$check[$i] = "SELECT * FROM " . $this->table_question_choices . " WHERE question_id = '". $ques_id ."' AND survey_id = '" . $survey_id . "' AND choice_id = '". $i ."'";
				
				$stmt[$i] = $this->conn->getCount( $check[$i] );
				
				if($stmt[$i] > 0){
					
					if(empty($data['radio'.$i."_".$ques_id]) == false){
					
						$query_choice[$i] = "UPDATE " . $this->table_question_choices . " SET choice_answer = '" . $data['radio'.$i."_".$ques_id] . "', created = '" . date('m/d/Y') . "' WHERE question_id = '". $ques_id ."' AND survey_id = '" . $survey_id . "' AND choice_id = '". $i ."'";
						
						$this->conn->execute($query_choice[$i]);
						
					}else{
						
						$query_choice[$i] = "DELETE FROM " . $this->table_question_choices . " WHERE survey_id = '". $survey_id ."' AND question_id = '". $ques_id ."' AND choice_id = '". $i ."'";
						
						$this->conn->execute($query_choice[$i]);
						
					}
					
					
					
				}else{
					
					if(empty($data['radio'.$i."_".$ques_id]) == false){
						
						$query_choice[$i] = "INSERT INTO " . $this->table_question_choices . " (survey_id, question_id, choice_id, choice_answer, created) VALUES ('" . $survey_id . "', '". $ques_id ."', '". $i ."', '". $data['radio'.$i."_".$ques_id] ."', '" . date('m/d/Y') . "') ";
						
						$this->conn->execute($query_choice[$i]);
						
					}
					
				}
				
			}
			
		}
		
    }
	
    // get questions count 
    public function countQuestions($survey_id){
		
        $query = "SELECT * FROM " . $this->table_questions . " WHERE survey_id = '". $survey_id ."'";
        $stmt = $this->conn->getCount( $query );
 
        return $stmt;
    }
	
    // read survey title by survey_id 
    public function readSurveyTitle($survey_id){
		
        $query = "SELECT survey_title FROM " . $this->table_surveys . " WHERE id = '". $survey_id ."'";
        $stmt = $this->conn->getData( $query );
 
        return $stmt[0]['survey_title'];
    }
	
    // add new question 
    public function addNewQuestion($data, $type, $survey_id){
		
		if($type == 'text'){
			
			$query1 = "INSERT INTO " . $this->table_questions . " (survey_id, question_type, question, key_id, key_answer, created, active) VALUES ('" . $survey_id . "', 'Text', '". $data['text_question'] ."', '1', '". $data['text_answer'] ."', '" . date('m/d/Y') . "', '0') ";
			
			if($this->conn->execute($query1)){
				return true;
			}else{
				return false;
			} 
			
		}else if($type == 'radio'){
			
			$query1 = "INSERT INTO " . $this->table_questions . " (survey_id, question_type, question, key_id, key_answer, created, active) VALUES ('" . $survey_id . "', 'Radio', '". $data['radio_question'] ."', '". $data['radio_key'] ."', '". $data['radio_answer'] ."', '" . date('m/d/Y') . "', '0') ";
			
			$this->conn->execute($query1);
			
			for($i = 1; $i < 6; $i++){
				
				if(empty($data['radio'.$i]) == false){
					
					$query[$i] = "INSERT INTO " . $this->table_question_choices . " (survey_id, question_id, choice_id, choice_answer, created) VALUES ('" . $survey_id . "', (SELECT id FROM ". $this->table_questions ." WHERE question = '". $data['radio_question'] ."'), '". $i ."', '". $data['radio'.$i] ."', '" . date('m/d/Y') . "') ";
					
					$this->conn->execute( $query[$i] );
					
				}				
				
			}
			
		}		
        
    }
	
	// delete Question by question_id 
    public function delQuestion($survey_id, $ques_id){
		
		$query_member = "SELECT * FROM " . $this->table_answers . " WHERE question_id = '". $ques_id ."'";

		$check_member = $this->conn->getCount( $query_member );
		
		if($check_member > 0){
			
			$member_sql = "DELETE FROM " . $this->table_answers . " WHERE question_id = '". $ques_id ."'";
			
			$this->conn->execute( $member_sql );
			
		}
		
		$question_sql = "DELETE FROM " . $this->table_questions . " WHERE survey_id = '". $survey_id ."' AND id = '". $ques_id ."'";
        
		$this->conn->execute( $question_sql );
		
		$choice_sql = "DELETE FROM " . $this->table_question_choices . " WHERE survey_id = '". $survey_id ."' AND question_id = '". $ques_id ."'";
        
		if($this->conn->execute( $choice_sql )){
			
			return true;
			
		}else{
			
			return false;
			
		}
    }
	
	
    // read member survey by user_id 
    public function readMemberSurvey($user_id){
		
		$query = "SELECT MAX(question_id), choice_answer FROM " . $this->table_answers . " WHERE user_id = '". $user_id ."'";

		if($max_id = $this->conn->getData( $query )){
			
			if(empty($max_id[0]['choice_answer']) == true){
				
				$max_id[0]['MAX(question_id)'] = 0;
				
			}
			
		}else{
			
			$max_id[0]['MAX(question_id)'] = 0;
			
		}
        
		$query_ques = "SELECT * FROM " . $this->table_questions . " WHERE id > ". $max_id[0]['MAX(question_id)'] ." ORDER BY id";
       
	   
	   
		if($question_list = $this->conn->getData( $query_ques )){
			
			return $question_list;
			
		}else{
			
			return $question_list = array();
			
		}

        
    }
	
	
	
	
	
}
?>