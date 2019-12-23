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
	
	$university_id = $userObject->data["university_info"]["university_id"]; 
	
	$table_name = "tbl_class";
    
	if(empty($_POST['edit_id']) == false){
		
		$id = $_POST['edit_id'];
		
		$query = "DELETE FROM " . $table_name . " WHERE id = '" . $id . "' AND University_id = '" . $university_id . "'";
		
		if($stmt = $conn->execute( $query )){
			
			echo json_encode(array('statusCode' => 1));
			
		}else{
			
			echo json_encode(array('statusCode' => 0));
			
		}
		
	}
		
	
		
?>