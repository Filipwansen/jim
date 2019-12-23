<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once("config.php");


session_start();

//print_r($_SESSION);

if(empty($_SESSION['user_id']) || $_SESSION['user_id'] == "" )

{

    header('Location: /logincaamember.php');

}


if ( strtolower($_SESSION["user_role"])=="program director" )
	
{
	 header('Location: /member/programportalWeb/?class_of_year='.date('Y'));
}else if ( strtolower($_SESSION["user_role"])=="admin" )
	
{
	 header('Location: /member/admin/');
}	
	


require_once( BASE_PATH . "includes/util.php");

require_once( BASE_PATH . "classes/user.class.php");

$userObject = new userObject();
$userObject->init( $_SESSION['user_id'] );

require_once( BASE_PATH . "member/classes/database.class.php");

global $db;

$db = new Database();

require_once( BASE_PATH . "member/admin/classes/survey.class.php");

global $SurveyObject;

$SurveyObject = new SurveyObject();

$total_ques_list = $SurveyObject->readMemberSurvey($_SESSION['user_id']);


require_once( BASE_PATH . "member/email/classes/email.class.php");

global $email;

$email = new EmailObject($db);

$UnreadCnt = $email->getUnreadCnt($_SESSION['user_id']);


include_once "../payment/payment.php";

include_once "../incomecdq/incomecdq.php";

include_once "examcme/examcme.php";

include_once "examcertification/examcertification.php";

$photo_sql = "SELECT * FROM profile_photo WHERE user_id = '". $_SESSION['user_id'] ."'";

if($photo_name = $db->getData($photo_sql)){
	true;
}else{
	$photo_name="";
}

?>
<!DOCTYPE html>
 
<title>NCCAA</title>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="./assets/fonts/font-awesome/fontawesome-all.min.css">

    <link rel="stylesheet" href="./assets/fonts/fonts.css">

    <link rel="stylesheet" href="./assets/css/stylesheet.css">

	<script src="./assets/js/jquery.min.js" type="text/javascript"></script>
	
	<script src="./assets/js/bootstrap.min.js" type="text/javascript"></script>
	
    
    <script>var api_path = "<?php echo API_PATH; ?>";</script>
   
   <title>index</title>

</head>


<?php
require_once( BASE_PATH . "member/blog/blog.php");
?>

<body>

    <div class="wrapper">

	    <header class="header">

        <div class="header-top">

          <div class="container">

            <div class="header-top-inner d-sm-flex justify-content-between align-items-center">

              <div class="header-logo">

                <a href="/member/"><img src="./assets/images/logo2.png" alt="" class="img-fluid"></a>

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

                      <form class="form-inline position-relative" style="display:none">

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

                        <li 
<?php 
if(isset($_GET['item'])){
	if($_GET['item'] == 'homepage'){
		echo 'class="nav-item active"';
	}else{
		echo 'class="nav-item"';
	}
}else{
		echo 'class="nav-item"';
}
?>

						>

                          <a class="nav-link" href="./?item=homepage">Home</a>

                        </li>

                        <li 
<?php 
if(isset($_GET['item'])){
	if($_GET['item'] == 'blogpage'){
		echo 'class="nav-item active"';
	}else{
		echo 'class="nav-item"';
	}
}else{
		echo 'class="nav-item"';
}
?>
						>

                          <a class="nav-link" href="?content=blog/template/blogviewall&item=blogpage">Blog</a>

                        </li>

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

                        <li
