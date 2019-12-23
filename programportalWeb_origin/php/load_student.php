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

	$table_name = "tbl_class";
	
	if(empty($_POST['class_of']) == false){
		
		$class_of = $_POST['class_of'];
		
	}else if(empty($_POST['class_of']) == true){
		
		$class_of = date('Y');
		
	}

	$query = "SELECT * FROM " . $table_name . " WHERE class_of = '" . $class_of . "' AND University_id = " . $userObject->data["university_info"]["university_id"];
	
	if(empty($_POST['edit_id']) == false){
		
		$query = "SELECT * FROM " . $table_name . " WHERE id = '" . $_POST['edit_id'] . "' AND University_id = " . $userObject->data["university_info"]["university_id"];
		
	}

	$stmt = $conn->getData( $query );

	if(count($stmt) == 0){
		
		echo json_encode(array('statusCode' => 0));
		
	}else if(count($stmt) > 0){
		
		echo json_encode(array('statusCode' => 1, 'value' => $stmt));
		
	}

?>