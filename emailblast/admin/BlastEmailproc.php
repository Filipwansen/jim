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
    // $subject = 'Birthday Reminders for August - Email Testing..';
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
        $message_  = $email->content;                              
        $message = '<P style="padding-top: 10px">Dear Maria Sanchez,</P>

                                        <p>This message contains important information for accessing your October 2019 <strong> NCCAA Certification Examination </strong> results via the Internet. Please follow the instructions below to successfully log on and print your certification letter, score report, keywords for the questions you answered incorrectly, and performance interpretation guidelines.</p>

                                        <p>To log on you must provide the following information:<br>
                                        <strong>Last Name:</strong> Sanchez<br>
                                        <strong>First Name:</strong> Maria<br>
                                        <strong>NCCAA (Constituent) ID#:</strong> 378476TY</p>

                                        <P style="background: #ececec;">*Note: You will not be able to access your exam results if you do not supply information for all three items above.</P>

                                        <p>You will also be prompted to provide your current email address.</p>

                                        <P>To access your examination results, go to <a href="http://examinee.nbme.org/documents/NCCAA" target="_blink">http://examinee.nbme.org/documents/NCCAA</a>, log on using the identifying information listed above, and select the ‘Print Score Report’ link. Your exam results will open in a new browser window. Use your browser’s ‘Print’ function to print the report. If you lose your score report, you will be permitted to log on and access your report for approximately 6 months after the initial posting date.</P>

                                        <p>Please note, NCCAA certification is a two-step process, obtained by passing the certification exam AND completing graduation from your university.  Your certificate will be available via the homepage of the NCCAA website within one week following official graduation.  Once NCCAA receives verification of graduation, you will receive instructions via email for obtaining your certificate and official certification number  According to the <a href="javascript:void(0)">Rules and Regulations</a>, the NCCAA is unable to provide verification of certification until this two-step process is complete.</p>  

                                        <p>It is very important to maintain a current email address on file with the NCCAA. Your email address will be your login to access your account on the NCCAA website after graduation. Going forward, all communication, including CME Submission reminders and re-certification exam reminders will be sent via email. Your first CME Submission will be due by June 1, 2021, and once every two years following, including the year in which you are due to take the re-certification exam, which will occur in the year 2025. For a full list of the <a href="#">NCCAA Rules and Regulations</a>, please visit the website.</p>

                                        <p>Once again, your certificate or certification number will NOT be available until after you have graduated.  Please refrain from requesting verification of certification be sent to State Medical Boards and/or Employers until AFTER your certificate has been released.</p>
                                         
                                        <p>If you have any questions or problems accessing your report, contact NCCAA by email at <a href="javascript:void(0)">cynthia.m@nccaa.org</a>.  Please refer to <a href="https://www.nccaatest.org/">www.nccaa.org</a> for additional information.</p>

                                        <p>Sincerely,</p>';

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

        $message = $msg_header.$message.$msg_footer;

        // To send HTML mail, the Content-type header must be set
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';

        // Additional headers
        $headers[] = 'To: All of users';
        $headers[] = 'From: test@mkbazaar.co.uk';
        $headers[] = 'Cc: test@mkbazaar.co.uk';
        $headers[] = 'Bcc: test@mkbazaar.co.uk';

        // var_dump( $to, $subject, $message, implode("\r\n", $headers) );
        var_dump( $message );
        echo "\r\n";
        die();

        // Mail it
        $res=0; $msg='';
        try{            
            // $res = mail($to, $subject, $message, implode("\r\n", $headers));
        }
        catch (customException $e){
            $msg = $e->errorMessage();
        }

        if($res == 1){

            $_SESSION['emailMSG'] = ['type'=>$res, 'msg'=>'Emails were sent successfully!'];
        }
        else if($res == 0){

            $_SESSION['emailMSG'] = ['type'=>$res, 'msg'=>'Oops.. Email was failed.'];
        }

        header('Location: ../../admin/?content=../emailblast/admin/ViewAllBlastEmail&li_class=EmailBlast');
        return;
    }

?>