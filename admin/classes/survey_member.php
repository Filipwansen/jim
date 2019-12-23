<?php
	session_start();

	require_once("../../config.php");

	if(empty($_SESSION['user_id']) || $_SESSION['user_id'] == "" )

	{

		header('Location: /logincaamember.php');

	}

	require_once("../../../includes/util.php");

	require_once("../../../classes/user.class.php");

	$userObject = new userObject();

	$userObject->init( $_SESSION['user_id'] );

	require_once("../../classes/database.class.php");

	global $conn;

	$conn = new Database();
	
	$question_type = htmlspecialchars($_POST['question_type']);
	
	$question_id = htmlspecialchars($_POST['question_id']);
	
	if(isset($_POST['member_text']) && empty($_POST['member_text']) == false){
		
		$member_text = htmlspecialchars($_POST['member_text']);
		
	}else if(isset($_POST['choice_answer']) && empty($_POST['choice_answer']) == false){
		
		$choice_id = htmlspecialchars($_POST['choice_id']);

		$choice_answer = htmlspecialchars($_POST['choice_answer']);
		
	}
     
	$user_id = $_SESSION['user_id'];
	
	$table_answers = "survey_answers";

	
	$query_member = "SELECT * FROM " . $table_answers . " WHERE user_id = '". $user_id ."' AND question_id = '". $question_id ."'";

	$check_member = $conn->getCount( $query_member );

	if($check_member > 0){
		
		if($question_type == 'Text'){
			
			$query = "UPDATE " . $table_answers . " SET choice_id = '1', choice_answer = '". $member_text ."', created = '". date('m/d/Y') ."' WHERE user_id = '". $user_id ."' AND question_id = '". $question_id ."'";
			
		}else{
			
			$query = "UPDATE " . $table_answers . " SET choice_id = '". $choice_id ."', choice_answer = '". $choice_answer ."', created = '". date('m/d/Y') ."' WHERE user_id = '". $user_id ."' AND question_id = '". $question_id ."'";
			
		}
		
	}else{
		
		if($question_type == 'Text'){
			
			//add new member answer in survey_answers table.
			$query = "INSERT INTO " . $table_answers . " (user_id, question_id, choice_id, choice_answer, created) VALUES ('". $user_id ."', '" . $question_id . "', '1', '". $member_text ."', '". date('m/d/Y') ."')";
			
		}else{
			
			//add new member answer in survey_answers table.
			$query = "INSERT INTO " . $table_answers . " (user_id, question_id, choice_id, choice_answer, created) VALUES ('". $user_id ."', '" . $question_id . "', '". $choice_id ."', '". $choice_answer ."', '". date('m/d/Y') ."')";
			
		}
		
	}

	if($stmt = $conn->execute( $query )){
		
		echo json_encode(array('statusCode' => 1));
		
	}else{
		
		echo json_encode(array('statusCode' => 0));
		
	}

?>