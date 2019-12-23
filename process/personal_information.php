<?php
session_start();
include("../config.php");
session_start();

if(isset($_POST['personal_form_submit'])){
    //print_r($_SESSION);
	//print_r($_POST);
	//exit;
	
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
	
	

    $query = "select * from temp_personal_information where user_id=".$_SESSION['user_id'];
    $result = mysqli_query($con,$query);
    $resultDatar=mysqli_fetch_object($result);
    
    $rowcount=mysqli_num_rows($result);
    
    if($rowcount >0){
        
       $update_query = "UPDATE temp_personal_information set age='".$age."',gender='".$gender."',race ='".$race."',ethnicity='".$ethnicity."',ethnicity_other='".$ethnicity_other."',height='".$height."',weight='".$weight."',marital_status='".$marital_status."',any_children='".$children."',no_of_children='".$number_of_children."' WHERE user_id=".$_SESSION['user_id'];
        $exec = mysqli_query($con,$update_query);
        if(mysqli_affected_rows($con)>0)
        {
            header('Location: ../form.php?message=Success');
        }else{
            header('Location: ../form.php?message=failed');
        }
       
       
    }else{
        $user_id = $_SESSION['user_id'];
        $insert_query = "INSERT INTO temp_personal_information (user_id,age,gender,race,ethnicity,ethnicity_other,height,weight,marital_status,any_children,no_of_children) VALUES ($user_id,'".$age."','".$gender."','".$race."','".$ethnicity."','".$ethnicity_other."','".$height."','".$weight."','".$marital_status."','".$children."','".$number_of_children."')";
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
    
 }
 ?>
 
 
 