<?php 
if(isset($_GET['item'])){
	if($_GET['item'] == 'historypage'){
		echo 'class="nav-item active"';
	}else{
		echo 'class="nav-item"';
	}
}else{
		echo 'class="nav-item"';
}
?>
						>

                          <a class="nav-link" href="?content=content/history&item=historypage">History</a>

                        </li>

                        <?php 
                        if ( strtolower($_SESSION["user_role"])=="admin" ) {
                        ?>
                        <li class="nav-item">

                          <a class="nav-link" href="/member/admin/">Admin</a>

                        </li>

												<?PHP
												}
												?>
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

                <div class="col-lg-4 left-side-bar">

                  <div class="page-block block-border page-block-margin">

                    <div class="ncca-left-section page-block">

                      <div class="ncca-profile ncca-left-block">
					  
						<div class="profile_photo" onclick="edit_profile_picture()" style="background-image: url('<?php
									if(empty($photo_name) == false){
										
										if(empty($photo_name[0]['photo']) == false){
											
											echo $photo_name[0]['photo'];
										
										}else{
											
											echo"./assets/images/profile-img.png";
											
										}
									} 
									else echo"./assets/images/profile-img.png";
									?>');" >
									
									<div align="center"><i class="fa fa-camera" style="color:#ffffff; padding-top:35%"></i><br><font style="color:white">Edit picture</font></div>
						</div>	  
						 
                          
						  <p class="show-debug"><?php echo $userObject->data["generalinfo"]["f_name"]." ".$userObject->data["generalinfo"]["l_name"]; ?></p>

                          <span><?php echo $userObject->data["employment_info"]["employer_name"]; ?></br><?php if(empty($userObject->data["employment_info"]["employer_address"]) == false) echo $userObject->data["employment_info"]["employer_address"].", ".$userObject->data["employment_info"]["employer_city"].", ".$userObject->data["employment_info"]["employer_state"]." ".$userObject->data["employment_info"]["employer_zip"]; ?></span>

                          <a href="form.php">Edit Profile </a>

                      </div>

                      <div class="ncca-left-info ncca-left-block">

                        <div class="accordion" id="accordionExample">

                            <div class="accorion-header" id="headingOne">

                              <button class="btn btn-link midium-title p-0" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">

                                  NCCAA INFO <i class="far fa-question-circle"></i>

                              </button>

                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">

                              <div class="accordion-body">

                                <ul>

                                  <li><b>Employed since: </b> <span><?php echo date("m/d/Y",strtotime($userObject->data["employment_info"]["first_employment_date"])); ?></span></li>

<?php 
    $date1 = new DateTime(date('Y-m-d', strtotime($userObject->data["employment_info"]["first_employment_date"]))); 
    $date2 = new DateTime("now"); 
    $interval = $date1->diff($date2); 
    //print "interval:<pre><br>\n";
    //var_dump( $interval );
    //print "</pre><br>";
    $years = $interval->format('%y'); 
    $months = $interval->format('%m'); 
    $days = $interval->format('%d'); 
    if($years!=0){ 
        $ago = $years.' year';
				if ( $years != 1 ) $ago .= 's';
    }
    $ago .=" / ";
    $ago .= $months.' month';
		if ( $months != 1 ) $ago .= 's';
?>                                   <li><b>Time: </b> <span><?php echo $ago; ?></span></li>

                                  <li><b>Status:</b> <span><?php echo $userObject->status["status"]; ?></span></li>

                                  <li><b>Certified Through: </b> <span><?php echo $userObject->status["certification_end"]; ?></span></li>

                                  <li><b>CME Due Date: </b> <span><?php echo date("m/d/Y",strtotime($userObject->vitals["cme_due"])); ?></span></li>

                                  <li><b>CDQ Due Date: </b> <span><?php echo date("m/d/Y",strtotime($userObject->vitals["cdq_due"])); ?></span></li>

                                </ul>

                              </div>

                            </div>

                        </div>

                      </div>

                      <div class="ncca-left-info ncca-left-block">

                        <div class="accordion" id="accordionExample">

                            <div class="accorion-header" id="headingOne">

                              <button class="btn btn-link midium-title p-0" type="button" data-toggle="collapse" data-target="#education_info" aria-expanded="true" aria-controls="education_info">

                                  EDUCATION INFO  <i class="far fa-question-circle"></i>

                              </button>

                            </div>

                            <div id="education_info" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">

                              <div class="accordion-body">

                                <ul>

<?php
if ( $userObject->status["status"]=="CAA" ) $graduation=date("m/d/Y",strtotime($userObject->data["university_info"]["actual_graduation_date"]));
else $graduation=date("m/d/Y",strtotime($userObject->data["university_info"]["expected_graduation_date"]));
?>                                	
                                  <li><b>Graduation: </b> <span><?php echo $graduation; ?></span></li>

                                  <li><b>School: </b> <span><?php echo $userObject->data["university_info"]["university"]; ?></span></li>

                                  <li><b>Year 1: </b> <span><?php echo $userObject->vitals["first_year"]; ?></span></li>
<?php
$current_year=date("Y");
$first_year=$userObject->status["certification_year"];

//print "current_year:$current_year<br>\n";
//print "first_year:$first_year<br>\n";
//print "graduation_year:$graduation_year<br>\n";
//print "end_year:$end_year<br>\n";

