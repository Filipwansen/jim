<?php
session_start();
include("../config.php");


if(isset($_POST['certification_submit'])){
   
	//echo "<pre>";
	//print_r($_POST);
	//echo "</pre>";
	//exit;
	
	
	
	/* Actual Test Date 1 Start */
	
	$actual_test_month = $_POST['actual_test_month'];
	$actual_test_day = $_POST['actual_test_day'];
	$actual_test_year = $_POST['actual_test_year'];
	$actual_test_passfail = $_POST['actual_test_passfail'];
	
	$actual_test_date = $actual_test_year."-".$actual_test_month."-".$actual_test_day;
	
	
	/* Actual Test Date 1 End */
	
	/* Actual certification Test Date 1 Start */
	
	$actual_certification_test_month = $_POST['actual_certification_test_month'];
	$actual_certification_test_day = $_POST['actual_certification_test_day'];
	$actual_certification_test_year = $_POST['actual_certification_test_year'];
	$actual_certification_test_passfail = $_POST['actual_certification_test_passfail'];
	
	$certification_actual_test_date = $actual_certification_test_year."-".$actual_certification_test_month."-".$actual_certification_test_day;
	
	
	/* Actual certification Test Date 1 End */
	
	/* Actual Test Date 2 Start */
	
	$actual_test_month_2 = $_POST['actual_test_month_2'];
	$actual_test_day_2 = $_POST['actual_test_day_2'];
	$actual_test_year_2 = $_POST['actual_test_year_2'];
	$actual_test_passfail_2 = $_POST['actual_test_passfail_2'];
	
	$actual_test_date2 = $actual_test_year_2."-".$actual_test_month_2."-".$actual_test_day_2;
	
	
	/* Actual Test Date 2 End */
	/* Expiry Date Start */
	
	$expiry_date_month = $_POST['expiry_date_month'];
	$expiry_date_day = $_POST['expiry_date_day'];
	$expiry_date_year = $_POST['expiry_date_year'];
	
	$expiry_date = $expiry_date_year."-".$expiry_date_month."-".$expiry_date_day;
	
	/* Expiry Date End */
	/* Other Post variables start */
	
	$fail_opportunities = $_POST['fail_opportunities'];
	$pass_opportunities = $_POST['pass_opportunities'];
	$reg_cycle = $_POST['reg_cycle'];
	$org_name = $_POST['org_name'];
	$meeting_title = $_POST['meeting_title'];
	$start_date = $_POST['start_date'];
	$end_date = $_POST['end_date'];
	$hours = $_POST['hours'];
	$accredited_by_dropdown = $_POST['accredited_by_dropdown'];
	$accredited_by_text = $_POST['accredited_by_text'];
	$search_expiration_date = $_POST['search_expiration_date'];
	$expiration_dates = $_POST['expiration_dates'];
	$past_periods = $_POST['past_periods'];
	$exam_accomodation = $_POST['exam_accomodation'];
	$prior_attempts = $_POST['prior_attempts'];
	$country_regionid = $_POST['country_regionid'];
	
	/* Other Post variables end */
	
	/** here we go **/
	
	//print_r($_SESSION);
	//echo "<pre>";
	//print_r($_POST);
	//echo "</pre>";
	//exit;
	
	
	$query = "select * from temp_exam_certification_info where user_id=".$_SESSION['user_id'];
    $result = mysqli_query($con,$query);
    $resultDatar=mysqli_fetch_object($result);
    
    $rowcount=mysqli_num_rows($result);
    
    if($rowcount >0){
        
       $update_query = "UPDATE `temp_exam_certification_info` SET `actual_exam_date_taken`='".$actual_test_date."',`actual_exam_result`='".$actual_test_passfail."',`actual_certification_exam_taken`='".$certification_actual_test_date."',`actual_certification_result`='".$actual_certification_test_passfail."',`actual_exam_date_taken2`='".$actual_test_date2."',`actual_exam_result2`='".$actual_test_passfail_2."',`expiry_date`='".$expiry_date."',`fail_opportunities`='".$fail_opportunities."',`pass_opportunities`='".$pass_opportunities."',`registration_cycle`='".$reg_cycle."',`organization_name`='".$org_name."',`title_of_meeting`='".$meeting_title."',`c_start_date`='".$start_date."',`c_end_date`='".$end_date."',`c_time`='".$hours."',`accredited_by`='".$accredited_by_dropdown."',`accredited_by2`='".$accredited_by_text."',`search_expiration_date`='".$search_expiration_date."',`expiration_date`='".$expiration_dates."',`past_periods`='".$past_periods."',`exam_accomodations`='".$exam_accomodation."',`prior_attempts`='".$prior_attempts."',`country_region_id`='".$country_regionid."' WHERE user_id=".$_SESSION['user_id'];
	   
	   //echo $update_query;
	   //exit;
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
        $insert_query = "INSERT INTO `temp_exam_certification_info`(`user_id`,  `actual_exam_date_taken`, `actual_exam_result`, `actual_certification_exam_taken`, `actual_certification_result`, `actual_exam_date_taken2`, `actual_exam_result2`, `expiry_date`, `fail_opportunities`, `pass_opportunities`, `registration_cycle`, `organization_name`, `title_of_meeting`, `c_start_date`, `c_end_date`, `c_time`, `accredited_by`, `accredited_by2`, `search_expiration_date`, `expiration_date`, `past_periods`, `exam_accomodations`, `prior_attempts`, `country_region_id`) 
		VALUES ($user_id,'".$actual_test_date."','".$actual_test_passfail."','".$certification_actual_test_date."','".$actual_certification_test_passfail."','".$actual_test_date2."','".$actual_test_passfail_2."','".$expiry_date."','".$fail_opportunities."','".$pass_opportunities."','".$reg_cycle."','".$org_name."','".$meeting_title."','".$start_date."','".$end_date."','".$hours."','".$accredited_by_dropdown."','".$accredited_by_text."','".$search_expiration_date."','".$expiration_dates."','".$past_periods."','".$exam_accomodation."','".$prior_attempts."','".$country_regionid."')";
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
 
 
 