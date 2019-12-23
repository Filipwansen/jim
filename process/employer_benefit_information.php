<?php
session_start();
include("../config.php");


if(isset($_POST['employer_benefit_submit'])){
   // print_r($_POST);
	
	
	$employer_benefits = $_POST['employer_benefits'];
	/* seprate with - */
	$allemployer_benefits = implode(" - ",$employer_benefits);
	/* seprate with - */
	
	$employer_other_benefits = $_POST['employer_other_benefits'];
	
	/** here we go **/
	
	
	$query = "select * from temp_employer_benefits where user_id=".$_SESSION['user_id'];
    $result = mysqli_query($con,$query);
    $resultDatar=mysqli_fetch_object($result);
    
    $rowcount=mysqli_num_rows($result);
    
    if($rowcount >0){
        
       $update_query = "UPDATE `temp_employer_benefits` SET `employer_offer_benefit`='".$allemployer_benefits."',`other_benefits`='".$employer_other_benefits."' WHERE user_id=".$_SESSION['user_id'];
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
        $insert_query = "INSERT INTO `temp_employer_benefits`(`user_id`, `employer_offer_benefit`, `other_benefits`) VALUES ($user_id,'".$allemployer_benefits."','".$employer_other_benefits."')";
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
 
 
 