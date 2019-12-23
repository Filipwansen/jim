<?php
session_start();
include("../config.php");


if(isset($_POST['general_info_form'])){

    $title = $_POST['title'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $suffix = $_POST['suffix'];
    $status = $_POST['status'];

    $query = "select * from temp_generalinform where user_id=".$_SESSION['user_id'];
    $result = mysqli_query($con,$query);
    $resultDatar=mysqli_fetch_object($result);
    
    $rowcount=mysqli_num_rows($result);
    
    if($rowcount >0){
        
       $update_query = "UPDATE temp_generalinform set title='".$title."',f_name='".$fname."',m_name ='".$mname."',l_name='".$lname."',suffix='".$suffix."',status='".$status."' WHERE user_id=".$_SESSION['user_id'];
        $exec = mysqli_query($con,$update_query);
        if(mysqli_affected_rows($con)>0)
        {
            header('Location: ../form.php?message=Success');
        }else{
            header('Location: ../form.php?message=failed');
        }
       
       
    }else{
        $user_id = $_SESSION['user_id'];
        $insert_query = "INSERT INTO temp_generalinform (user_id,title,f_name,m_name,l_name,suffix,status) VALUES ($user_id,'".$title."','".$fname."','".$mname."','".$lname."','".$suffix."','".$status."')";
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
 
 
 