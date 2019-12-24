<?php
    session_start();

    require_once("../../config.php");

    if(empty($_SESSION['user_id']) || $_SESSION['user_id'] == "" )
    {
        header('Location: /logincaamember.php');
    }

    require_once("../../classes/database.class.php");

    require_once("../classes/blastemail.class.php");

    $conn = new Database();
    $email = new EmailObject($conn);
// ===> Form action define.
    if(isset($_POST) && !empty($_POST['title'])) {

        $email->sender_id = $_POST['sender_id'];

        $r_type = $_POST['receiver_type'];

        $email->subject = $_POST['title'];
 
        $email->content = $_POST['msg_contents'];  

        $email->receiver_cc = $_POST['cc'];

        $email->receiver_bcc = $_POST['bcc'];
        

        /*==>> File upload .. email_banner*/ 
        $MSG = "";
        $target_dir =  "../../upload/";
        $target_file = $target_dir . basename($_FILES["attached"]["name"]);

        $uploadOk = 1; $attached = "";
        
        //Check if file already exists
        if (file_exists($target_file)) {

            $MSG = "Sorry, file already exists.";
            $attached = $_FILES["attached"]["name"];
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["attached"]["size"] > 500000) {

            $MSG = "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        else{

            if (move_uploaded_file($_FILES["attached"]["tmp_name"], $target_file)) {
                
                $MSG =  "Your MSG sent successfully. <br> The file has been uploaded.";
                $uploadOk = 1;
                $attached = $_FILES["attached"]["name"];
            }
            else{
                $uploadOk = 1;
                $MSG = "Your MSG sent successfully. <br> But, Not Attached file.";
            }
        }


        $_SESSION['resultMSG']=['type'=>$uploadOk, 'msg'=>$MSG];

        /*==>> Banner image upload */
        $_MSG = "";
        $_target_dir =  "../../upload/banner_image/";
        $_target_file = $_target_dir . basename($_FILES["banner"]["name"]);

        $_uploadOk = 1; $banner = "";
        
        //Check if file already exists
        if (file_exists($_target_file)) {

            // $_MSG = "Sorry, file already exists.";
            $banner = $_FILES["banner"]["name"];
            $_uploadOk = 0;
        }

        if ( move_uploaded_file($_FILES["banner"]["tmp_name"], $_target_file) ) {

            $_MSG =  "Your MSG sent successfully. <br> The file has been uploaded.";
            $_uploadOk = 1;
            $banner = $_FILES["banner"]["name"];
        }
        else{

            $_uploadOk = 1;
            $_MSG = "Your MSG sent successfully. <br> But, Not Banner file.";
        }

        $_SESSION['_resultMSG']=['type'=>$_uploadOk, 'msg'=>$_MSG];

        // insert the db table
        $email->attach = $attached; 
        $email->banner = $banner;
        $receiver_id   = [];

        if($r_type=="members"){ 
            $r_ids = isset($_POST['receiver_ids']) ? $_POST['receiver_ids'] : "";
            $email->receiver_ids = $r_ids;
            $email->receiver_emails = $_POST['selectedEmails'];
        }
        else if($r_type=="groups"){//selected groups
            $g_ids = isset($_POST['receiver_ids']) ?  $_POST['receiver_ids'] : "";
            $g_ids = $email->get_users_ids( $g_ids );
            $email->receiver_ids = $g_ids;
            $ee = $email->get_users_emails($email->receiver_ids);
            $email->receiver_emails = join(',', $ee);
        }

        $email->create();
        
        header('Location: ../../admin/?content=../emailblast/admin/ViewAllBlastEmail&li_class=EmailBlast');
        return;
    }

?>