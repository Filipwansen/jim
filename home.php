<?php


ini_set('display_errors', 1);


ini_set('display_startup_errors', 1);


error_reporting(E_ALL);

require_once("config.php");

session_start();



//print_r($_SESSION);



if(empty($_SESSION['user_id']) || $_SESSION['user_id'] == "" )



{



    header('Location: ../logincaamember.php');



}





require_once("../includes/util.php");


require_once("../classes/user.class.php");





$userObject = new userObject();


$userObject->init( $_SESSION['user_id'] );


require_once( BASE_PATH . "member/classes/database.class.php");

global $db;

$db = new Database();

require_once( BASE_PATH . "member/admin/classes/survey.class.php");

global $SurveyObject;

$SurveyObject = new SurveyObject();

$total_ques_list = $SurveyObject->readMemberSurvey($_SESSION['user_id']);




?>


<!DOCTYPE html>
 


;<title>NCCAA</title>


<html lang="en">



<head>



    <meta charset="UTF-8">



    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">



    <meta http-equiv="X-UA-Compatible" content="ie=edge">



    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">



    <link rel="stylesheet" href="./assets/fonts/font-awesome/fontawesome-all.min.css">



    <link rel="stylesheet" href="./assets/fonts/fonts.css">



    <link rel="stylesheet" href="./assets/css/stylesheet.css">



    <title>index</title>



</head>



<body>



    <div class="wrapper">



	    <header class="header">



        <div class="header-top">



          <div class="container">



            <div class="header-top-inner d-sm-flex justify-content-between align-items-center">



              <div class="header-logo">



                <a href="/member/home.php"><img src="./assets/images/logo2.png" alt="" class="img-fluid"></a>



              </div>



              <div class="header-top-right">



                <p>National Commission for Certification of Anesthesiologist Assistants </p>



              </div>



            </div>



          </div>



        </div>



        <div class="header-bottom">



          <div class="container">



            <div class="header-bottom-inner">



              <div class="heade-menu">



                  <nav class="navbar navbar-expand-md">



                    <div class="header-search">



                      <form class="form-inline position-relative">



                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">



                        <div class="header-search-icon">



                            <i class="fas fa-search"></i>



                        </div>



                      </form>



                    </div>



                    <div class="collapse navbar-collapse" id="navbardropdown">



                      <div class="mobile-logo d-md-none">



                        <a href="#"><img src="./assets/images/logo2.png" alt="" class="img-fluid"></a>



                      </div>



                      <ul class="navbar-nav ml-auto">



                        <li class="nav-item active">



                          <a class="nav-link" href="home.php">Home</a>



                        </li>



                        <li class="nav-item">



                          <a class="nav-link" href="blogviewall.php">Blog</a>



                        </li>



                        <li class="nav-item">



                          <li 
