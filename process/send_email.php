<?php
include("../config.php");
$uniqid = uniqid();
            $updte = mysqli_query($con,"UPDATE users SET password = '".md5($uniqid)."' WHERE id = '2621'");

$to = $user->name;
$name = $user->full_name;
$subject = "Forget Password";

$message = "Hi $name, <br> Username is: $to <br> Your New Password Is ".$uniqid."<br> <a href='http://ysmnet.com/nccaa/'>Click Here To Signin</a>";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <info@globaltechkyllc.com' . "\r\n";

$mail = mail($to,$subject,$message,$headers);
if($mail)
{
	echo "Email sent to ".$to;
}
else
{
	echo "Email failed to sent  ".$to;	
}
?>