<?php

	session_start();

	require_once("../../config.php");

	if(empty($_SESSION['user_id']) || $_SESSION['user_id'] == "" )
	{

		header('Location: /logincaamember.php');

	}

	require_once("../../../includes/util.php");

	require_once("../../classes/database.class.php");

	require_once("email_group.class.php");
	
	global $conn;

	$conn = new Database();

	$EmailGroupObject = new EmailGroupObject($conn);

	$groupsList = $EmailGroupObject->readAll();

	if(isset($groupsList)){	

		echo json_encode(['data' => $groupsList]);		

	}else{		

		echo json_encode(array('statusCode' => 0, 'data' => []));
	}
?>