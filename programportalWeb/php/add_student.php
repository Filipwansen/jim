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
     
	$university_id = ($_SESSION['user_id'] - 3202);
	
	$table_class = "tbl_class";
	
	$table_users = "users";

	//add new student in users table.
	$query1 = "INSERT INTO " . $table_users . " (user, email, password, status, is_certified, full_name, temp_password, role, last_login, last_import) VALUES ('', '" . $student_email . "', ' ', '0', '1', '" . $firstname." ".$lastname . "', '0', 'Student', '". date('Y-m-d H:i:s') ."', '". date('Y-m-d H:i:s') ."')";
	
	$stmt1 = $conn->execute( $query1 );
	
	//get user_id from users table
	$query2 = "SELECT id FROM " . $table_users . " WHERE role='Student' AND email='". $student_email ."' AND full_name='". $firstname." ".$lastname ."'";
    
	$student_id = $conn->getData($query2);
	
	//add new student info in tbl_class
	$query = "INSERT INTO " . $table_class . " (user_id, University_id, first_name, last_name, overview_active, ITE_exam_active, ITE_score, Cert_exam_active, Certification_score, Graduation_active, Graduation_score, class_of) VALUES ('". $student_id[0]['id'] ."', '" . $university_id . "', '". $firstname ."', '". $lastname ."', '0', '0', '0', '0', '0', '0', '0', '" . $classof . "')";

	if($stmt = $conn->execute( $query )){
		
		echo json_encode(array('statusCode' => 1));
		
	}else{
		
		echo json_encode(array('statusCode' => 0));
		
	}

?>