<?php
    session_start();

    require_once("../../config.php");

    if(empty($_SESSION['user_id']) || $_SESSION['user_id'] == "" )
    {
        header('Location: /logincaamember.php');
    }

    require_once("../../classes/database.class.php");

    require_once("../classes/blastemail.class.php");

    $conn  = new Database();
    $email = new BlastEmailObject($conn);
// ===> Form action define.
    if(isset($_POST) && !empty($_POST['title'])) {

        $r_type = $_POST['receiver_type'];

        $email->sender_id = $_POST['sender_id'];

        $email->sender_email = $_SESSION['email'];

        $email->subject = $_POST['title'];
 
        $email->content = $_POST['msg_contents'];  

        $email->receiver_cc = $_POST['cc'];

        $email->receiver_bcc = $_POST['bcc'];        

/*==>> Attach File upload ...*/ 
        $MSG = "";
        $target_dir =  "../../upload/";
        $target_file = $target_dir . basename($_FILES["attached"]["name"]);

        $uploadOk = 1; $attached = "";
        
        //Check if file already exists
        if (file_exists($target_file)) {

            $attached = $_FILES["attached"]["name"];
        }
        // Check file size
        if ($_FILES["attached"]["size"] > 500000) {

            $MSG = "Attach file is too large. Retry with 500kB file.";
            $_SESSION['resultMSG'] = ['type' => 1, 'msg' => $MSG];
        }
        else{

            if ( move_uploaded_file($_FILES["attached"]["tmp_name"], $target_file) ){
                
                $attached = $_FILES["attached"]["name"];
            }
        }

/*==>> Banner image upload ... */
        $_MSG = "";
        $_target_dir =  "../../upload/banner_image/";
        $_target_file = $_target_dir . basename($_FILES["banner"]["name"]);

        $banner = "";
        
        //Check if file already exists
        if ( file_exists($_target_file) ) {

            $banner = $_FILES["banner"]["name"];
        }

        if ( move_uploaded_file($_FILES["banner"]["tmp_name"], $_target_file) ) {

            $banner = $_FILES["banner"]["name"];
        }

        // insert the db table
        $email->attach = $attached; 
        $email->banner = $banner;

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

/*====>> Email sender Routine ... */
    // Multiple recipients
    // $to = 'VangHaleena17@outlook.com, wansenzhang2016@gmail.com'; // note the comma
    $to = $email->receiver_emails; // note the comma

    // Subject
    $subject = $email->subject;

    // Banner Img
    $banner = $email->banner == "" ? 
            '<td align="center" style="color:#000000;font-size:24px;height: 200px;background: #c5c5c5;">
                <!-- Banner IMG -->
            </td>' : 
            '<img src="../../upload/banner_image/'.$email->banner.'" style="width: 600px; padding-top:10px">';

    // Message
    $msg_header = '
    <table width="640" cellspacing="0" cellpadding="0" bgcolor="#" class="100p">
    <tr>
        <td width="640" valign="top" class="100p" style="background-color: #f4f4f4">
            <div>
                <table width="640" border="0" cellspacing="0" cellpadding="20" class="100p">
                    <tr>
                        <td valign="top">

                            <table border="0" cellspacing="0" cellpadding="0" width="600" class="100p">
                                <tr>
                                    <td align="left" width="50%" class="100p">
                                      <img src="http://www.nccaatest.org/member/assets/images/logo2.png" alt="Logo" border="0" style="display:block; height: 60px; " />
                                    </td>
                                    <td width="50%" class="hide" align="right" style="font-size:16px; color:#000000;">
                                      <font face="Roboto, Arial, sans-serif, Circe" style="font-weight: bold;">
                                        National Commission for Certification of Anesthesiologist Assistants 
                                      </font>
                                    </td>
                                </tr>
                            </table>

                            <table border="0" cellspacing="0" cellpadding="0" width="600" class="100p">
                                <tr>
                                    <td height="35"></td>
                                </tr>
                                <tr>'
                                    .$banner.
                                '</tr>
                                <tr>
                                    <td>
                                      <div>';

        $htmlContent  = $email->content;        

        $msg_footer ='</div>
                                    </td>
                                </tr>
                                <tr>
                                  <td height="35" style="display: flex; padding-top: 50px">
                                    <div style="width: 50px; height: 50px; border-radius: 25px; background: #858585"></div>
                                    <div style="padding-left: 5px">
                                      <p style="padding: 0px;margin: 0px; font-size: 12pt; font-weight: bold;">Cynthia Maraugha</p>
                                      <p style="padding-top: 5px; margin: 0px; font-size: 8pt">Director of Administration & Operations</p>
                                      <p style="padding-top: 5px; margin: 0px; font-size: 8pt">NCCAA</p>
                                    </div>
                                    
                                  </td>
                                </tr>
                            </table>

                        </td>
                    </tr>
                </table>
            </div>                    
        </td>
    </tr>
    <tr>
        <td width="640" valign="top" class="100p" style="background-color: #ffffff">
            <div>
                <table width="640" border="0" cellspacing="0" cellpadding="20" class="100p">
                    <tr style="font-weight: bold;">
                        <td style="text-align: left;">MAILING ADDRESS</td>
                        <td style="text-align: right;">VISIT US ON SOCIAL MEDIA</td>
                    </tr>
                    <tr>
                      <td style="text-align: left;">
                        8459 US Hwy 42, #160<br>
                        Florence, KY. 41042<br>
                        business.office@nccaa.org<br>
                        (p) 859-903-0089<br>
                        (f) 859-903-0877<br>
                      </td>
                      <td style="text-align: right;">
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                        <a href="#"><i class="fa fa-twitter-square"></i></a>
                        <a href="#" style="padding-left: 10px"><i class="fa fa-facebook-square"></i></a>
                        <a href="#" style="padding-left: 10px"><i class="fa fa-pinterest-square"></i></a>
                        <a href="#" style="padding-left: 10px"><i class="fa fa-youtube-square"></i></a>
                        <a href="#" style="padding-left: 10px"><i class="fa fa-instagram"></i></a>
                        <br><br><br><br>
                        <a href="#">www.nccaa.org</a>
                      </td>
                    </tr>
                    <tr>
                      <td style="padding: 0px; margin: 0px" colspan="2"><hr></td>
                    </tr>
                    <tr>
                      <td colspan="2" style="text-align: center;">
                        Copyright © 2019 National Commission for Certification of Anesthesiologist Assistants.
                        All Rights Reserved.
                      </td>
                    </tr>
                    <tr style="text-align: center;">
                      <td colspan="2" style="padding: 0px; margin: 0px; opacity: 0.5">
                        Want to change how you receive these emails?
                      </td>
                    </tr>
                    <tr style="text-align: center;">
                      <td colspan="2" style="padding: 0px; margin: 0px">
                        You can update your <a href="#">preferences</a> or <a href="#">unsubscribe from this list</a>.
                      </td>
                    </tr>                    
                </table>
            </div>
        </td>
    </tr>
</table>';

        $htmlContent = $msg_header.$htmlContent.$msg_footer;

        // Mail it
        $res=0; $msg='';

        //header for sender info
        // $headers  = "From: test@mkbazaar.co.uk\n";
        $headers  = "From: ".$email->sender_email."\n";
        $headers .= "To: Users\n";
        $headers .= "Cc: ".$email->receiver_cc."\n";
        $headers .= "Bcc: ".$email->receiver_bcc."\n";
        //boundary 
        $semi_rand = md5(time()); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 

        //headers for attachment 
        $headers .= "MIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 

        //multipart boundary 
        $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
                   "Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n"; 

        //preparing attachment
        $file = "../../upload/".$email->attach;
        if(!empty($file) > 0){
            if(is_file($file)){
                $message .= "--{$mime_boundary}\n";
                $fp =    @fopen($file,"rb");
                $data =  @fread($fp,filesize($file));

                @fclose($fp);
                $data = chunk_split(base64_encode($data));
                $message .= "Content-Type: application/octet-stream; name=\"".basename($file)."\"\n" . 
                "Content-Description: ".basename($file)."\n" .
                "Content-Disposition: attachment;\n" . " filename=\"".basename($file)."\"; size=".filesize($file).";\n" . 
                "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
            }
        }
        $message .= "--{$mime_boundary}--";
        $returnpath = "-f" . $email->sender_email;

        // var_dump($message);
        // die();

        //send email
        $res = @mail($to, $subject, $message, $headers, $returnpath);

        if($res){

            $_SESSION['emailMSG'] = ['type'=>$res, 'msg'=>'Emails were sent successfully!'];
        }
        else{

            $_SESSION['emailMSG'] = ['type'=>$res, 'msg'=>'Oops.. Email Sending was failed.'];
        }

        header('Location: ../../admin/?content=../emailblast/admin/ViewAllBlastEmail&li_class=EmailBlast');
        return;
    }

?>