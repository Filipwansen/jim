<?php
    session_start();

    require_once("../../config.php");

    if(empty($_SESSION['user_id']) || $_SESSION['user_id'] == "" )
    {
        header('Location: /logincaamember.php');
    }

    require_once("../../classes/database.class.php");

    require_once("../classes/email.class.php");

    $conn = new Database();
    $email = new EmailObject($conn);
// ===> Form action define.
    if(isset($_POST) && !empty($_POST['title'])) {

        $email->sender_id = $_POST['sender_id'];

        $r_type = $_POST['receiver_type'];

        $email->subject = $_POST['title'];

        $email->content = $_POST['msg_contents'];        

        /*==>> File upload*/
        $MSG = "";
        $target_dir =  "../../upload/";
        $target_file = $target_dir . basename($_FILES["attached"]["name"]);

        $uploadOk = 1; $attached = "";

        // Check if file already exists
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

        if (move_uploaded_file($_FILES["attached"]["tmp_name"], $target_file)) {
            
            $MSG =  "Your MSG sent successfully. <br> The file has been uploaded.";
            $uploadOk = 1;
            $attached = $_FILES["attached"]["name"];
        }
        else{
            $uploadOk = 1;
            $MSG = "Your MSG sent successfully. <br> But, Not Attached file.";
        }

        $_SESSION['resultMSG']=['type'=>$uploadOk, 'msg'=>$MSG];

        // insert the db table

        $email->attach = $attached; $receiver_id=[];
        if($r_type=="members"){
            $r_ids = isset($_POST['receiver_ids']) ? $_POST['receiver_ids'] : "";
            $receiver_id = explode(',', $r_ids);
        }
        else if($r_type=="groups"){//selected groups
            $g_ids = isset($_POST['receiver_ids']) ?  $_POST['receiver_ids'] : "";
            $g_ids = $email->get_users_ids($g_ids);
            $receiver_id = explode(',', $g_ids);
        }

        $parent_id = isset($_POST['parent_id']) ? $_POST['parent_id'] : 0;

        foreach ($receiver_id as $key => $r_id) {
            $email->receiver_id = $r_id;
            $email->p_id = $parent_id;
            $email->create();
        }
        
        if(isset($_POST['emailType']) && $_POST['emailType'] == 'user'){// user page redirect

            header('Location: ../../?content=content/emailviewall&item=emailpage');
            return;                        
        }
        else{//admin page redirect.

            header('Location: ../../admin/?content=../email/admin/ViewAllEmail&item=emailpage');
            return;            
        }

    }

?>