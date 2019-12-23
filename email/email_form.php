<?php
include("../config.php");
//print_r($_POST);

if(isset($_POST['submit'])){ 

$emails = $_POST['emails'];
$count = 0;
//$to = implode(", ", $emails);
		
		
		
		foreach($emails as $arr){
            $uniqid = uniqid();
            $updte = mysqli_query($con,"UPDATE users SET password = '".$uniqid."' WHERE name = '$arr'");
		 $subject = "Immediate Action Needed!";
		 $header = "From:noreply@globaltechkyllc.com \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";
		 //$message = "<p>Dear <b>".$arr."</b>,</p> \r\n";
         $message = "<p>Dear <b> All NCCAA Members</b>,</p> \r\n";
         $message .= "<p>As we end 2018, NCCAA has begun a process to help its CAA members make a transition to what we are calling 2.0 – a complete set of new website features to help our veteran members, newly certified members, and the students enrolled each year in one of our superb programs, to benefit in the following ways:</p> \r\n";
         $message .= "<ul><li>Quickly access where they are at any stage any exam or CME</li><li>Search for any CAA, whether local or in the U.S., to communicate</li><li>Search for any employers in our database for job opportunities</li><li>Upload and track all CMEs</li></ul>";
         $message .= "<p>Our first reveal for the new website will be at the Indianapolis event on April 9, 2019 where I and the main developer will do a live demonstration of some of the major benefits for our members. In the meantime, we need your help in filling in the gaps of individual profiles that will meet the standards set forth by Medicare but also provide us with the much needed data that will serve the entire community never before attempted.</p>  \r\n";
         $message .= "<p>Simply click the link below which will lead you to your individual profiles. Use the temporary password to login and then reset the password to a new permanent password that will be used for now on. Until the website is ready, the only part you will see are the profile fields that are mandatory for all CAA members to complete. If possible, we would like to have all of our members complete the entire profile within the next week (or two) so we can move forward with the rest of the project and integrate your profiles with the rest of the new features we will reveal in April. Because this part is mandatory, we have setup a system to help us keep track of each person’s progress so we can further assist in meeting the deadline of completing the profile in a week (or two). I have personally completed the profile section and it took me approx. 90 minutes since I had to remember some of the information that occurred to me many years ago. Our newer members can probably complete their profiles even sooner since some of the questions either don’t apply or easily at the top of their minds. Please let us know if you have any questions so we can help you through this very important step. Sometime in the spring or summer of 2019 you will begin to see the importance of where we are headed and how it will make your job and the CAA profession as a whole to the next level</p>  \r\n";
         $message .= "<p>Click this link to begin completing your profile: <a href='http://www.nccaatest.org/login/index.php?email=".$arr."'>Click here</a></p> \r\n";
         $message .= "<p><strong>Temporary Password: </strong> ".$uniqid."</p>";
         //$message .= "<p>Please visit our link <strong>(http://1stopwebsitesolution.com/demo/techkyle/)</strong> and login with your email and default password test123. You are requested to change your email and password. </p>";
		 $retval = mail ($arr,$subject,$message,$header);
			//echo $arr;
		if( $retval == true ) {
           $count = $count + 1;
         }else {
            $count = 0;
         }
			
		}

		if($count >= 1){
			//echo $count;	
			//echo "Message Sent Successfully";
			header('Location: index.php?msg=success');
		}else{
		header('Location: index.php?msg=failed');
		}
         




//echo $to;
}

