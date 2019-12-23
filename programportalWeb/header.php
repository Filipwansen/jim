<?php 

	session_start();

	require_once("../config.php");

	if(empty($_SESSION['user_id']) || $_SESSION['user_id'] == "" )

	{

		header('Location: /logincaamember.php');

	}

	require_once("../../includes/util.php");

	require_once("../../classes/user.class.php");
	
	$userObject = new userObject();
    
	$userObject->init( $_SESSION['user_id'] );
	
	require_once("../classes/database.class.php");

	global $db;

	$db = new Database();

	$university_id = ($_SESSION['user_id'] - 3202); 
	
	require_once("classes/director.class.php");
	
	$pdObject = new ProgramDirectorInfo();
	
	//university info
	$university_info = $pdObject->readUniversityInfo($university_id);
	
	$university_name = $university_info[0]['University_Name'];
	
	$portal_picture = $university_info[0]['University_Photo'];
	
	$university_logo = $university_info[0]['University_logo'];
	
	//Directors info
	$title = array("", "Regional Director", "Program Director", "Assistant Program Director", "Admin Assistant", "ITE Coordinator");
	
	$rd_info = $pdObject->readProgramDirectorInfo($university_id, $title[1]);
	
	$pd_info = $pdObject->readProgramDirectorInfo($university_id, $title[2]);
	
	$apd_info = $pdObject->readProgramDirectorInfo($university_id, $title[3]);
	
	$aa_info = $pdObject->readProgramDirectorInfo($university_id, $title[4]);
	
	$ite_info = $pdObject->readProgramDirectorInfo($university_id, $title[5]);
	//print_r(file_exists($pd_info[0]['Photo']));exit;
	//print_r($pd_info[0]['Photo']);exit;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta xmlns="" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



    <link rel="stylesheet" type="text/css" href="../admin/fonts/fonts.css">

    <link rel="stylesheet" href="../admin/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="../admin/css/dataTables.bootstrap.min.css">

    <link rel="stylesheet" href="../admin/css/select.dataTables.min.css">

    <link rel="stylesheet" href="../admin/css/buttons.dataTables.min.css">

    <link rel="stylesheet" href="../admin/css/jquery-ui.css">

    <link href="../admin/css/style.css" type="text/css" rel="stylesheet" />

	<link rel="stylesheet" href="../admin/css/bootstrap-datepicker.css">
	
	<link rel="stylesheet" href="../admin/css/jquery.gritter.css">
	
	<link rel="stylesheet" href="./css/owl.carousel.css">
	
	<style>
	
		.yeardetialblock ul li p{
			font-size:13px !important;
		}
	
	</style>

    <title>NCCAA</title>

</head>

<body>



<header>

    <div class="container">

        <div class="headerLogo">

            <a href="./"><img src="../admin/images/logo.png" alt="" /> </a>

        </div>

        <div class="headerContent">

            <p>National Commission for Certification of Anesthesiologist Assistants</p>

            <a href="../logout.php">Logout</a>

        </div>

    </div>

</header>

