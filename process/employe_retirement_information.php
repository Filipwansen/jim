<?php
session_start();
include("../config.php");


if(isset($_POST['employe_retirement_submit'])){
	
	//echo "<pre>";
   // print_r($_POST);
	//echo "</pre>";
	
	
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
	
	/** here we go **/
	$query = "select * from temp_employer_retirement where user_id=".$_SESSION['user_id'];
    $result = mysqli_query($con,$query);
    $resultDatar=mysqli_fetch_object($result);
    
    $rowcount=mysqli_num_rows($result);
    
    if($rowcount >0){
        
       $update_query = "UPDATE `temp_employer_retirement` SET `retirement_setup_plan`='".$all_retirement_plan_setup."',`retirement_setup_plan_other`='".$retirement_plan."',`profit_sharing`='".$profilt_sharing."',`employer_matching`='".$employer_matching."',`employer_offer_lumpsum`='".$employer_offers."',`pension_of`='".$pension_offers."',`after_service_years`='".$pension_after_years."',`service_offer_other`='".$employer_others."',`anticipated_year_retirement`='".$retirement_year."',`anticipated_month_retirement`='".$retirement_month."' WHERE user_id=".$_SESSION['user_id'];
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
        $insert_query = "INSERT INTO `temp_employer_retirement` (`user_id`,  `retirement_setup_plan`, `retirement_setup_plan_other`, `profit_sharing`, `employer_matching`, `employer_offer_lumpsum`, `pension_of`, `after_service_years`, `service_offer_other`, `anticipated_year_retirement`, `anticipated_month_retirement`)
		VALUES ('$user_id','".$all_retirement_plan_setup."','".$retirement_plan."','".$profilt_sharing."','".$employer_matching."','".$employer_offers."','".$pension_offers."','".$pension_after_years."','".$employer_others."','".$retirement_year."','".$retirement_month."')";
        
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
 
 
 