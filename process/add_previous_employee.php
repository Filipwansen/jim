<?php
session_start();
include("../config.php");


if(isset($_POST['add_previous_submit'])){
   // echo "<pre>";
	////print_r($_POST);
	//echo "</pre>";
	
	$add_previous_startmonth = $_POST['add_previous_startmonth'];
	$add_previous_startdate = $_POST['add_previous_startdate'];
	$add_previous_startyear = $_POST['add_previous_startyear'];
	
	$add_previous_start_date = $add_previous_startyear."-".$add_previous_startmonth."-".$add_previous_startdate;
	
	
	$add_previous_endmonth = $_POST['add_previous_endmonth'];
	$add_previous_enddate = $_POST['add_previous_enddate'];
	$add_previous_endyear = $_POST['add_previous_endyear'];

	$add_previous_end_date = $add_previous_endyear."-".$add_previous_endmonth."-".$add_previous_enddate;
	
	$add_previous_employer_name = $_POST['add_previous_employer_name'];
	$add_previous_employer_address = $_POST['add_previous_employer_address'];
	$add_previous_city = $_POST['add_previous_city'];
	$add_previous_state = $_POST['add_previous_state'];
	$add_previous_zipcode = $_POST['add_previous_zipcode'];
	$add_previous_phone = $_POST['add_previous_phone'];
	
	
	
	$query = "select * from temp_retirements_previous_employers where user_id=".$_SESSION['user_id'];
    $result = mysqli_query($con,$query);
    $resultDatar=mysqli_fetch_object($result);
    
    $rowcount=mysqli_num_rows($result);
    
    if($rowcount >0){
        
       $update_query = "UPDATE `temp_retirements_previous_employers` SET `start_date`='".$add_previous_start_date."',`end_date`='".$add_previous_end_date."',`ex_employer_name`='".$add_previous_employer_name."',`ex_employer_address`='".$add_previous_employer_address."',`ex_employer_city`='".$add_previous_city."',`ex_employer_state`='".$add_previous_state."',`ex_employer_zip`='".$add_previous_zipcode."',`ex_employer_phone`='".$add_previous_phone."' WHERE user_id=".$_SESSION['user_id'];
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
        $insert_query = "INSERT INTO `temp_retirements_previous_employers`(`user_id`, `start_date`, `end_date`, `ex_employer_name`, `ex_employer_address`, `ex_employer_city`, `ex_employer_state`, `ex_employer_zip`, `ex_employer_phone`)
		VALUES ('$user_id','".$add_previous_start_date."','".$add_previous_end_date."','".$add_previous_employer_name."','".$add_previous_employer_address."','".$add_previous_city."','".$add_previous_state."','".$add_previous_zipcode."','".$add_previous_phone."')";
        
		
		
        $exec = mysqli_query($con,$insert_query);
        if(mysqli_affected_rows($con)>0)
        {
		//echo $insert_query;
        //exit;
            header('Location: ../form.php?message=Success');
        }else{
            header('Location: ../form.php?message=failed');
        }
    }
	
	
}
?>