<section class="mainContent">

    <div class="innerContainer2">

        <div class="row">

            <div class="col-lg-12">

                <div class="middle-heading card">

                    <h2>NCCAA Program Director Portal</h2>



                    <div align="center" style="margin-top:10px;">

                        <img src="../admin/images/logo/<?php echo $university_logo;?>" 
						<?php 
						if($university_id == 4 || $university_id == 5) echo "style='width:250px !important;'";
						else echo"style='width:150px'";
						?> alt="" class="img-responsive" />

                    </div>


                </div>
				
                <div class="middle-heading card">

                    <h2><?=$university_name?></h2>

                    <span class="toggler"><img src="../admin/images/arrow-doen.png" alt=""></span>

                </div>



                <div class="portal-member card">

                    <div class="mainBanner">

                        <img src="<?php echo $portal_picture;?>" alt="" class="img-responsive" />

                    </div>

                </div>

                <div class="middle-heading2 card">

                    <h2>Directors and Assistants</h2>

                    <span class="toggler"><img src="../admin/images/arrow-doen.png" alt=""></span>

                </div>

                <div class="portal-cards card">

                    <div class="row">

                        <div class="col-md-6 fNone">
						
						<?php if(empty($pd_info) == false) {?>

                            <div class="card clearfix">

                                <div class="profpic">

                                    <img src="<?php echo $pd_info[0]['Photo']?>" alt="" class="img-responsive" />

                                </div>

                                <div class="profpicinner">

                                    <h4><?php echo $pd_info[0]['Title']?></h4>

                                    <p><?php echo $pd_info[0]['First_Name']." ".$pd_info[0]['Last_Name']. " " . $pd_info[0]['Designation']?></p>

                                    <p><?php echo $university_name;?></p>

                                    <p><?php echo $pd_info[0]['Cell_Phone']; if(empty($pd_info[0]['Email']) == false){ ?> (<a href="mailto:<?php echo $pd_info[0]['Email']?>"><?php echo $pd_info[0]['Email']?></a> ) <?php }?></p>

                                </div>

                            </div>
						<?php }?> 
                        </div>

                        <div class="clearfix"></div>

                        <div class="col-md-6">
						
						<?php if(empty($aa_info) == false) {?>
                            <div class="card clearfix">

                                <div class="profpic">

                                    <img src="<?php echo $aa_info[0]['Photo']?>" alt="" class="img-responsive" />

                                </div>

                                <div class="profpicinner">

                                    <h4><?php echo $aa_info[0]['Title']?></h4>

                                    <p><?php echo $aa_info[0]['First_Name']." ".$aa_info[0]['Last_Name']. " " . $aa_info[0]['Designation']?></p>

                                    <p><?php echo $aa_info[0]['Cell_Phone']; if(empty($aa_info[0]['Email']) == false){?> (<a href="mailto:<?php echo $aa_info[0]['Email']?>"><?php echo $aa_info[0]['Email']?></a> ) <?php }?></p>

                                </div>

                            </div>
						<?php }?> 
						
                        </div>

                        <div class="col-md-6">
						
						<?php if(empty($apd_info) == false) {?>
                            <div class="card clearfix">

                                <div class="profpic">

                                    <img src="<?php echo $apd_info[0]['Photo']?>" alt="" class="img-responsive" />

                                </div>

                                <div class="profpicinner">

                                    <h4><?php echo $apd_info[0]['Title']?></h4>

                                    <p><?php echo $apd_info[0]['First_Name']." ".$apd_info[0]['Last_Name']. " " . $apd_info[0]['Designation']?></p>

                                    <p><?php echo $apd_info[0]['Cell_Phone']; if(empty($apd_info[0]['Email']) == false){?> (<a href="mailto:<?php echo $apd_info[0]['Email']?>"><?php echo $apd_info[0]['Email']?></a> ) <?php }?></p>

                                </div>

                            </div>
						<?php }?> 
						
                        </div>

                        <div class="clearfix"></div>

                        <div class="col-md-6">
						
						<?php if(empty($rd_info) == false) {?>
                            <div class="card clearfix">

                                <div class="profpic">

                                    <img src="<?php echo $rd_info[0]['Photo']?>" alt="" class="img-responsive" />

                                </div>

                                <div class="profpicinner">

                                    <h4><?php echo $rd_info[0]['Title']?></h4>

                                    <p><?php echo $rd_info[0]['First_Name']." ".$rd_info[0]['Last_Name']. " " . $rd_info[0]['Designation']?></p>

                                    <p><?php echo $rd_info[0]['Cell_Phone']; if(empty($rd_info[0]['Email']) == false){?> (<a href="mailto:<?php echo $rd_info[0]['Email']?>"><?php echo $rd_info[0]['Email']?></a> ) <?php }?></p>

                                </div>

                            </div>
						<?php }?> 
						
                        </div>

                        <div class="col-md-6">
						
						<?php if(empty($ite_info) == false) {?>
                            <div class="card clearfix">

                                <div class="profpic">

                                    <img src="<?php echo $ite_info[0]['Photo']?>" alt="" class="img-responsive" />

                                </div>

                                <div class="profpicinner">

                                    <h4><?php echo $ite_info[0]['Title']?></h4>

                                    <p><?php echo $ite_info[0]['First_Name']." ".$ite_info[0]['Last_Name']. " " . $ite_info[0]['Designation']?></p>

                                    <p><?php echo $ite_info[0]['Cell_Phone']; if(empty($ite_info[0]['Email']) == false){?> (<a href="mailto:<?php echo $ite_info[0]['Email']?>"><?php echo $ite_info[0]['Email']?></a> ) <?php }?></p>

                                </div>

                            </div>
						<?php }?> 
						
                        </div>

                    </div>

                </div>
