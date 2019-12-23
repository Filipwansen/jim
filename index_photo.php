<?php
	
	session_start();

	require_once("config.php");

	if(empty($_SESSION['user_id']) || $_SESSION['user_id'] == "" )

	{

		header('Location: /logincaamember.php');

	}

	require_once( BASE_PATH . "includes/util.php");

	require_once( BASE_PATH . "classes/user.class.php");

	$userObject = new userObject();

	$userObject->init( $_SESSION['user_id'] );

	require_once( "./classes/database.class.php");

	global $conn;

	$conn = new Database();
	
	$table_name = "profile_photo";
	
	$user_id = htmlspecialchars($_POST['user_id']);
	
	//photo upload
	function file_upload($file_name){
		
		$upload_day = getdate();
		
		//file upload start
		$target_dir = "./photos/";
		
		$filename = $_FILES[$file_name]["name"];
		
		$file_basename = substr($filename, 0, strripos($filename, '.')); 
		
		$file_ext = substr($filename, strripos($filename, '.')); 
		
		$filesize = $_FILES[$file_name]["size"];
		
		$allowed_file_types = array('.gif', '.jpg', '.png', '.jpeg');	
		
		if ($filesize == 0) {
			
			echo json_encode(array('statusCode' => 4));exit;

		}
		
		if (in_array($file_ext,$allowed_file_types))
		{	
			$newfilename = "photo_" . $upload_day[0] . $file_ext;
			
			$GLOBALS['photo_dir'] = "photos/".$newfilename;
			
			if (file_exists($target_dir . $newfilename))
			{
				echo "You have already uploaded this file.";
			}
			else
			{		
				move_uploaded_file($_FILES[$file_name]["tmp_name"], $target_dir . $newfilename);
			}
		}
		elseif (empty($file_basename))
		{	
			echo "Please select a file to upload.";
		} 
		else
		{
			echo "Only these file typs are allowed for upload: " . implode(', ',$allowed_file_types);
			
			unlink($_FILES[$file_name]["tmp_name"]);
		}
		
	}
	
    // add user picture
    if(empty($_FILES['add_picture_file']["name"]) == false){
   
        $query = "SELECT * FROM profile_photo WHERE user_id = " . $user_id; 
		
		if($user_count = $conn->getCount($query)){
			
			 true;
			
		}else{
		
			 $user_count = 0;
		}
		
		file_upload('add_picture_file');
		
		if($user_count > 0){
			
			$query1 = "SELECT * FROM " . $table_name . " WHERE user_id = '". $user_id ."'";
			
			$stmt1 = $conn->getData( $query1 );
			
			if(empty($stmt1[0]['photo']) == false){
				
				$file_url = $stmt1[0]['photo'];
				
				$file_exist = file_exists($file_url);
				
				if($file_exist == true){
					
					unlink($file_url);
					
				}
				
			}

			$query = "UPDATE " . $table_name . " SET photo = '". $photo_dir ."', created = '". date('Y-m-d') ."' WHERE user_id = '". $user_id ."'";
			
		}else{
			
			$query = "INSERT INTO " . $table_name . " (user_id, full_name, photo, created) VALUES('". $user_id ."', (SELECT full_name FROM users WHERE id = '". $user_id ."'), '". $photo_dir ."', '". date('Y-m-d') ."')";
			
		}
              
		
		if($stmt = $conn->execute($query)){
			
			echo json_encode(array('statusCode' => 1));
			
		}else{
			
			echo json_encode(array('statusCode' => 0));
			
		}    
	
	}else{
		
		echo json_encode(array('statusCode' => 1));
		
	}
	

?>

