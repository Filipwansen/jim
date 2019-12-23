<?php
session_start();
include("../config.php");


if(isset($_POST['another_submit'])){
    //echo "<pre>";
	//print_r($_POST);
	//echo "</pre>";
	//exit;
	
	
	$another_address = $_POST['another_address'];
	$another_apt_suite = $_POST['another_apt_suite'];
	$another_city = $_POST['another_city'];
	$another_state = $_POST['another_state'];
	$another_zip_code = $_POST['another_zip_code'];
	$another_country = $_POST['another_country'];
	
	
	
	
	
	$query = "select * from temp_add_another_address where user_id=".$_SESSION['user_id'];
    $result = mysqli_query($con,$query);
    $resultDatar=mysqli_fetch_object($result);
    
    $rowcount=mysqli_num_rows($result);
    
    if($rowcount >0){
        
       $update_query = "UPDATE `temp_add_another_address` SET `another_address`='".$another_address."',`another_apt`='".$another_apt_suite."',`another_city`='".$another_city."',`another_state`='".$another_state."',`another_zip`='".$another_zip_code."',`another_country`='".$another_country."' WHERE user_id=".$_SESSION['user_id'];
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
        $insert_query = "INSERT INTO `temp_add_another_address`(`user_id`, `another_address`, `another_apt`, `another_city`, `another_state`, `another_zip`, `another_country`)
		VALUES ('$user_id','".$another_address."','".$another_apt_suite."','".$another_city."','".$another_state."','".$another_zip_code."','".$another_country."')";
		
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