if(isset($_POST['single_submit'])){ 

$emails = $_POST['emails'];
$uniqid = uniqid();
            $updte = mysqli_query($con,"UPDATE users SET password = '".$uniqid."' WHERE name = '$emails'");
         $subject = "Immediate Action Needed!";
		 $header = "From:noreply@globaltechkyllc.com \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";
         $message = "<p>Dear <b>NCCAA Member</b>,</p> \r\n";
         $message .= "<p>As we end 2018, NCCAA has begun a process to help its CAA members make a transition to what we are calling 2.0 – a complete set of new website features to help our veteran members, newly certified members, and the students enrolled each year in one of our superb programs, to benefit in the following ways:</p> \r\n";
         $message .= "<ul><li>Quickly access where they are at any stage any exam or CME</li><li>Search for any CAA, whether local or in the U.S., to communicate</li><li>Search for any employers in our database for job opportunities</li><li>Upload and track all CMEs</li></ul>";
         $message .= "<p>Our first reveal for the new website will be at the Indianapolis event on April 9, 2019 where I and the main developer will do a live demonstration of some of the major benefits for our members. In the meantime, we need your help in filling in the gaps of individual profiles that will meet the standards set forth by Medicare but also provide us with the much needed data that will serve the entire community never before attempted.</p>  \r\n";
         $message .= "<p>Simply click the link below which will lead you to your individual profiles. Use the temporary password to login and then reset the password to a new permanent password that will be used for now on. Until the website is ready, the only part you will see are the profile fields that are mandatory for all CAA members to complete. If possible, we would like to have all of our members complete the entire profile within the next week (or two) so we can move forward with the rest of the project and integrate your profiles with the rest of the new features we will reveal in April. Because this part is mandatory, we have setup a system to help us keep track of each person’s progress so we can further assist in meeting the deadline of completing the profile in a week (or two). I have personally completed the profile section and it took me approx. 90 minutes since I had to remember some of the information that occurred to me many years ago. Our newer members can probably complete their profiles even sooner since some of the questions either don’t apply or easily at the top of their minds. Please let us know if you have any questions so we can help you through this very important step. Sometime in the spring or summer of 2019 you will begin to see the importance of where we are headed and how it will make your job and the CAA profession as a whole to the next level</p>  \r\n";
         $message .= "<p>Click this link to begin completing your profile: <a href='http://www.nccaatest.org/login/index.php?email='".$emails.">Click here</a></p> \r\n";
         $message .= "<p><strong>Temporary Password: </strong> ".$uniqid."</p>";
		 //$message = "<p>Dear <b>".$emails."</b>,</p> \r\n";
         //$message .= "<p>Please visit our link <strong>(http://1stopwebsitesolution.com/demo/techkyle/)</strong> and login with your email and default password test123. You are requested to change your email and password. </p>";

		 $retval = mail ($emails,$subject,$message,$header);
		 if( $retval == true ) {
           header('Location: single-email.php?msg=success');
         }else {
             header('Location: single-email.php?msg=failed');
         }
}

if(isset($_POST['sendtoall'])){
    //print_r($_POST);
    $sql = "select * from users";
    $result = mysqli_query($con,$sql);
    $count = 0;
    while($row = mysqli_fetch_object($result)){
        $uniqid = uniqid();
        $updte = mysqli_query($con,"UPDATE users SET password = '".$uniqid."' WHERE name = '".$row->name."'");
        $subject = "Immediate Action Needed!";
        $header = "From:noreply@globaltechkyllc.com \r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";
        //$message = "<p>Dear <b>".$arr."</b>,</p> \r\n";
        $message = "<p>Dear <b> All NCCAA Members</b>,</p> \r\n";
        $message .= "<p>As we end 2018, NCCAA has begun a process to help its CAA members make a transition to what we are calling 2.0 – a complete set of new website features to help our veteran members, newly certified members, and the students enrolled each year in one of our superb programs, to benefit in the following ways:</p> \r\n";
        $message .= "<ul><li>Quickly access where they are at any stage any exam or CME</li><li>Search for any CAA, whether local or in the U.S., to communicate</li><li>Search for any employers in our database for job opportunities</li><li>Upload and track all CMEs</li></ul>";
        $message .= "<p>Our first reveal for the new website will be at the Indianapolis event on April 9, 2019 where I and the main developer will do a live demonstration of some of the major benefits for our members. In the meantime, we need your help in filling in the gaps of individual profiles that will meet the standards set forth by Medicare but also provide us with the much needed data that will serve the entire community never before attempted.</p>  \r\n";
        $message .= "<p>Simply click the link below which will lead you to your individual profiles. Use the temporary password to login and then reset the password to a new permanent password that will be used for now on. Until the website is ready, the only part you will see are the profile fields that are mandatory for all CAA members to complete. If possible, we would like to have all of our members complete the entire profile within the next week (or two) so we can move forward with the rest of the project and integrate your profiles with the rest of the new features we will reveal in April. Because this part is mandatory, we have setup a system to help us keep track of each person’s progress so we can further assist in meeting the deadline of completing the profile in a week (or two). I have personally completed the profile section and it took me approx. 90 minutes since I had to remember some of the information that occurred to me many years ago. Our newer members can probably complete their profiles even sooner since some of the questions either don’t apply or easily at the top of their minds. Please let us know if you have any questions so we can help you through this very important step. Sometime in the spring or summer of 2019 you will begin to see the importance of where we are headed and how it will make your job and the CAA profession as a whole to the next level</p>  \r\n";
        $message .= "<p>Click this link to begin completing your profile: <a href='http://www.nccaatest.org/login/index.php?email=".$row->name."'>Click here</a></p> \r\n";
        $message .= "<p><strong>Temporary Password: </strong> ".$uniqid."</p>";

        $retval = mail ($row->name,$subject,$message,$header);
        //echo $arr;
        if( $retval == true ) {
            $count = $count + 1;
        }else {
            $count = 0;
        }

    }

    if($count >= 1){
        //echo $count;
        //echo "Message Sent Successfully";
        header('Location: index.php?msg=success');
    }else{
        header('Location: index.php?msg=failed');
    }

}
 ?>