<?php
session_start();
include("../config.php");


if(isset($_POST['employment_form_submit'])){
    
	//echo "<pre>";
	//print_r($_POST);
	//echo "</pre>";
	//exit;
	
	
	/** emp expire date **/
	$emp_expiry_date_month = $_POST['emp_expiry_date_month'];
	$emp_expiry_date_day = $_POST['emp_expiry_date_day'];
	$emp_expiry_date_year = $_POST['emp_expiry_date_year'];
	
	$emp_expiry_date = $emp_expiry_date_year."-".$emp_expiry_date_month."-".$emp_expiry_date_day;
	/** emp expire date **/
	
	//Status
	$emp_employment_status = $_POST['emp_employment_status'];
	
	//State
	$emp_state = $_POST['select_3_states'];
	 $emp_state1 = implode(" , ",$emp_state);
	
	//emp expected test 2
	$emp_expected_test_month_2 = $_POST['emp_expected_test_month_2'];
	$emp_expected_test_day_2 = $_POST['emp_expected_test_day_2'];
	$emp_expected_test_year_2 = $_POST['emp_expected_test_year_2'];
	
	$emp_expected_test_date2 = $emp_expected_test_year_2."-".$emp_expected_test_month_2."-".$emp_expected_test_day_2;
	
	//employer info
	$emp_employer_name = $_POST['emp_employer_name'];
	$emp_employer_address = $_POST['emp_employer_address'];
	$emp_employer_state = $_POST['emp_employer_state'];
	$emp_employer_zip = $_POST['emp_employer_zip'];
	$emp_employer_city = $_POST['emp_employer_city'];
	$emp_employer_phone = $_POST['emp_employer_phone'];
	
	$type_of_setting = $_POST['type_of_setting'];
	 $type_of_setting_imp = implode(" , ",$type_of_setting);
	
	 /*$emp_employer_group = $_POST['emp_employer_group'];
	$emp_employer_group_other = $_POST['emp_employer_group_other'];*/
	
	
	//provider
	
	$emp_provider_group_cs = $_POST['emp_provider_group_cs'];
	$emp_provider_group_nas = $_POST['emp_provider_group_nas'];
	$emp_provider_group_mo = $_POST['emp_provider_group_mo'];
	
	//work schedule 
	$emp_work_schedule = $_POST['emp_work_schedule'];
	$emp_work_schedule_all = implode(" , ",$emp_work_schedule);
	
	$emp_work_schedule_other = $_POST['emp_work_schedule_other'];
	
	//other fields
	$emp_directe = $_POST['emp_directe'];
	$emp_indirect_care = $_POST['emp_indirect_care'];
	$emp_administrative = $_POST['emp_administrative'];
	$emp_non_clinical = $_POST['emp_non_clinical'];
	$emp_research = $_POST['emp_research'];
	$emp_safety_improv = $_POST['emp_safety_improv'];
	$emp_other_pra = $_POST['emp_other_pra'];
	$emp_not_practicing = $_POST['emp_not_practicing'];
	
	//echo "<pre>";
	//print_r($_POST);
	//echo "</pre>";
	
	//exit;
	
	/** here we go **/
	
	
	$query = "select * from temp_employment_info where user_id=".$_SESSION['user_id'];
    $result = mysqli_query($con,$query);
    $resultDatar=mysqli_fetch_object($result);
    
    $rowcount=mysqli_num_rows($result);
    
    if($rowcount >0){
        
       $update_query = "UPDATE temp_employment_info SET `first_employment_date`='".$emp_expiry_date."',`employment_status`='".$emp_employment_status."',`employement_practice_state1`='".$emp_state1."',`start_date`='".$emp_expected_test_date2."',`employer_name`='".$emp_employer_name."',`employer_address`='".$emp_employer_address."',`employer_city`='".$emp_employer_city."',`employer_state`='".$emp_employer_state."',`employer_zip`='".$emp_employer_zip."',`employer_phone`='".$emp_employer_phone."',`type_setting_1`='".$type_of_setting_imp."',`providers_grp1`='".$emp_provider_group_cs."',`providers_grp2`='".$emp_provider_group_nas."',`providers_grp3`='".$emp_provider_group_mo."',`typical_weekly1`='".$emp_work_schedule_all."',`typical_weekly_other`='".$emp_work_schedule_other."',`divided_1`='".$emp_directe."',`divided_2`='".$emp_indirect_care."',`divided_3`='".$emp_administrative."',`divided_4`='".$emp_non_clinical."',`divided_5`='".$emp_research."',`divided_6`='".$emp_safety_improv."',`divided_7`='".$emp_other_pra."',`divided_8`='".$emp_not_practicing."' WHERE user_id=".$_SESSION['user_id'];
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
        $insert_query = "INSERT INTO `temp_employment_info`(`user_id`, `first_employment_date`, `employment_status`, `employement_practice_state1`, `start_date`, `employer_name`, `employer_address`, `employer_city`, `employer_state`, `employer_zip`, `employer_phone`, `type_setting_1`, `providers_grp1`, `providers_grp2`, `providers_grp3`, `typical_weekly1`, `typical_weekly_other`, `divided_1`, `divided_2`, `divided_3`, `divided_4`, `divided_5`, `divided_6`, `divided_7`, `divided_8`) VALUES ($user_id,'".$emp_expiry_date."','".$emp_employment_status."','".$emp_state1."','".$emp_expected_test_date2."','".$emp_employer_name."','".$emp_employer_address."','".$emp_employer_city."','".$emp_employer_state."','".$emp_employer_zip."','".$emp_employer_phone."','".$type_of_setting_imp."','".$emp_provider_group_cs."','".$emp_provider_group_nas."','".$emp_provider_group_mo."','".$emp_work_schedule_all."','".$emp_work_schedule_other."','".$emp_directe."','".$emp_indirect_care."','".$emp_administrative."','".$emp_non_clinical."','".$emp_research."','".$emp_safety_improv."','".$emp_other_pra."','".$emp_not_practicing."')";
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
 
 
 