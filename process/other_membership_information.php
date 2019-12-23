<?php
session_start();
include("../config.php");


if(isset($_POST['other_membership_submit'])){
	
	//echo "<pre>";
    //print_r($_POST);
	//echo "</pre>";
	
	
	$other_membership = $_POST['other_member_ship'];
	$memberships_expiry_date_month = $_POST['memberships_expiry_date_month'];
	$memberships_expiry_date_day = $_POST['memberships_expiry_date_day'];
	$memberships_expiry_date_year = $_POST['memberships_expiry_date_year'];
	
	$membership_expiry_date = $memberships_expiry_date_year."-".$memberships_expiry_date_month."-".$memberships_expiry_date_day;
	
	$membership_no = $_POST['membership_no'];
	$member_groups = $_POST['member_groups'];
	$memberships_comments = $_POST['memberships_comments'];
	
	/** here we go **/
	
	$query = "select * from temp_other_memberships where user_id=".$_SESSION['user_id'];
    $result = mysqli_query($con,$query);
    $resultDatar=mysqli_fetch_object($result);
    
    $rowcount=mysqli_num_rows($result);
    
    if($rowcount >0){
        
       $update_query = "UPDATE `temp_other_memberships` SET `belong_to_othermembership`='".$other_membership."',`dated_joined`='".$membership_expiry_date."',`membership_number`='".$membership_no."',`other_groups_belongs`='".$member_groups."',`comments`='".$memberships_comments."' WHERE user_id=".$_SESSION['user_id'];
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
        $insert_query = "INSERT INTO `temp_other_memberships` (`user_id`, `belong_to_othermembership`, `dated_joined`, `membership_number`, `other_groups_belongs`, `comments`) VALUES ('$user_id','".$other_membership."','".$membership_expiry_date."','".$membership_no."','".$member_groups."','".$memberships_comments."')";
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
 
 
 