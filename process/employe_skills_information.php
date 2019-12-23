<?php
session_start();
include("../config.php");


if(isset($_POST['employe_skills_submit'])){
    //echo "<pre>";
	//print_r($_POST);
	//echo "</pre>";
	
	
	$skills_speak_lang = $_POST['skills_speak_lang'];
	$skills_communicate = $_POST['skills_communicate'];
	$skills_languages = $_POST['skills_languages'];
	$skills_environment = $_POST['skills_environment'];
	$skills_other_health_care = $_POST['skills_other_health_care'];
	
	$skills_specialties = $_POST['skills_answers'];
	
	$all_skills_specialties = implode(" , ",$skills_specialties);
	
	$skills_list_all = $_POST['skills_list_all'];
	
	/** here we go **/
	
	$query = "select * from temp_employee_skills where user_id=".$_SESSION['user_id'];
    $result = mysqli_query($con,$query);
    $resultDatar=mysqli_fetch_object($result);
    
    $rowcount=mysqli_num_rows($result);
    
    if($rowcount >0){
        
       $update_query = "UPDATE `temp_employee_skills` SET `languages_speak`='".$skills_speak_lang."',`other_than_english`='".$skills_communicate."',`which_languages`='".$skills_languages."',`teach_or_environment`='".$skills_environment."',`teach_healthcare_or`='".$skills_other_health_care."',`all_specialities_techniques`='".$all_skills_specialties."',`all_specialities_techniques_other`='".$skills_list_all."' WHERE user_id=".$_SESSION['user_id'];
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
        $insert_query = "INSERT INTO `temp_employee_skills`(`user_id`, `languages_speak`, `other_than_english`, `which_languages`, `teach_or_environment`, `teach_healthcare_or`, `all_specialities_techniques`, `all_specialities_techniques_other`)
		VALUES ('$user_id','".$skills_speak_lang."','".$skills_communicate."','".$skills_languages."','".$skills_environment."','".$skills_other_health_care."','".$all_skills_specialties."','".$skills_list_all."')";
        
		//echo $insert_query;
        //exit;
		
        $exec = mysqli_query($con,$insert_query);
        if(mysqli_affected_rows($con)>0)
        {
            header('Location: ../form.php?message=Success');
        }else{
            header('Location: ../form.php?message=failed');
        }
    }
	
	
	
	
	
 } ?>
 
 
 