<?php 
    
    session_start();
    require_once("../../config.php");
    if(empty($_SESSION['user_id']) || $_SESSION['user_id'] == "" || empty($_GET['id'])){
        header('Location: /logincaamember.php');
    }

    require_once("../../classes/database.class.php");

    require_once("../classes/blastemail.class.php");

    $conn  = new Database();
    $blastemail = new BlastEmailObject($conn);

    $row = $blastemail->getById($_GET['id']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html, charset=UTF-8"/>
<meta name="format-detection" content="telephone=no"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=9, IE=8, IE=7, IE=EDGE" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body style="padding:0; margin:0;">

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
                                <tr>
                                <?php if(empty($row['banner_img'])){?>                                   
                                    <td align="center" style="color:#000000;font-size:24px;height: 200px;background: #c5c5c5;">
                                    	<!-- Banner IMG -->
                                    </td>
                                <?php }else{ ?>
                                    <img src="../../upload/banner_image/<?= $row['banner_img'] ?>" style="width: 600px; padding-top:10px">
                                <?php } ?>
                                </tr>
                                <tr>
                                    <td>
                                    	<div style="padding-top: 5px">
                                    		<?= $row['content']?>
                                    	</div>
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
</table>

</body>
</html>

