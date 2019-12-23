<?php
session_start();
include("../config.php");


if(isset($_POST['employer_compensation_submit'])){
    
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
	
	
	 $query = "select * from temp_employer_compensation where user_id=".$_SESSION['user_id'];
    $result = mysqli_query($con,$query);
    $resultDatar=mysqli_fetch_object($result);
    
    $rowcount=mysqli_num_rows($result);
    
    if($rowcount >0){
        
       $update_query = "UPDATE `temp_employer_compensation` SET `basic_compension`='".$allcompensation_box."',`full_compension`='".$all_full_time_compensation_box."',`overtime_pay`='".$considered_overtime_pay."',`overtime_compensation`='".$overtime_compensation."' WHERE user_id=".$_SESSION['user_id'];
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
        $insert_query = "INSERT INTO `temp_employer_compensation`(`user_id`, `basic_compension`, `full_compension`, `overtime_pay`, `overtime_compensation`) VALUES ($user_id,'".$allcompensation_box."','".$all_full_time_compensation_box."','".$considered_overtime_pay."','".$overtime_compensation."')";
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
 
 
 