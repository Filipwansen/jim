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
    
	if(empty($_POST['edit_id']) == false){
		
		$id = $_POST['edit_id'];
		
		$query_users = "DELETE FROM " . $table_users . " WHERE id = (SELECT user_id FROM ". $table_class ." WHERE id = '" . $id . "' AND University_id = '" . $university_id . "')";
		
		$stmt1 = $conn->execute( $query_users );
		
		$query_class = "DELETE FROM " . $table_class . " WHERE id = '" . $id . "' AND University_id = '" . $university_id . "'";
		
		if($stmt2 = $conn->execute( $query_class )){
			
			echo json_encode(array('statusCode' => 1));
			
		}else{
			
			echo json_encode(array('statusCode' => 0));
			
		}
		
	}
		
	
		
?>