$num_year = $current_year - $first_year;
?>

                                  <li><b># of Year: </b> <span><?php echo $num_year; ?></span></li>

                                  <li><b>Designation: </b> <span><?php echo $userObject->data["university_info"]["designation"]; ?></span></li>

                                  <li><b>Certificate #: </b> <span><?php echo $userObject->status["certificate"]; ?></span></li>
                                </ul>

                              </div>

                            </div>

                        </div>

                      </div>

                    </div>

                    <div class="ncca-contact">

                      <p class="midium-title text-uppercase pb-4">NCCAA CONTACT</p>

                      <ul>

                        <li>Cynthia Maraugha</li>

                        <li><a href="#">612-859-4415</a></li>

                        <li><a href="#">cynthia@nccaa.org</a></li>

                      </ul>

                    </div>

                  </div>

                  <div class="facebook-icon page-block">

                    <a href="#" class="facebook"><i class="fab fa-facebook-square"></i> <span>Share on facebook</span></a>

                  </div>

                </div>

                <div class="col-lg-8 main-container">

                  <div class="ncca-right-section page-block">

                    <div class="ncca-right-block block-border ncca-right-padding page-block-margin">

                      <div class="row">

                        <div class="col-sm-6 pr-0 jk-60">

                          <div class="ncca-welcome">

                            <h3 class="big-title">Welcome back, <?php echo $userObject->data["generalinfo"]["f_name"]; ?>.</h3>

                            <p>

                              NCCAA Internal Email:

                              <a href="#"><?php echo $userObject->data["generalinfo"]["f_name"].".".$userObject->data["generalinfo"]["l_name"]; ?>@nccaa.org</a>

                            </p>

                          </div>

                        </div>

                        <div class="col-6 col-sm-3 jk-20">

                          <div class="mail-status">

                            <h2 class="big-title"><?= $UnreadCnt ?></h2>

                            <p>Unread emails</p>

                            <a href="?content=content/emailviewall&item=emailpage" class="text-blue">Click here</a>

                          </div>

                        </div>

                        <div class="col-6 col-sm-3 jk-20">

                          <div class="mail-status">

                            <h2 class="big-title"><?php echo $blog->getUserNewCount( $_SESSION["user_id"] ); ?></h2>

                            <p>Unread posts</p>

                            <a href="?content=blog/template/blogviewall&item=blogpage&new=true" class="text-blue">Click here</a>

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
                                      <li class="dots-green"><span>"New Blog Posts Name" has been published today </span><a href="?content=blog/template/blogviewall&item=blogpage&new=true" class="text-blue">Click here</a></li>
                                    </ul>
                                  </div>
                                </div>
                            </div> 
                          </div>
                        </div>
                      </div>
                    </div>
					
<?php 
if ( strtolower($_SESSION["user_role"])=="admin" || strtolower($_SESSION["user_role"])=="caa") {
?>					
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
                                  <a class="nav-link  text-blue" href="?content=content/cmehistory">History</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link text-blue" href="?content=content/cmeadd">Add CME</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link text-blue" href="?content=content/cmehelp" role="tab" aria-controls="contact" aria-selected="false">NCCAA CMEs</a>
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
                                  <a class="nav-link text-blue" href="?content=content/cdqhistory" role="tab">History</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link text-blue"href="?content=content/cdqhelp" role="tab" aria-controls="profile" aria-selected="false">NCCAA Prep Course</a>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
					
<?php 
}
else if ( strtolower($_SESSION["user_role"])=="student" ) {
	
	$certificationhistory = new PaymentHistoryCertification();
	
	$read_history = $certificationhistory->readAllAction($_SESSION['user_id']);
	
	$expected_date = $certificationhistory->readExpectedDate($_SESSION['user_id']);
	
	$check_cert_active = $certificationhistory->readCheckCertification($_SESSION['user_id']);
	
	$main_date = "00/00/00";

	$begin_date = "00/00/00";

	$end_date = "00/00/00";

	if(empty($expected_date) == false){
		
			$main_date = $expected_date[0]['Expected_Cert_Exam'];
			
			$begin_date = $expected_date[0]['Cert_Registration_Begins'];
			
			$end_date = $expected_date[0]['Cert_Registration_Ends'];
	
	}
	
?>					
					
                    <div class="ncca-right-block cme-block-main">
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="page-block block-border page-block-margin">
                            <div class="cme-block-head ncca-right-padding">
                              <p class="midium-title">CERTIFICATION Exam</p>
							  <div class="row">
								<div class="col-sm-10">
								  <span>You are scheduled to take the Certification Exam on <?php if(empty($expected_date) == false) echo $main_date;?>. <br>You can make payment between <?php if(empty($expected_date) == false) echo $begin_date;?> and <?php if(empty($expected_date) == false) echo $end_date;?></span>
								</div>
								<div class="col-sm-2" align="right">
									<div id="pay_now_inactive">
									<?php 
									if(empty($expected_date) == false && $check_cert_active > 0){
										
										if(empty($expected_date[0]['University_Id']) == false){
											
											if(empty($read_history[0]['action_num']) == false){
												
												if($read_history[0]['action_num'] == 2){
													
													echo '<button type="button" class="btn btn-blue">Pay Now</button>
														  <span class="top">Waiting for <br>Certification Exam Results.
															  <i></i>
														  </span>';
												}else if($read_history[0]['action_num'] > 2){
												
													echo'<button type="button" id="certification_pay" class="btn btn-blue" style="width:87px; height:38px; font-size:1rem;">Pay Now</button>';
												}
												
											}else{
												
												echo'<button type="button" id="certification_pay" class="btn btn-blue" style="width:87px; height:38px; font-size:1rem;">Pay Now</button>';
											}
										}
									}
																	
									?>
										
									</div>
								</div>
							  </div>
                            </div>
                            <div class="cme-block-bottom page-block">
                              <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                  <a class="nav-link  text-blue" href="?content=content/history">History</a>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
<?php }?>					
					
					
                    <div class="ncca-right-block ">
