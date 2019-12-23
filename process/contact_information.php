<?php
session_start();
include("../config.php");


if(isset($_POST['contact_info_submit'])){
    //echo "<pre>";
    //print_r($_POST);
    //echo "</pre>";
    //exit;
    
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
    
    

    $query = "select * from temp_address_contact_information where user_id=".$_SESSION['user_id'];
    $result = mysqli_query($con,$query);
    $resultDatar=mysqli_fetch_object($result);
    
    $rowcount=mysqli_num_rows($result);
    
    if($rowcount >0){
        
       $update_query = "UPDATE temp_address_contact_information set address_1='".$address."',apt_suite='".$apt_suite."',city ='".$city."',state='".$state."',zip_code='".$zip_code."',country='".$country."',cell_phone='".$cell_no."',business_phone='".$business_no."',home_phone='".$home_no."',other_phone='".$other_no."',
       email_default='".$email_primary."',confirm_email='".$email_pri_confirm."',email_default2='".$email_secondary."',confirm_email2='".$email_secondary_confirm."' WHERE user_id=".$_SESSION['user_id'];
       
        $exec = mysqli_query($con,$update_query);
        if(mysqli_affected_rows($con)>0)
        {
            header('Location: ../form.php?message=Success');
        }else{
            header('Location: ../form.php?message=failed');
        }
       
       
    }else{
        $user_id = $_SESSION['user_id'];
        $insert_query = "INSERT INTO temp_address_contact_information (user_id,address_1,apt_suite,city,state,zip_code,country,cell_phone,business_phone,home_phone,other_phone,email_default,confirm_email,email_default2,confirm_email2)
        VALUES ($user_id,'".$address."','".$apt_suite."','".$city."','".$state."','".$zip_code."','".$country."','".$cell_no."','".$business_no."','".$home_no."','".$other_no."','".$email_primary."','".$email_pri_confirm."','".$email_secondary."','".$email_secondary_confirm."')";
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