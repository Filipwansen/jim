<?php
session_start();
include("../config.php");

//print_r($_POST);
//exit;
$countFind = 0;
$data;

/******** INSERT QUERY FOR GENERAL INFORMATION TABLE *********/
	$title = $_POST['title'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $suffix = $_POST['suffix'];
    $status = $_POST['status'];
	
		$query_11 = "select * from temp_generalinform where user_id=".$_SESSION['user_id'];
		$result_11 = mysqli_query($con,$query_11);
		$rowcount_11=mysqli_num_rows($result_11);
    
		if($rowcount_11 >0){ 
			$countFind = $countFind + 1;
		}else {
			
			$data['message']="Please Save General Information Form";
			$data['code'] = 300;
		}
		
		
		
		$user_id = $_SESSION['user_id'];
        $insert_query = "INSERT INTO final_generalinform (user_id,title,f_name,m_name,l_name,suffix,status) VALUES ($user_id,'".$title."','".$fname."','".$mname."','".$lname."','".$suffix."','".$status."');";
	   
	   
	
/******** END INSERT QUERY FOR GENERAL INFORMATION TABLE *********/


/******** INSERT QUERY FOR PERSONAL INFORMATION TABLE *********/

	$age = $_POST['age'];
    $gender = $_POST['gender'];
    $race = $_POST['race'];
    $ethnicity = $_POST['ethnicity'];
    $ethnicity_other = $_POST['ethnicity-other'];
    $height = $_POST['height'];
	$weight = $_POST['weight'];
    $marital_status = $_POST['marital-status'];
    $children = $_POST['children'];
    $number_of_children = $_POST['number-of-childrens'];
	
		$query_22 = "select * from temp_personal_information where user_id=".$_SESSION['user_id'];
		$result_22 = mysqli_query($con,$query_22);
		$rowcount_22=mysqli_num_rows($result_22);
    
		if($rowcount_22 >0){ 
			$countFind = $countFind + 1;
		}else {
			
			$data['message']="Please Save Personal Information Form";
			$data['code'] = 300;
		}
	
		$user_id = $_SESSION['user_id'];
        $insert_query .= "INSERT INTO final_personal_information (user_id,age,gender,race,ethnicity,ethnicity_other,height,weight,marital_status,any_children,no_of_children) VALUES ($user_id,'".$age."','".$gender."','".$race."','".$ethnicity."','".$ethnicity_other."','".$height."','".$weight."','".$marital_status."','".$children."','".$number_of_children."');";
	   
	   
		
/******** END INSERT QUERY FOR PERSONAL INFORMATION TABLE *********/


/******** INSERT QUERY FOR ADDRESS & CONTACT INFORMATION TABLE *********/

$address = $_POST['address'];
    $apt_suite = $_POST['apt-suite'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip_code = $_POST['zip-code'];
    $country = $_POST['country'];
    $cell_no = $_POST['cell-no'];
    $business_no = $_POST['business-no'];
    $home_no = $_POST['home-no'];
    $other_no = $_POST['other-no'];
    $email_primary = $_POST['email-primary'];
    $email_pri_confirm = $_POST['email-primary-confirm'];
    $email_secondary = $_POST['email-secondary'];
    $email_secondary_confirm = $_POST['email-secondary-confirm'];
	
		
		$query_33 = "select * from temp_address_contact_information where user_id=".$_SESSION['user_id'];
		$result_33 = mysqli_query($con,$query_33);
		$rowcount_33=mysqli_num_rows($result_33);
    
		if($rowcount_33 >0){ 
			$countFind = $countFind + 1;
		}else {
			
			$data['message']="Please Save Address / Contact Information Form";
			$data['code'] = 300;
		}
		
		$user_id = $_SESSION['user_id'];
        $insert_query .= "INSERT INTO final_address_contact_information (user_id,address_1,apt_suite,city,state,zip_code,country,cell_phone,business_phone,home_phone,other_phone,email_default,confirm_email,email_default2,confirm_email2)
        VALUES ($user_id,'".$address."','".$apt_suite."','".$city."','".$state."','".$zip_code."','".$country."','".$cell_no."','".$business_no."','".$home_no."','".$other_no."','".$email_primary."','".$email_pri_confirm."','".$email_secondary."','".$email_secondary_confirm."');";
		
		

/******** END INSERT QUERY FOR ADDRESS & CONTACT INFORMATION TABLE *********/


/******** INSERT QUERY FOR Account / Security INFORMATION TABLE *********/

	$crmid = $_POST['crmid'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];
    $program_code = $_POST['program-code'];
    $security_info = $_POST['security-info'];
    $month = $_POST['month'];
    $day = $_POST['day'];
    $year = $_POST['year'];
    $social_security = $_POST['social-security'];
    $mother_name = $_POST['mother-name'];
    //$nmonth = date("m", strtotime($month));
    
     $date = $year."-".$month."-".$day;
	 
		
		$query_44 = "select * from temp_account_security_information where user_id=".$_SESSION['user_id'];
		$result_44 = mysqli_query($con,$query_44);
		$rowcount_44=mysqli_num_rows($result_44);
    
		if($rowcount_44 >0){ 
			$countFind = $countFind + 1;
		}else {
			
			$data['message']="Please Save Acount / Security Information Form";
			$data['code'] = 300;
		}
		
	 
		$user_id = $_SESSION['user_id'];
        $insert_query .= "INSERT INTO final_account_security_information (user_id,id_crm,username,password,program_code,security_information,dob,social_security,mother_maiden_name)
        VALUES ($user_id,'".$crmid."','".$username."','".$confirm_password."','".$program_code."','".$security_info."','".$date."','".$social_security."','".$mother_name."');";
		
		
		


/******** END INSERT QUERY FOR Account / Security INFORMATION TABLE *********/


/******** INSERT QUERY FOR Program / University INFORMATION TABLE *********/

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
	
	    $user_id = $_SESSION['user_id'];
		
		
		$query_55 = "select * from temp_program_university_info where user_id=".$_SESSION['user_id'];
		$result_55 = mysqli_query($con,$query_55);
		$rowcount_55=mysqli_num_rows($result_55);
    
		if($rowcount_55 >0){ 
			$countFind = $countFind + 1;
		}else {
			
			$data['message']="Please Save Program / University Information Form";
			$data['code'] = 300;
		}
		
		
        $insert_query .= "INSERT INTO `final_program_university_info` (`user_id`, `university`, `univerisity_code`, `university_address`, `university_state`, `university_city`, `university_zip_code`, `university_phone`, `univeristy_program_director`, `university_phone2`,`matric_date`, `expected_graduation_date`, `actual_graduation_date`, `program_length`, `clinical_length`, `specialities_training`, `degree_type1`, `degree_type2`, `years_certified`, `designation`, `certificate`,`other_specialities`) VALUES ($user_id,'".$university."','".$code_no."','".$university_address."','".$university_state."','".$university_city."','".$university_zipcode."','".$university_phone."','".$university_director."','".$university_director_no."','".$matric_date."','".$grad_date."','".$actual_date."','".$program_length."','".$completed_hours."','".$allAnswersText."','".$degree_type."','".$degree_type_other."','".$years_certified."','".$designation."','".$certificate_no."','".$others_specialties."');";
	   
	   



/******** END INSERT QUERY FOR Program / University INFORMATION TABLE *********/

/******** INSERT QUERY FOR Exam / Certification Information TABLE *********/
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
	
		
		$query_66 = "select * from temp_exam_certification_info where user_id=".$_SESSION['user_id'];
		$result_66 = mysqli_query($con,$query_66);
		$rowcount_66=mysqli_num_rows($result_66);
    
		if($rowcount_66 >0){ 
			$countFind = $countFind + 1;
		}else {
			
			$data['message']="Please Save Exam / Certification Information Form";
			$data['code'] = 300;
		}
		
	
	
        $user_id = $_SESSION['user_id'];
        $insert_query .= "INSERT INTO `final_exam_certification_info`(`user_id`,  `actual_exam_date_taken`, `actual_exam_result`, `actual_certification_exam_taken`, `actual_certification_result`, `actual_exam_date_taken2`, `actual_exam_result2`, `expiry_date`, `fail_opportunities`, `pass_opportunities`, `registration_cycle`, `organization_name`, `title_of_meeting`, `c_start_date`, `c_end_date`, `c_time`, `accredited_by`, `accredited_by2`, `search_expiration_date`, `expiration_date`, `past_periods`, `exam_accomodations`, `prior_attempts`, `country_region_id`) 
		VALUES ($user_id,'".$actual_test_date."','".$actual_test_passfail."','".$certification_actual_test_date."','".$actual_certification_test_passfail."','".$actual_test_date2."','".$actual_test_passfail_2."','".$expiry_date."','".$fail_opportunities."','".$pass_opportunities."','".$reg_cycle."','".$org_name."','".$meeting_title."','".$start_date."','".$end_date."','".$hours."','".$accredited_by_dropdown."','".$accredited_by_text."','".$search_expiration_date."','".$expiration_dates."','".$past_periods."','".$exam_accomodation."','".$prior_attempts."','".$country_regionid."');";
		
		
		
		

/******** END INSERT QUERY FOR Exam / Certification Information TABLE *********/

/******** INSERT QUERY FOR Employment Information TABLE *********/

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
		
		
		
		$query_77 = "select * from temp_employment_info where user_id=".$_SESSION['user_id'];
		$result_77 = mysqli_query($con,$query_77);
		$rowcount_77=mysqli_num_rows($result_77);
    
		if($rowcount_77 >0){ 
			$countFind = $countFind + 1;
		}else {
			
			$data['message']="Please Save Employment Information Form";
			$data['code'] = 300;
		}
		
		
	
	$user_id = $_SESSION['user_id'];
        $insert_query .= "INSERT INTO `final_employment_info`(`user_id`, `first_employment_date`, `employment_status`, `employement_practice_state1`, `start_date`, `employer_name`, `employer_address`, `employer_city`, `employer_state`, `employer_zip`, `employer_phone`, `type_setting_1`, `providers_grp1`, `providers_grp2`, `providers_grp3`, `typical_weekly1`, `typical_weekly_other`, `divided_1`, `divided_2`, `divided_3`, `divided_4`, `divided_5`, `divided_6`, `divided_7`, `divided_8`) VALUES ($user_id,'".$emp_expiry_date."','".$emp_employment_status."','".$emp_state1."','".$emp_expected_test_date2."','".$emp_employer_name."','".$emp_employer_address."','".$emp_employer_city."','".$emp_employer_state."','".$emp_employer_zip."','".$emp_employer_phone."','".$type_of_setting_imp."','".$emp_provider_group_cs."','".$emp_provider_group_nas."','".$emp_provider_group_mo."','".$emp_work_schedule_all."','".$emp_work_schedule_other."','".$emp_directe."','".$emp_indirect_care."','".$emp_administrative."','".$emp_non_clinical."','".$emp_research."','".$emp_safety_improv."','".$emp_other_pra."','".$emp_not_practicing."');";
	  
	  
		


/******** END INSERT QUERY FOR Employment Information Information TABLE *********/


/******** INSERT QUERY FOR Employer Compensation Information TABLE *********/


//echo "<pre>";
	//print_r($_POST);
	//echo "</pre>";
	
	$compensation_box = $_POST['compensation_box'];
	/* seprate with - */
	$allcompensation_box = implode(" - ",$compensation_box);
	/* seprate with - */
	
	
	$full_time_compensation_box = $_POST['full_time_compensation_box'];
	/* seprate with - */
	$all_full_time_compensation_box = implode(" - ",$full_time_compensation_box);
	/* seprate with - */
	
	$considered_overtime_pay = $_POST['considered_overtime_pay'];
	$overtime_compensation = $_POST['overtime_compensation'];
	
		
		
		$query_88 = "select * from temp_employer_compensation where user_id=".$_SESSION['user_id'];
		$result_88 = mysqli_query($con,$query_88);
		$rowcount_88=mysqli_num_rows($result_88);
    
		if($rowcount_88 >0){ 
			$countFind = $countFind + 1;
		}else {
			
			$data['message']="Please Save Employer Compensation Form";
			$data['code'] = 300;
		}
		
		
	
		$user_id = $_SESSION['user_id'];
        $insert_query .= "INSERT INTO `final_employer_compensation`(`user_id`, `basic_compension`, `full_compension`, `overtime_pay`, `overtime_compensation`) VALUES ($user_id,'".$allcompensation_box."','".$all_full_time_compensation_box."','".$considered_overtime_pay."','".$overtime_compensation."');";
	  
	  
		

/******** END INSERT QUERY FOR Employer Compensation Information TABLE *********/


/******** INSERT QUERY FOR Employer Benefits Information TABLE *********/


	$employer_benefits = $_POST['employer_benefits'];
	/* seprate with - */
	$allemployer_benefits = implode(" - ",$employer_benefits);
	/* seprate with - */
	
	$employer_other_benefits = $_POST['employer_other_benefits'];
	
	
		$query_99 = "select * from temp_employer_benefits where user_id=".$_SESSION['user_id'];
		$result_99 = mysqli_query($con,$query_99);
		$rowcount_99=mysqli_num_rows($result_99);
    
		if($rowcount_99 >0){ 
			$countFind = $countFind + 1;
		}else {
			
			$data['message']="Please Save Employer Benefits Form";
			$data['code'] = 300;
		}
		
	
		$user_id = $_SESSION['user_id'];
        $insert_query .= "INSERT INTO `final_employer_benefits`(`user_id`, `employer_offer_benefit`, `other_benefits`) VALUES ($user_id,'".$allemployer_benefits."','".$employer_other_benefits."');";
		
	


/******** END INSERT QUERY FOR Employer Benefits Information TABLE *********/

/******** INSERT QUERY FOR Employer Retirement Information TABLE *********/

$retirement_plan_setup = $_POST['retirement_plan_setup'];
	$all_retirement_plan_setup = implode(" - ",$retirement_plan_setup);
	
	
	$retirement_plan = $_POST['retirement_plan'];
	$profilt_sharing = $_POST['profilt_sharing'];
	$employer_matching = $_POST['employer_matching'];
	$employer_offers = $_POST['employer_offers'];
	$pension_offers = $_POST['pension_offers'];
	$pension_after_years = $_POST['pension_after_years'];
	$employer_others = $_POST['employer_others'];
	
	$retirement_month = $_POST['retirement_month'];
	$retirement_year = $_POST['retirement_year'];
	
	
		$query_110 = "select * from temp_employer_retirement where user_id=".$_SESSION['user_id'];
		$result_110 = mysqli_query($con,$query_110);
		$rowcount_110=mysqli_num_rows($result_110);
    
		if($rowcount_110 >0){ 
			$countFind = $countFind + 1;
		}else {
			
			$data['message']="Please Save Employer Retirement Form";
			$data['code'] = 300;
		}
		
	
		$user_id = $_SESSION['user_id'];
        $insert_query .= "INSERT INTO `final_employer_retirement` (`user_id`,  `retirement_setup_plan`, `retirement_setup_plan_other`, `profit_sharing`, `employer_matching`, `employer_offer_lumpsum`, `pension_of`, `after_service_years`, `service_offer_other`, `anticipated_year_retirement`, `anticipated_month_retirement`)
		VALUES ('$user_id','".$all_retirement_plan_setup."','".$retirement_plan."','".$profilt_sharing."','".$employer_matching."','".$employer_offers."','".$pension_offers."','".$pension_after_years."','".$employer_others."','".$retirement_year."','".$retirement_month."');";
		
		


/******** END INSERT QUERY FOR Employer Retirement Information TABLE *********/


/******** INSERT QUERY FOR Skills Information TABLE *********/

	$skills_speak_lang = $_POST['skills_speak_lang'];
	$skills_communicate = $_POST['skills_communicate'];
	$skills_languages = $_POST['skills_languages'];
	$skills_environment = $_POST['skills_environment'];
	$skills_other_health_care = $_POST['skills_other_health_care'];
	
	$skills_specialties = $_POST['skills_answers'];
	
	$all_skills_specialties = implode(" , ",$skills_specialties);
	
	$skills_list_all = $_POST['skills_list_all'];
	
	/** here we go **/
	
		
		$query_111 = "select * from temp_employee_skills where user_id=".$_SESSION['user_id'];
		$result_111 = mysqli_query($con,$query_111);
		$rowcount_111 = mysqli_num_rows($result_111);
    
		if($rowcount_111 >0){ 
			$countFind = $countFind + 1;
		}else {
			
			$data['message']="Please Save Employee Skill Form";
			$data['code'] = 300;
		}
		
		
		$user_id = $_SESSION['user_id'];
        $insert_query .= "INSERT INTO `final_employee_skills`(`user_id`, `languages_speak`, `other_than_english`, `which_languages`, `teach_or_environment`, `teach_healthcare_or`, `all_specialities_techniques`, `all_specialities_techniques_other`)
		VALUES ('$user_id','".$skills_speak_lang."','".$skills_communicate."','".$skills_languages."','".$skills_environment."','".$skills_other_health_care."','".$all_skills_specialties."','".$skills_list_all."');";
	

/******** END INSERT QUERY FOR Skills Information TABLE *********/

/******** INSERT QUERY FOR OTHER MEMBERSHIP Information TABLE *********/

	$other_membership = $_POST['other_member_ship'];
	$memberships_expiry_date_month = $_POST['memberships_expiry_date_month'];
	$memberships_expiry_date_day = $_POST['memberships_expiry_date_day'];
	$memberships_expiry_date_year = $_POST['memberships_expiry_date_year'];
	
	$membership_expiry_date = $memberships_expiry_date_year."-".$memberships_expiry_date_month."-".$memberships_expiry_date_day;
	
	$membership_no = $_POST['membership_no'];
	$member_groups = $_POST['member_groups'];
	$memberships_comments = $_POST['memberships_comments'];
	
	/** here we go **/
	
		
		$query_112 = "select * from temp_other_memberships where user_id=".$_SESSION['user_id'];
		$result_112 = mysqli_query($con,$query_112);
		$rowcount_112=mysqli_num_rows($result_112);
    
		if($rowcount_112 >0){ 
			$countFind = $countFind + 1;
		}
		else {
			
			$data['message']="Please Save Other Membership Form";
			$data['code'] = 300;
			//echo "Errorrrr";
		}
		
		
		$user_id = $_SESSION['user_id'];
        $insert_query .= "INSERT INTO `final_other_memberships` (`user_id`, `belong_to_othermembership`, `dated_joined`, `membership_number`, `other_groups_belongs`, `comments`) VALUES ('$user_id','".$other_membership."','".$membership_expiry_date."','".$membership_no."','".$member_groups."','".$memberships_comments."');";

	

/******** END INSERT QUERY FOR OTHER MEMBERSHIP Information TABLE *********/

//echo $countFind;
//print_r($data);
//exit;

$queryCount = 0;
if($countFind == 12){
	if (mysqli_multi_query($con,$insert_query)) {
    //echo "New records created successfully";
	while(mysqli_more_results($con))
{
   mysqli_next_result($con);
}
	//$queryCount = $queryCount +1;
	$data['message'] = "Successfully Form Submitted";
	$data['code'] = 200;
	
} else {
    //echo "Error: " . $sql . "<br>" . mysqli_error($con);
	//echo $insert_query;
	$data['message']="Please Save All Forms Than Submit";
	$data['code'] = 300;
	
}


//echo $queryCount;
/*	
  if($data['code'] = 200){
	
	$db_temp_tables = array('temp_generalinform','temp_exam_certification_info','	
temp_employment_info','temp_employer_retirement','temp_employer_compensation','temp_employer_benefits','temp_employee_skills','temp_address_contact_information','temp_account_security_information','temp_other_memberships','temp_personal_information','temp_program_university_info');
foreach($db_temp_tables as $table) 
{
    //echo $table.'<br/>';

    # truncate data from this table
    # $sql = "TRUNCATE TABLE `test_tbl`";

    # truncate data from this table
     $sql_delete = "DELETE FROM ".$table." WHERE user_id = $user_id;";

    $result = mysqli_query($con,$sql_delete);
	# if($result){
	#	echo $result;
	#}else{
	#	echo "Error: " . $sql_delete . "<br>" . mysqli_error($con);
	#}
	
	
}

}
*/
//print_r($truncate_res);
	//exit;
	
echo json_encode($data);

}else{
	echo json_encode($data);
}





