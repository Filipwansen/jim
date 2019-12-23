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
	
	$table_director = "tbl_program_director";
	
	$table_university = "tbl_university";
	
	$title = array("", "Regional Director", "Program Director", "Assistant Program Director", "Admin Assistant", "ITE Coordinator");
	
	//first name
	function split_name($name) {
			
			$name = trim($name);
			
			$last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
			
			$first_name = trim( preg_replace('#'.$last_name.'#', '', $name ) );
			
			return array($first_name, $last_name);
	}
	
	//photo upload
	function file_upload($file_name){
		
		$upload_day = getdate();
		
		//file upload start
		$target_dir = "../uploads/";
		
		$filename = $_FILES[$file_name]["name"];
		
		$file_basename = substr($filename, 0, strripos($filename, '.')); 
		
		$file_ext = substr($filename, strripos($filename, '.')); 
		
		$filesize = $_FILES[$file_name]["size"];
		
		$allowed_file_types = array('.gif', '.jpg', '.png', '.jpeg');	

		if (in_array($file_ext,$allowed_file_types))
		{	
			$newfilename = $file_name . $upload_day[0] . $file_ext;
			
			$GLOBALS['photo_dir'] = "uploads/".$newfilename;
			
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
	
	function director_exist_check($director_title){
	
		$query = "SELECT * FROM " . $GLOBALS['table_director'] . " WHERE Title = '" . $director_title . "' AND University_Id = '" . $GLOBALS['university_id'] . "'";
		
		$stmt = $GLOBALS['conn']->getCount($query);
		
		return $stmt;
	
	}
	
	//Regional Director
    if((empty($_POST['rd_fullname']) == false) && (empty($_FILES['rd_file']["name"]) == false)){
		
		$rd_fullname = htmlspecialchars($_POST['rd_fullname']);
		
		$rd_firstname = split_name($rd_fullname)[0];
		
		$rd_lastname = split_name($rd_fullname)[1];
		
		$rd_designations = htmlspecialchars($_POST['rd_designations']);
		
		$rd_program_name = htmlspecialchars($_POST['rd_program_name']);
		
		$rd_program_address = htmlspecialchars($_POST['rd_program_address']);
		
		$rd_phone = htmlspecialchars($_POST['rd_phone']);
		
		$rd_email = htmlspecialchars($_POST['rd_email']);
		
		file_upload('rd_file');
		
		if(director_exist_check($title[1]) > 0){
			
			$query = "UPDATE " . $table_director . " SET First_Name='" . $rd_firstname . "', Last_Name='" . $rd_lastname . "', Designation='" . $rd_designations . "', Program_Name='" . $rd_program_name . "', Program_Address='" . $rd_program_address . "', Cell_Phone='" . $rd_phone . "', Email='" . $rd_email . "', Start_Date='" . date('m-d-Y') . "', Photo='" . $photo_dir . "' WHERE University_Id='" . $university_id . "' AND Title='" . $title[1] . "'";
			
		}else{
			
			$query = "INSERT INTO " . $table_director . " (University_Id, First_Name, Last_Name, Designation, Program_Name, Program_Address, Title, Bus_Phone, Cell_Phone, Other, Email, Start_Date, Other_Credentials, Photo,user_id) VALUES ('" . $university_id . "', '" . $rd_firstname . "', '" . $rd_lastname . "', '" . $rd_designations . "', '" . $rd_program_name . "', '" . $rd_program_address . "', '" . $title[1] . "', '0', '" . $rd_phone . "', '0', '" . $rd_email . "', '" . date('m-d-Y') . "', '0', '" . $photo_dir . "', '0')";
			
		}
		
		$stmt = $conn->execute( $query );
		
	}	
	
	//Program Director
    if((empty($_POST['pd_fullname']) == false) && (empty($_FILES['pd_file']["name"]) == false)){
		
		$pd_fullname = htmlspecialchars($_POST['pd_fullname']);
		
		$pd_firstname = split_name($pd_fullname)[0];
		
		$pd_lastname = split_name($pd_fullname)[1];
		
		$pd_designations = htmlspecialchars($_POST['pd_designations']);
		
		$pd_program_name = htmlspecialchars($_POST['pd_program_name']);
		
		$pd_program_address = htmlspecialchars($_POST['pd_program_address']);
		
		$pd_phone = htmlspecialchars($_POST['pd_phone']);
		
		$pd_email = htmlspecialchars($_POST['pd_email']);
		
		file_upload('pd_file');
		
		if(director_exist_check($title[2]) > 0){
			
			$query = "UPDATE " . $table_director . " SET First_Name='" . $pd_firstname . "', Last_Name='" . $pd_lastname . "', Designation='" . $pd_designations . "', Program_Name='" . $pd_program_name . "', Program_Address='" . $pd_program_address . "', Cell_Phone='" . $pd_phone . "', Email='" . $pd_email . "', Start_Date='" . date('m-d-Y') . "', Photo='" . $photo_dir . "' WHERE University_Id='" . $university_id . "' AND Title='" . $title[2] . "'";
			
		}else{
			
			$query = "INSERT INTO " . $table_director . " (University_Id, First_Name, Last_Name, Designation, Program_Name, Program_Address, Title, Bus_Phone, Cell_Phone, Other, Email, Start_Date, Other_Credentials, Photo,user_id) VALUES ('" . $university_id . "', '" . $pd_firstname . "', '" . $pd_lastname . "', '" . $pd_designations . "', '" . $pd_program_name . "', '" . $pd_program_address . "', '" . $title[2] . "', '0', '" . $pd_phone . "', '0', '" . $pd_email . "', '" . date('m-d-Y') . "', '0', '" . $photo_dir . "', '0')";
			
		}
		
		$stmt = $conn->execute( $query );

	}	
	
	//Assistant Program Director 
    if((empty($_POST['apd_fullname']) == false) && (empty($_FILES['apd_file']["name"]) == false)){
		
		$apd_fullname = htmlspecialchars($_POST['apd_fullname']);
		
		$apd_firstname = split_name($apd_fullname)[0];
		
		$apd_lastname = split_name($apd_fullname)[1];
		
		$apd_designations = htmlspecialchars($_POST['apd_designations']);
		
		$apd_program_name = htmlspecialchars($_POST['apd_program_name']);
		
		$apd_program_address = htmlspecialchars($_POST['apd_program_address']);
		
		$apd_phone = htmlspecialchars($_POST['apd_phone']);
		
		$apd_email = htmlspecialchars($_POST['apd_email']);
		
		file_upload('apd_file');
		
		if(director_exist_check($title[3]) > 0){
			
			$query = "UPDATE " . $table_director . " SET First_Name='" . $apd_firstname . "', Last_Name='" . $apd_lastname . "', Designation='" . $apd_designations . "', Program_Name='" . $apd_program_name . "', Program_Address='" . $apd_program_address . "', Cell_Phone='" . $apd_phone . "', Email='" . $apd_email . "', Start_Date='" . date('m-d-Y') . "', Photo='" . $photo_dir . "' WHERE University_Id='" . $university_id . "' AND Title='" . $title[3] . "'";
			
		}else{
			
			$query = "INSERT INTO " . $table_director . " (University_Id, First_Name, Last_Name, Designation, Program_Name, Program_Address, Title, Bus_Phone, Cell_Phone, Other, Email, Start_Date, Other_Credentials, Photo,user_id) VALUES ('" . $university_id . "', '" . $apd_firstname . "', '" . $apd_lastname . "', '" . $apd_designations . "', '" . $apd_program_name . "', '" . $apd_program_address . "', '" . $title[3] . "', '0', '" . $apd_phone . "', '0', '" . $apd_email . "', '" . date('m-d-Y') . "', '0', '" . $photo_dir . "', '0')";
			
		}
		
		$stmt = $conn->execute( $query );
		
	}	
	
	//Admin Assistant
    if((empty($_POST['aa_fullname']) == false) && (empty($_FILES['aa_file']["name"]) == false)){
		
		$aa_fullname = htmlspecialchars($_POST['aa_fullname']);
		
		$aa_firstname = split_name($aa_fullname)[0];
		
		$aa_lastname = split_name($aa_fullname)[1];
		
		$aa_designations = htmlspecialchars($_POST['aa_designations']);
		
		$aa_program_name = htmlspecialchars($_POST['aa_program_name']);
		
		$aa_program_address = htmlspecialchars($_POST['aa_program_address']);
		
		$aa_phone = htmlspecialchars($_POST['aa_phone']);
		
		$aa_email = htmlspecialchars($_POST['aa_email']);
		
		file_upload('aa_file');
		
		if(director_exist_check($title[4]) > 0){
			
			$query = "UPDATE " . $table_director . " SET First_Name='" . $aa_firstname . "', Last_Name='" . $aa_lastname . "', Designation='" . $aa_designations . "', Program_Name='" . $aa_program_name . "', Program_Address='" . $aa_program_address . "', Cell_Phone='" . $aa_phone . "', Email='" . $aa_email . "', Start_Date='" . date('m-d-Y') . "', Photo='" . $photo_dir . "' WHERE University_Id='" . $university_id . "' AND Title='" . $title[4] . "'";
			
		}else{
			
			$query = "INSERT INTO " . $table_director . " (University_Id, First_Name, Last_Name, Designation, Program_Name, Program_Address, Title, Bus_Phone, Cell_Phone, Other, Email, Start_Date, Other_Credentials, Photo,user_id) VALUES ('" . $university_id . "', '" . $aa_firstname . "', '" . $aa_lastname . "', '" . $aa_designations . "', '" . $aa_program_name . "', '" . $aa_program_address . "', '" . $title[4] . "', '0', '" . $aa_phone . "', '0', '" . $aa_email . "', '" . date('m-d-Y') . "', '0', '" . $photo_dir . "', '0')";
			
		}
		
		$stmt = $conn->execute( $query );
		
	}	
	
	//ITE Coordinator 
    if((empty($_POST['coordinator_fullname']) == false) && (empty($_FILES['coordinator_file']["name"]) == false)){
		
		$coordinator_fullname = htmlspecialchars($_POST['coordinator_fullname']);
		
		$coordinator_firstname = split_name($coordinator_fullname)[0];
		
		$coordinator_lastname = split_name($coordinator_fullname)[1];
		
		$coordinator_designations = htmlspecialchars($_POST['coordinator_designations']);
		
		$coordinator_program_name = htmlspecialchars($_POST['coordinator_program_name']);
		
		$coordinator_program_address = htmlspecialchars($_POST['coordinator_program_address']);
		
		$coordinator_phone = htmlspecialchars($_POST['coordinator_phone']);
		
		$coordinator_email = htmlspecialchars($_POST['coordinator_email']);
		
		file_upload('coordinator_file');
		
		if(director_exist_check($title[5]) > 0){
			
			$query = "UPDATE " . $table_director . " SET First_Name='" . $coordinator_firstname . "', Last_Name='" . $coordinator_lastname . "', Designation='" . $coordinator_designations . "', Program_Name='" . $coordinator_program_name . "', Program_Address='" . $coordinator_program_address . "', Cell_Phone='" . $coordinator_phone . "', Email='" . $coordinator_email . "', Start_Date='" . date('m-d-Y') . "', Photo='" . $photo_dir . "' WHERE University_Id='" . $university_id . "' AND Title='" . $title[5] . "'";
			
		}else{
			
			$query = "INSERT INTO " . $table_director . " (University_Id, First_Name, Last_Name, Designation, Program_Name, Program_Address, Title, Bus_Phone, Cell_Phone, Other, Email, Start_Date, Other_Credentials, Photo,user_id) VALUES ('" . $university_id . "', '" . $coordinator_firstname . "', '" . $coordinator_lastname . "', '" . $coordinator_designations . "', '" . $coordinator_program_name . "', '" . $coordinator_program_address . "', '" . $title[5] . "', '0', '" . $coordinator_phone . "', '0', '" . $coordinator_email . "', '" . date('m-d-Y') . "', '0', '" . $photo_dir . "', '0')";
			
		}
		
		$stmt = $conn->execute( $query );
		
	}	
	
	//University picture.
    if(empty($_FILES['university_photo']["name"]) == false){
		
		file_upload('university_photo');
		
		$query = "UPDATE " . $table_university . " SET University_Photo='" . $photo_dir . "' WHERE id='" . $university_id . "'";
		
		$stmt = $conn->execute( $query );
		
	}
	
	//Matriculation_Date
    if(empty($_POST['matriculation_date']) == false){
		
		$query = "UPDATE " . $table_university . " SET Matriculation_Date='" . $_POST['matriculation_date'] . "' WHERE id='" . $university_id . "'";
		
		$stmt = $conn->execute( $query );
		
	}
	
	//Expected_ITE_Exam
    if(empty($_POST['ite_date']) == false){
		
		$query = "UPDATE " . $table_university . " SET Expected_ITE_Exam='" . $_POST['ite_date'] . "' WHERE id='" . $university_id . "'";
		
		$stmt = $conn->execute( $query );
		
	}
	
	//ITE_Registration_Begins
    if(empty($_POST['ite_begins_date']) == false){
		
		$query = "UPDATE " . $table_university . " SET ITE_Registration_Begins='" . $_POST['ite_begins_date'] . "' WHERE id='" . $university_id . "'";
		
		$stmt = $conn->execute( $query );
		
	}
	
	//ITE_Registration_Ends
    if(empty($_POST['ite_ends_date']) == false){
		
		$query = "UPDATE " . $table_university . " SET ITE_Registration_Ends='" . $_POST['ite_ends_date'] . "' WHERE id='" . $university_id . "'";
		
		$stmt = $conn->execute( $query );
		
	}
	
	//Expected_Certification
    if(empty($_POST['cert_date']) == false){
		
		$query = "UPDATE " . $table_university . " SET Expected_Certification='" . $_POST['cert_date'] . "' WHERE id='" . $university_id . "'";
		
		$stmt = $conn->execute( $query );
		
	}
	
	//Certification_Begins
    if(empty($_POST['cert_begins_date']) == false){
		
		$query = "UPDATE " . $table_university . " SET Certification_Begins='" . $_POST['cert_begins_date'] . "' WHERE id='" . $university_id . "'";
		
		$stmt = $conn->execute( $query );
		
	}
	
	//Certification_Ends
    if(empty($_POST['cert_ends_date']) == false){
		
		$query = "UPDATE " . $table_university . " SET Certification_Ends='" . $_POST['cert_ends_date'] . "' WHERE id='" . $university_id . "'";
		
		$stmt = $conn->execute( $query );
		
	}
	
	//Expected_Graduation
    if(empty($_POST['graguation_date']) == false){
		
		$query = "UPDATE " . $table_university . " SET Expected_Graduation='" . $_POST['graguation_date'] . "' WHERE id='" . $university_id . "'";
		
		$stmt = $conn->execute( $query );
		
	}

	echo json_encode(array('statusCode' => 1));

?>