<?php
session_start();
include("../config.php");


if(isset($_POST['account_security_submit'])){
     //echo "<pre>";
   // print_r($_POST);
   // echo "</pre>";
  
    
    
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
    //echo $newDate = date($date);
    
    //exit;
    
    

    $query = "select * from temp_account_security_information where user_id=".$_SESSION['user_id'];
    $result = mysqli_query($con,$query);
    $resultDatar=mysqli_fetch_object($result);
    
    $rowcount=mysqli_num_rows($result);
    
    if($rowcount >0){
        
       $update_query = "UPDATE temp_account_security_information set id_crm='".$crmid."',username='".$username."',password ='".$confirm_password."',program_code='".$program_code."',security_information='".$security_info."',dob='".$date."',social_security='".$social_security."',mother_maiden_name='".$mother_name."' WHERE user_id=".$_SESSION['user_id'];
       
        $exec = mysqli_query($con,$update_query);
        if(mysqli_affected_rows($con)>0)
        {
            header('Location: ../form.php?message=Success');
        }else{
            header('Location: ../form.php?message=failed');
        }
       
       
    }else{
        $user_id = $_SESSION['user_id'];
        $insert_query = "INSERT INTO temp_account_security_information (user_id,id_crm,username,password,program_code,security_information,dob,social_security,mother_maiden_name)
        VALUES ($user_id,'".$crmid."','".$username."','".$confirm_password."','".$program_code."','".$security_info."','".$date."','".$social_security."','".$mother_name."')";
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