<?PHP
if ( ( ! isset( $_REQUEST["content"] ) ) ||  ( $_REQUEST["content"]=="" ) ) $content="content/home.php";
else $content = $_REQUEST["content"].".php";

include( $content );
?>


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
<script src="./assets/js/script.js" type="text/javascript"></script>
<?php 

if((count($total_ques_list) > 0) && ($userObject->status["status"] == "CAA")){
	
	include 'survey-modal.php'; 

}
?>


<div id="debug">
<?php 
// print "userObject:<pre><br>\n";
// var_dump( $userObject );
// print "</pre><br>\n";
?>	
</div>


<div id="edit__photo_modal" class="modal fade" role="dialog">
  <div class="modal-dialog" style=" width: 400px;">

		<!-- Modal content-->
		<div class="modal-content">
			  <div class="modal-header" style="background-color: #f7f7f7; border-bottom: 1px solid #ebebeb; height: 50px;">
				 <h2 class="modal-title" style="font-size:20px !important;">Edit Profile Picture</h3>
				 <button type="button" class="close" data-dismiss="modal">&times;</button>
			  </div>
			  <div class="modal-body" >
					<div class="row">

							<div class="col-md-12" align="center">
									<img src="<?php
									if(empty($photo_name) == false){
										
										if(empty($photo_name[0]['photo']) == false){
											
											echo $photo_name[0]['photo'];
										
										}else{
											
											echo"./assets/images/profile-img.png";
											
										}
									} 
									else echo"./assets/images/profile-img.png";
									?>" 
									style="width:350px;" id="view_photo" alt="Edit Profile Picture" />
							</div>
								
							<div class="col-md-12" style="margin-top:15px;" align="center" >
							
								<button class="btn" style="width:350px;" >Change Picture</button>
								
								<input type="file" class="form-control" style="cursor:pointer; margin-top: -35px; opacity:0" id="add_picture_file" name="add_picture_file" accept="image/x-png,image/gif,image/jpeg" />
							
							</div>
								
							<div class="col-md-12" style="margin-top:15px;" align="center" >
								
								
								<input type="button" class="btn" style="width:350px; background-color: #24608b; color: white" onclick="add_profile_picture('<?=$_SESSION['user_id']?>')" value="Set as Profile Picture" />
							
							</div>
								
					</div>
						
						
			  </div>
		</div>

   </div>
</div>	

<script>

function edit_profile_picture(){
	
	 $('#edit__photo_modal').modal('show');
	
}


$("#add_picture_file").change(function() {
	
  readURL(this);
  
});

function readURL(input) {
	
  if (input.files && input.files[0]) {
	  
	var reader = new FileReader();
	
	reader.onload = function(e) {
		
		$('#view_photo').attr('src', e.target.result);
		
	}
	
	reader.readAsDataURL(input.files[0]);
	
  }
  
}


function add_profile_picture(user_id){
	
	var add_picture_file = $('#add_picture_file').prop('files')[0]; 
	
    var form_data = new FormData();   
	
    form_data.append('user_id', user_id);
    
	form_data.append('add_picture_file', add_picture_file);

	$.ajax({
		
		url: './index_photo.php',
		
		type: 'POST',
		
		dataType: 'json',
		
		cache: false,
		
        contentType: false,
		
        processData: false,	
		
		data: form_data,
		
		async: true,
		
		headers: {
		  "cache-control": "no-cache"
		},
		
		success: function(data) {
			
			if(data['statusCode'] == 1){
				
				location.reload();
				
			}
			
		},
		
		error: function(data) {
			
			false;
			
		}
	});
}

</script>









</body>
</html>
