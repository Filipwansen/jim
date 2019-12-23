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
	
	$table_pd = "tbl_program_director";
	
	$table_university = "tbl_university";
    
	if($_POST['remove_object'] == 'rd_photo' ){
		
		$query = "SELECT * FROM " . $table_pd . " WHERE Title = 'Regional Director' AND University_Id = '" . $university_id . "'";
		
		$stmt1 = $conn->getData( $query );
		
		if(empty($stmt1[0]['Photo']) == false){
			
			$file_url = "../". $stmt1[0]['Photo'];
			
			$file_exist = file_exists($file_url);
			
			if($file_exist == true){
				
				unlink($file_url);
				
			}
			
		}
		
		$query_del = "UPDATE " . $table_pd . " SET Photo = '' WHERE Title = 'Regional Director' AND University_Id = '" . $university_id . "'";
		
		if($stmt2 = $conn->execute( $query_del )){
			
			echo json_encode(array('statusCode' => 1));
			
		}else{
			
			echo json_encode(array('statusCode' => 0));
			
		}
		
	}else if($_POST['remove_object'] == 'pd_photo' ){
		
		$query = "SELECT * FROM " . $table_pd . " WHERE Title = 'Program Director' AND University_Id = '" . $university_id . "'";
		
		$stmt1 = $conn->getData( $query );
		
		if(empty($stmt1[0]['Photo']) == false){
			
			$file_url = "../". $stmt1[0]['Photo'];
			
			$file_exist = file_exists($file_url);
			
			if($file_exist == true){
				
				unlink($file_url);
				
			}
			
		}
		
		$query_del = "UPDATE " . $table_pd . " SET Photo = '' WHERE Title = 'Program Director' AND University_Id = '" . $university_id . "'";
		
		if($stmt2 = $conn->execute( $query_del )){
			
			echo json_encode(array('statusCode' => 1));
			
		}else{
			
			echo json_encode(array('statusCode' => 0));
			
		}
		
	}else if($_POST['remove_object'] == 'apd_photo' ){
		
		$query = "SELECT * FROM " . $table_pd . " WHERE Title = 'Assistant Program Director' AND University_Id = '" . $university_id . "'";
		
		$stmt1 = $conn->getData( $query );
		
		if(empty($stmt1[0]['Photo']) == false){
			
			$file_url = "../". $stmt1[0]['Photo'];
			
			$file_exist = file_exists($file_url);
			
			if($file_exist == true){
				
				unlink($file_url);
				
			}
			
		}
		
		$query_del = "UPDATE " . $table_pd . " SET Photo = '' WHERE Title = 'Assistant Program Director' AND University_Id = '" . $university_id . "'";
		
		if($stmt2 = $conn->execute( $query_del )){
			
			echo json_encode(array('statusCode' => 1));
			
		}else{
			
			echo json_encode(array('statusCode' => 0));
			
		}
		
	}else if($_POST['remove_object'] == 'aa_photo' ){
		
		$query = "SELECT * FROM " . $table_pd . " WHERE Title = 'Admin Assistant' AND University_Id = '" . $university_id . "'";
		
		$stmt1 = $conn->getData( $query );
		
		if(empty($stmt1[0]['Photo']) == false){
			
			$file_url = "../". $stmt1[0]['Photo'];
			
			$file_exist = file_exists($file_url);
			
			if($file_exist == true){
				
				unlink($file_url);
				
			}
			
		}
		
		$query_del = "UPDATE " . $table_pd . " SET Photo = '' WHERE Title = 'Admin Assistant' AND University_Id = '" . $university_id . "'";
		
		if($stmt2 = $conn->execute( $query_del )){
			
			echo json_encode(array('statusCode' => 1));
			
		}else{
			
			echo json_encode(array('statusCode' => 0));
			
		}
		
	}else if($_POST['remove_object'] == 'ite_photo' ){
		
		$query = "SELECT * FROM " . $table_pd . " WHERE Title = 'ITE Coordinator' AND University_Id = '" . $university_id . "'";
		
		$stmt1 = $conn->getData( $query );
		
		if(empty($stmt1[0]['Photo']) == false){
			
			$file_url = "../". $stmt1[0]['Photo'];
			
			$file_exist = file_exists($file_url);
			
			if($file_exist == true){
				
				unlink($file_url);
				
			}
			
		}
		
		$query_del = "UPDATE " . $table_pd . " SET Photo = '' WHERE Title = 'ITE Coordinator' AND University_Id = '" . $university_id . "'";
		
		if($stmt2 = $conn->execute( $query_del )){
			
			echo json_encode(array('statusCode' => 1));
			
		}else{
			
			echo json_encode(array('statusCode' => 0));
			
		}
		
	}else if($_POST['remove_object'] == 'portal_picture' ){
		
		$query = "SELECT * FROM " . $table_university . " WHERE id = '" . $university_id . "'";
		
		$stmt1 = $conn->getData( $query );
		
		if(empty($stmt1[0]['University_Photo']) == false){
			
			$file_url = "../". $stmt1[0]['University_Photo'];
			
			$file_exist = file_exists($file_url);
			
			if($file_exist == true){
				
				unlink($file_url);
				
			}
			
		}
		
		$query_del = "UPDATE " . $table_university . " SET University_Photo = '' WHERE id = '" . $university_id . "'";
		
		if($stmt2 = $conn->execute( $query_del )){
			
			echo json_encode(array('statusCode' => 1));
			
		}else{
			
			echo json_encode(array('statusCode' => 0));
			
		}
		
	}
		
	
		
?>