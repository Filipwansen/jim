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
	
	$university_id = ($_SESSION['user_id'] - 3202);
	
	$table_class = "tbl_class";
	
	$table_users = "users";
    
	//overview update
	if(empty($_POST['overview_check']) == false && empty($_POST['overview_id']) == false){
		
		$overview_active = $_POST['overview_check'];
		
		$id = $_POST['overview_id'];

		for($i=0; $i < count($id); $i++){
			
			$query = "UPDATE " . $table_class . " SET overview_active = '" . $overview_active[$i] . "' WHERE id = '" . $id[$i] . "' AND University_id = '" . $university_id . "'";
			
			$stmt = $conn->execute( $query );
		}

		//echo json_encode(array('statusCode' => 1));
	
	}
	
    //ITE check submit	
	if(empty($_POST['ITE_exam_check']) == false && empty($_POST['ITE_exam_id']) == false){
		
		$ITE_exam_active = $_POST['ITE_exam_check'];
		
		$id = $_POST['ITE_exam_id'];

		for($i=0; $i < count($id); $i++){
			
			$query = "UPDATE " . $table_class . " SET ITE_exam_active = '" . $ITE_exam_active[$i] . "' WHERE id = '" . $id[$i] . "' AND University_id = '" . $university_id . "'";
			
			$stmt = $conn->execute( $query );
		}
		
		//echo json_encode(array('statusCode' => 1));
		
	}
	
	//Certification exam check submit
	if(empty($_POST['cert_exam_check']) == false && empty($_POST['cert_exam_id']) == false){
		
		$cert_exam_active = $_POST['cert_exam_check'];
		
		$id = $_POST['cert_exam_id'];

		for($i=0; $i < count($id); $i++){
			
			$query = "UPDATE " . $table_class . " SET Cert_exam_active = '" . $cert_exam_active[$i] . "' WHERE id = '" . $id[$i] . "' AND University_id = '" . $university_id . "'";
			
			$stmt = $conn->execute( $query );
		}

		//echo json_encode(array('statusCode' => 1));
		
	}
	
	//Graduation exam check submit
	if(empty($_POST['Graduation_check']) == false && empty($_POST['Graduation_id']) == false){
		
		$graduation_active = $_POST['Graduation_check'];
		
		$id = $_POST['Graduation_id'];

		for($i=0; $i < count($id); $i++){
			
			$query = "UPDATE " . $table_class . " SET Graduation_active = '" . $graduation_active[$i] . "' WHERE id = '" . $id[$i] . "' AND University_id = '" . $university_id . "'";
			
			$stmt = $conn->execute( $query );
		}

		echo json_encode(array('statusCode' => 1));
		
	}
	
	//Edit student info when click the table's row
	if(empty($_POST['edit_id']) == false){
		
		$firstname = $_POST['firstname'];
		
		$lastname = $_POST['lastname'];
		
		$classof = $_POST['classof'];
		
		$email = $_POST['email'];
		
		$id = $_POST['edit_id'];
		
		$query_users = "UPDATE " . $table_users . " SET full_name = '". $firstname ." ". $lastname ."', email = '" . $email . "' WHERE id=(SELECT user_id FROM ". $table_class ." WHERE id = '" . $id . "' AND University_id = '" . $university_id . "')";
		
		$stmt1 = $conn->execute( $query_users );
		
		$query_class = "UPDATE " . $table_class . " SET First_Name = '" . $firstname . "', Last_Name = '" . $lastname . "', class_of = '" . $classof . "' WHERE id = '" . $id . "' AND University_id = '" . $university_id . "'";
		
		if($stmt2 = $conn->execute( $query_class )){
			
			echo json_encode(array('statusCode' => 1));
			
		}else{
			
			echo json_encode(array('statusCode' => 0));
			
		}
	
	}
	
	//ITE exam score change	
	if((empty($_POST['ITE_score_id']) == false) && ($_POST['ITE_score_value'] >= 0)){
		
		$id = $_POST['ITE_score_id'];
		
		$ITE_score_value = $_POST['ITE_score_value'];
		
		$query = "UPDATE " . $table_class . " SET ITE_score = '" . $ITE_score_value . "' WHERE id = '" . $id . "' AND University_id = '" . $university_id . "'";
		
		if($stmt = $conn->execute( $query )){
			
			echo json_encode(array('statusCode' => 1));
			
		}else{
			
			echo json_encode(array('statusCode' => 0));
			
		}
		
	}
	
	//Certification exam score change
	if((empty($_POST['cert_score_id']) == false) && ($_POST['cert_score_value'] >= 0)){
		
		$id = $_POST['cert_score_id'];
		
		$cert_score_value = $_POST['cert_score_value'];
		
		$query = "UPDATE " . $table_class . " SET Certification_score = '" . $cert_score_value . "' WHERE id = '" . $id . "' AND University_id = '" . $university_id . "'";
		
		if($stmt = $conn->execute( $query )){
			
			echo json_encode(array('statusCode' => 1));
			
		}else{
			
			echo json_encode(array('statusCode' => 0));
			
		}
	
	}
	
	//Graduation score change
	if((empty($_POST['Graduation_score_id']) == false) && ($_POST['Graduation_score_value'] >= 0)){
		
		$id = $_POST['Graduation_score_id'];
		
		$graduation_score_value = $_POST['Graduation_score_value'];
		
		$query = "UPDATE " . $table_class . " SET Graduation_score = '" . $graduation_score_value . "' WHERE id = '" . $id . "' AND University_id = '" . $university_id . "'";
		
		if($stmt = $conn->execute( $query )){
			
			echo json_encode(array('statusCode' => 1));
			
		}else{
			
			echo json_encode(array('statusCode' => 0));
			
		}
		
	}
		
	
		
?>