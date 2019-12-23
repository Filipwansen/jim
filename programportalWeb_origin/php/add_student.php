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
	
	$firstname = htmlspecialchars($_POST['firstname']);
	
	$lastname = htmlspecialchars($_POST['lastname']);
	
	$classof = htmlspecialchars($_POST['classof']);

	$student_email = htmlspecialchars($_POST['student_email']);
     
	$university_id = $userObject->data["university_info"]["university_id"]; 
	
	$table_name = "tbl_class";

	$query = "INSERT INTO " . $table_name . " (University_id, First_Name, Last_Name, email, overview_active, ITE_exam_active, ITE_score, Cert_exam_active, Certification_score, Graduation_active, Graduation_score, class_of) VALUES ('" . $university_id . "', '" . $firstname . "', '" . $lastname . "', '" . $student_email . "', '0', '0', '0', '0', '0', '0', '0', '" . $classof . "')";

	if($stmt = $conn->execute( $query )){
		
		echo json_encode(array('statusCode' => 1));
		
	}else{
		
		echo json_encode(array('statusCode' => 0));
		
	}

?>