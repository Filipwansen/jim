<?php
session_start();
include("../config.php");


if(isset($_POST['program_uni_submit'])){
	//echo "<pre>";
	//print_r($_POST);
	//echo "</pre>";
	//exit;
	
	
	/**
	university fields
	**/
	
	$university = $_POST['university'];
    $code_no = $_POST['roll_no'];
    $university_address = $_POST['university_address'];
    $university_city = $_POST['university_city'];
    $university_state = $_POST['university_state'];
    $university_zipcode = $_POST['university_zipcode'];
	$university_phone = $_POST['university_phone'];
    $university_director = $_POST['university_director'];
    $university_director_no = $_POST['university_director_no'];
	
	/**
	matric fields
	**/
	
	$matric_month = $_POST['matric_month'];
	$matric_day = $_POST['matric_day'];
	$matric_year = $_POST['matric_year'];
	
	 $matric_date = $matric_year."-".$matric_month."-".$matric_day;
	
	
	$program_length = $_POST['program_length'];
	
	/**
	grad fields
	**/
	
	$grad_month = $_POST['grad_month'];
	$grad_day = $_POST['grad_day'];
	$grad_year = $_POST['grad_year'];
	
	 $grad_date =  $grad_year."-".$grad_month."-".$grad_day;
	
	/**
	actual fields
	**/
	
	$actual_grad_month = $_POST['actual_grad_month'];
	$actual_grad_day = $_POST['actual_grad_day'];
	$actual_grad_year = $_POST['actual_grad_year'];
	
	 $actual_date = $actual_grad_year."-".$actual_grad_month."-".$actual_grad_day;
	
	
	$completed_hours = $_POST['clinical_hours'];
	
	/**
	specialities fields array
	**/
	$answers = $_POST['answers'];
	 $allAnswersText = implode(" , ",$answers);
	
	$others_specialties = $_POST['others_specialties'];
	
	/**
	Degree type / Certification fields
	**/
	
	$degree_type = $_POST['degree_type'];
	$degree_type_other = $_POST['degree_type_other'];
	$years_certified = $_POST['years_certified'];
	$designation = $_POST['designation'];
	$certificate_no = $_POST['certificate_no'];
	
	
	
	
	$query = "select * from temp_program_university_info where user_id=".$_SESSION['user_id'];
    $result = mysqli_query($con,$query);
    $resultDatar=mysqli_fetch_object($result);
    
    $rowcount=mysqli_num_rows($result);
    
    if($rowcount >0){
        
       $update_query = "UPDATE `temp_program_university_info` SET `university`='".$university."',`univerisity_code`='".$code_no."',`university_address`='".$university_address."',`university_state`='".$university_state."',`university_city`='".$university_city."',`university_zip_code`='".$university_zipcode."',`university_phone`='".$university_phone."',`univeristy_program_director`='".$university_director."',`university_phone2`='".$university_director_no."',`matric_date`='".$matric_date."',`expected_graduation_date`='".$grad_date."',`actual_graduation_date`='".$actual_date."',`program_length`='".$program_length."',`clinical_length`='".$completed_hours."',`specialities_training`='".$allAnswersText."',`degree_type1`='".$degree_type."',`degree_type2`='".$degree_type_other."',`years_certified`='".$years_certified."',`designation`='".$designation."',`certificate`='".$certificate_no."',`other_specialities`='".$others_specialties."' WHERE user_id=".$_SESSION['user_id'];
        
		$exec = mysqli_query($con,$update_query);
		
		//echo $update_query;
		//echo mysqli_affected_rows($con);
		//exit;
		
        if(mysqli_affected_rows($con)>0)
        {
            header('Location: ../form.php?message=Success');
        }else{
            header('Location: ../form.php?message=failed');
        }
       
       
    }else{
        $user_id = $_SESSION['user_id'];
		
        $insert_query = "INSERT INTO `temp_program_university_info` (`user_id`, `university`, `univerisity_code`, `university_address`, `university_state`, `university_city`, `university_zip_code`, `university_phone`, `univeristy_program_director`, `university_phone2`,`matric_date`, `expected_graduation_date`, `actual_graduation_date`, `program_length`, `clinical_length`, `specialities_training`, `degree_type1`, `degree_type2`, `years_certified`, `designation`, `certificate`,`other_specialities`) VALUES ($user_id,'".$university."','".$code_no."','".$university_address."','".$university_state."','".$university_city."','".$university_zipcode."','".$university_phone."','".$university_director."','".$university_director_no."','".$matric_date."','".$grad_date."','".$actual_date."','".$program_length."','".$completed_hours."','".$allAnswersText."','".$degree_type."','".$degree_type_other."','".$years_certified."','".$designation."','".$certificate_no."','".$others_specialties."')";
        $insert_query;
        
		
        $exec = mysqli_query($con,$insert_query);
        if(mysqli_affected_rows($con)>0)
        {
            header('Location: ../form.php?message=Success');
        }else{
            header('Location: ../form.php?message=failed');
        }
    }
    

	
 } ?>
 
 
 