<?php 
if(isset($_GET['item'])){
	if($_GET['item'] == 'emailpage'){
		echo 'class="nav-item active"';
	}else{
		echo 'class="nav-item"';
	}
}else{
		echo 'class="nav-item"';
}
?>
						>

                          <a class="nav-link" href="?content=content/emailviewall&item=emailpage">Email</a>

                        </li>



                        </li>



                        <li class="nav-item">



                          <a class="nav-link" href="cmehistory.php">History</a>



                        </li>



                        <li class="nav-item">



                          <a class="nav-link" href="homesurvey1.php">Surveys</a>



                        </li>



                        <li class="nav-item">



                          <a class="nav-link logout-btn" href="logout.php">Log Out</a>



                        </li>



                      </ul>



                    </div>



                    <button class="navbar-toggler pr-0" type="button" data-toggle="collapse" data-target="#navbardropdown" aria-controls="navbardropdown" aria-expanded="false" aria-label="Toggle navigation">



                        <i class="fas fa-bars"></i>



                    </button>



                  </nav>



              </div>



            </div>



          </div>



        </div>



    	</header>



    	<section>



        <div class="page-block ncca-section">



          <div class="container">



            <div class="ncca-section-inner">



              <div class="row">

                 <?php
              include("sidenavigation.php");
              ?>




                <div class="col-lg-8 main-container">



                  <div class="ncca-right-section page-block">



                    <div class="ncca-right-block block-border ncca-right-padding page-block-margin">



                      <div class="row">



                        <div class="col-sm-6 pr-0 jk-60">



                          <div class="ncca-welcome">



                            <h3 class="big-title">Welcome back, <?php echo $userObject->data["generalinfo"]["f_name"]; ?>.</h3>



                            <p>



                              NCCAA Internal Email:



                              <a href="#"><?php echo $userObject->data["generalinfo"]["f_name"].".".$userObject->data["generalinfo"]["f_name"]; ?>@nccaa.org</a>



                            </p>



                          </div>



                        </div>



                        <div class="col-6 col-sm-3 jk-20">



                          <div class="mail-status">



                            <h2 class="big-title"><?php echo dummy_get_email_count( $_SESSION["user_id"] ); ?></h2>



                            <p>Unread mails</p>



                            <a href="#" class="text-blue">Click here</a>



                          </div>



                        </div>



                        <div class="col-6 col-sm-3 jk-20">



                          <div class="mail-status">



                            <h2 class="big-title"><?php echo dummy_get_blog_count( $_SESSION["user_id"] ); ?></h2>



                            <p>Unread posts</p>



                            <a href="#" class="text-blue">Click here</a>



                          </div>



                        </div>



                        <div class="col-sm-12">



                         <div class="ncca-reminders">


                            <div class="accordion" id="accordionExample">


                                <div class="accorion-header" id="headingOne">


                                  <button class="btn btn-link midium-title text-uppercase p-0" type="button" data-toggle="collapse" data-target="#reminder_accordion" aria-expanded="true" aria-controls="reminder_accordion">REMINDERS</button>


                                </div>


                                <div id="reminder_accordion" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">


                                  <div class="accordion-body">


                                    <ul>


                                      <li class="dots-pink"><span>You have completed only <?php echo $userObject->status["profile_completion"]; ?> of your profile</span> <a href="#" class="text-blue">Click here</a></li>


                                      <li class="dots-green"><span>"New Blog Posts Name" has been published today.</span><a href="#" class="text-blue">Click here</a></li>


                                    </ul>


                                  </div>


                                </div>


                            </div> 


                          </div>


                        </div>


                      </div>


                    </div>


                    <div class="ncca-right-block cme-block-main">


                      <div class="row">


                        <div class="col-sm-6">


                          <div class="page-block block-border page-block-margin">


                            <div class="cme-block-head ncca-right-padding">


                              <p class="midium-title text-uppercase">CME</p>


                              <b>Deadline:</b>


                              <?PHP


                              $days = (strtotime($userObject->vitals["cme_due"]) - time() ) / ( 24*60*60);


                              $weeks = (int)( $days / 7 );


                              if ( $weeks > 52 ) {


                              	$months=(int)( $days / 30.5 );


                              	$deadline = $months." months";


                              } else {


                              	$deadline = $weeks." weeks";


                              }


                              ?>


                              <span><?php echo date("F d, Y",strtotime($userObject->vitals["cme_due"])); ?> - only <?php echo $deadline; ?> left to register</span>


                            </div>


                            <div class="cme-block-bottom page-block">


                              <ul class="nav nav-tabs" id="myTab" role="tablist">


                                <li class="nav-item">


                                  <a class="nav-link  text-blue" href="cmehistory.php">History</a>


                                </li>


                                <li class="nav-item">


                                  <a class="nav-link text-blue" href="cmeadd.php">Add CME</a>


                                </li>


                                <li class="nav-item">


                                  <a class="nav-link text-blue" id="contact-tab" data-toggle="tab" href="#" role="tab" aria-controls="contact" aria-selected="false">NCCAA CMEs</a>


                                </li>


                              </ul>


                            </div>


                          </div>


                        </div>


                        <div class="col-sm-6">


                          <div class="page-block block-border page-block-margin">


                            <div class="cme-block-head ncca-right-padding">


                              <p class="midium-title ">CDQ Exam</p>


                              <b>Deadline:</b>


                              <?PHP


                              $days = (strtotime($userObject->vitals["cdq_due"]) - time() ) / ( 24*60*60);


                              $weeks = (int)( $days / 7 );


                              if ( $weeks > 52 ) {


                              	$months=(int)( $days / 30.5 );


                              	$deadline = $months." months";


                              } else {


                              	$deadline = $weeks." weeks";


                              }


                              ?>


                              <span><?php echo date("F d, Y",strtotime($userObject->vitals["cdq_due"])); ?> - only <?php echo $deadline; ?> left to register</span>


                            </div>


                            <div class="cme-block-bottom page-block">


                              <ul class="nav nav-tabs" id="myTab" role="tablist">


                                <li class="nav-item">


                                  <a class="nav-link text-blue" href="cdqhistory.php" role="tab">History</a>


                                </li>


                                <li class="nav-item">


                                  <a class="nav-link text-blue" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">NCCAA Prep Course</a>


                                </li>


                              </ul>


                            </div>


                          </div>


                        </div>


                      </div>


                    </div>


                    <div class="ncca-right-block ">


                      <div class="tab-content" id="myTabContent">


                          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">


                          <div class="home-main block-border ncca-right-padding">


                            <p class="midium-title title-bottom-border text-uppercase">CERTIFICATE


                              <button class="print"><img src="./assets/images/white version.png"> Print</button>


                              <button class="share"><img src="./assets/images/share white.png"> Share</button>


                              <button class="email"><img src="./assets/images/mail white.png"> Email</button> 


                            </p>


                            <div class="home-main-container <?php if ( ( $userObject->status["certificate"]=="" ) || ( $userObject->status["certificate"]=="COMING SOON! " )) echo "watermarked"; ?>" data-watermark="COMING SOON!">


                              <div class="home-inner-container" >


                              	


                                <p class="center"><img class="logo" src="./assets/images/logo2.png"></p>


                                <h2 class="center">National Commission for CERTIFICATION of Anesthesiologist Assistants </h2>


                                <p class="center">Be It Known That</p>


                                <h3 class="center title-1"><?php echo $userObject->data["generalinfo"]["f_name"]." ".$userObject->data["generalinfo"]["l_name"]; ?></h3>


                                  	<?php 


                                  	if ( $userObject->status["certificate"] > 0 ) { 


																		?>


                                <p class="center">Successfully Completed Certifying Examination for Anesthesiologist Assistants in</p>


                                <h3 class="center title-2"><?php echo $userObject->status["certification_year"]; ?></h3>


                                <p class="center">Has met all requirements for maintaining continued certification and hereby is designated</p>


                                <h3 class="center title-3">Certified Anesthesiologist Assistants Certificate
                                <?php echo $userObject->status["certificate"]; ?></h3>


                                <?PHP


                              		} else {


                              	?>


                              	<center><h2>CERTIFICATE <br><?php echo $userObject->status["certificate"]; ?></h2></center>


                              	<p>&nbsp;</p>


                              	<h3>&nbsp;</h3>


																<?PHP


                              		}


                              	?>


                                <div class="row">


                                  <div class="col-sm-7 sm-center">


                                  	<?php 


                                  	if ( $userObject->status["certificate"] > 0 ) { 


                                  		print "<h4>Official Certification Date: ".$userObject->status["certification_date"]."</h4>\n";


                                    	print "<h4>Certified Through ".$userObject->status["certification_end"]."</h4>\n";


                                    } else {


                                    	print "<h4>&nbsp;</h4><h4>&nbsp;</h4>\n";


                                    }


                                    ?>


                                  </div>


                                  <div class="col-sm-5 text-right sm-center">


                                    <span class="sign">signature</span>


                                  </div>


                                </div>


                                


                              </div> 


                              <img class="logo-mark" src="./assets/images/logo-mark.png">


                                <img class="stamp" src="./assets/images/stamp.png">                             


                            </div>


                          </div>


                        </div>        





                      </div>


                    </div>


                  </div>


                </div>


              </div>


            </div>  


          </div>


        </div>


      </section>		


    	<footer class="footer">


      </footer>


    </div>


<script src="./assets/js/jquery.min.js" type="text/javascript"></script>


<script src="./assets/js/bootstrap.min.js" type="text/javascript"></script>


<script src="./assets/js/script.js" type="text/javascript"></script>


<?php include 'survey-modal.php'; ?>


<div id="debug">


<?php 


// print "userObject:<pre><br>\n";


// var_dump( $userObject );


// print "</pre><br>\n";


?>	


</div>


</body>


</html>


