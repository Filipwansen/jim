<?php



session_start();



if($_SESSION['user_id'] == "" || empty($_SESSION['user_id']))



{



    header('Location: index.php');



}   



include('config.php');



require_once( BASE_PATH . "includes/util.php");



require_once( BASE_PATH . "classes/user.class.php");



$userObject = new userObject();

$userObject->init( $_SESSION['user_id'] );



$photo_sql = "SELECT * FROM profile_photo WHERE user_id = '". $_SESSION['user_id'] ."'";



$photo_query = mysqli_query($con, $photo_sql);

$photo_name = mysqli_fetch_object($photo_query);



/**



 * Query for data selectiion



 * 



 **/



function validateDate($date)



{



    $d = DateTime::createFromFormat('Y-m-d', $date);



    return $d && $d->format('Y-m-d') == $date;



}



$sql10 = "select * from final_account_security_information where user_id=".$_SESSION['user_id'];



$result10 = mysqli_query($con,$sql10);



$tab_4 = mysqli_fetch_object($result10);







$sql = "select * from final_generalinform where user_id=".$_SESSION['user_id'];



$result = mysqli_query($con,$sql);



$row_general_info = mysqli_fetch_object($result);







$sql2 = "select * from final_address_contact_information where user_id=".$_SESSION['user_id'];



$result2 = mysqli_query($con,$sql2); 



$address_contact_information = mysqli_fetch_object($result2);







$sql3 = "select * from final_account_security_information where user_id=".$_SESSION['user_id'];



$result3 = mysqli_query($con,$sql3);



$account_security_information = mysqli_fetch_object($result3);



$account_security_dob = $account_security_information->dob;



$account_security_date = $account_security_dob;







 











$sql4 = "select * from final_personal_information where user_id=".$_SESSION['user_id'];



$result4 = mysqli_query($con,$sql4);



$personal_information = mysqli_fetch_object($result4);







$sql4_u = "select * from users where id=".$_SESSION['user_id'];



$result4_u = mysqli_query($con,$sql4_u);



$user_information = mysqli_fetch_object($result4_u);







$sql4tab5 = "select * from final_program_university_info where user_id=".$_SESSION['user_id'];



$result4tab5 = mysqli_query($con,$sql4tab5);



$tab4_info = mysqli_fetch_object($result4tab5);





$sql4inc = "SELECT COUNT(id)+1 AS code FROM `final_account_security_information` WHERE id_crm != ''";



$result4inc = mysqli_query($con,$sql4inc);



$inc_count = mysqli_fetch_object($result4inc);



$inc_count = '7777'.sprintf("%04s", $inc_count->code);











$sql5 = "select * from final_program_university_info where user_id=".$_SESSION['user_id'];



$result5 = mysqli_query($con,$sql5); 



$program_university_info = mysqli_fetch_object($result5);







$matric_dt = $program_university_info->matric_date;







if($matric_dt != ""){



$matric_dt_month = date("m",strtotime($matric_dt));



$matric_dt_date = date("d",strtotime($matric_dt));



$matric_dt_year = date("Y",strtotime($matric_dt));



    



}else{



$matric_dt_month = " ";



$matric_dt_date =  " ";



$matric_dt_year =  " ";



    



}







$matric_dt_expected_graduation = $program_university_info->expected_graduation_date;







if($matric_dt_expected_graduation != ""){



$matric_dt_expected_graduation_month = date("m",strtotime($matric_dt_expected_graduation));



$matric_dt_expected_graduation_date = date("d",strtotime($matric_dt_expected_graduation));



$matric_dt_expected_graduation_year = date("Y",strtotime($matric_dt_expected_graduation));  



}else{



$matric_dt_expected_graduation_month = " ";



$matric_dt_expected_graduation_date = " ";



$matric_dt_expected_graduation_year = " ";



}



















$matric_dt_actual_graduation_date = $program_university_info->actual_graduation_date;



$matric_dt_actual_graduation_year = $program_university_info->actual_grad_year;











if($matric_dt_actual_graduation != ""){







}else{







}











$program_university_specialities = explode(" , ",$program_university_info->specialities_training);























$sql6 = "select * from final_exam_certification_info where user_id=".$_SESSION['user_id'];



$result6 = mysqli_query($con,$sql6); 



$certification_info = mysqli_fetch_object($result6);







$actual_exam_taken_date = $certification_info->actual_exam_date_taken;







if($actual_exam_taken_date != ""){



$actual_exam_taken_date_month = date("m",strtotime($actual_exam_taken_date));



$actual_exam_taken_date_date = date("d",strtotime($actual_exam_taken_date));



$actual_exam_taken_date_year = date("Y",strtotime($actual_exam_taken_date));    



}



else{



$actual_exam_taken_date_month =  " ";



$actual_exam_taken_date_date =  " ";



$actual_exam_taken_date_year =  " ";



}















$actual_certification_exam_taken = $certification_info->actual_certification_exam_taken;







if($actual_certification_exam_taken != ""){



$actual_certification_exam_taken_month = date("m",strtotime($actual_certification_exam_taken));



$actual_certification_exam_taken_date = date("d",strtotime($actual_certification_exam_taken));



$actual_certification_exam_taken_year = date("Y",strtotime($actual_certification_exam_taken));



}else{



$actual_certification_exam_taken_month = " ";



$actual_certification_exam_taken_date = " ";



$actual_certification_exam_taken_year = " ";



}



















$actual_exam_date_taken2 = $certification_info->actual_exam_date_taken2;







if($actual_exam_date_taken2 != ""){



$actual_exam_taken_date_month_2 = date("m",strtotime($actual_exam_date_taken2));



$actual_exam_taken_date_date_2 = date("d",strtotime($actual_exam_date_taken2));



$actual_exam_taken_date_year_2 = date("Y",strtotime($actual_exam_date_taken2));



}else{



$actual_exam_taken_date_month_2 = " ";



$actual_exam_taken_date_date_2 = " ";



$actual_exam_taken_date_year_2 = " ";



}















$expiry_date = $certification_info->expiry_date;



if($expiry_date != ""){



$expiry_date_month = date("m",strtotime($expiry_date));



$expiry_date_date = date("d",strtotime($expiry_date));



$expiry_date_year = date("Y",strtotime($expiry_date));



}else{



$expiry_date_month = " ";



$expiry_date_date = " ";



$expiry_date_year = " ";



}







    















$sql7 = "select * from final_employment_info where user_id=".$_SESSION['user_id'];



$result7 = mysqli_query($con,$sql7); 



$employment_info = mysqli_fetch_object($result7);







$first_employeement_dt = $employment_info->first_employment_date;







if($first_employeement_dt != ""){



$first_employeement_month = date("m",strtotime($first_employeement_dt));



$first_employeement_date = date("d",strtotime($first_employeement_dt));



$first_employeement_year = date("Y",strtotime($first_employeement_dt)); 



}else{



$first_employeement_month = " ";



$first_employeement_date = " ";



$first_employeement_year = " "; 



}











$start_dt = $employment_info->start_date;



if($start_dt != ""){



$start_dt_month = date("m",strtotime($start_dt));



$start_dt_date = date("d",strtotime($start_dt));



$start_dt_year = date("Y",strtotime($start_dt));    



}else{



$start_dt_month = " ";



$start_dt_date =  " ";



$start_dt_year = " ";   



}







$employee_info_type_setting = explode(" , ",$employment_info->type_setting_1);



$employee_info_typical_week = explode(" , ",$employment_info->typical_weekly1);



$employee_info_state1 = explode(" , ",$employment_info->employement_practice_state1);



















$sql8 = "select * from final_employer_compensation where user_id=".$_SESSION['user_id'];



$result8 = mysqli_query($con,$sql8);



$employer_compensation = mysqli_fetch_object($result8);



$employer_basic_compension = explode(" - ",$employer_compensation->basic_compension);



$employer_full_compension = explode(" - ",$employer_compensation->full_compension);



















$sql9 = "select * from final_employer_benefits where user_id=".$_SESSION['user_id'];



$result9 = mysqli_query($con,$sql9); 



$employer_benefits = mysqli_fetch_object($result9);



$employe_offer_benefit = explode(" - ",$employer_benefits->employer_offer_benefit);











$sql10 = "select * from final_employer_retirement where user_id=".$_SESSION['user_id'];



$result10 = mysqli_query($con,$sql10); 



$employer_retirement = mysqli_fetch_object($result10);



$retirement_plan_setup = explode(" - ",$employer_retirement->retirement_setup_plan);



















$sql11= "select * from final_retirements_previous_employers where user_id=".$_SESSION['user_id'];



$result11 = mysqli_query($con,$sql11); 







$sql12 = "select * from final_employee_skills where user_id=".$_SESSION['user_id'];



$result12 = mysqli_query($con,$sql12); 



$employee_skills = mysqli_fetch_object($result12);



$all_specialities_techniques = explode(" , ",$employee_skills->all_specialities_techniques);















$sql13 = "select * from final_other_memberships where user_id=".$_SESSION['user_id'];



$result13 = mysqli_query($con,$sql13); 



$other_memberships = mysqli_fetch_object($result13);



$other_memberships_dated_joined = $other_memberships->dated_joined;







if($other_memberships_dated_joined != "" && $other_memberships_dated_joined != "--" && validateDate($other_memberships_dated_joined) == true)



{



$dated_joined_month = date("m",strtotime($other_memberships_dated_joined));



$dated_joined_date = date("d",strtotime($other_memberships_dated_joined));



$dated_joined_year = date("Y",strtotime($other_memberships_dated_joined));



}



else{



$dated_joined_month = " ";



$dated_joined_date = " ";



$dated_joined_year = " ";



}















$sql_states = "select * from states";



$result_states = mysqli_query($con,$sql_states);



$row_states = mysqli_fetch_object($result_states);















$sql14 = "select * from final_retirements_previous_employers where user_id=".$_SESSION['user_id'];



$result14 = mysqli_query($con,$sql14); 



$previous_employers = mysqli_fetch_object($result14);











$previous_employers_start_date = $previous_employers->start_date;







if($previous_employers_start_date != "" && $previous_employers_start_date != "--" && validateDate($previous_employers_start_date) == true)



{



$start_dated_joined_month = date("m",strtotime($previous_employers_start_date));



$start_dated_joined_date = date("d",strtotime($previous_employers_start_date));



$start_dated_joined_year = date("Y",strtotime($previous_employers_start_date));



}



else{



$start_dated_joined_month = " ";



$start_dated_joined_date = " ";



$start_dated_joined_year = " ";



}











$previous_employers_end_date = $previous_employers->end_date;







if($previous_employers_end_date != "" && $previous_employers_end_date != "--" && validateDate($previous_employers_end_date) == true)



{



$end_dated_joined_month = date("m",strtotime($previous_employers_end_date));



$end_dated_joined_date = date("d",strtotime($previous_employers_end_date));



$end_dated_joined_year = date("Y",strtotime($previous_employers_end_date));



}



else{



$end_dated_joined_month = " ";



$end_dated_joined_date = " ";



$end_dated_joined_year = " ";



}











$sql15 = "select * from final_add_another_address where user_id=".$_SESSION['user_id'];



$result15 = mysqli_query($con,$sql15); 



$add_another_address = mysqli_fetch_object($result15);











?>



<!DOCTYPE html>



<html lang="en">



<head>



<meta charset="utf-8">



<title>NCCAA</title>



<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">



    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">



    <link rel="stylesheet" href="./assets/fonts/font-awesome/fontawesome-all.min.css">



    <link rel="stylesheet" href="./assets/fonts/fonts.css">



    



<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">



<link rel="stylesheet" href="style.css">



<link rel="stylesheet" href="./assets/css/stylesheet.css">



<link href="css/owl.carousel.css" rel="stylesheet" type="text/css">

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>







<script src="./assets/js/jquery.min.js" type="text/javascript"></script>



<script src="./assets/js/bootstrap.min.js" type="text/javascript"></script>



<script src="./assets/js/script.js" type="text/javascript"></script>



<script src="js/jquery.form-validator.min.js"></script>



<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.js"></script>





	<script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>







        <style type="text/css">



            .js .inputfile {



    width: 0.1px;



    height: 0.1px;



    opacity: 0;



    overflow: hidden;



    position: absolute;



    z-index: -1;



}







.inputfile + label {



   /* max-width: 80%;*/



    font-size: 1.25rem;



    /* 20px */



    font-weight: 700;



    text-overflow: ellipsis;



    white-space: nowrap;



    cursor: pointer;



    display: inline-block;



    overflow: hidden;



    padding: 0.625rem 1.25rem;



    /* 10px 20px */



}







.no-js .inputfile + label {



    display: none;



}







.inputfile:focus + label,



.inputfile.has-focus + label {



    outline: 1px dotted #000;



    outline: -webkit-focus-ring-color auto 5px;



}







.inputfile + label * {



    /* pointer-events: none; */



    /* in case of FastClick lib use */



}







.inputfile + label svg {



    width: 1em;



    height: 1em;



    vertical-align: middle;



    fill: currentColor;



    margin-top: -0.25em;



    /* 4px */



    margin-right: 0.25em;



    /* 4px */



}







/* style 2 */







.inputfile-2 + label {



    color: #d3394c;



    border: 1px solid #e1dbdb;



}







.inputfile-2:focus + label,



.inputfile-2.has-focus + label,



.inputfile-2 + label:hover {



    color: #000;



}















        </style>



</head>



	



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



                <p>National Commission for Certification of Anesthesiologist Assistants</p>



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



                          <a class="nav-link" href="./?content=blog/template/blogviewall&item=blogpage">Blog</a>



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



                          <a class="nav-link" href="./?content=content/emailviewall&item=emailpage">Email</a>



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



                          <a class="nav-link" href="./?content=content/history&item=historypage">History</a>



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

										

										if(empty($photo_name->photo) == false  && file_exists($photo_name->photo)){

											

											echo $photo_name->photo;

										

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

					  

					  

					  

					  

					  

					  

						<div class="profile_photo" onclick="edit_profile_picture()" style="background-image: url('<?php

									if(empty($photo_name) == false){

										

										if(empty($photo_name->photo) == false  && file_exists($photo_name->photo)){

											

											echo $photo_name->photo;

										

										}else{

											

											echo"./assets/images/profile-img.png";

											

										}

									} 

									else echo"./assets/images/profile-img.png";

									?>'); margin-left: 60px">

									

									<div align="center"><i class="fa fa-camera" style="color:#ffffff; padding-top:35%"></i><br><font style="color:white">Edit picture</font></div>

						</div>	  

						 

                          

						  <p class="show-debug"><?php echo $userObject->data["generalinfo"]["f_name"]." ".$userObject->data["generalinfo"]["l_name"]; ?></p>



                          <span><?php echo $userObject->data["employment_info"]["employer_name"]; ?></br><?php if(empty($userObject->data["employment_info"]["employer_address"]) == false) echo $userObject->data["employment_info"]["employer_address"].", ".$userObject->data["employment_info"]["employer_city"].", ".$userObject->data["employment_info"]["employer_state"]." ".$userObject->data["employment_info"]["employer_zip"]; ?></span>



                          <a href="form.php">Edit Profile</a>



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



                                  EDUCATION INFO <i class="far fa-question-circle"></i>



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

					  

						<a href="./?item=homepage" class="backbtn"><span class="glyphicon glyphicon-chevron-left"></span>< Back</a>

 

 <div id="content">



  	   <div class="content-inner2">



            <div class="title-sec">



                 <h1>CAA PROFILE</h1>



                 <div class="tab-menu">



                    <?php 







                    /*



                    if(empty($row_general_info->f_name)) { $current1 ='current';  } 



                    else if(!empty($row_general_info->f_name) && empty($account_security_date)) { $current2 ='current'; }



                    else if(!empty($account_security_date) && empty($address_contact_information->address_1)) { $current3 ='current'; }



                    else if(!empty($address_contact_information->address_1) && empty($tab4_info)) { $current4 ='current'; }



                    else if(!empty($tab4_info) && empty($employment_info->first_employment_date)) { $current5 ='current'; }



                    else if(!empty($employment_info->first_employment_date) && empty($employer_compensation->full_compension)) { $current6 ='current'; }



                    else if(!empty($employer_compensation->full_compension) && empty($employment_info->typical_weekly1)) { $current7 ='current'; }



                    else if(!empty($employment_info->typical_weekly1) && empty($employer_benefits->employer_offer_benefit)) { $current8 ='current'; }



                    else if(!empty($employer_benefits->employer_offer_benefit) && empty($employee_skills->languages_speak)) { $current9 ='current'; }



                    else if(!empty($employee_skills->languages_speak)) { $current10 ='current'; } */



                    $current = (isset($_GET['tab']))?$_GET['tab']:'current1';



                    ?>



                 	  <ul class="category-slider category-tab nav owl-carousel owl-theme tabs" id="category-tab" role="tablist">



                        <li class="tab-link <?php if($current == 'current1') { echo 'current'; }; ?>" data-tab="tab-1">Basic Info</li>



                        <li class="tab-link <?php if($current == 'current2') { echo 'current'; }; ?>" data-tab="tab-2">About You</li>



                        



                        <li class="tab-link <?php if($current == 'current3') { echo 'current'; }; ?>" data-tab="tab-3">Personal Info</li>



                        <li class="tab-link <?php if($current == 'current4') { echo 'current'; }; ?>" data-tab="tab-4">University Programs</li>



                        <li class="tab-link <?php if($current == 'current5') { echo 'current'; }; ?>" data-tab="tab-5">Employer Info</li>



                        <li class="tab-link <?php if($current == 'current6') { echo 'current'; }; ?>" data-tab="tab-6">Employer Compensation</li>



                        <li class="tab-link <?php if($current == 'current7') { echo 'current'; }; ?>" data-tab="tab-7">Employer Schedule</li>



                        <li class="tab-link <?php if($current == 'current8') { echo 'current'; }; ?>" data-tab="tab-8">Employer Benefits/Retirement</li>



                        <li class="tab-link <?php if($current == 'current9') { echo 'current'; }; ?>" data-tab="tab-9">Skills</li>



                        <li class="tab-link <?php if($current == 'current10') { echo 'current'; }; ?>" data-tab="tab-10">Memberships</li>



                    </ul>



                 </div>



                 



            </div>



       	    



            <div class="form-sec">



            



                  <div id="tab-1" class="tab-content <?php if($current == 'current1') { echo 'current'; }; ?>">



                    <form id="GeneralInfo_Form" name="GeneralInfo_Form"  action="process/tab1.php?tab=current2" enctype="multipart/form-data" method="POST">



                       <div class="row">



                     <div class="col4">



                         <label>Member Unique Identifier</label>



                         <input data-validation="required" type="text" onchange="" value="<?php if(!empty($account_security_information->id_crm)) { echo $account_security_information->id_crm; } else { echo $inc_count; }     ?>" id="account_security_field0" minlength="8" maxlength="8"  "79270293" name="id_crm" class="form-input bg-input">



                         <p class="msg">Assigned by Admin</p>



                     </div>



                 </div>



                 



                 <div class="row">



                     <div class="col4">



                         <label>Title</label>



                            <select data-validation="required" id="general_info_form_field0" onchange="" class="form-input bg-input" name="title" oninvalid="this.setCustomValidity('Please Select Title')" oninput="this.setCustomValidity('')" >



                                <option value="">Select Title</option>



                            <option <?php if($row_general_info->title == "Mr."){ echo "Selected";} ?> value="Mr.">Mr.</option>



                            <option <?php if($row_general_info->title == "Mrs."){ echo "Selected";} ?> value="Mrs.">Mrs.</option>



                            <option <?php if($row_general_info->title == "Ms."){ echo "Selected";} ?> value="Ms.">Ms.</option>



                            <option <?php if($row_general_info->title == "Miss"){ echo "Selected";} ?> value="Miss">Miss</option>



                         </select>



                         <p class="msg">Assigned by Admin</p>



                     </div>



                 </div>



                 



                 <div class="row">



                     <div class="col4">



                         <label>First Name</label>



                         <input data-validation="required" type="text" onchange="" id="general_info_form_field1" minlength="1" value="<?php echo $row_general_info->f_name; ?>" name="f_name" maxlength="15" class="form-input" "Soren">



                         <p class="msg"><p class="msg">Assigned by Admin</p></p>



                     </div>



                     <div class="col4">



                         <label>Middle Name</label>



                         <input  type="text" onchange="" id="general_info_form_field2" minlength="1" value="<?php echo $row_general_info->m_name; ?>" name="m_name" maxlength="30" class="form-input" " ">



                         <p class="msg"><p class="msg">Contact admin for name changes</p></p>



                     </div>



                     <div class="col4">



                         <label>Last Name</label>



                         <input data-validation="required" type="text" onchange="" minlength="1" id="general_info_form_field3" value="<?php echo $row_general_info->l_name; ?>" name="l_name" maxlength="15" class="form-input" "Campbell">



                         <p class="msg"><p class="msg">Contact admin for name changes</p></p>



                     </div>



                 </div>



                 



                 <div class="row">



                     <div class="col4">



                         <label>Suffix</label>



                            <select  class="form-input" onchange="" id="general_info_form_field4" name="suffix" oninvalid="this.setCustomValidity('Please Select Suffix')" oninput="this.setCustomValidity('')">



                         	<option <?php if($row_general_info->suffix == "Select Suffux"){ echo "Selected";} ?> value="">Select Suffix</option>



                                        <option <?php if($row_general_info->suffix == "Sr."){ echo "Selected";} ?> value="Sr.">Sr.</option>



                                        <option <?php if($row_general_info->suffix == "Jr."){ echo "Selected";} ?> value="Jr.">Jr.</option>



                                        <option <?php if($row_general_info->suffix == "III"){ echo "Selected";} ?> value="III">III</option>



                                        <option <?php if($row_general_info->suffix == "IV"){ echo "Selected";} ?> value="IV">IV</option>



                                        <option <?php if($row_general_info->suffix == "N/A"){ echo "Selected";} ?> value="N/A">N/A</option>



                         </select>



                         <p class="msg">Assigned by Admin</p>



                     </div>



                 </div>



                 



                 <div class="row">



                     <div class="col4">



                         <label>Username</label>



                         <input  style=" background-color: #C0C0C0;color: blue;"data-validation="required" type="text" onchange="" value="<?php echo $user_information->name; ?>" minlength="5" name="username" id="account_security_field1" class="form-input" "soren.campbell@nccaa.org" >



                     </div>



                 </div>



                 



                 <div class="row">



                     <div class="col4">



                         <label>Password</label>



                         <input  style=" background-color: #C0C0C0;color: blue;"data-validation="required" type="text" onchange="" minlength="5" value="<?php echo $_SESSION['pass']; ?>" name="password" id="account_security_field2" class="form-input" "******">



                     </div>



                     <div class="col4">



                         <label>Confirm Password</label>



                         <input style=" background-color: #C0C0C0;color: blue;" data-validation="required" type="text" onchange="" minlength="5" value="<?php echo $_SESSION['pass']; ?>" name="confirm-password" id="account_security_field3" class="form-input" "****" oninput="check(this)">



                         <script language='javascript' type='text/javascript'>



                        function check(input) {



                        if (input.value != document.getElementById('account_security_field2').value) {



                          input.setCustomValidity('Password Must be Matching.');



                         } else {



                             // input is valid -- reset the error message



                             input.setCustomValidity('');



                          }



                        }



                    </script>



                     </div>



                 </div>



                 



                 <div class="row">



                     <div class="col4">



                         <label>Last 4 Digits of Social Security</label>



                         <input style=" background-color: #C0C0C0;color: blue;" data-validation="required" type="text" value="<?php echo $account_security_information->last4ssn; ?>" onchange="" minlength="4" maxlength="4" name="last4ssn" id="account_security_field4" class="form-input" "5396">



                     </div>



                 </div>



                 



                 <div class="row">



                     <div class="col4">



                         <label>Mother’s Maiden Name</label>



                         <input  style=" background-color: #C0C0C0;color: blue;"data-validation="required" type="text" minlength="3" value="<?php echo $account_security_information->mother_maiden_name; ?>" onchange="" name="mother_maiden_name" id="account_security_field10" class="form-input" "Sanchez">



                     </div>



                 </div>



                 



                 <div class="row">



                     <div class="col4">



                         <label>Graduation Date</label>



                         <input data-validation="required" type="date" class="form-input" "09/15/99" id="program_university_17" onchange="" name="actual_graduation_date" class="form-control" value="<?php echo $matric_dt_actual_graduation_date; ?>">



                         <p class="msg msg2">For better statistics, please enter the exact graduation date; otherwise, select the <br>year only</p>



                     </div>



                     



                     <div class="col4">



                         <span class="or">or</span>



                         <label>Year</label>



                         <select id="program_university_18" onchange="" name="actual_grad_year" class="form-input">



                                            <option value="" selected >Select Year</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "1970") { echo "selected"; } ?> value="1970" name="day">1970</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "1971") { echo "selected"; } ?> value="1971" name="day">1971</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "1972") { echo "selected"; } ?> value="1972" name="day">1972</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "1973") { echo "selected"; } ?> value="1973" name="day">1973</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "1974") { echo "selected"; } ?> value="1974" name="day">1974</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "1975") { echo "selected"; } ?> value="1975" name="day">1975</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "1976") { echo "selected"; } ?> value="1976" name="day">1976</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "1977") { echo "selected"; } ?> value="1977" name="day">1977</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "1978") { echo "selected"; } ?> value="1978" name="day">1978</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "1979") { echo "selected"; } ?> value="1979" name="day">1979</option>    



                                        <option <?php if($matric_dt_actual_graduation_year == "1980") { echo "selected"; } ?> value="1980" name="day">1980</option>    



                                        <option <?php if($matric_dt_actual_graduation_year == "1981") { echo "selected"; } ?> value="1981" name="day">1981</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "1982") { echo "selected"; } ?> value="1982" name="day">1982</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "1983") { echo "selected"; } ?> value="1983" name="day">1983</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "1984") { echo "selected"; } ?> value="1984" name="day">1984</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "1985") { echo "selected"; } ?> value="1985" name="day">1985</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "1986") { echo "selected"; } ?> value="1986" name="day">1986</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "1987") { echo "selected"; } ?> value="1987" name="day">1987</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "1988") { echo "selected"; } ?> value="1988" name="day">1988</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "1989") { echo "selected"; } ?> value="1989" name="day">1989</option>    



                                        <option <?php if($matric_dt_actual_graduation_year == "1990") { echo "selected"; } ?> value="1990" name="day">1990</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "1991") { echo "selected"; } ?> value="1991" name="day">1991</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "1992") { echo "selected"; } ?> value="1992" name="day">1992</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "1993") { echo "selected"; } ?> value="1993" name="day">1993</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "1994") { echo "selected"; } ?> value="1994" name="day">1994</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "1995") { echo "selected"; } ?> value="1995" name="day">1995</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "1996") { echo "selected"; } ?> value="1996" name="day">1996</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "1997") { echo "selected"; } ?> value="1997" name="day">1997</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "1998") { echo "selected"; } ?> value="1998" name="day">1998</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "1999") { echo "selected"; } ?> value="1999" name="day">1999</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "2000") { echo "selected"; } ?> value="2000" name="day">2000</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "2001") { echo "selected"; } ?> value="2001" name="day">2001</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "2002") { echo "selected"; } ?> value="2002" name="day">2002</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "2003") { echo "selected"; } ?> value="2003" name="day">2003</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "2004") { echo "selected"; } ?> value="2004" name="day">2004</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "2005") { echo "selected"; } ?> value="2005" name="day">2005</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "2006") { echo "selected"; } ?> value="2006" name="day">2006</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "2007") { echo "selected"; } ?> value="2007" name="day">2007</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "2008") { echo "selected"; } ?> value="2008" name="day">2008</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "2009") { echo "selected"; } ?> value="2009" name="day">2009</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "2010") { echo "selected"; } ?> value="2010" name="day">2010</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "2011") { echo "selected"; } ?> value="2011" name="day">2011</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "2012") { echo "selected"; } ?> value="2012" name="day">2012</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "2013") { echo "selected"; } ?> value="2013" name="day">2013</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "2014") { echo "selected"; } ?> value="2014" name="day">2014</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "2015") { echo "selected"; } ?> value="2015" name="day">2015</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "2016") { echo "selected"; } ?> value="2016" name="day">2016</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "2017") { echo "selected"; } ?> value="2017" name="day">2017</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "2018") { echo "selected"; } ?> value="2018" name="day">2018</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "2019") { echo "selected"; } ?> value="2019" name="day">2019</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "2020") { echo "selected"; } ?> value="2020" name="day">2020</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "2021") { echo "selected"; } ?> value="2021" name="day">2021</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "2022") { echo "selected"; } ?> value="2022" name="day">2022</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "2023") { echo "selected"; } ?> value="2023" name="day">2023</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "2024") { echo "selected"; } ?> value="2024" name="day">2024</option>



                                        <option <?php if($matric_dt_actual_graduation_year == "2025") { echo "selected"; } ?> value="2025" name="day">2025</option>



                                    </select>



                     </div>



                     



                     



                 </div>



                 



                 <div class="row">



                     <div class="col8">



                         <label>Alma Mater</label>



                         <select data-validation="required" class="form-input" name="alma_mater" onchange="autofill(this)">



                            <option value="">Select University</option>



                                        



                                        <?php



                                        //print_r($result_states);



                                        $sql_states3 = "select * from tbl_university order by University_Name asc";



                                        $result_states9900 = mysqli_query($con,$sql_states3);



                                        while($rowState = mysqli_fetch_object($result_states9900)){



                                    ?>



                                        <option  value="<?php echo $rowState->id;?>" <?php if($rowState->id == $account_security_information->alma_mater) { echo "Selected";} else { echo ""; } ?>><?php echo $rowState->University_Name;?></option>



                                    



                                    



                                        <?php }







                                        ?>



                         </select>



                     </div>



                 </div>



                 



                 <div class="row" id="img-blcok">



                     <div class="col8">



                         <label>Main University Photo</label>



                         <?php /*



                         <div class="upload-row">



                         	  <input <?php if(empty($program_university_info->university_photo)) { ?>data-validation="required" <?php } ?> type="file" class="upload-input" value="<?php echo $program_university_info->university_photo; ?>" name="university_photo[]" multiple>



                              <span class="upload-plus"></span>



                         </div>



                         */ ?>



                         <div class="box">







                    <input <?php if(empty($program_university_info->university_photo)) { ?> data-status='1' <?php } ?> type="file" name="university_photo[]" id="file-2" class="inputfile inputfile-2" data-multiple-caption="{count} files selected" multiple style="color: rgb(255, 255, 255); background: rgb(255, 255, 255) none repeat scroll 0% 0%; opacity: 0.1; border-color: rgb(185, 74, 72);display: none;" data-status="0" oninvalid="this.setCustomValidity('Please Select Photo')"/>



                    <label for="file-2"><svg  xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path  d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span id="file-2-lable">Choose a file&hellip;</span></label>



                </div>



                <input type="hidden" name="img_data" id="img_data" value="1">



                     <?php if(!empty($program_university_info->university_photo)) { 







                        $img_data = explode(',', $program_university_info->university_photo);



                        foreach ($img_data as $key => $value) {



                        ?>



                            



                         <img width="100px" height="100px" src="upload/university_photo/<?php echo  $value; ?>" class="img-responsive" style="margin-top: 10px;">



                            



                     <?php } }  ?>



                         <p class="msg msg3">Current or recent grad students - take pride in your school bydisplaying school photos in your member account. We provide the main school photo by default but you can add one here or later in your member account. In addition, a personal photo is required for the personalized member area. We require at least one uploaded file, whether university or personal photo.</p>







                     </div>



                     <div class="col4">



                         <a href="javascript:void(0);" id="hide_img" <?php if(empty($program_university_info->university_photo)) { ?> style="background-color: rgb(204, 204, 204);" <?php } ?> class="no-thanks">No Thanks</a>



                     </div>



                 </div>



                 



                



                 



                 



                 <div class="submit-row">



                     <button class="save-btn" type="submit" name="tab1" id="general_info_form" value="Save" onclick="return confirm( 'do you want to save this changes?');"><span>(1/10)</span> SAVE</button>



                 </div>



             </form>



                  </div><!--close tab1-->



                  



                <div id="tab-2" class="tab-content <?php if($current == 'current2') { echo 'current'; }; ?>">



                    <form id="GeneralInfo_Form" name="GeneralInfo_Form"  action="process/tab1.php?tab=current3" enctype="multipart/form-data" method="POST">



                     <div class="row">



                     <div class="col4">



                         <label>Birth Date</label>



                         <input type="date" data-validation="required" name="dob" class="form-input" id="account_security_field7" onchange="" oninvalid="this.setCustomValidity('Please Select Date')" oninput="this.setCustomValidity('')" value="<?php echo $account_security_date; ?>">



                                        



                     </div>



                 </div>



                 



                 <div class="row">



                     <div class="col4">



                         <label>Gender</label>



                            <select data-validation="required" class="form-input" id="personal_form_info1" onchange="" name="gender" oninvalid="this.setCustomValidity('Please Select Gender')" oninput="this.setCustomValidity('')">



                            <option <?php if($personal_information->gender == "Select Gender"){ echo "Selected";} ?> value="">Select Gender</option>



                                        <option <?php if($personal_information->gender == "Male"){ echo "Selected";} ?> value="Male">Male</option>



                                        <option <?php if($personal_information->gender == "Female"){ echo "Selected";} ?> value="Female">Female</option>



                         </select>



                     </div>



                 </div>



                 



                 <div class="row">



                     <div class="col4">



                         <label>Race</label>



                            <select data-validation="required" class="form-input" id="personal_form_info2" onchange="" name="race" oninvalid="this.setCustomValidity('Please Select Race')" oninput="this.setCustomValidity('')">



                         	  <option <?php if($personal_information->race == "Select Race"){ echo "selected";} ?> value="">Select Race</option>



                                        <option <?php if($personal_information->race == "Alaska Native"){ echo "selected";} ?> value="Alaska Native">Alaska Native</option>



                                        <option <?php if($personal_information->race == "American Indian"){ echo "selected";} ?> value="American Indian">American Indian</option>



                                        <option <?php if($personal_information->race == "Asian"){ echo "selected";} ?> value="Asian">Asian</option>



                                        <option <?php if($personal_information->race == "Black or Afrian American"){ echo "selected";} ?> value="Black or Afrian American">Black or Afrian American</option>



                                        <option <?php if($personal_information->race == "Latino or Hispanic"){ echo "selected";} ?> value="Latino or Hispanic">Latino or Hispanic</option>



                                        <option <?php if($personal_information->race == "Middle Eastern"){ echo "selected";} ?> value="Middle Eastern">Middle Eastern</option>



                                        <option <?php if($personal_information->race == "Native Hawaiian"){ echo "selected";} ?> value="Native Hawaiian">Native Hawaiian</option>



                                        <option <?php if($personal_information->race == "Pacific Islander"){ echo "selected";} ?> value="Pacific Islander">Pacific Islander</option>



                                        <option <?php if($personal_information->race == "White or Caucasian"){ echo "selected";} ?> value="White or Caucasian">White or Caucasian</option>



                                        <option <?php if($personal_information->race == "Other"){ echo "selected";} ?> value="Other">Other</option>



                                        <option <?php if($personal_information->race == "Prefer Not To Answer"){ echo "selected";} ?> value="Prefer Not To Answer">Prefer Not To Answer</option>



                         </select>



                         <p class="msg">NCCAA Statistics</p>



                     </div>



                 </div>



                 



                 <div class="row">



                     <div class="col4">



                         <label>Ethnicity</label>



                            <select data-validation="required" id="ethnicity_id" oninvalid="this.setCustomValidity('Please Select Ethnicity')" oninput="this.setCustomValidity('')" class="form-input" minlength="5" maxlength="50" "Ethnicity (Hispanic)" name="ethnicity" onchange="ethnicity_val(this.value)">



                                <option value="">Select Ethnicity</option>



                            	<option <?php if($personal_information->ethnicity == "African-American") { echo "selected"; } ?> value="African-American">African-American</option>



                            	<option <?php if($personal_information->ethnicity == "American") { echo "selected"; } ?> value="American">American</option>



                            	<option <?php if($personal_information->ethnicity == "Dutch") { echo "selected"; } ?> value="Dutch">Dutch</option>



                            <option <?php if($personal_information->ethnicity == "English") { echo "selected"; } ?> value="English">English</option>



                            <option <?php if($personal_information->ethnicity == "French") { echo "selected"; } ?> value="French">French</option>



                            <option <?php if($personal_information->ethnicity == "German") { echo "selected"; } ?> value="German">German</option>



                            <option <?php if($personal_information->ethnicity == "Irish") { echo "selected"; } ?> value="Irish">Irish</option>



                            <option <?php if($personal_information->ethnicity == "Italian") { echo "selected"; } ?> value="Italian">Italian</option>



                            <option <?php if($personal_information->ethnicity == "Mexican") { echo "selected"; } ?> value="Mexican">Mexican</option>



                         	<option <?php if($personal_information->ethnicity == "Norwegian") { echo "selected"; } ?> value="Norwegian">Norwegian</option>



                         	<option <?php if($personal_information->ethnicity == "Polish") { echo "selected"; } ?> value="Polish">Polish</option>



                         	<option <?php if($personal_information->ethnicity == "Scottish") { echo "selected"; } ?> value="Scottish">Scottish</option>



                         	<option <?php if($personal_information->ethnicity == "Swedish") { echo "selected"; } ?> value="Swedish">Swedish</option>



                            <option <?php if($personal_information->ethnicity == "Other") { echo "selected"; } ?> value="Other">Other</option>



                         </select>



                         <p class="msg">NCCAA Statistics</p>



                     </div>



                     



                     <div class="col4">



                         <label>Other Ethnicity</label>



                         <input type="text" data-validation="required" value="<?php echo $personal_information->ethnicity_other; ?>" class="form-input" maxlength="5" "Ethnicity (Other)" id="ethnicity_other" name="ethnicity_other">



                         <p class="msg">NCCAA Statistics</p>



                     </div>



                 </div>



                 



                 <div class="row">



                     <div class="col4">



                         <label>Marital Status</label>



                         <select data-validation="required" class="form-input" onchange="" name="marital_status" id="general_info_form_field5" oninvalid="this.setCustomValidity('Please Select Status')" oninput="this.setCustomValidity('')">



                         	<option <?php if($personal_information->marital_status == "Select Marital Status"){ echo "Selected";} ?> value="">Select Marital Status</option>



                                        <option <?php if($personal_information->marital_status == "Single"){ echo "Selected";} ?> value="Single">Single</option>



                                        <option <?php if($personal_information->marital_status == "Married"){ echo "Selected";} ?> value="Married">Married</option>



                                        <option <?php if($personal_information->marital_status == "Separated"){ echo "Selected";} ?> value="Separated">Separated</option>



                                        <option <?php if($personal_information->marital_status == "Divorced"){ echo "Selected";} ?> value="Divorced">Divorced</option>



                                        <option <?php if($personal_information->marital_status == "Widowed"){ echo "Selected";} ?> value="Widowed">Widowed</option>



                         </select>



                         <p class="msg">NCCAA Statistics</p>



                     </div>



                 </div>



                 



                 <div class="submit-row">



                     <button class="save-btn" type="submit" name="personal_form_submit" id="personal_form_submit" value="Save" onclick="return confirm( 'do you want to save this changes?');"><span>(2/8)</span> SAVE</button>



                 </div>



             </form>



                </div><!--close tab2-->



                



                <div id="tab-3" class="tab-content <?php if($current == 'current3') { echo 'current'; }; ?>">



                    <form id="GeneralInfo_Form" name="GeneralInfo_Form"  action="process/tab1.php?tab=current4" enctype="multipart/form-data" method="POST">



                     <div class="row">



                     <div class="col8">



                         <label>Home Address</label>



                         <input data-validation="required" type="text" minlength="5" onchange="" id="address_info_field0" name="address_1" value="<?php echo $address_contact_information->address_1; ?>" class="form-input" "">



                     </div>



                     <div class="col4">



                         <label>Apt/Suite</label>



                         <input  data-validation="required" type="text" value="<?php echo $address_contact_information->apt_suite; ?>"  onchange="" id="address_info_field1" "" name="apt_suite" class="form-input">



                     </div>



                 </div>



                 



                 <!-- <div class="row">



                     <div class="col4">



                         <label>Apt/Suite</label>



                         <input  type="text" value="<?php echo $address_contact_information->apt_suite; ?>"  onchange="" id="address_info_field1" "" name="apt_suite" class="form-input">



                     </div>



                 </div> -->



                 



                 <div class="row">



                     <div class="col4">



                         <label>City</label>



                         <input data-validation="required" type="text" onchange="" name="city" id="address_info_field2" value="<?php echo $address_contact_information->city; ?>" class="form-input" "">



                     </div>



                     <div class="col4">



                         <label>State</label>



                            <select data-validation="required" onchange="" class="form-input" name="state"  id="address_info_field3" oninvalid="this.setCustomValidity('Please Select State')" oninput="this.setCustomValidity('')">



                         	<option value="">Select State</option>



                                        



                                        <?php



                                        //print_r($result_states);



                                        $sql_states3 = "select * from states";



                                        $result_states99 = mysqli_query($con,$sql_states3);



                                        while($rowState = mysqli_fetch_object($result_states99)){



                                    ?>



                                        <option  value="<?php echo $rowState->states;?>" <?php if($rowState->states == $address_contact_information->state) { echo "Selected";} else { echo ""; } ?>><?php echo $rowState->states;?></option>



                                    



                                    



                                        <?php }







                                        ?>



                         </select>



                     </div>



                     <div class="col4">



                         <label>Zip</label>



                         <input data-validation="required" type="text" value="<?php echo $address_contact_information->zip_code; ?>" minlength="4" onchange="" name="zip_code" "Zip Code" id="address_info_field4" class="form-input" "">



                     </div>



                 </div>



                 



                 <div class="row">



                     <div class="col8">



                         <label>Country</label>



                            <select  onchange="" class="form-input" name="country" id="address_info_field5" oninvalid="this.setCustomValidity('Please Select Country')" oninput="this.setCustomValidity('')">



                         	  <option value="">Select Country</option>



                                                        <option <?php if($address_contact_information->country == "Afghanistan"){ echo "Selected";} ?> value="Afghanistan">Afghanistan</option>



                <option <?php if($address_contact_information->country == "Åland Islands"){ echo "Selected";} ?> value="Åland Islands">Åland Islands</option>



                <option <?php if($address_contact_information->country == "Albania"){ echo "Selected";} ?> value="Albania">Albania</option>



                <option <?php if($address_contact_information->country == "Algeria"){ echo "Selected";} ?> value="Algeria">Algeria</option>



                <option <?php if($address_contact_information->country == "American Samoa"){ echo "Selected";} ?> value="American Samoa">American Samoa</option>



                <option <?php if($address_contact_information->country == "Andorra"){ echo "Selected";} ?> value="Andorra">Andorra</option>



                <option <?php if($address_contact_information->country == "Angola"){ echo "Selected";} ?> value="Angola">Angola</option>



                <option <?php if($address_contact_information->country == "Anguilla"){ echo "Selected";} ?> value="Anguilla">Anguilla</option>



                <option <?php if($address_contact_information->country == "Antarctica"){ echo "Selected";} ?> value="Antarctica">Antarctica</option>



                <option <?php if($address_contact_information->country == "Antigua and Barbuda"){ echo "Selected";} ?> value="Antigua and Barbuda">Antigua and Barbuda</option>



                <option <?php if($address_contact_information->country == "Argentina"){ echo "Selected";} ?> value="Argentina">Argentina</option>



                <option <?php if($address_contact_information->country == "Armenia"){ echo "Selected";} ?> value="Armenia">Armenia</option>



                <option <?php if($address_contact_information->country == "Aruba"){ echo "Selected";} ?> value="Aruba">Aruba</option>



                <option <?php if($address_contact_information->country == "Australia"){ echo "Selected";} ?> value="Australia">Australia</option>



                <option <?php if($address_contact_information->country == "Austria"){ echo "Selected";} ?> value="Austria">Austria</option>



                <option <?php if($address_contact_information->country == "Azerbaijan"){ echo "Selected";} ?> value="Azerbaijan">Azerbaijan</option>



                <option <?php if($address_contact_information->country == "Bahamas"){ echo "Selected";} ?> value="Bahamas">Bahamas</option>



                <option <?php if($address_contact_information->country == "Bahrain"){ echo "Selected";} ?> value="Bahrain">Bahrain</option>



                <option <?php if($address_contact_information->country == "Bangladesh"){ echo "Selected";} ?> value="Bangladesh">Bangladesh</option>



                <option <?php if($address_contact_information->country == "Barbados"){ echo "Selected";} ?> value="Barbados">Barbados</option>



                <option <?php if($address_contact_information->country == "Belarus"){ echo "Selected";} ?> value="Belarus">Belarus</option>



                <option <?php if($address_contact_information->country == "Belgium"){ echo "Selected";} ?> value="Belgium">Belgium</option>



                <option <?php if($address_contact_information->country == "Belize"){ echo "Selected";} ?> value="Belize">Belize</option>



                <option <?php if($address_contact_information->country == "Benin"){ echo "Selected";} ?> value="Benin">Benin</option>



                <option <?php if($address_contact_information->country == "Bermuda"){ echo "Selected";} ?> value="Bermuda">Bermuda</option>



                <option <?php if($address_contact_information->country == "Bhutan"){ echo "Selected";} ?> value="Bhutan">Bhutan</option>



                <option <?php if($address_contact_information->country == "Bolivia"){ echo "Selected";} ?> value="Bolivia">Bolivia</option>



                <option <?php if($address_contact_information->country == "Bosnia and Herzegovina"){ echo "Selected";} ?> value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>



                <option <?php if($address_contact_information->country == "Botswana"){ echo "Selected";} ?> value="Botswana">Botswana</option>



                <option <?php if($address_contact_information->country == "Bouvet Island"){ echo "Selected";} ?> value="Bouvet Island">Bouvet Island</option>



                <option <?php if($address_contact_information->country == "Brazil"){ echo "Selected";} ?> value="Brazil">Brazil</option>



                <option <?php if($address_contact_information->country == "British Indi"){ echo "Selected";} ?> value="British Indian Ocean Territory">British Indian Ocean Territory</option>



                <option <?php if($address_contact_information->country == "Brunei Darussalam"){ echo "Selected";} ?> value="Brunei Darussalam">Brunei Darussalam</option>



                <option <?php if($address_contact_information->country == "Bulgaria"){ echo "Selected";} ?> value="Bulgaria">Bulgaria</option>



                <option <?php if($address_contact_information->country == "Burkina Faso"){ echo "Selected";} ?> value="Burkina Faso">Burkina Faso</option>



                <option <?php if($address_contact_information->country == "Burundi"){ echo "Selected";} ?> value="Burundi">Burundi</option>



                <option <?php if($address_contact_information->country == "Cambodia"){ echo "Selected";} ?> value="Cambodia">Cambodia</option>



                <option <?php if($address_contact_information->country == "Cameroon"){ echo "Selected";} ?> value="Cameroon">Cameroon</option>



                <option <?php if($address_contact_information->country == "Canada"){ echo "Selected";} ?> value="Canada">Canada</option>



                <option <?php if($address_contact_information->country == "Cape Verde"){ echo "Selected";} ?> value="Cape Verde">Cape Verde</option>



                <option <?php if($address_contact_information->country == "Cayman Islands"){ echo "Selected";} ?> value="Cayman Islands">Cayman Islands</option>



                <option <?php if($address_contact_information->country == "Central African Republic"){ echo "Selected";} ?> value="Central African Republic">Central African Republic</option>



                <option <?php if($address_contact_information->country == "Chad"){ echo "Selected";} ?> value="Chad">Chad</option>



                <option <?php if($address_contact_information->country == "Chile"){ echo "Selected";} ?> value="Chile">Chile</option>



                <option <?php if($address_contact_information->country == "China"){ echo "Selected";} ?> value="China">China</option>



                <option <?php if($address_contact_information->country == "Christmas Island"){ echo "Selected";} ?> value="Christmas Island">Christmas Island</option>



                <option <?php if($address_contact_information->country == "Cocos (Keeling) Islands"){ echo "Selected";} ?> value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>



                <option <?php if($address_contact_information->country == "Colombia"){ echo "Selected";} ?> value="Colombia">Colombia</option>



                <option <?php if($address_contact_information->country == "Comoros"){ echo "Selected";} ?> value="Comoros">Comoros</option>



                <option <?php if($address_contact_information->country == "Congo"){ echo "Selected";} ?> value="Congo">Congo</option>



                <option <?php if($address_contact_information->country == "Co"){ echo "Selected";} ?> value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>



                <option <?php if($address_contact_information->country == "Cook Islands"){ echo "Selected";} ?> value="Cook Islands">Cook Islands</option>



                <option <?php if($address_contact_information->country == "Costa Rica"){ echo "Selected";} ?> value="Costa Rica">Costa Rica</option>



                <option <?php if($address_contact_information->country == "Cote D'ivoire"){ echo "Selected";} ?> value="Cote D'ivoire">Cote D'ivoire</option>



                <option <?php if($address_contact_information->country == "Croatia"){ echo "Selected";} ?> value="Croatia">Croatia</option>



                <option <?php if($address_contact_information->country == "Cuba"){ echo "Selected";} ?> value="Cuba">Cuba</option>



                <option <?php if($address_contact_information->country == "Cyprus"){ echo "Selected";} ?> value="Cyprus">Cyprus</option>



                <option <?php if($address_contact_information->country == "Czech Republic"){ echo "Selected";} ?> value="Czech Republic">Czech Republic</option>



                <option <?php if($address_contact_information->country == "Denmark"){ echo "Selected";} ?> value="Denmark">Denmark</option>



                <option <?php if($address_contact_information->country == "Djibouti"){ echo "Selected";} ?> value="Djibouti">Djibouti</option>



                <option <?php if($address_contact_information->country == "Dominica"){ echo "Selected";} ?> value="Dominica">Dominica</option>



                <option <?php if($address_contact_information->country == "Dominican Republic"){ echo "Selected";} ?> value="Dominican Republic">Dominican Republic</option>



                <option <?php if($address_contact_information->country == "Ecuador"){ echo "Selected";} ?> value="Ecuador">Ecuador</option>



                <option <?php if($address_contact_information->country == "Egypt"){ echo "Selected";} ?> value="Egypt">Egypt</option>



                <option <?php if($address_contact_information->country == "El Salvador"){ echo "Selected";} ?> value="El Salvador">El Salvador</option>



                <option <?php if($address_contact_information->country == "Equatorial Guinea"){ echo "Selected";} ?> value="Equatorial Guinea">Equatorial Guinea</option>



                <option <?php if($address_contact_information->country == "Eritrea"){ echo "Selected";} ?> value="Eritrea">Eritrea</option>



                <option <?php if($address_contact_information->country == "Estonia"){ echo "Selected";} ?> value="Estonia">Estonia</option>



                <option <?php if($address_contact_information->country == "Ethiopia"){ echo "Selected";} ?> value="Ethiopia">Ethiopia</option>



                <option <?php if($address_contact_information->country == "Falkland "){ echo "Selected";} ?> value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>



                <option <?php if($address_contact_information->country == "Faroe Islands"){ echo "Selected";} ?> value="Faroe Islands">Faroe Islands</option>



                <option <?php if($address_contact_information->country == "Fiji"){ echo "Selected";} ?> value="Fiji">Fiji</option>



                <option <?php if($address_contact_information->country == "Finland"){ echo "Selected";} ?> value="Finland">Finland</option>



                <option <?php if($address_contact_information->country == "France"){ echo "Selected";} ?> value="France">France</option>



                <option <?php if($address_contact_information->country == "French Guiana"){ echo "Selected";} ?> value="French Guiana">French Guiana</option>



                <option <?php if($address_contact_information->country == "French Polynesia"){ echo "Selected";} ?> value="French Polynesia">French Polynesia</option>



                <option <?php if($address_contact_information->country == "French "){ echo "Selected";} ?> value="French Southern Territories">French Southern Territories</option>



                <option <?php if($address_contact_information->country == "Gabon"){ echo "Selected";} ?> value="Gabon">Gabon</option>



                <option <?php if($address_contact_information->country == "Gambia"){ echo "Selected";} ?> value="Gambia">Gambia</option>



                <option <?php if($address_contact_information->country == "Georgia"){ echo "Selected";} ?> value="Georgia">Georgia</option>



                <option <?php if($address_contact_information->country == "Germany"){ echo "Selected";} ?> value="Germany">Germany</option>



                <option <?php if($address_contact_information->country == "Ghana"){ echo "Selected";} ?> value="Ghana">Ghana</option>



                <option <?php if($address_contact_information->country == "Gibraltar"){ echo "Selected";} ?> value="Gibraltar">Gibraltar</option>



                <option <?php if($address_contact_information->country == "Greece"){ echo "Selected";} ?> value="Greece">Greece</option>



                <option <?php if($address_contact_information->country == "Greenland"){ echo "Selected";} ?> value="Greenland">Greenland</option>



                <option <?php if($address_contact_information->country == "Grenada"){ echo "Selected";} ?> value="Grenada">Grenada</option>



                <option <?php if($address_contact_information->country == "Guadeloupe"){ echo "Selected";} ?> value="Guadeloupe">Guadeloupe</option>



                <option <?php if($address_contact_information->country == "Guam"){ echo "Selected";} ?> value="Guam">Guam</option>



                <option <?php if($address_contact_information->country == "Guatemala"){ echo "Selected";} ?> value="Guatemala">Guatemala</option>



                <option <?php if($address_contact_information->country == "Guernsey"){ echo "Selected";} ?> value="Guernsey">Guernsey</option>



                <option <?php if($address_contact_information->country == "Guinea"){ echo "Selected";} ?> value="Guinea">Guinea</option>



                <option <?php if($address_contact_information->country == "Guinea-bissau"){ echo "Selected";} ?> value="Guinea-bissau">Guinea-bissau</option>



                <option <?php if($address_contact_information->country == "Guyana"){ echo "Selected";} ?> value="Guyana">Guyana</option>



                <option <?php if($address_contact_information->country == "Haiti"){ echo "Selected";} ?> value="Haiti">Haiti</option>



                <option <?php if($address_contact_information->country == "Heard Is"){ echo "Selected";} ?> value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>



                <option <?php if($address_contact_information->country == "Holy See (Vati"){ echo "Selected";} ?> value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>



                <option <?php if($address_contact_information->country == "Honduras"){ echo "Selected";} ?> value="Honduras">Honduras</option>



                <option <?php if($address_contact_information->country == "Hong Kong"){ echo "Selected";} ?> value="Hong Kong">Hong Kong</option>



                <option <?php if($address_contact_information->country == "Hungary"){ echo "Selected";} ?> value="Hungary">Hungary</option>



                <option <?php if($address_contact_information->country == "Iceland"){ echo "Selected";} ?> value="Iceland">Iceland</option>



                <option <?php if($address_contact_information->country == "India"){ echo "Selected";} ?> value="India">India</option>



                <option <?php if($address_contact_information->country == "Indonesia"){ echo "Selected";} ?> value="Indonesia">Indonesia</option>



                <option <?php if($address_contact_information->country == "Iran, Islamic "){ echo "Selected";} ?> value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>



                <option <?php if($address_contact_information->country == "Iraq"){ echo "Selected";} ?> value="Iraq">Iraq</option>



                <option <?php if($address_contact_information->country == "Ireland"){ echo "Selected";} ?> value="Ireland">Ireland</option>



                <option <?php if($address_contact_information->country == "Isle of Man"){ echo "Selected";} ?> value="Isle of Man">Isle of Man</option>



                <option <?php if($address_contact_information->country == "Israel"){ echo "Selected";} ?> value="Israel">Israel</option>



                <option <?php if($address_contact_information->country == "Italy"){ echo "Selected";} ?> value="Italy">Italy</option>



                <option <?php if($address_contact_information->country == "Jamaica"){ echo "Selected";} ?> value="Jamaica">Jamaica</option>



                <option <?php if($address_contact_information->country == "Japan"){ echo "Selected";} ?> value="Japan">Japan</option>



                <option <?php if($address_contact_information->country == "Jersey"){ echo "Selected";} ?> value="Jersey">Jersey</option>



                <option <?php if($address_contact_information->country == "Jordan"){ echo "Selected";} ?> value="Jordan">Jordan</option>



                <option <?php if($address_contact_information->country == "Kazakhstan"){ echo "Selected";} ?> value="Kazakhstan">Kazakhstan</option>



                <option <?php if($address_contact_information->country == "Kenya"){ echo "Selected";} ?> value="Kenya">Kenya</option>



                <option <?php if($address_contact_information->country == "Kiribati"){ echo "Selected";} ?> value="Kiribati">Kiribati</option>



                <option <?php if($address_contact_information->country == "Korea, De"){ echo "Selected";} ?> value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>



                <option <?php if($address_contact_information->country == "Korea, Republic of"){ echo "Selected";} ?> value="Korea, Republic of">Korea, Republic of</option>



                <option <?php if($address_contact_information->country == "Kuwait"){ echo "Selected";} ?> value="Kuwait">Kuwait</option>



                <option <?php if($address_contact_information->country == "Kyrgyzstan"){ echo "Selected";} ?> value="Kyrgyzstan">Kyrgyzstan</option>



                <option <?php if($address_contact_information->country == "Lao People's De"){ echo "Selected";} ?> value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>



                <option <?php if($address_contact_information->country == "Latvia"){ echo "Selected";} ?> value="Latvia">Latvia</option>



                <option <?php if($address_contact_information->country == "Lebanon"){ echo "Selected";} ?> value="Lebanon">Lebanon</option>



                <option <?php if($address_contact_information->country == "Lesotho"){ echo "Selected";} ?> value="Lesotho">Lesotho</option>



                <option <?php if($address_contact_information->country == "Liberia"){ echo "Selected";} ?> value="Liberia">Liberia</option>



                <option <?php if($address_contact_information->country == "Libyan Arab Jamahiriya"){ echo "Selected";} ?> value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>



                <option <?php if($address_contact_information->country == "Liechtenstein"){ echo "Selected";} ?> value="Liechtenstein">Liechtenstein</option>



                <option <?php if($address_contact_information->country == "Lithuania"){ echo "Selected";} ?> value="Lithuania">Lithuania</option>



                <option <?php if($address_contact_information->country == "Luxembourg"){ echo "Selected";} ?> value="Luxembourg">Luxembourg</option>



                <option <?php if($address_contact_information->country == "Macao"){ echo "Selected";} ?> value="Macao">Macao</option>



                <option <?php if($address_contact_information->country == "Macedo"){ echo "Selected";} ?> value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>



                <option <?php if($address_contact_information->country == "Madagascar"){ echo "Selected";} ?> value="Madagascar">Madagascar</option>



                <option <?php if($address_contact_information->country == "Malawi"){ echo "Selected";} ?> value="Malawi">Malawi</option>



                <option <?php if($address_contact_information->country == "Malaysia"){ echo "Selected";} ?> value="Malaysia">Malaysia</option>



                <option <?php if($address_contact_information->country == "Maldives"){ echo "Selected";} ?> value="Maldives">Maldives</option>



                <option <?php if($address_contact_information->country == "Mali"){ echo "Selected";} ?> value="Mali">Mali</option>



                <option <?php if($address_contact_information->country == "Malta"){ echo "Selected";} ?> value="Malta">Malta</option>



                <option <?php if($address_contact_information->country == "Marshall Islands"){ echo "Selected";} ?> value="Marshall Islands">Marshall Islands</option>



                <option <?php if($address_contact_information->country == "Martinique"){ echo "Selected";} ?> value="Martinique">Martinique</option>



                <option <?php if($address_contact_information->country == "Mauritania"){ echo "Selected";} ?> value="Mauritania">Mauritania</option>



                <option <?php if($address_contact_information->country == "Mauritius"){ echo "Selected";} ?> value="Mauritius">Mauritius</option>



                <option <?php if($address_contact_information->country == "Mayotte"){ echo "Selected";} ?> value="Mayotte">Mayotte</option>



                <option <?php if($address_contact_information->country == "Mexico"){ echo "Selected";} ?> value="Mexico">Mexico</option>



                <option <?php if($address_contact_information->country == "Micronesia, F"){ echo "Selected";} ?> value="Micronesia, Federated States of">Micronesia, Federated States of</option>



                <option <?php if($address_contact_information->country == "Moldova, Republic of"){ echo "Selected";} ?> value="Moldova, Republic of">Moldova, Republic of</option>



                <option <?php if($address_contact_information->country == "Monaco"){ echo "Selected";} ?> value="Monaco">Monaco</option>



                <option <?php if($address_contact_information->country == "Mongolia"){ echo "Selected";} ?> value="Mongolia">Mongolia</option>



                <option <?php if($address_contact_information->country == "Montenegro"){ echo "Selected";} ?> value="Montenegro">Montenegro</option>



                <option <?php if($address_contact_information->country == "Montserrat"){ echo "Selected";} ?> value="Montserrat">Montserrat</option>



                <option <?php if($address_contact_information->country == "Morocco"){ echo "Selected";} ?> value="Morocco">Morocco</option>



                <option <?php if($address_contact_information->country == "Mozambique"){ echo "Selected";} ?> value="Mozambique">Mozambique</option>



                <option <?php if($address_contact_information->country == "Myanmar"){ echo "Selected";} ?> value="Myanmar">Myanmar</option>



                <option <?php if($address_contact_information->country == "Namibia"){ echo "Selected";} ?> value="Namibia">Namibia</option>



                <option <?php if($address_contact_information->country == "Nauru"){ echo "Selected";} ?> value="Nauru">Nauru</option>



                <option <?php if($address_contact_information->country == "Nepal"){ echo "Selected";} ?> value="Nepal">Nepal</option>



                <option <?php if($address_contact_information->country == "Netherlands"){ echo "Selected";} ?> value="Netherlands">Netherlands</option>



                <option <?php if($address_contact_information->country == "Netherlands Antilles"){ echo "Selected";} ?> value="Netherlands Antilles">Netherlands Antilles</option>



                <option <?php if($address_contact_information->country == "New Caledonia"){ echo "Selected";} ?> value="New Caledonia">New Caledonia</option>



                <option <?php if($address_contact_information->country == "New Zealand"){ echo "Selected";} ?> value="New Zealand">New Zealand</option>



                <option <?php if($address_contact_information->country == "Nicaragua"){ echo "Selected";} ?> value="Nicaragua">Nicaragua</option>



                <option <?php if($address_contact_information->country == "Niger"){ echo "Selected";} ?> value="Niger">Niger</option>



                <option <?php if($address_contact_information->country == "Nigeria"){ echo "Selected";} ?> value="Nigeria">Nigeria</option>



                <option <?php if($address_contact_information->country == "Niue"){ echo "Selected";} ?> value="Niue">Niue</option>



                <option <?php if($address_contact_information->country == "Norfolk Island"){ echo "Selected";} ?> value="Norfolk Island">Norfolk Island</option>



                <option <?php if($address_contact_information->country == "Northern Mariana Islands"){ echo "Selected";} ?> value="Northern Mariana Islands">Northern Mariana Islands</option>



                <option <?php if($address_contact_information->country == "Norway"){ echo "Selected";} ?> value="Norway">Norway</option>



                <option <?php if($address_contact_information->country == "Oman"){ echo "Selected";} ?> value="Oman">Oman</option>



                <option <?php if($address_contact_information->country == "Pakistan"){ echo "Selected";} ?> value="Pakistan">Pakistan</option>



                <option <?php if($address_contact_information->country == "Palau"){ echo "Selected";} ?> value="Palau">Palau</option>



                <option <?php if($address_contact_information->country == "Palestinian Te"){ echo "Selected";} ?> value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>



                <option <?php if($address_contact_information->country == "Panama"){ echo "Selected";} ?> value="Panama">Panama</option>



                <option <?php if($address_contact_information->country == "Papua New Guinea"){ echo "Selected";} ?> value="Papua New Guinea">Papua New Guinea</option>



                <option <?php if($address_contact_information->country == "Paraguay"){ echo "Selected";} ?> value="Paraguay">Paraguay</option>



                <option <?php if($address_contact_information->country == "Peru"){ echo "Selected";} ?> value="Peru">Peru</option>



                <option <?php if($address_contact_information->country == "Philippines"){ echo "Selected";} ?> value="Philippines">Philippines</option>



                <option <?php if($address_contact_information->country == "Pitcairn"){ echo "Selected";} ?> value="Pitcairn">Pitcairn</option>



                <option <?php if($address_contact_information->country == "Poland"){ echo "Selected";} ?> value="Poland">Poland</option>



                <option <?php if($address_contact_information->country == "Portugal"){ echo "Selected";} ?> value="Portugal">Portugal</option>



                <option <?php if($address_contact_information->country == "Puerto Rico"){ echo "Selected";} ?> value="Puerto Rico">Puerto Rico</option>



                <option <?php if($address_contact_information->country == "Qatar"){ echo "Selected";} ?> value="Qatar">Qatar</option>



                <option <?php if($address_contact_information->country == "Reunion"){ echo "Selected";} ?> value="Reunion">Reunion</option>



                <option <?php if($address_contact_information->country == "Romania"){ echo "Selected";} ?> value="Romania">Romania</option>



                <option <?php if($address_contact_information->country == "Russian Federation"){ echo "Selected";} ?> value="Russian Federation">Russian Federation</option>



                <option <?php if($address_contact_information->country == "Rwanda"){ echo "Selected";} ?> value="Rwanda">Rwanda</option>



                <option <?php if($address_contact_information->country == "Saint Helena"){ echo "Selected";} ?> value="Saint Helena">Saint Helena</option>



                <option <?php if($address_contact_information->country == "Saint Kitts and Nevis"){ echo "Selected";} ?> value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>



                <option <?php if($address_contact_information->country == "Saint Lucia"){ echo "Selected";} ?> value="Saint Lucia">Saint Lucia</option>



                <option <?php if($address_contact_information->country == "Saint Pi"){ echo "Selected";} ?> value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>



                <option <?php if($address_contact_information->country == "Saint Vincent"){ echo "Selected";} ?> value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>



                <option <?php if($address_contact_information->country == "Samoa"){ echo "Selected";} ?> value="Samoa">Samoa</option>



                <option <?php if($address_contact_information->country == "San Marino"){ echo "Selected";} ?> value="San Marino">San Marino</option>



                <option <?php if($address_contact_information->country == "Sao Tome and Principe"){ echo "Selected";} ?> value="Sao Tome and Principe">Sao Tome and Principe</option>



                <option <?php if($address_contact_information->country == "Saudi Arabia"){ echo "Selected";} ?> value="Saudi Arabia">Saudi Arabia</option>



                <option <?php if($address_contact_information->country == "Senegal"){ echo "Selected";} ?> value="Senegal">Senegal</option>



                <option <?php if($address_contact_information->country == "Serbia"){ echo "Selected";} ?> value="Serbia">Serbia</option>



                <option <?php if($address_contact_information->country == "Seychelles"){ echo "Selected";} ?> value="Seychelles">Seychelles</option>



                <option <?php if($address_contact_information->country == "Sierra Leone"){ echo "Selected";} ?> value="Sierra Leone">Sierra Leone</option>



                <option <?php if($address_contact_information->country == "Singapore"){ echo "Selected";} ?> value="Singapore">Singapore</option>



                <option <?php if($address_contact_information->country == "Slovakia"){ echo "Selected";} ?> value="Slovakia">Slovakia</option>



                <option <?php if($address_contact_information->country == "Slovenia"){ echo "Selected";} ?> value="Slovenia">Slovenia</option>



                <option <?php if($address_contact_information->country == "Solomon Islands"){ echo "Selected";} ?> value="Solomon Islands">Solomon Islands</option>



                <option <?php if($address_contact_information->country == "Somalia"){ echo "Selected";} ?> value="Somalia">Somalia</option>



                <option <?php if($address_contact_information->country == "South Africa"){ echo "Selected";} ?> value="South Africa">South Africa</option>



                <option <?php if($address_contact_information->country == "South Georgia and The South Sandwich Islands"){ echo "Selected";} ?> value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>



                <option <?php if($address_contact_information->country == "Spain"){ echo "Selected";} ?> value="Spain">Spain</option>



                <option <?php if($address_contact_information->country == "Sri Lanka"){ echo "Selected";} ?> value="Sri Lanka">Sri Lanka</option>



                <option <?php if($address_contact_information->country == "Sudan"){ echo "Selected";} ?> value="Sudan">Sudan</option>



                <option <?php if($address_contact_information->country == "Suriname"){ echo "Selected";} ?> value="Suriname">Suriname</option>



                <option <?php if($address_contact_information->country == "Svalbard and Jan Mayen"){ echo "Selected";} ?> value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>



                <option <?php if($address_contact_information->country == "Swaziland"){ echo "Selected";} ?> value="Swaziland">Swaziland</option>



                <option <?php if($address_contact_information->country == "Sweden"){ echo "Selected";} ?> value="Sweden">Sweden</option>



                <option <?php if($address_contact_information->country == "Switzerland"){ echo "Selected";} ?> value="Switzerland">Switzerland</option>



                <option <?php if($address_contact_information->country == "Syrian Arab Republic"){ echo "Selected";} ?> value="Syrian Arab Republic">Syrian Arab Republic</option>



                <option <?php if($address_contact_information->country == "Taiwan, Pro"){ echo "Selected";} ?> value="Taiwan, Province of China">Taiwan, Province of China</option>



                <option <?php if($address_contact_information->country == "Tajikistan"){ echo "Selected";} ?> value="Tajikistan">Tajikistan</option>



                <option <?php if($address_contact_information->country == "Tanzania, United "){ echo "Selected";} ?> value="Tanzania, United Republic of">Tanzania, United Republic of</option>



                <option <?php if($address_contact_information->country == "Thailand"){ echo "Selected";} ?> value="Thailand">Thailand</option>



                <option <?php if($address_contact_information->country == "Timor-leste"){ echo "Selected";} ?> value="Timor-leste">Timor-leste</option>



                <option <?php if($address_contact_information->country == "Togo"){ echo "Selected";} ?> value="Togo">Togo</option>



                <option <?php if($address_contact_information->country == "Tokelau"){ echo "Selected";} ?> value="Tokelau">Tokelau</option>



                <option <?php if($address_contact_information->country == "Tonga"){ echo "Selected";} ?> value="Tonga">Tonga</option>



                <option <?php if($address_contact_information->country == "Trinidad and Tobago"){ echo "Selected";} ?> value="Trinidad and Tobago">Trinidad and Tobago</option>



                <option <?php if($address_contact_information->country == "Tunisia"){ echo "Selected";} ?> value="Tunisia">Tunisia</option>



                <option <?php if($address_contact_information->country == "Turkey"){ echo "Selected";} ?> value="Turkey">Turkey</option>



                <option <?php if($address_contact_information->country == "Turkmenistan"){ echo "Selected";} ?> value="Turkmenistan">Turkmenistan</option>



                <option <?php if($address_contact_information->country == "Turks and Caicos Islands"){ echo "Selected";} ?> value="Turks and Caicos Islands">Turks and Caicos Islands</option>



                <option <?php if($address_contact_information->country == "Tuvalu"){ echo "Selected";} ?> value="Tuvalu">Tuvalu</option>



                <option <?php if($address_contact_information->country == "Uganda"){ echo "Selected";} ?> value="Uganda">Uganda</option>



                <option <?php if($address_contact_information->country == "Ukraine"){ echo "Selected";} ?> value="Ukraine">Ukraine</option>



                <option <?php if($address_contact_information->country == "United Arab Emirates"){ echo "Selected";} ?> value="United Arab Emirates">United Arab Emirates</option>



                <option <?php if($address_contact_information->country == "United Kingdom"){ echo "Selected";} ?> value="United Kingdom">United Kingdom</option>



                <option <?php if(empty($address_contact_information->country) || $address_contact_information->country == "United States"){ echo "Selected";} ?> value="United States">United States</option>



                <option <?php if($address_contact_information->country == "United States Minor Outlying Islands"){ echo "Selected";} ?> value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>



                <option <?php if($address_contact_information->country == "Uruguay"){ echo "Selected";} ?> value="Uruguay">Uruguay</option>



                <option <?php if($address_contact_information->country == "Uzbekistan"){ echo "Selected";} ?> value="Uzbekistan">Uzbekistan</option>



                <option <?php if($address_contact_information->country == "Vanuatu"){ echo "Selected";} ?> value="Vanuatu">Vanuatu</option>



                <option <?php if($address_contact_information->country == "Venezuela"){ echo "Selected";} ?> value="Venezuela">Venezuela</option>



                <option <?php if($address_contact_information->country == "Viet Nam"){ echo "Selected";} ?> value="Viet Nam">Viet Nam</option>



                <option <?php if($address_contact_information->country == "Virgin Islands, British"){ echo "Selected";} ?> value="Virgin Islands, British">Virgin Islands, British</option>



                <option <?php if($address_contact_information->country == "Virgin Islands, U.S."){ echo "Selected";} ?> value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>



                <option <?php if($address_contact_information->country == "Wallis and Futuna"){ echo "Selected";} ?> value="Wallis and Futuna">Wallis and Futuna</option>



                <option <?php if($address_contact_information->country == "Western Sahara"){ echo "Selected";} ?> value="Western Sahara">Western Sahara</option>



                <option <?php if($address_contact_information->country == "Yemen"){ echo "Selected";} ?> value="Yemen">Yemen</option>



                <option <?php if($address_contact_information->country == "Zambia"){ echo "Selected";} ?> value="Zambia">Zambia</option>



                <option <?php if($address_contact_information->country == "Zimbabwe"){ echo "Selected";} ?> value="Zimbabwe">Zimbabwe</option>



                         </select>



                     </div>



                 </div>



                 



                 <div class="row">



                     <div class="col4">



                         <label>Cell #</label>



                         <input data-validation="required" type="text" value="<?php echo $address_contact_information->cell_phone; ?>" onchange="" name="cell_phone" id="address_info_field6" class="phone form-input">



                     </div>



                  </div>



                    <div class="row">



                     <div class="col4">



                         <label>Business #</label>



                         <input  type="text" value="<?php echo $address_contact_information->business_phone; ?>" onchange="" name="business_phone" id="address_info_field7" class="phone form-input" "">



                     </div>



                     <div class="col4">



                         <label>Home #</label>



                         <input  type="text" value="<?php echo $address_contact_information->home_phone; ?>" onchange="" name="home_phone" "" class="phone form-input" id="address_info_field8">



                     </div>



                 </div>



                



                 <div class="row">



                     <div class="col4">



                         <label>Other #</label>



                         <input  type="text" value="<?php echo $address_contact_information->other_phone; ?>" onchange="" name="other_phone" "" class="phone form-input" id="address_info_field9">



                     </div>



                 </div>



                 



                 <div class="row">



                     <div class="col4">



                         <label> Additional Email #2 </label>



                         <input data-validation="required" type="email" onchange="" value="<?php echo $address_contact_information->email_default; ?>" name="email_default" id="address_info_field10" class="form-input" "">

                       <p class="msg">Additional Email #2 and #3 below are different than the email used for logging in. We will primarily use the main Email #1 for communication but CAAs constantly change emails due to job, personal or lifestyle changes. This will enable us to continue sending alerts or updates regarding your exams or CMEs</p>

                    </div>





                     <div class="col4">



                         <label>Confirm Email #2</label>



                         <input data-validation="required" type="email" onchange="" name="confirm_email" value="<?php echo $address_contact_information->confirm_email; ?>" id="address_info_field11" class="form-input" "" oninput="check_email(this)">



                     </div>



                     <script language='javascript' type='text/javascript'>



                        function check_email(input) {



                        if (input.value != document.getElementById('address_info_field10').value) {



                          input.setCustomValidity('Email Must be Matching.');



                         } else {



                             // input is valid -- reset the error message



                             input.setCustomValidity('');



                          }



                        }



                    </script>



                 </div>



                 



                 <div class="row">



                     <div class="col4">



                         <label> Additional Email #3</label>



                         <input  type="email" onchange="" name="email_default2" value="<?php echo $address_contact_information->email_default2; ?>" id="address_info_field12" class="form-input" "">



                     </div>



                     <div class="col4">



                         <label>Confirm Email #3</label>



                         <input  type="email" onchange="" value="<?php echo $address_contact_information->confirm_email2; ?>" name="confirm_email2"  id="address_info_field13" class="form-input" "" oninput="check_email2(this)">



                     </div>



                     <script language='javascript' type='text/javascript'>



                        function check_email2(input) {



                        if (input.value != document.getElementById('address_info_field12').value) {



                          input.setCustomValidity('Email Must be Matching.');



                         } else {



                             // input is valid -- reset the error message



                             input.setCustomValidity('');



                          }



                        }



                    </script>



                 </div>



                 



                 



                 <div class="submit-row">



                     <button type="submit" name="contact_info_submit" value="Save" class="save-btn" onclick="return confirm( 'do you want to save this changes?');"><span>(3/10)</span> SAVE</button>



                 </div>



             </form>



                </div><!--close tab3-->



                



                <div id="tab-4" class="tab-content <?php if($current == 'current4') { echo 'current'; }; ?>">



                <form id="GeneralInfo_Form" name="GeneralInfo_Form"  action="process/tab1.php?tab=current5" enctype="multipart/form-data" method="POST">



                    <p class="pera1">This page is the current program information (not your personal or individual program information from when you graduated). On page 1, you selected your Alma Mater, which then auto-populated this page with the MOST current program information available provided by the current program directors. Many CAAs contact us regarding certain information about their Alma Mater and as a

                    service we asked all program directors to provide us the latest

                    information for our members to use when needed. Our most senior

                    CAAs will notice that certain fields will be empty, 1st year certified,

                    previous program director, etc. Please note that we are aware that

                    senior CAAs will not show the information from when they

                    graduated.</p>



                    



                    <div class="row">



                     <div class="col8">



                         <label>Name of University Graduation</label>



                            <input data-validation="required" id="program_university_0" onchange="" type="text" name="university" class="form-input bg-input">

                      </div>



                 </div>



                 



                 <div class="row">



                     <div class="col4">



                         <label>Institution Unique Identifier</label>



                         <?php 

                         

						$sql10211 = "select * from tbl_university where id=".$tab4_info->university_id;



                        $result1033 = mysqli_query($con,$sql10211);



                        $tab_433 = mysqli_fetch_object($result1033);

                         ?>



                         <input data-validation="required" id="program_university_1" onchange="" type="text" value="<?php echo $tab_433->University_Code; ?>" name="univerisity_code" class="form-input bg-input" "12345">



                     </div>



                     <div class="col4">



                         <label>Program Length</label>



                         <?php 



                         $sql102112 = "select * from tbl_program_details where University_Id=".$tab4_info->university_id;



                          $result10332 = mysqli_query($con,$sql102112);



                          $tab_4332 = mysqli_fetch_object($result10332);



                         ?>



                         <input data-validation="required" id="program_university_12" onchange="" type="text" value="<?php echo $tab_4332->Program_Length; ?>" name="program_length" class="form-input bg-input" "2 years, 3 Months">



                     </div>



                 </div>



                 



                 <!-- <div class="row">



                     <div class="col4">



                         <label>Program Length</label>



                         <?php 



                         $sql102112 = "select * from tbl_program_details where University_Id=".$tab4_info->university_id;



                          $result10332 = mysqli_query($con,$sql102112);



                          $tab_4332 = mysqli_fetch_object($result10332);



                         ?>



                         <input data-validation="required" id="program_university_12" onchange="" type="text" value="<?php echo $tab_4332->Program_Length; ?>" name="program_length" class="form-input bg-input" "2 years, 3 Months">



                     </div>



                 </div> -->



                 



                 



                 <div class="row">



                     <div class="col4">



                         <label>Graduation Date (or Year)</label>



                         <?php 



                         $sql1021122 = "select * from tbl_program_details where University_Id=".$tab4_info->university_id;



                          $result103322 = mysqli_query($con,$sql1021122);



                          $tab_43322 = mysqli_fetch_object($result103322);



                          if(!empty($tab_43322->Matriculation_Date))



                          {



                          	$Matriculation_Date = date('Y-m-d',strtotime($tab_43322->Matriculation_Date));



                          }



                          else



                          {



                          	$Matriculation_Date = "";	



                          }



                         ?>



                        <input data-validation="required" type="date" class="form-input bg-input" "09/15/99" id="program_university_16" onchange="" name="university_actual_grad_day" value="<?php echo $Matriculation_Date; ?>">



                     </div>



                     <div class="col4">

                      <span class="or">or</span>

                      



                         <label>&nbsp;</label>



                         <?php 



                           $sql10211221 = "select * from tbl_program_details where University_Id=".$tab4_info->university_id;



                            $result1033221 = mysqli_query($con,$sql10211221);



                            $tab_433221 = mysqli_fetch_object($result1033221);



                            if(!empty($tab_433221->Matriculation_Date))



                            {



                            	$Matriculation_Year = date('Y',strtotime($tab_43322->Matriculation_Date));



                            }



                            else



                            {



                            	$Matriculation_Year = "";	



                            }



                         ?>



                            <select data-validation="required" id="program_university_18" onchange="" name="university_actual_grad_year" class="form-input bg-input">



                         	<option <?php if($program_university_info->university_actual_grad_year == $Matriculation_Year) { echo "selected"; } ?> value="<?php echo $Matriculation_Year; ?>" name="day"><?php echo $Matriculation_Year; ?></option>



                         </select>



                     </div>



                 </div>



                 



                 <div class="row">



                     <div class="col4">



                     	<?php 



                         $sql1021122a = "select * from tbl_program_details where University_Id=".$tab4_info->university_id;



$result103322a = mysqli_query($con,$sql1021122a);



$tab_43322a = mysqli_fetch_object($result103322a);



                         ?>



                         <label>1st Year Certified</label>



                         <input data-validation="required" type="text" class="form-input bg-input" "1997" name="one_year_certified" value="<?php echo $tab_43322a->First_year; ?>">



                     </div>



                     <div class="col4">



                         <label># Years Certified</label>



                         <input data-validation="required" type="text" class="form-input bg-input" "21" name="years_certified" value="<?php echo $tab_43322a->years_certified; ?>">



                     </div>



                 </div>



                 



                 <div class="row">



                     <div class="col4">



                         <label>Degree</label>



                         <?php 



                         $sql1021122ad = "select * from tbl_program_details where University_Id=".$tab4_info->university_id;



$result103322ad = mysqli_query($con,$sql1021122ad);



$tab_43322ad = mysqli_fetch_object($result103322ad);



                         ?>



                         <select data-validation="required" id="program_university_20" onchange="" name="degree_type1" class="form-input bg-input">



                                        <option <?php if($program_university_info->degree_type1 == $tab_43322ad->Degree_Offered){ echo "selected";} ?> value="<?php echo $tab_43322ad->Degree_Offered; ?>"><?php echo $tab_43322ad->Degree_Offered; ?></option>



                                    </select>



                     </div>



                     <div class="col4">



                         <label>Designation</label>



                         <?php 



                         $sql1021122adr = "select * from tbl_program_details where University_Id=".$tab4_info->university_id;



$result103322adr = mysqli_query($con,$sql1021122adr);



$tab_43322adr = mysqli_fetch_object($result103322adr);



                         ?>



                            <select data-validation="required" id="program_university_23" onchange="" name="designation" class="form-input bg-input">



                                        <option <?php if($program_university_info->designation == $tab_43322adr->Designation){ echo "selected";} ?> value="<?php echo $tab_43322adr->Designation; ?>"><?php echo $tab_43322adr->Designation; ?></option>



                                    </select>



                     </div>



                     <div class="col4">



                         <label>Certificate #</label>



                         <input data-validation="required" id="program_university_24" onchange="" type="text" value="<?php echo $tab_43322adr->certificate; ?>" name="certificate" class="form-input bg-input" "572">



                     </div>



                 </div>



                 



                 <div class="row">



                     <div class="col8">



                         <label>University Address</label>



                         <?php 



                         $sql1021122adr5 = "select * from tbl_university where id=".$tab4_info->university_id;



                         



$result103322adr5 = mysqli_query($con,$sql1021122adr5);



$tab_43322adr5 = mysqli_fetch_object($result103322adr5);







                         ?>



                         <input data-validation="required" id="program_university_2" onchange="" type="text" value="<?php echo $tab_43322adr5->Program_Address_First; ?>" name="university_address" class="form-input bg-input" "201 Dowman Drive">



                     </div>



                 </div>



                 



                 



                 <div class="row">



                     <div class="col4">



                         <label>Apt / Suite</label>



                         



                         <input data-validation="required" onchange="" type="text" value="<?php echo $tab_43322adr5->Program_Suite; ?>" name="university_apt" class="form-input bg-input" "">



                     </div>



                     <div class="col4">



                         <label>City</label>



                         <input data-validation="required" id="program_university_3" onchange="" type="text" value="<?php echo $tab_43322adr5->Program_City; ?>" name="university_city" class="form-input bg-input" "Atlanta">



                     </div>



                     <div class="col4">



                         <label>State</label>



                         <select data-validation="required" id="program_university_4" onchange="" type="text" value="<?php echo $program_university_info->university_state; ?>" name="university_state" class="form-input bg-input">



                                      <option  value="<?php echo $tab_43322adr5->Program_State;?>" ><?php echo $tab_43322adr5->Program_State;?></option>  



                         </select>



                     </div>



                 </div>



                 



                 <div class="row">



                     <div class="col4">



                         <label>Zip</label>



                         <input data-validation="required" id="program_university_5" onchange="" type="text" value="<?php echo $tab_43322adr5->Program_Zip; ?>" name="university_zip_code" class="form-input bg-input" "30322">



                     </div>



                 </div>



                 



                 <div class="row">



                     <div class="col8">



                         <label>Country</label>



                         <select data-validation="required" onchange="" class="form-input bg-input" name="university_country" id="address_info_field5" oninvalid="this.setCustomValidity('Please Select Country')" oninput="this.setCustomValidity('')">



                                  <option  value="<?php echo $tab_43322adr5->Country;?>" ><?php echo $tab_43322adr5->Country;?></option> 



                                    </select>



                     </div>



                 </div>



                 



                 <div class="row">



                     <div class="col4">



                     	<?php 



                         $sql1021122adr5ww = "select * from tbl_department where University_Id=".$tab4_info->university_id;



$result103322adr5ww = mysqli_query($con,$sql1021122adr5ww);



$tab_43322adr5ww = mysqli_fetch_object($result103322adr5ww);



                         ?>



                         <label>Anesthesiology Dept. Phone #</label>



                         <input data-validation="required" id="program_university_6" onchange="" type="text"  value="<?php echo $tab_43322adr5ww->Department_Phone; ?>" name="university_phone" class="form-input bg-input" "(404) 727-5910">



                     </div>



                     <div class="col4">



                         <label>Other Phone # / Fax #</label>



                         <input data-validation="required" id="program_university_8" onchange="" type="text" value="<?php echo $tab_43322adr5ww->Fax; ?>" name="university_phone2" class="form-input bg-input" "">



                     </div>



                 </div>



                 



                 <div class="row">



                     <div class="col8">



                         <label>Anesthesiology Dept. Email</label>



                         <input data-validation="required" id="program_university_588" onchange="" type="email" value="<?php echo $tab_43322adr5ww->Department_Email; ?>" name="university_email" class="form-input bg-input" "admissions@emoryaaprogram.org">



                     </div>



                 </div>



                 



                 <div class="row">



                     <div class="col8">



                         <label>Confirm Email</label>



                         <input data-validation="required" id="program_university_5" onchange="" type="email" value="<?php echo $tab_43322adr5ww->Confirm_Email; ?>" name="university_email_conf" class="form-input bg-input" "admissions@emoryaaprogram.org" oninput="check_email3(this)">



                     </div>



                     <script language='javascript' type='text/javascript'>



                        function check_email3(input) {



                        if (input.value != document.getElementById('program_university_588').value) {



                          input.setCustomValidity('Email Must be Matching.');



                         } else {



                             // input is valid -- reset the error message



                             input.setCustomValidity('');



                          }



                        }



                    </script>



                 </div>



                 



                 <div class="row">



                     <div class="col8">



                         <label>Website URL</label>



                         <input data-validation="required" id="program_university_5" onchange="" type="text" value="<?php echo $tab_43322adr5ww->Website_URL; ?>" name="university_url" class="form-input bg-input" "http://www.anesthesiology.emory.edu/">



                     </div>



                 </div>



                 



                 <div class="row">



                     <div class="col4">



                         <label>Program Director First Name</label>



                         <?php 



                         $sql1021122adr5wwee = "select * from tbl_program_director where University_Id=".$tab4_info->university_id;



$result103322adr5wwee = mysqli_query($con,$sql1021122adr5wwee);



$tab_43322adr5wwee = mysqli_fetch_object($result103322adr5wwee);



                         ?>



                         <input data-validation="required" id="program_university_7" onchange="" type="text" value="<?php echo $tab_43322adr5wwee->First_Name; ?>" name="univeristy_program_director" class="form-input bg-input" "James">



                     </div>



                     <div class="col4">



                         <label>Program Director Last Name</label>



                         <input data-validation="required" id="program_university_7" onchange="" type="text" value="<?php echo $tab_43322adr5wwee->Last_Name; ?>" name="univeristy_program_director_last_name" class="form-input bg-input" "Hall">



                     </div>



                     <div class="col4">



                         <label>PD Designation</label>



                         <input data-validation="required" id="program_university_7" onchange="" type="text" value="<?php echo $tab_43322adr5wwee->Designation; ?>" name="univeristy_program_director_designation" class="form-input bg-input" "PD Designation">



                     </div>



                 </div>



                 



                 <div class="row">



                     <div class="col4">



                         <label>Program Title</label>



                         <input data-validation="required" id="certification_information_19" onchange="" type="text" value="<?php echo $tab_43322adr5wwee->Title; ?>" name="title_of_meeting" class="form-input bg-input" "Clinical Program Director">



                     </div>



                     <div class="col4">



                         <label>Program Director Phone #</label>



                         <input data-validation="required" id="program_university_7" onchange="" type="text" value="<?php echo $tab_43322adr5wwee->Bus_Phone; ?>" name="univeristy_program_director_phone" class="phone form-input bg-input" "">



                     </div>



                     <div class="col4">



                         <label>Program Director Email</label>



                         <input data-validation="required" id="program_university_7" onchange="" type="text" value="<?php echo $tab_43322adr5wwee->Email; ?>" name="univeristy_program_director_email" class="form-input bg-input" "">



                     </div>



                 </div>



                 



                 <div class="row">



                     <div class="col4">



                     	 <?php 



                         $sql1021122adr5wweeff = "select * from tbl_program_medical where University_Id=".$tab4_info->university_id;



$result103322adr5wweeff = mysqli_query($con,$sql1021122adr5wweeff);



$tab_43322adr5wweeff = mysqli_fetch_object($result103322adr5wweeff);



                         ?>



                         <label>Program Director First Name</label>



                         <input data-validation="required" id="program_university_7" onchange="" type="text" value="<?php echo $tab_43322adr5wweeff->First_Name; ?>" name="univeristy_program_director1" class="form-input bg-input" "Katherine">



                     </div>



                     <div class="col4">



                         <label>Program Director Last Name</label>



                         <input data-validation="required" id="program_university_7" onchange="" type="text" value="<?php echo $tab_43322adr5wweeff->Last_Name; ?>" name="univeristy_program_director_last_name" class="form-input bg-input" "Monroe">



                     </div>



                     <div class="col4">



                         <label>PD Designation</label>



                         <input data-validation="required" id="program_university_7" onchange="" type="text" value="<?php echo $tab_43322adr5wweeff->Designation; ?>" name="univeristy_program_director_designation1" class="form-input bg-input" "MMSc, PhD">



                     </div>



                 </div>



                 



                 <div class="row">



                     <div class="col4">



                         <label>Program Title</label>



                         <input data-validation="required" id="certification_information_19" onchange="" type="text" value="<?php echo $tab_43322adr5wweeff->Job_Title; ?>" name="univeristy_program_title1" class="form-input bg-input" "Academic Program Director">



                     </div>



                     <div class="col4">



                         <label>Program Director Phone #</label>



                         <input data-validation="required" id="program_university_7" onchange="" type="text" value="<?php echo $tab_43322adr5wweeff->Bus_Phone; ?>" name="univeristy_program_director_phone1" class="phone form-input bg-input" "">



                     </div>



                     <div class="col4">



                         <label>Program Director Email</label>



                         <input data-validation="required" id="program_university_7" onchange="" type="text" value="<?php echo $tab_43322adr5wweeff->Email; ?>" name="univeristy_program_director_email1" class="form-input bg-input" "">



                     </div>



                 </div>



                 



                 <div class="row">



                     <div class="col4">



                         <label>Program Director First Name</label>



                         <?php 



                         $sql1021122adr5wweeffe = "select * from tbl_regional_director where University_Id=".$tab4_info->university_id;



$result103322adr5wweeffe = mysqli_query($con,$sql1021122adr5wweeffe);



$tab_43322adr5wweeffe = mysqli_fetch_object($result103322adr5wweeffe);



                         ?>



                         <input data-validation="required" id="program_university_7" onchange="" type="text" value="<?php echo $tab_43322adr5wweeffe->First_Name; ?>" name="univeristy_program_director2" class="form-input bg-input" "">



                     </div>



                     <div class="col4">



                         <label>Program Director Last Name</label>



                         <input data-validation="required" id="program_university_7" onchange="" type="text" value="<?php echo $tab_43322adr5wweeffe->Last_Name; ?>" name="univeristy_program_director_last_name1" class="form-input bg-input" "">



                     </div>



                     <div class="col4">



                         <label>Job Title</label>



                         <input data-validation="required" id="program_university_7" onchange="" type="text" value="<?php echo $tab_43322adr5wweeffe->Job_Title; ?>" name="univeristy_program_director_designation2" class="form-input bg-input" "">



                     </div>



                 </div>



                 



                 <div class="row">



                     <div class="col4">



                         <label>Assistant Phone #</label>



                         <?php 



                         $sqlkkkk = "select * from tbl_admin_assistant where University_Id=".$tab4_info->university_id;



$sqlkkkk2 = mysqli_query($con,$sqlkkkk);



$tkk = mysqli_fetch_object($sqlkkkk2);



                         ?>



                         <input data-validation="required" id="program_university_7" onchange="" type="text" value="<?php echo $tkk->Bus_Phone; ?>" name="univeristy_assistant_phone" class="phone form-input bg-input" "">



                     </div>



                     <div class="col4">



                         <label>Assistant Email</label>



                         <input data-validation="required" id="program_university_7" onchange="" type="text" value="<?php echo $tkk->Email; ?>" name="univeristy_assistant_email" class="form-input bg-input" "">



                     </div>



                 </div>



                 



                 <div class="row">



                     <div class="col4">



                         <label>School Photo</label>



                         <?php 



                         $sqlkkkk1 = "select * from tbl_university where id=".$tab4_info->university_id;



$sqlkkkk21 = mysqli_query($con,$sqlkkkk1);



$tkk1 = mysqli_fetch_object($sqlkkkk21);



                         ?>



                         <input data-validation="required" id="program_university_7" onchange="" type="text" value="<?php echo $tkk1->Program_School_Photo_First; ?>" name="univeristy_photo1" class="form-input bg-input" "">



                      



                     </div>



                     <div class="col4">



                         <label>School Photo</label>



                         <input data-validation="required" id="program_university_7" onchange="" type="text" value="<?php echo $tkk1->Program_School_Photo_Second; ?>" name="univeristy_photo2" class="form-input bg-input" "">



                            



                     </div>



                 </div>



                 



                 



                 



                



                 



                 



                 <div class="submit-row">



                     <button class="save-btn" type="submit" name="program_uni_submit" id="program_uni_submit" value="Save">(4/10)</span> SAVE</button>



                 </div>



             </form>



                </div><!--close tab4-->



                



                <div id="tab-5" class="tab-content <?php if($current == 'current5') { echo 'current'; }; ?>">



                    <form id="GeneralInfo_Form" name="GeneralInfo_Form"  action="process/tab1.php?tab=current6" enctype="multipart/form-data" method="POST">



                    <div class="row">



                         <label class="padding-left">Date of 1st Employment After Graduation</label>



                         <div class="col4">



                             <input data-validation="required" type="date" class="form-input" "09/15/99" onchange="" id="employment_information_1" name="first_employment_date" value="<?php echo $employment_info->first_employment_date; ?>">







                         </div>



                         <div class="col4">



                                <select data-validation="required" onchange="" id="employment_information_2" name="first_employment_year" class="form-input">



                                <option value="">Select Year</option>



                                               <option <?php if($employment_info->first_employment_year == "1970") { echo "selected"; } ?> value="1970" name="day">1970</option>



                                        <option <?php if($employment_info->first_employment_year == "1971") { echo "selected"; } ?> value="1971" name="day">1971</option>



                                        <option <?php if($employment_info->first_employment_year == "1972") { echo "selected"; } ?> value="1972" name="day">1972</option>



                                        <option <?php if($employment_info->first_employment_year == "1973") { echo "selected"; } ?> value="1973" name="day">1973</option>



                                        <option <?php if($employment_info->first_employment_year == "1974") { echo "selected"; } ?> value="1974" name="day">1974</option>



                                        <option <?php if($employment_info->first_employment_year == "1975") { echo "selected"; } ?> value="1975" name="day">1975</option>



                                        <option <?php if($employment_info->first_employment_year == "1976") { echo "selected"; } ?> value="1976" name="day">1976</option>



                                        <option <?php if($employment_info->first_employment_year == "1977") { echo "selected"; } ?> value="1977" name="day">1977</option>



                                        <option <?php if($employment_info->first_employment_year == "1978") { echo "selected"; } ?> value="1978" name="day">1978</option>



                                        <option <?php if($employment_info->first_employment_year == "1979") { echo "selected"; } ?> value="1979" name="day">1979</option>    



                                        <option <?php if($employment_info->first_employment_year == "1980") { echo "selected"; } ?> value="1980" name="day">1980</option>    



                                        <option <?php if($employment_info->first_employment_year == "1981") { echo "selected"; } ?> value="1981" name="day">1981</option>



                                        <option <?php if($employment_info->first_employment_year == "1982") { echo "selected"; } ?> value="1982" name="day">1982</option>



                                        <option <?php if($employment_info->first_employment_year == "1983") { echo "selected"; } ?> value="1983" name="day">1983</option>



                                        <option <?php if($employment_info->first_employment_year == "1984") { echo "selected"; } ?> value="1984" name="day">1984</option>



                                        <option <?php if($employment_info->first_employment_year == "1985") { echo "selected"; } ?> value="1985" name="day">1985</option>



                                        <option <?php if($employment_info->first_employment_year == "1986") { echo "selected"; } ?> value="1986" name="day">1986</option>



                                        <option <?php if($employment_info->first_employment_year == "1987") { echo "selected"; } ?> value="1987" name="day">1987</option>



                                        <option <?php if($employment_info->first_employment_year == "1988") { echo "selected"; } ?> value="1988" name="day">1988</option>



                                        <option <?php if($employment_info->first_employment_year == "1989") { echo "selected"; } ?> value="1989" name="day">1989</option>    



                                        <option <?php if($employment_info->first_employment_year == "1990") { echo "selected"; } ?> value="1990" name="day">1990</option>



                                        <option <?php if($employment_info->first_employment_year == "1991") { echo "selected"; } ?> value="1991" name="day">1991</option>



                                        <option <?php if($employment_info->first_employment_year == "1992") { echo "selected"; } ?> value="1992" name="day">1992</option>



                                        <option <?php if($employment_info->first_employment_year == "1993") { echo "selected"; } ?> value="1993" name="day">1993</option>



                                        <option <?php if($employment_info->first_employment_year == "1994") { echo "selected"; } ?> value="1994" name="day">1994</option>



                                        <option <?php if($employment_info->first_employment_year == "1995") { echo "selected"; } ?> value="1995" name="day">1995</option>



                                        <option <?php if($employment_info->first_employment_year == "1996") { echo "selected"; } ?> value="1996" name="day">1996</option>



                                        <option <?php if($employment_info->first_employment_year == "1997") { echo "selected"; } ?> value="1997" name="day">1997</option>



                                        <option <?php if($employment_info->first_employment_year == "1998") { echo "selected"; } ?> value="1998" name="day">1998</option>



                                        <option <?php if($employment_info->first_employment_year == "1999") { echo "selected"; } ?> value="1999" name="day">1999</option>



                                        <option <?php if($employment_info->first_employment_year == "2000") { echo "selected"; } ?> value="2000" name="day">2000</option>



                                        <option <?php if($employment_info->first_employment_year == "2001") { echo "selected"; } ?> value="2001" name="day">2001</option>



                                        <option <?php if($employment_info->first_employment_year == "2002") { echo "selected"; } ?> value="2002" name="day">2002</option>



                                        <option <?php if($employment_info->first_employment_year == "2003") { echo "selected"; } ?> value="2003" name="day">2003</option>



                                        <option <?php if($employment_info->first_employment_year == "2004") { echo "selected"; } ?> value="2004" name="day">2004</option>



                                        <option <?php if($employment_info->first_employment_year == "2005") { echo "selected"; } ?> value="2005" name="day">2005</option>



                                        <option <?php if($employment_info->first_employment_year == "2006") { echo "selected"; } ?> value="2006" name="day">2006</option>



                                        <option <?php if($employment_info->first_employment_year == "2007") { echo "selected"; } ?> value="2007" name="day">2007</option>



                                        <option <?php if($employment_info->first_employment_year == "2008") { echo "selected"; } ?> value="2008" name="day">2008</option>



                                        <option <?php if($employment_info->first_employment_year == "2009") { echo "selected"; } ?> value="2009" name="day">2009</option>



                                        <option <?php if($employment_info->first_employment_year == "2010") { echo "selected"; } ?> value="2010" name="day">2010</option>



                                        <option <?php if($employment_info->first_employment_year == "2011") { echo "selected"; } ?> value="2011" name="day">2011</option>



                                        <option <?php if($employment_info->first_employment_year == "2012") { echo "selected"; } ?> value="2012" name="day">2012</option>



                                        <option <?php if($employment_info->first_employment_year == "2013") { echo "selected"; } ?> value="2013" name="day">2013</option>



                                        <option <?php if($employment_info->first_employment_year == "2014") { echo "selected"; } ?> value="2014" name="day">2014</option>



                                        <option <?php if($employment_info->first_employment_year == "2015") { echo "selected"; } ?> value="2015" name="day">2015</option>



                                        <option <?php if($employment_info->first_employment_year == "2016") { echo "selected"; } ?> value="2016" name="day">2016</option>



                                        <option <?php if($employment_info->first_employment_year == "2017") { echo "selected"; } ?> value="2017" name="day">2017</option>



                                        <option <?php if($employment_info->first_employment_year == "2018") { echo "selected"; } ?> value="2018" name="day">2018</option>



                                        <option <?php if($employment_info->first_employment_year == "2019") { echo "selected"; } ?> value="2019" name="day">2019</option>



                                        <option <?php if($employment_info->first_employment_year == "2020") { echo "selected"; } ?> value="2020" name="day">2020</option>



                                        <option <?php if($employment_info->first_employment_year == "2021") { echo "selected"; } ?> value="2021" name="day">2021</option>



                                        <option <?php if($employment_info->first_employment_year == "2022") { echo "selected"; } ?> value="2022" name="day">2022</option>



                                        <option <?php if($employment_info->first_employment_year == "2023") { echo "selected"; } ?> value="2023" name="day">2023</option>



                                        <option <?php if($employment_info->first_employment_year == "2024") { echo "selected"; } ?> value="2024" name="day">2024</option>



                                        <option <?php if($employment_info->first_employment_year == "2025") { echo "selected"; } ?> value="2025" name="day">2025</option>



                             </select>



                         </div>



                    </div>



                    



                    <div class="row">



                         <label class="padding-left">Which States Eligible to Work</label>



                         <div class="col4">



                                <select data-validation="required" class="form-input" name="employement_practice_state1" id="<?php echo $rowState3->states;?>">



                                    <option value="">Select State</option>



                                    <?php



                                        $sql_states3 = "select * from states";



                                        $result_states3 = mysqli_query($con,$sql_states3);



                                        //print_r($result_states);



                                        while($rowState3 = mysqli_fetch_object($result_states3)){



                                    ?>



                                <option <?php if($rowState3->states == $employment_info->employement_practice_state1){ echo "selected";} ?> value="<?php echo $rowState3->states;?>"><?php echo $rowState3->states;?></option>



                                <?php }







                                        ?>



                             </select>



                         </div>



                         <div class="col4">



                                <select  class="form-input" name="employement_practice_state2" id="<?php echo $rowState3->states;?>">



                                    <option value="">Select State</option>



                                    <?php



                                        $sql_states3 = "select * from states";



                                        $result_states3 = mysqli_query($con,$sql_states3);



                                        //print_r($result_states);



                                        while($rowState3 = mysqli_fetch_object($result_states3)){



                                    ?>



                                <option <?php if($rowState3->states == $employment_info->employement_practice_state2){ echo "selected";} ?> value="<?php echo $rowState3->states;?>"><?php echo $rowState3->states;?></option>



                                <?php }







                                        ?>



                             </select>



                         </div>



                         <div class="col4">



                                <select  class="form-input" name="employement_practice_state3" id="<?php echo $rowState3->states;?>">



                                    <option value="">Select State</option>



                                    <?php



                                        $sql_states3 = "select * from states";



                                        $result_states3 = mysqli_query($con,$sql_states3);



                                        //print_r($result_states);



                                        while($rowState3 = mysqli_fetch_object($result_states3)){



                                    ?>



                                <option <?php if($rowState3->states == $employment_info->employement_practice_state3){ echo "selected";} ?> value="<?php echo $rowState3->states;?>"><?php echo $rowState3->states;?></option>



                                <?php }







                                        ?>



                             </select>



                         </div>



                    </div>



                    



                    <div class="row">



                         <div class="col4">



                             <label>Current CAA Employer Status</label>



                             <select data-validation="required" onchange="employer_status(this.value)"  id="employment_information_3" name="employment_status" class="form-input">



                                        <option value="">Select Employment Status</option>



                                        <option <?php if($employment_info->employment_status == "Full-time"){ echo "selected";} ?> value="Full-time">Full-time</option>



                                        <option <?php if($employment_info->employment_status == "Part-time"){ echo "selected";} ?> value="Part-time">Part-time</option>



                                        <option <?php if($employment_info->employment_status == "PRN"){ echo "selected";} ?> value="PRN">PRN</option>



                                        <option <?php if($employment_info->employment_status == "Locum tenens"){ echo "selected";} ?> value="Locum tenens">Locum tenens</option>



                                        <option <?php if($employment_info->employment_status == "Retired"){ echo "selected";} ?> value="Retired">Retired</option>



                                        <option <?php if($employment_info->employment_status == "Not currently employed as a CAA"){ echo "selected";} ?> value="Not currently employed as a CAA">Not currently employed as a CAA</option>



                                        



                                    </select>



                         </div>



                         <div class="col4">



                             <label>Current CAA Employer Name</label>



                             <input data-validation="required" onchange="" id="employment_information_7" type="text" value="<?php echo $employment_info->employer_name; ?>" name="employer_name" class="form-input" "The Christ Hospital">



                         </div>



                         <div class="col4">



                             <label>Current CAA Employer Address</label>



                             <input data-validation="required" onchange="" id="employment_information_8" type="text" value="<?php echo $employment_info->employer_address; ?>" name="employer_address" class="form-input" "2139 Auburn Ave">



                         </div>



                    </div>



                    



                    <div class="row">



                         <div class="col4">



                             <label class="big-label">Current CAA Employer Apt / Suite</label>



                             <input data-validation="required" onchange="" id="employment_information_9" type="text" value="<?php echo $employment_info->employer_apt; ?>" name="employer_apt" class="form-input" "">



                         </div>



                         <div class="col4">



                             <label>Current CAA Employer City</label>



                             <input data-validation="required" onchange="" id="employment_information_9000" type="text" value="<?php echo $employment_info->employer_city; ?>" name="employer_city" class="form-input" "Cincinnati">



                         </div>



                    </div>



                    



                    <div class="row">



                         <div class="col4">



                             <label>State</label>



                             <select data-validation="required" onchange="" id="employment_information_10" name="employer_state" class="form-input">



                                        <option value="">Select Employer State</option>



                                        <?php



                                        $sql_states2 = "select * from states";



                                        $result_states2 = mysqli_query($con,$sql_states2);



                                        //print_r($result_states);



                                        while($rowState2 = mysqli_fetch_object($result_states2)){



                                    ?>



                                        <option  value="<?php echo $rowState2->states;?>"  <?php if($rowState2->states == $employment_info->employer_state) { echo "selected";} ?> ><?php echo $rowState2->states;?></option>



                                    



                                    



                                        <?php }







                                        ?>



                                        



                                    </select>



                         </div>



                         <div class="col4">



                             <span class="or">or</span>



                             <label>Zip</label>



                             <input data-validation="required" onchange="" id="employment_information_11" type="text" value="<?php echo $employment_info->employer_zip; ?>" name="employer_zip" class="form-input" "45219">



                         </div>



                    </div>



                    



                    <div class="row">



                         <div class="col8">



                             <label>Country</label>



                                <select data-validation="required" onchange="" class="form-input" name="employer_country" id="address_info_field99" oninvalid="this.setCustomValidity('Please Select Country')" oninput="this.setCustomValidity('')">



                              <option value="">Select Country</option>



                                       <option <?php if($employment_info->employer_country == "Afghanistan"){ echo "Selected";} ?> value="Afghanistan">Afghanistan</option>



                <option <?php if($employment_info->employer_country == "Åland Islands"){ echo "Selected";} ?> value="Åland Islands">Åland Islands</option>



                <option <?php if($employment_info->employer_country == "Albania"){ echo "Selected";} ?> value="Albania">Albania</option>



                <option <?php if($employment_info->employer_country == "Algeria"){ echo "Selected";} ?> value="Algeria">Algeria</option>



                <option <?php if($employment_info->employer_country == "American Samoa"){ echo "Selected";} ?> value="American Samoa">American Samoa</option>



                <option <?php if($employment_info->employer_country == "Andorra"){ echo "Selected";} ?> value="Andorra">Andorra</option>



                <option <?php if($employment_info->employer_country == "Angola"){ echo "Selected";} ?> value="Angola">Angola</option>



                <option <?php if($employment_info->employer_country == "Anguilla"){ echo "Selected";} ?> value="Anguilla">Anguilla</option>



                <option <?php if($employment_info->employer_country == "Antarctica"){ echo "Selected";} ?> value="Antarctica">Antarctica</option>



                <option <?php if($employment_info->employer_country == "Antigua and Barbuda"){ echo "Selected";} ?> value="Antigua and Barbuda">Antigua and Barbuda</option>



                <option <?php if($employment_info->employer_country == "Argentina"){ echo "Selected";} ?> value="Argentina">Argentina</option>



                <option <?php if($employment_info->employer_country == "Armenia"){ echo "Selected";} ?> value="Armenia">Armenia</option>



                <option <?php if($employment_info->employer_country == "Aruba"){ echo "Selected";} ?> value="Aruba">Aruba</option>



                <option <?php if($employment_info->employer_country == "Australia"){ echo "Selected";} ?> value="Australia">Australia</option>



                <option <?php if($employment_info->employer_country == "Austria"){ echo "Selected";} ?> value="Austria">Austria</option>



                <option <?php if($employment_info->employer_country == "Azerbaijan"){ echo "Selected";} ?> value="Azerbaijan">Azerbaijan</option>



                <option <?php if($employment_info->employer_country == "Bahamas"){ echo "Selected";} ?> value="Bahamas">Bahamas</option>



                <option <?php if($employment_info->employer_country == "Bahrain"){ echo "Selected";} ?> value="Bahrain">Bahrain</option>



                <option <?php if($employment_info->employer_country == "Bangladesh"){ echo "Selected";} ?> value="Bangladesh">Bangladesh</option>



                <option <?php if($employment_info->employer_country == "Barbados"){ echo "Selected";} ?> value="Barbados">Barbados</option>



                <option <?php if($employment_info->employer_country == "Belarus"){ echo "Selected";} ?> value="Belarus">Belarus</option>



                <option <?php if($employment_info->employer_country == "Belgium"){ echo "Selected";} ?> value="Belgium">Belgium</option>



                <option <?php if($employment_info->employer_country == "Belize"){ echo "Selected";} ?> value="Belize">Belize</option>



                <option <?php if($employment_info->employer_country == "Benin"){ echo "Selected";} ?> value="Benin">Benin</option>



                <option <?php if($employment_info->employer_country == "Bermuda"){ echo "Selected";} ?> value="Bermuda">Bermuda</option>



                <option <?php if($employment_info->employer_country == "Bhutan"){ echo "Selected";} ?> value="Bhutan">Bhutan</option>



                <option <?php if($employment_info->employer_country == "Bolivia"){ echo "Selected";} ?> value="Bolivia">Bolivia</option>



                <option <?php if($employment_info->employer_country == "Bosnia and Herzegovina"){ echo "Selected";} ?> value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>



                <option <?php if($employment_info->employer_country == "Botswana"){ echo "Selected";} ?> value="Botswana">Botswana</option>



                <option <?php if($employment_info->employer_country == "Bouvet Island"){ echo "Selected";} ?> value="Bouvet Island">Bouvet Island</option>



                <option <?php if($employment_info->employer_country == "Brazil"){ echo "Selected";} ?> value="Brazil">Brazil</option>



                <option <?php if($employment_info->employer_country == "British Indi"){ echo "Selected";} ?> value="British Indian Ocean Territory">British Indian Ocean Territory</option>



                <option <?php if($employment_info->employer_country == "Brunei Darussalam"){ echo "Selected";} ?> value="Brunei Darussalam">Brunei Darussalam</option>



                <option <?php if($employment_info->employer_country == "Bulgaria"){ echo "Selected";} ?> value="Bulgaria">Bulgaria</option>



                <option <?php if($employment_info->employer_country == "Burkina Faso"){ echo "Selected";} ?> value="Burkina Faso">Burkina Faso</option>



                <option <?php if($employment_info->employer_country == "Burundi"){ echo "Selected";} ?> value="Burundi">Burundi</option>



                <option <?php if($employment_info->employer_country == "Cambodia"){ echo "Selected";} ?> value="Cambodia">Cambodia</option>



                <option <?php if($employment_info->employer_country == "Cameroon"){ echo "Selected";} ?> value="Cameroon">Cameroon</option>



                <option <?php if($employment_info->employer_country == "Canada"){ echo "Selected";} ?> value="Canada">Canada</option>



                <option <?php if($employment_info->employer_country == "Cape Verde"){ echo "Selected";} ?> value="Cape Verde">Cape Verde</option>



                <option <?php if($employment_info->employer_country == "Cayman Islands"){ echo "Selected";} ?> value="Cayman Islands">Cayman Islands</option>



                <option <?php if($employment_info->employer_country == "Central African Republic"){ echo "Selected";} ?> value="Central African Republic">Central African Republic</option>



                <option <?php if($employment_info->employer_country == "Chad"){ echo "Selected";} ?> value="Chad">Chad</option>



                <option <?php if($employment_info->employer_country == "Chile"){ echo "Selected";} ?> value="Chile">Chile</option>



                <option <?php if($employment_info->employer_country == "China"){ echo "Selected";} ?> value="China">China</option>



                <option <?php if($employment_info->employer_country == "Christmas Island"){ echo "Selected";} ?> value="Christmas Island">Christmas Island</option>



                <option <?php if($employment_info->employer_country == "Cocos (Keeling) Islands"){ echo "Selected";} ?> value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>



                <option <?php if($employment_info->employer_country == "Colombia"){ echo "Selected";} ?> value="Colombia">Colombia</option>



                <option <?php if($employment_info->employer_country == "Comoros"){ echo "Selected";} ?> value="Comoros">Comoros</option>



                <option <?php if($employment_info->employer_country == "Congo"){ echo "Selected";} ?> value="Congo">Congo</option>



                <option <?php if($employment_info->employer_country == "Co"){ echo "Selected";} ?> value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>



                <option <?php if($employment_info->employer_country == "Cook Islands"){ echo "Selected";} ?> value="Cook Islands">Cook Islands</option>



                <option <?php if($employment_info->employer_country == "Costa Rica"){ echo "Selected";} ?> value="Costa Rica">Costa Rica</option>



                <option <?php if($employment_info->employer_country == "Cote D'ivoire"){ echo "Selected";} ?> value="Cote D'ivoire">Cote D'ivoire</option>



                <option <?php if($employment_info->employer_country == "Croatia"){ echo "Selected";} ?> value="Croatia">Croatia</option>



                <option <?php if($employment_info->employer_country == "Cuba"){ echo "Selected";} ?> value="Cuba">Cuba</option>



                <option <?php if($employment_info->employer_country == "Cyprus"){ echo "Selected";} ?> value="Cyprus">Cyprus</option>



                <option <?php if($employment_info->employer_country == "Czech Republic"){ echo "Selected";} ?> value="Czech Republic">Czech Republic</option>



                <option <?php if($employment_info->employer_country == "Denmark"){ echo "Selected";} ?> value="Denmark">Denmark</option>



                <option <?php if($employment_info->employer_country == "Djibouti"){ echo "Selected";} ?> value="Djibouti">Djibouti</option>



                <option <?php if($employment_info->employer_country == "Dominica"){ echo "Selected";} ?> value="Dominica">Dominica</option>



                <option <?php if($employment_info->employer_country == "Dominican Republic"){ echo "Selected";} ?> value="Dominican Republic">Dominican Republic</option>



                <option <?php if($employment_info->employer_country == "Ecuador"){ echo "Selected";} ?> value="Ecuador">Ecuador</option>



                <option <?php if($employment_info->employer_country == "Egypt"){ echo "Selected";} ?> value="Egypt">Egypt</option>



                <option <?php if($employment_info->employer_country == "El Salvador"){ echo "Selected";} ?> value="El Salvador">El Salvador</option>



                <option <?php if($employment_info->employer_country == "Equatorial Guinea"){ echo "Selected";} ?> value="Equatorial Guinea">Equatorial Guinea</option>



                <option <?php if($employment_info->employer_country == "Eritrea"){ echo "Selected";} ?> value="Eritrea">Eritrea</option>



                <option <?php if($employment_info->employer_country == "Estonia"){ echo "Selected";} ?> value="Estonia">Estonia</option>



                <option <?php if($employment_info->employer_country == "Ethiopia"){ echo "Selected";} ?> value="Ethiopia">Ethiopia</option>



                <option <?php if($employment_info->employer_country == "Falkland "){ echo "Selected";} ?> value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>



                <option <?php if($employment_info->employer_country == "Faroe Islands"){ echo "Selected";} ?> value="Faroe Islands">Faroe Islands</option>



                <option <?php if($employment_info->employer_country == "Fiji"){ echo "Selected";} ?> value="Fiji">Fiji</option>



                <option <?php if($employment_info->employer_country == "Finland"){ echo "Selected";} ?> value="Finland">Finland</option>



                <option <?php if($employment_info->employer_country == "France"){ echo "Selected";} ?> value="France">France</option>



                <option <?php if($employment_info->employer_country == "French Guiana"){ echo "Selected";} ?> value="French Guiana">French Guiana</option>



                <option <?php if($employment_info->employer_country == "French Polynesia"){ echo "Selected";} ?> value="French Polynesia">French Polynesia</option>



                <option <?php if($employment_info->employer_country == "French "){ echo "Selected";} ?> value="French Southern Territories">French Southern Territories</option>



                <option <?php if($employment_info->employer_country == "Gabon"){ echo "Selected";} ?> value="Gabon">Gabon</option>



                <option <?php if($employment_info->employer_country == "Gambia"){ echo "Selected";} ?> value="Gambia">Gambia</option>



                <option <?php if($employment_info->employer_country == "Georgia"){ echo "Selected";} ?> value="Georgia">Georgia</option>



                <option <?php if($employment_info->employer_country == "Germany"){ echo "Selected";} ?> value="Germany">Germany</option>



                <option <?php if($employment_info->employer_country == "Ghana"){ echo "Selected";} ?> value="Ghana">Ghana</option>



                <option <?php if($employment_info->employer_country == "Gibraltar"){ echo "Selected";} ?> value="Gibraltar">Gibraltar</option>



                <option <?php if($employment_info->employer_country == "Greece"){ echo "Selected";} ?> value="Greece">Greece</option>



                <option <?php if($employment_info->employer_country == "Greenland"){ echo "Selected";} ?> value="Greenland">Greenland</option>



                <option <?php if($employment_info->employer_country == "Grenada"){ echo "Selected";} ?> value="Grenada">Grenada</option>



                <option <?php if($employment_info->employer_country == "Guadeloupe"){ echo "Selected";} ?> value="Guadeloupe">Guadeloupe</option>



                <option <?php if($employment_info->employer_country == "Guam"){ echo "Selected";} ?> value="Guam">Guam</option>



                <option <?php if($employment_info->employer_country == "Guatemala"){ echo "Selected";} ?> value="Guatemala">Guatemala</option>



                <option <?php if($employment_info->employer_country == "Guernsey"){ echo "Selected";} ?> value="Guernsey">Guernsey</option>



                <option <?php if($employment_info->employer_country == "Guinea"){ echo "Selected";} ?> value="Guinea">Guinea</option>



                <option <?php if($employment_info->employer_country == "Guinea-bissau"){ echo "Selected";} ?> value="Guinea-bissau">Guinea-bissau</option>



                <option <?php if($employment_info->employer_country == "Guyana"){ echo "Selected";} ?> value="Guyana">Guyana</option>



                <option <?php if($employment_info->employer_country == "Haiti"){ echo "Selected";} ?> value="Haiti">Haiti</option>



                <option <?php if($employment_info->employer_country == "Heard Is"){ echo "Selected";} ?> value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>



                <option <?php if($employment_info->employer_country == "Holy See (Vati"){ echo "Selected";} ?> value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>



                <option <?php if($employment_info->employer_country == "Honduras"){ echo "Selected";} ?> value="Honduras">Honduras</option>



                <option <?php if($employment_info->employer_country == "Hong Kong"){ echo "Selected";} ?> value="Hong Kong">Hong Kong</option>



                <option <?php if($employment_info->employer_country == "Hungary"){ echo "Selected";} ?> value="Hungary">Hungary</option>



                <option <?php if($employment_info->employer_country == "Iceland"){ echo "Selected";} ?> value="Iceland">Iceland</option>



                <option <?php if($employment_info->employer_country == "India"){ echo "Selected";} ?> value="India">India</option>



                <option <?php if($employment_info->employer_country == "Indonesia"){ echo "Selected";} ?> value="Indonesia">Indonesia</option>



                <option <?php if($employment_info->employer_country == "Iran, Islamic "){ echo "Selected";} ?> value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>



                <option <?php if($employment_info->employer_country == "Iraq"){ echo "Selected";} ?> value="Iraq">Iraq</option>



                <option <?php if($employment_info->employer_country == "Ireland"){ echo "Selected";} ?> value="Ireland">Ireland</option>



                <option <?php if($employment_info->employer_country == "Isle of Man"){ echo "Selected";} ?> value="Isle of Man">Isle of Man</option>



                <option <?php if($employment_info->employer_country == "Israel"){ echo "Selected";} ?> value="Israel">Israel</option>



                <option <?php if($employment_info->employer_country == "Italy"){ echo "Selected";} ?> value="Italy">Italy</option>



                <option <?php if($employment_info->employer_country == "Jamaica"){ echo "Selected";} ?> value="Jamaica">Jamaica</option>



                <option <?php if($employment_info->employer_country == "Japan"){ echo "Selected";} ?> value="Japan">Japan</option>



                <option <?php if($employment_info->employer_country == "Jersey"){ echo "Selected";} ?> value="Jersey">Jersey</option>



                <option <?php if($employment_info->employer_country == "Jordan"){ echo "Selected";} ?> value="Jordan">Jordan</option>



                <option <?php if($employment_info->employer_country == "Kazakhstan"){ echo "Selected";} ?> value="Kazakhstan">Kazakhstan</option>



                <option <?php if($employment_info->employer_country == "Kenya"){ echo "Selected";} ?> value="Kenya">Kenya</option>



                <option <?php if($employment_info->employer_country == "Kiribati"){ echo "Selected";} ?> value="Kiribati">Kiribati</option>



                <option <?php if($employment_info->employer_country == "Korea, De"){ echo "Selected";} ?> value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>



                <option <?php if($employment_info->employer_country == "Korea, Republic of"){ echo "Selected";} ?> value="Korea, Republic of">Korea, Republic of</option>



                <option <?php if($employment_info->employer_country == "Kuwait"){ echo "Selected";} ?> value="Kuwait">Kuwait</option>



                <option <?php if($employment_info->employer_country == "Kyrgyzstan"){ echo "Selected";} ?> value="Kyrgyzstan">Kyrgyzstan</option>



                <option <?php if($employment_info->employer_country == "Lao People's De"){ echo "Selected";} ?> value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>



                <option <?php if($employment_info->employer_country == "Latvia"){ echo "Selected";} ?> value="Latvia">Latvia</option>



                <option <?php if($employment_info->employer_country == "Lebanon"){ echo "Selected";} ?> value="Lebanon">Lebanon</option>



                <option <?php if($employment_info->employer_country == "Lesotho"){ echo "Selected";} ?> value="Lesotho">Lesotho</option>



                <option <?php if($employment_info->employer_country == "Liberia"){ echo "Selected";} ?> value="Liberia">Liberia</option>



                <option <?php if($employment_info->employer_country == "Libyan Arab Jamahiriya"){ echo "Selected";} ?> value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>



                <option <?php if($employment_info->employer_country == "Liechtenstein"){ echo "Selected";} ?> value="Liechtenstein">Liechtenstein</option>



                <option <?php if($employment_info->employer_country == "Lithuania"){ echo "Selected";} ?> value="Lithuania">Lithuania</option>



                <option <?php if($employment_info->employer_country == "Luxembourg"){ echo "Selected";} ?> value="Luxembourg">Luxembourg</option>



                <option <?php if($employment_info->employer_country == "Macao"){ echo "Selected";} ?> value="Macao">Macao</option>



                <option <?php if($employment_info->employer_country == "Macedo"){ echo "Selected";} ?> value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>



                <option <?php if($employment_info->employer_country == "Madagascar"){ echo "Selected";} ?> value="Madagascar">Madagascar</option>



                <option <?php if($employment_info->employer_country == "Malawi"){ echo "Selected";} ?> value="Malawi">Malawi</option>



                <option <?php if($employment_info->employer_country == "Malaysia"){ echo "Selected";} ?> value="Malaysia">Malaysia</option>



                <option <?php if($employment_info->employer_country == "Maldives"){ echo "Selected";} ?> value="Maldives">Maldives</option>



                <option <?php if($employment_info->employer_country == "Mali"){ echo "Selected";} ?> value="Mali">Mali</option>



                <option <?php if($employment_info->employer_country == "Malta"){ echo "Selected";} ?> value="Malta">Malta</option>



                <option <?php if($employment_info->employer_country == "Marshall Islands"){ echo "Selected";} ?> value="Marshall Islands">Marshall Islands</option>



                <option <?php if($employment_info->employer_country == "Martinique"){ echo "Selected";} ?> value="Martinique">Martinique</option>



                <option <?php if($employment_info->employer_country == "Mauritania"){ echo "Selected";} ?> value="Mauritania">Mauritania</option>



                <option <?php if($employment_info->employer_country == "Mauritius"){ echo "Selected";} ?> value="Mauritius">Mauritius</option>



                <option <?php if($employment_info->employer_country == "Mayotte"){ echo "Selected";} ?> value="Mayotte">Mayotte</option>



                <option <?php if($employment_info->employer_country == "Mexico"){ echo "Selected";} ?> value="Mexico">Mexico</option>



                <option <?php if($employment_info->employer_country == "Micronesia, F"){ echo "Selected";} ?> value="Micronesia, Federated States of">Micronesia, Federated States of</option>



                <option <?php if($employment_info->employer_country == "Moldova, Republic of"){ echo "Selected";} ?> value="Moldova, Republic of">Moldova, Republic of</option>



                <option <?php if($employment_info->employer_country == "Monaco"){ echo "Selected";} ?> value="Monaco">Monaco</option>



                <option <?php if($employment_info->employer_country == "Mongolia"){ echo "Selected";} ?> value="Mongolia">Mongolia</option>



                <option <?php if($employment_info->employer_country == "Montenegro"){ echo "Selected";} ?> value="Montenegro">Montenegro</option>



                <option <?php if($employment_info->employer_country == "Montserrat"){ echo "Selected";} ?> value="Montserrat">Montserrat</option>



                <option <?php if($employment_info->employer_country == "Morocco"){ echo "Selected";} ?> value="Morocco">Morocco</option>



                <option <?php if($employment_info->employer_country == "Mozambique"){ echo "Selected";} ?> value="Mozambique">Mozambique</option>



                <option <?php if($employment_info->employer_country == "Myanmar"){ echo "Selected";} ?> value="Myanmar">Myanmar</option>



                <option <?php if($employment_info->employer_country == "Namibia"){ echo "Selected";} ?> value="Namibia">Namibia</option>



                <option <?php if($employment_info->employer_country == "Nauru"){ echo "Selected";} ?> value="Nauru">Nauru</option>



                <option <?php if($employment_info->employer_country == "Nepal"){ echo "Selected";} ?> value="Nepal">Nepal</option>



                <option <?php if($employment_info->employer_country == "Netherlands"){ echo "Selected";} ?> value="Netherlands">Netherlands</option>



                <option <?php if($employment_info->employer_country == "Netherlands Antilles"){ echo "Selected";} ?> value="Netherlands Antilles">Netherlands Antilles</option>



                <option <?php if($employment_info->employer_country == "New Caledonia"){ echo "Selected";} ?> value="New Caledonia">New Caledonia</option>



                <option <?php if($employment_info->employer_country == "New Zealand"){ echo "Selected";} ?> value="New Zealand">New Zealand</option>



                <option <?php if($employment_info->employer_country == "Nicaragua"){ echo "Selected";} ?> value="Nicaragua">Nicaragua</option>



                <option <?php if($employment_info->employer_country == "Niger"){ echo "Selected";} ?> value="Niger">Niger</option>



                <option <?php if($employment_info->employer_country == "Nigeria"){ echo "Selected";} ?> value="Nigeria">Nigeria</option>



                <option <?php if($employment_info->employer_country == "Niue"){ echo "Selected";} ?> value="Niue">Niue</option>



                <option <?php if($employment_info->employer_country == "Norfolk Island"){ echo "Selected";} ?> value="Norfolk Island">Norfolk Island</option>



                <option <?php if($employment_info->employer_country == "Northern Mariana Islands"){ echo "Selected";} ?> value="Northern Mariana Islands">Northern Mariana Islands</option>



                <option <?php if($employment_info->employer_country == "Norway"){ echo "Selected";} ?> value="Norway">Norway</option>



                <option <?php if($employment_info->employer_country == "Oman"){ echo "Selected";} ?> value="Oman">Oman</option>



                <option <?php if($employment_info->employer_country == "Pakistan"){ echo "Selected";} ?> value="Pakistan">Pakistan</option>



                <option <?php if($employment_info->employer_country == "Palau"){ echo "Selected";} ?> value="Palau">Palau</option>



                <option <?php if($employment_info->employer_country == "Palestinian Te"){ echo "Selected";} ?> value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>



                <option <?php if($employment_info->employer_country == "Panama"){ echo "Selected";} ?> value="Panama">Panama</option>



                <option <?php if($employment_info->employer_country == "Papua New Guinea"){ echo "Selected";} ?> value="Papua New Guinea">Papua New Guinea</option>



                <option <?php if($employment_info->employer_country == "Paraguay"){ echo "Selected";} ?> value="Paraguay">Paraguay</option>



                <option <?php if($employment_info->employer_country == "Peru"){ echo "Selected";} ?> value="Peru">Peru</option>



                <option <?php if($employment_info->employer_country == "Philippines"){ echo "Selected";} ?> value="Philippines">Philippines</option>



                <option <?php if($employment_info->employer_country == "Pitcairn"){ echo "Selected";} ?> value="Pitcairn">Pitcairn</option>



                <option <?php if($employment_info->employer_country == "Poland"){ echo "Selected";} ?> value="Poland">Poland</option>



                <option <?php if($employment_info->employer_country == "Portugal"){ echo "Selected";} ?> value="Portugal">Portugal</option>



                <option <?php if($employment_info->employer_country == "Puerto Rico"){ echo "Selected";} ?> value="Puerto Rico">Puerto Rico</option>



                <option <?php if($employment_info->employer_country == "Qatar"){ echo "Selected";} ?> value="Qatar">Qatar</option>



                <option <?php if($employment_info->employer_country == "Reunion"){ echo "Selected";} ?> value="Reunion">Reunion</option>



                <option <?php if($employment_info->employer_country == "Romania"){ echo "Selected";} ?> value="Romania">Romania</option>



                <option <?php if($employment_info->employer_country == "Russian Federation"){ echo "Selected";} ?> value="Russian Federation">Russian Federation</option>



                <option <?php if($employment_info->employer_country == "Rwanda"){ echo "Selected";} ?> value="Rwanda">Rwanda</option>



                <option <?php if($employment_info->employer_country == "Saint Helena"){ echo "Selected";} ?> value="Saint Helena">Saint Helena</option>



                <option <?php if($employment_info->employer_country == "Saint Kitts and Nevis"){ echo "Selected";} ?> value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>



                <option <?php if($employment_info->employer_country == "Saint Lucia"){ echo "Selected";} ?> value="Saint Lucia">Saint Lucia</option>



                <option <?php if($employment_info->employer_country == "Saint Pi"){ echo "Selected";} ?> value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>



                <option <?php if($employment_info->employer_country == "Saint Vincent"){ echo "Selected";} ?> value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>



                <option <?php if($employment_info->employer_country == "Samoa"){ echo "Selected";} ?> value="Samoa">Samoa</option>



                <option <?php if($employment_info->employer_country == "San Marino"){ echo "Selected";} ?> value="San Marino">San Marino</option>



                <option <?php if($employment_info->employer_country == "Sao Tome and Principe"){ echo "Selected";} ?> value="Sao Tome and Principe">Sao Tome and Principe</option>



                <option <?php if($employment_info->employer_country == "Saudi Arabia"){ echo "Selected";} ?> value="Saudi Arabia">Saudi Arabia</option>



                <option <?php if($employment_info->employer_country == "Senegal"){ echo "Selected";} ?> value="Senegal">Senegal</option>



                <option <?php if($employment_info->employer_country == "Serbia"){ echo "Selected";} ?> value="Serbia">Serbia</option>



                <option <?php if($employment_info->employer_country == "Seychelles"){ echo "Selected";} ?> value="Seychelles">Seychelles</option>



                <option <?php if($employment_info->employer_country == "Sierra Leone"){ echo "Selected";} ?> value="Sierra Leone">Sierra Leone</option>



                <option <?php if($employment_info->employer_country == "Singapore"){ echo "Selected";} ?> value="Singapore">Singapore</option>



                <option <?php if($employment_info->employer_country == "Slovakia"){ echo "Selected";} ?> value="Slovakia">Slovakia</option>



                <option <?php if($employment_info->employer_country == "Slovenia"){ echo "Selected";} ?> value="Slovenia">Slovenia</option>



                <option <?php if($employment_info->employer_country == "Solomon Islands"){ echo "Selected";} ?> value="Solomon Islands">Solomon Islands</option>



                <option <?php if($employment_info->employer_country == "Somalia"){ echo "Selected";} ?> value="Somalia">Somalia</option>



                <option <?php if($employment_info->employer_country == "South Africa"){ echo "Selected";} ?> value="South Africa">South Africa</option>



                <option <?php if($employment_info->employer_country == "South Georgia and The South Sandwich Islands"){ echo "Selected";} ?> value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>



                <option <?php if($employment_info->employer_country == "Spain"){ echo "Selected";} ?> value="Spain">Spain</option>



                <option <?php if($employment_info->employer_country == "Sri Lanka"){ echo "Selected";} ?> value="Sri Lanka">Sri Lanka</option>



                <option <?php if($employment_info->employer_country == "Sudan"){ echo "Selected";} ?> value="Sudan">Sudan</option>



                <option <?php if($employment_info->employer_country == "Suriname"){ echo "Selected";} ?> value="Suriname">Suriname</option>



                <option <?php if($employment_info->employer_country == "Svalbard and Jan Mayen"){ echo "Selected";} ?> value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>



                <option <?php if($employment_info->employer_country == "Swaziland"){ echo "Selected";} ?> value="Swaziland">Swaziland</option>



                <option <?php if($employment_info->employer_country == "Sweden"){ echo "Selected";} ?> value="Sweden">Sweden</option>



                <option <?php if($employment_info->employer_country == "Switzerland"){ echo "Selected";} ?> value="Switzerland">Switzerland</option>



                <option <?php if($employment_info->employer_country == "Syrian Arab Republic"){ echo "Selected";} ?> value="Syrian Arab Republic">Syrian Arab Republic</option>



                <option <?php if($employment_info->employer_country == "Taiwan, Pro"){ echo "Selected";} ?> value="Taiwan, Province of China">Taiwan, Province of China</option>



                <option <?php if($employment_info->employer_country == "Tajikistan"){ echo "Selected";} ?> value="Tajikistan">Tajikistan</option>



                <option <?php if($employment_info->employer_country == "Tanzania, United "){ echo "Selected";} ?> value="Tanzania, United Republic of">Tanzania, United Republic of</option>



                <option <?php if($employment_info->employer_country == "Thailand"){ echo "Selected";} ?> value="Thailand">Thailand</option>



                <option <?php if($employment_info->employer_country == "Timor-leste"){ echo "Selected";} ?> value="Timor-leste">Timor-leste</option>



                <option <?php if($employment_info->employer_country == "Togo"){ echo "Selected";} ?> value="Togo">Togo</option>



                <option <?php if($employment_info->employer_country == "Tokelau"){ echo "Selected";} ?> value="Tokelau">Tokelau</option>



                <option <?php if($employment_info->employer_country == "Tonga"){ echo "Selected";} ?> value="Tonga">Tonga</option>



                <option <?php if($employment_info->employer_country == "Trinidad and Tobago"){ echo "Selected";} ?> value="Trinidad and Tobago">Trinidad and Tobago</option>



                <option <?php if($employment_info->employer_country == "Tunisia"){ echo "Selected";} ?> value="Tunisia">Tunisia</option>



                <option <?php if($employment_info->employer_country == "Turkey"){ echo "Selected";} ?> value="Turkey">Turkey</option>



                <option <?php if($employment_info->employer_country == "Turkmenistan"){ echo "Selected";} ?> value="Turkmenistan">Turkmenistan</option>



                <option <?php if($employment_info->employer_country == "Turks and Caicos Islands"){ echo "Selected";} ?> value="Turks and Caicos Islands">Turks and Caicos Islands</option>



                <option <?php if($employment_info->employer_country == "Tuvalu"){ echo "Selected";} ?> value="Tuvalu">Tuvalu</option>



                <option <?php if($employment_info->employer_country == "Uganda"){ echo "Selected";} ?> value="Uganda">Uganda</option>



                <option <?php if($employment_info->employer_country == "Ukraine"){ echo "Selected";} ?> value="Ukraine">Ukraine</option>



                <option <?php if($employment_info->employer_country == "United Arab Emirates"){ echo "Selected";} ?> value="United Arab Emirates">United Arab Emirates</option>



                <option <?php if($employment_info->employer_country == "United Kingdom"){ echo "Selected";} ?> value="United Kingdom">United Kingdom</option>



                <option <?php if(empty($employment_info->employer_country) || $employment_info->employer_country == "United States"){ echo "Selected";} ?> value="United States">United States</option>



                <option <?php if($employment_info->employer_country == "United States Minor Outlying Islands"){ echo "Selected";} ?> value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>



                <option <?php if($employment_info->employer_country == "Uruguay"){ echo "Selected";} ?> value="Uruguay">Uruguay</option>



                <option <?php if($employment_info->employer_country == "Uzbekistan"){ echo "Selected";} ?> value="Uzbekistan">Uzbekistan</option>



                <option <?php if($employment_info->employer_country == "Vanuatu"){ echo "Selected";} ?> value="Vanuatu">Vanuatu</option>



                <option <?php if($employment_info->employer_country == "Venezuela"){ echo "Selected";} ?> value="Venezuela">Venezuela</option>



                <option <?php if($employment_info->employer_country == "Viet Nam"){ echo "Selected";} ?> value="Viet Nam">Viet Nam</option>



                <option <?php if($employment_info->employer_country == "Virgin Islands, British"){ echo "Selected";} ?> value="Virgin Islands, British">Virgin Islands, British</option>



                <option <?php if($employment_info->employer_country == "Virgin Islands, U.S."){ echo "Selected";} ?> value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>



                <option <?php if($employment_info->employer_country == "Wallis and Futuna"){ echo "Selected";} ?> value="Wallis and Futuna">Wallis and Futuna</option>



                <option <?php if($employment_info->employer_country == "Western Sahara"){ echo "Selected";} ?> value="Western Sahara">Western Sahara</option>



                <option <?php if($employment_info->employer_country == "Yemen"){ echo "Selected";} ?> value="Yemen">Yemen</option>



                <option <?php if($employment_info->employer_country == "Zambia"){ echo "Selected";} ?> value="Zambia">Zambia</option>



                <option <?php if($employment_info->employer_country == "Zimbabwe"){ echo "Selected";} ?> value="Zimbabwe">Zimbabwe</option>



                         </select>



                         </div>



                    </div>



                    



                    <div class="row">



                         <div class="col4">



                             <label>Current CAA Employer Main #</label>



                             <input data-validation="required" onchange="" id="employment_information_12" type="text" value="<?php echo $employment_info->employer_phone; ?>" name="employer_phone" class="form-input" "(513) 585-2000">



                         </div>



                    </div>



                    



                    <div class="row">



                         <div class="col8">



                             <label>Current CAA Employer Main Email</label>



                             <input  onchange="" id="employment_information_12jj" type="email" value="<?php echo $employment_info->employer_email; ?>" name="employer_email" class="form-input" "maincampus@christhospital.com">



                         </div>



                    </div>



                    



                    <div class="row">



                         <div class="col8">



                             <label>Confirm Main Email</label>



                             <input  onchange="" id="employment_information_12" type="email" value="<?php echo $employment_info->employer_email_conf; ?>" name="employer_email_conf" class="form-input" "maincampus@christhospital.com" oninput="check_email4(this)">



                         </div>



                         <script language='javascript' type='text/javascript'>



                        function check_email4(input) {



                        if (input.value != document.getElementById('employment_information_12jj').value) {



                          input.setCustomValidity('Email Must be Matching.');



                         } else {



                             // input is valid -- reset the error message



                             input.setCustomValidity('');



                          }



                        }



                    </script>



                    </div>



                    



                    <div class="row">



                         <div class="col8">



                             <label>Email #2</label>



                             <input  onchange="" id="employment_information_12" type="email" value="<?php echo $employment_info->employer_email2; ?>" name="employer_email2" class="form-input" "Type email #2">



                         </div>



                    </div>



                    



                    <div class="row">



                         <div class="col12">







                             <label>Which of the following best describes the type of practice setting in which your position(s) are located? (select all that apply)</label>



                             <?php 



                             if(!empty($employment_info->type_setting_1))



                             {



                                $employment_info_type_setting_1 = explode(',', $employment_info->type_setting_1);



                             }



                             else



                             {



                                  $employment_info_type_setting_1 = [];                           



                                                       

                             }



                             ?>



                             <!-- <div><input type="checkbox"  class="checkall" onclick="selectall(1)" id="CheckAll" >Selectall</div> -->

                            

                                

                             <span class="radio-row"><input onclick="other_data2(this.value)"   <?php if (in_array("Community Hospital",$employment_info_type_setting_1)){ echo "Checked";} ?>  name="type_setting_1[0]" value="Community Hospital" id="Answer15" type="radio" class="radiobox">Community Hospital</span> 

                             <span class="radio-row"><input onclick="other_data2(this.value)"  class="type_of_setting radiobox" type="radio" <?php if (in_array("Outpatient center",$employment_info_type_setting_1)){ echo "Checked";} ?> name="type_setting_1[1]" value="Outpatient center" id="Answer16">Outpatient center</span> 



                             <span class="radio-row"><input onclick="other_data2(this.value)"   class="type_of_setting radiobox" type="radio" <?php if (in_array("Large-network Hospital",$employment_info_type_setting_1)){ echo "Checked";} ?> name="type_setting_1[2]" value="Large-network Hospital" id="Answer17">Large-network Hospital</span> 



                             <span class="radio-row"><input onclick="other_data2(this.value)"  class="type_of_setting radiobox" type="radio" <?php if (in_array("University Medical Center",$employment_info_type_setting_1)){ echo "Checked";} ?> name="type_setting_1[3]" value="University Medical Center" id="Answer18">University Medical Center</span> 



                             <span class="radio-row"><input onclick="other_data2(this.value)"  class="type_of_setting radiobox" type="radio" <?php if (in_array("County Hospital",$employment_info_type_setting_1)){ echo "Checked";} ?> name="type_setting_1[4]" value="County Hospital" id="Answer119">County Hospital</span> 



                             <span class="radio-row"><input onclick="other_data2(this.value)"  class="type_of_setting radiobox" type="radio" <?php if (in_array("Federal Govt. or VA Hospital",$employment_info_type_setting_1)){ echo "Checked";} ?> name="type_setting_1[5]" value="Federal Govt. or VA Hospital" id="Answer120">Federal Govt. or VA Hospital</span> 



                             <span class="radio-row"><input onclick="other_data2(this.value)"  class="type_of_setting radiobox" type="radio" <?php if (in_array("Office Based",$employment_info_type_setting_1)){ echo "Checked";} ?> name="type_setting_1[6]" value="Office Based" id="Answer121">Office Based</span> 



                              <span class="radio-row"><input onclick="other_data2(this.value)"  class="type_of_setting radiobox" type="radio" <?php if (in_array("Other",$employment_info_type_setting_1)){ echo "Checked";} ?> name="type_setting_1[7]" value="Other" id="Answer121">Other</span>

                              

                         </div>



                    </div>



                    



                    <div class="row" id="other_data2">



                         <div class="col8">



                             <label>Other</label>



                             <input  class="type_of_setting form-input" type="text"  name="type_setting_1_other" value="<?php echo $employment_info->type_setting_1_other; ?>" id="Answer122">



                         </div>



                     </div>

                   

                     <div class="row">



                         <div class="col8">



                          <!--  <?php 



                             //if(empty($employment_info->type_setting_1)){?>

 -->

                           <!--  <span class="radio-row"><input onclick="other_data2(this.value)" data-validation="required" class="type_of_setting radiobox" type="radio" <?php //if (in_array("N/A",$employment_info_type_setting_1)){ echo "Checked";} ?> name="type_setting_1[8]" value="N/A" id="Answer123">N/A not currently working as CAA</span>

  -->



                                <span class="radio-row"><input onclick="other_data2(this.value)" data-validation="required" class="type_of_setting radiobox" type="radio" <?php if(in_array("N/A",$employment_info_type_setting_1)) { echo "Checked";} ?> name="type_setting_1[8]" value="N/A" id="Answer123">N/A not currently working as CAA</span> 

                             

                         </div>

                    



                    </div>



                  

                



                    



                    <div class="row">



                         <div class="col12">



                             <label>Which of the following best describes the type of practice setting in which your position(s) are located? (select all that apply) </label>



                             <?php 



                             if(!empty($employment_info->type_setting_2))



                             {



                                $employment_info_type_setting_2 = explode(',', $employment_info->type_setting_2);



                             }



                             else



                             {



                                $employment_info_type_setting_2 = [];



                             }



                             ?>



                             <span class="radio-row"><input onclick="other_data3(this.value)"   <?php if (in_array("Small Private (less than 20 anesthetists)",$employment_info_type_setting_2)){ echo "Checked";} ?>  name="type_setting_2[0]" value="Small Private (less than 20 anesthetists)" id="Answer15" type="radio" class="radiobox">Small Private (less than 20 anesthetists)</span>



                             <span class="radio-row"><input onclick="other_data3(this.value)"   <?php if (in_array("Private (Between 20 and 50 anesthetists)",$employment_info_type_setting_2)){ echo "Checked";} ?>  name="type_setting_2[1]" value="Private (Between 20 and 50 anesthetists)" id="Answer15" type="radio" class="radiobox">Private (Between 20 and 50 anesthetists)</span>



                             <span class="radio-row"><input onclick="other_data3(this.value)"   <?php if (in_array("Large Private (Greater than 50 anesthetists)",$employment_info_type_setting_2)){ echo "Checked";} ?>  name="type_setting_2[2]" value="Large Private (Greater than 50 anesthetists)" id="Answer15" type="radio" class="radiobox">Large Private (Greater than 50 anesthetists)</span>



                             <span class="radio-row"><input onclick="other_data3(this.value)"   <?php if (in_array("National (multistate) anesthesia company",$employment_info_type_setting_2)){ echo "Checked";} ?>  name="type_setting_2[3]" value="National (multistate) anesthesia company" id="Answer15" type="radio" class="radiobox">National (multistate) anesthesia company</span>



                             <span class="radio-row"><input onclick="other_data3(this.value)"   <?php if (in_array("Academic Department",$employment_info_type_setting_2)){ echo "Checked";} ?>  name="type_setting_2[4]" value="Academic Department" id="Answer15" type="radio" class="radiobox">Academic Department</span>



                             <span class="radio-row"><input onclick="other_data3(this.value)"   <?php if (in_array("Hospital Employee",$employment_info_type_setting_2)){ echo "Checked";} ?>  name="type_setting_2[5]" value="Hospital Employee" id="Answer15" type="radio" class="radiobox">Hospital Employee</span>



                             <span class="radio-row"><input onclick="other_data3(this.value)"   <?php if (in_array("Independent Contractor/locum tenens",$employment_info_type_setting_2)){ echo "Checked";} ?>  name="type_setting_2[6]" value="Independent Contractor/locum tenens" id="Answer15" type="radio" class="radiobox">Independent Contractor/locum tenens</span>



                             <span class="radio-row"><input onclick="other_data3(this.value)"   <?php if(in_array("Other",$employment_info_type_setting_2)){ echo "Checked";} ?>  name="type_setting_2[7]" value="Other" id="Answer15" type="radio" class="radiobox">Other</span>



                         </div>



                    </div>



                    



                     <div class="row" id="other_data3">



                         <div class="col8">



                             <label>Other</label>



                             <input id="employment_information_19" type="text" value="<?php echo $employment_info->type_setting_2_other; ?>" name="type_setting_2_other" class="form-input" "" >



                         </div>



                    </div>



                    <div class="row" id="other_data4">



                         <div class="col8">



                             <label>Other</label>



                             <input  onchange="" id="employment_information_1925" type="text" value="<?php echo $employment_info->employed_group_other; ?>" name="employed_group_other" class="form-input" "" >



                         </div>



                    </div>



                    <?php /*



                    <div class="row">



                         <div class="col12">



                             <label>By which type of anesthesia group are you currently employed?</label>



                             <select  class="form-input full-width" name="employed_group" onchange="other_data4(this.value)" data-validation="required">



                                <option value="">Select only one</option>



                                <option <?php if($employment_info->employed_group == "Small Private (less than 20 anesthetists)" ){ echo "selected";} ?> value="Small Private (less than 20 anesthetists)">Small Private (less than 20 anesthetists)</option>



                                <option <?php if($employment_info->employed_group == "Private (Between 20 and 50 anesthetists)" ){ echo "selected";} ?> value="Private (Between 20 and 50 anesthetists)">Private (Between 20 and 50 anesthetists)</option>



                                <option <?php if($employment_info->employed_group == "Large Private (Greater than 50 anesthetists)" ){ echo "selected";} ?> value="Large Private (Greater than 50 anesthetists)">Large Private (Greater than 50 anesthetists)</option>



                                <option <?php if($employment_info->employed_group == "National (multistate) anesthesia company" ){ echo "selected";} ?> value="National (multistate) anesthesia company">National (multistate) anesthesia company</option>



                                <option <?php if($employment_info->employed_group == "Academic Department" ){ echo "selected";} ?> value="Academic Department">Academic Department</option>



                                <option <?php if($employment_info->employed_group == "Hospital Employee" ){ echo "selected";} ?> value="Hospital Employee">Hospital Employee</option>



                                <option <?php if($employment_info->employed_group == "Independent Contractor/locum tenens" ){ echo "selected";} ?> value="Independent Contractor/locum tenens">Independent Contractor/locum tenens</option>



                                <option <?php if($employment_info->employed_group == "Other" ){ echo "selected";} ?> value="Other">Other</option>



                             </select>



                         </div>



                    </div> */ ?>



                    



                    



                    



                    <div class="row">



                         <div class="col4">



                             <label>(CAA) [# providers]</label>



                             <input  onchange="" id="employment_information_13" type="text" value="<?php echo $employment_info->providers_grp1; ?>" name="providers_grp1" class="form-input" "">



                         </div>



                         <div class="col4">



                             <label>(CRNA) [# providers]</label>



                             <input  onchange="" id="employment_information_14" type="text" value="<?php echo $employment_info->providers_grp2; ?>" name="providers_grp2" class="form-input" "">



                         </div>



                         <div class="col4">



                             <label>(MD/DO) [# providers]</label>



                             <input  onchange="" id="employment_information_15" type="text" value="<?php echo $employment_info->providers_grp3; ?>" name="providers_grp3" class="form-input" "">



                         </div>



                    </div>



                    



                    <div class="row">



                         <div class="col12">



                         	  <p class="msg msg3">If part of national anesthesia company, respond with numbers for your local practice).</p>



                         </div>



                    </div>



                    



                    <?php /*



                    <div class="row">



                         <div class="col12">



                             <label>Do you receive overtime pay?</label>



                             <span class="radio-row yesno"><input data-validation="required" onchange="" id="compensation_field1" type="radio"  name="overtime_compensation" class="radiobox" value="Yes" <?php if($employer_compensation->overtime_compensation == "Yes" ){ echo "checked";} ?>>Yes</span>



                             <span class="radio-row yesno"><input data-validation="required" onchange="" id="compensation_field1" type="radio"  name="overtime_compensation" class="radiobox" value="No" <?php if($employer_compensation->overtime_compensation == "No" ){ echo "checked";} ?>>No</span>



                         </div>



                    </div>



                    



                    <div class="row">



                         <div class="col12">



                             <label>When Do You Receive Overtime Pay?</label>



                             <span class="radio-row"><input data-validation="required" type="radio" class="radiobox" onchange="" id="compensation_field0" name="overtime_pay" value="Any time worked after a set time in the day (eg. 3pm)" <?php if($employer_compensation->overtime_pay == "Any time worked after a set time in the day (eg. 3pm)" ){ echo "checked";} ?>>Any time worked after a set time in the day <br>(e.g. 3pm)</span>



                             <span class="radio-row"><input data-validation="required" type="radio" class="radiobox" onchange="" id="compensation_field0" name="overtime_pay" value="After cumulative hours worked within a pay period exceed scheduled hours for the pay period" <?php if($employer_compensation->overtime_pay == "After cumulative hours worked within a pay period exceed scheduled hours for the pay period" ){ echo "checked";} ?>>After cumulative hours worked within a pay period <br>exceed scheduled hours for the pay period</span>



                             <span class="radio-row"><input data-validation="required" type="radio" class="radiobox" onchange="" id="compensation_field0" name="overtime_pay" value="Do not receive overtime pay" <?php if($employer_compensation->overtime_pay == "Do not receive overtime pay" ){ echo "checked";} ?>>Do not receive overtime pay</span>



                             <span class="radio-row"><input data-validation="required" type="radio" class="radiobox" onchange="" id="compensation_field0" name="overtime_pay" value="Not eligible for overtime pay" <?php if($employer_compensation->overtime_pay == "Not eligible for overtime pay" ){ echo "checked";} ?>>Not eligible for overtime pay</span>



                         </div>



                    </div>



                 */?>



                 



                 



                 



                 <div class="submit-row">



                     <button class="save-btn" type="submit" name="employer_compensation_submit" id="employer_compensation_submit" value="Save"><span>(5/10)</span> SAVE</button>



                 </div>



             </form>



                </div><!--close tab5-->



                



                <div id="tab-6" class="tab-content <?php if($current == 'current6') { echo 'current'; }; ?>">



                    <form id="GeneralInfo_Form" name="GeneralInfo_Form"  action="process/tab1.php?tab=current7" enctype="multipart/form-data" method="POST">



                     <div class="row">



                         <div class="col12">



                             <label>What is the full time CAA annual compensation offered at your practice?</label>



                             <span class="radio-row"><input data-validation="required" onchange="" type="radio" class="radiobox" <?php if($employer_compensation->full_compension == 'Less than $100,000'){ echo "Checked";} ?> name="full_compension" value="Less than $100,000" id="Answer19">Less than $100,000</span>



                             <span class="radio-row"><input data-validation="required" onchange="" type="radio" class="radiobox" <?php if($employer_compensation->full_compension == '$101,000 - $125,000'){ echo "Checked";} ?> name="full_compension" value="$101,000 - $125,000" id="Answer19">$101,000 - $125,000</span>



                             <span class="radio-row"><input data-validation="required" onchange="" type="radio" class="radiobox" <?php if($employer_compensation->full_compension == '$126,000 - $140,000'){ echo "Checked";} ?> name="full_compension" value="$126,000 - $140,000" id="Answer19">$126,000 - $140,000</span>



                             <span class="radio-row"><input data-validation="required" onchange="" type="radio" class="radiobox" <?php if($employer_compensation->full_compension == '$141,000 - $160,000'){ echo "Checked";} ?> name="full_compension" value="$141,000 - $160,000" id="Answer19">$141,000 - $160,000</span>



                         </div>



                    </div>  



                    



                    <div class="row">



                         <div class="col12">



                         	  <p class="msg msg3">Including OT, call pay, and employer retirement contributions and excluding insurance premiums.</p>



                         </div>



                    </div>      



                                         



                    <div class="row">



                         <div class="col12">



                             <label>Do you receive overtime pay?</label>



                             <span class="radio-row yesno"><input data-validation="required" onchange="" id="compensation_field1" type="radio" class="radiobox" <?php if($employer_compensation->employer_overtime_compensation == "Yes"){ echo "Checked";} ?> name="employer_overtime_compensation" value="Yes">Yes</span>



                             <span class="radio-row yesno"><input data-validation="required" onchange="" id="compensation_field1" type="radio" class="radiobox" <?php if($employer_compensation->employer_overtime_compensation == "No"){ echo "Checked";} ?> name="employer_overtime_compensation" value="No">No</span>



                         </div>



                    </div>



                    



                    



                    



                    <div class="row">



                         <div class="col12">



                             <label>When Do You Receive Overtime Pay?</label>



                             <span class="radio-row"><input data-validation="required" type="radio" class="radiobox" onchange="" id="compensation_field0" name="employer_overtime_pay" <?php if($employer_compensation->employer_overtime_pay == "Any time worked after a set time in the day (e.g. 3pm)" ){ echo "checked";} ?> value="Any time worked after a set time in the day (e.g. 3pm)">Any time worked after a set time in the day <br>(e.g. 3pm)</span>



                             <span class="radio-row"><input data-validation="required" type="radio" class="radiobox" onchange="" id="compensation_field0" name="employer_overtime_pay" <?php if($employer_compensation->employer_overtime_pay == "After cumulative hours worked within a pay period exceed scheduled hours for the pay period" ){ echo "checked";} ?> value="After cumulative hours worked within a pay period exceed scheduled hours for the pay period">After cumulative hours worked within a pay period <br>exceed scheduled hours for the pay period</span>



                             <span class="radio-row"><input data-validation="required" type="radio" class="radiobox" onchange="" id="compensation_field0" name="employer_overtime_pay" <?php if($employer_compensation->employer_overtime_pay == "Do not receive overtime pay" ){ echo "checked";} ?> value="Do not receive overtime pay">Do not receive overtime pay</span>



                             <span class="radio-row"><input data-validation="required" type="radio" class="radiobox" onchange="" id="compensation_field0" name="employer_overtime_pay" <?php if($employer_compensation->employer_overtime_pay == "Not eligible for overtime pay" ){ echo "checked";} ?> value="Not eligible for overtime pay">Not eligible for overtime pay</span>



                         </div>



                    </div>



                 



                                  



                 <div class="submit-row">



                     <button class="save-btn" type="submit" name="employer_compensation_submit" id="employer_compensation_submit" value="Save"><span>(6/10)</span> SAVE</button>



                 </div>



             </form>



                </div><!--close tab6-->



                



                <div id="tab-7" class="tab-content <?php if($current == 'current7') { echo 'current'; }; ?>">



                    <form id="GeneralInfo_Form" name="GeneralInfo_Form"  action="process/tab1.php?tab=current8" enctype="multipart/form-data" method="POST">



                    <div class="row">



                         <div class="col12">



                             <label>What is your typical weekly work schedule</label>



                             <span class="radio-row"><input data-validation="required" value="Consistent shift of both time and duration (same hours every day e.g. 7am - 3pm or 11am - 7pm)"  <?php if($employment_info->typical_weekly1 == 'Consistent shift of both time and duration (same hours every day e.g. 7am - 3pm or 11am - 7pm)'){ echo "Checked";} ?> name="typical_weekly1" id="emp_work_schedule_1" type="radio" class="radiobox">Consistent shift of both time and duration (same hours every day e.g. 7am - 3pm or 11am - 7pm)</span>



                             <span class="radio-row"><input data-validation="required" value="Variable shifts of either time or duration (eg. 2 twelve hour and 2 eight hour shifts)"  <?php if($employment_info->typical_weekly1 == 'Variable shifts of either time or duration (eg. 2 twelve hour and 2 eight hour shifts)'){ echo "Checked";} ?> name="typical_weekly1" id="emp_work_schedule_1" type="radio" class="radiobox">Variable shifts of either time or duration (eg. 2 twelve hour and 2 eight hour shifts)</span>



                             <span class="radio-row"><input data-validation="required" value="Set start time each day with variable end time (eg. relieved of duty daily as OR schedule permits)"  <?php if($employment_info->typical_weekly1 == 'Set start time each day with variable end time (eg. relieved of duty daily as OR schedule permits)'){ echo "Checked";} ?> name="typical_weekly1" id="emp_work_schedule_1" type="radio" class="radiobox">Set start time each day with variable end time (eg. relieved of duty daily as OR schedule permits)</span>



                             <span class="radio-row"><input data-validation="required" value="Call (in hospital or from home)"  <?php if($employment_info->typical_weekly1 == 'Call (in hospital or from home)'){ echo "Checked";} ?> name="typical_weekly1" id="emp_work_schedule_1" type="radio" class="radiobox">Call (in hospital or from home)</span>



                         </div>



                    </div> 



                    



                    <div class="row">



                         <div class="col8">



                             <label>Other</label>



                             <input  onchange="" id="employment_information_16" type="text" value="<?php echo $employment_info->typical_weekly_other; ?>" name="typical_weekly_other" class="form-input" "">



                         </div>



                    </div> 



                    



                    <div class="row">



                         <div class="col12">



                             <label>How many hours do you typically work per week?</label>



                             <span class="radio-row"><input data-validation="required" value="Less than 20"  <?php if($employment_info->typical_weekly_hour == "Less than 20"){ echo "Checked";} ?> name="typical_weekly_hour" id="typical_weekly_hour" type="radio" class="radiobox">Less than 20</span>



                             <span class="radio-row"><input data-validation="required" value="20 - 30"  <?php if($employment_info->typical_weekly_hour == "20 - 30"){ echo "Checked";} ?> name="typical_weekly_hour" id="typical_weekly_hour" type="radio" class="radiobox">20 - 30</span>



                             <span class="radio-row"><input data-validation="required" value="30 - 40"  <?php if($employment_info->typical_weekly_hour == "30 - 40"){ echo "Checked";} ?> name="typical_weekly_hour" id="typical_weekly_hour" type="radio" class="radiobox">30 - 40</span>



                             <span class="radio-row"><input data-validation="required" value="Greater than 40"  <?php if($employment_info->typical_weekly_hour == "Greater than 40"){ echo "Checked";} ?> name="typical_weekly_hour" id="typical_weekly_hour" type="radio" class="radiobox">Greater than 40</span>



                         </div>



                    </div>



                    



                    <div class="row">



                         <div class="col12">



                         	  <p class="msg msg3">Include call time actually providing <br>anesthesia care.</p>



                         </div>



                    </div>  



                    



                     <div class="row">



                         <div class="col12">



                             <label>During the regular hours of a typical week, what number of hours do you spend on the following activities? (Total should equal weekly hours worked provided above)</label>



                         </div>



                    </div>



                    



                    <div class="row">



                         <div class="col4 left-align">



                             <label>Direct Patient Care</label>



                             <input data-validation="required" onchange="" id="employment_information_17" type="text" value="<?php echo $employment_info->divided_1; ?>" name="divided_1" class="form-input small-field total" "11">



                         </div>



                    </div>



                    



                    <div class="row">



                         <div class="col4 left-align">



                             <label class="two-line">Indirect (collateral) <br>patient care</label>



                             <input data-validation="required" onchange="" id="employment_information_18" type="text" value="<?php echo $employment_info->divided_2; ?>" name="divided_2" class="form-input small-field total" "6">



                             <p class="msg msg3">e.g. phone calls, reviewing labs, charting</p>



                         </div>



                    </div>



                    



                    <div class="row">



                         <div class="col4 left-align">



                             <label>Administration</label>



                             <input data-validation="required" onchange="" id="employment_information_19" type="text" value="<?php echo $employment_info->divided_3; ?>" name="divided_3" class="form-input small-field total" "8">



                             <p class="msg msg3">e.g. practice group management, <br>hospital committees</p>



                         </div>



                    </div>



                    



                    <div class="row">



                         <div class="col4 left-align">



                             <label>Nonclinical Teaching</label>



                             <input data-validation="required" onchange="" id="employment_information_20" type="text" value="<?php echo $employment_info->divided_4; ?>" name="divided_4" class="form-input small-field total" "12">



                             <p class="msg msg3">Classroom</p>



                         </div>



                    </div>



                    



                    <div class="row">



                         <div class="col4 left-align">



                             <label>Research</label>



                             <input data-validation="required" onchange="" id="employment_information_21" type="text" value="<?php echo $employment_info->divided_5; ?>" name="divided_5" class="form-input small-field total" "4">



                         </div>



                    </div>



                    



                    <div class="row">



                         <div class="col4 left-align">



                             <label class="three-line">Activities related to <br>quality improvement or <br>patient safety</label>



                             <input data-validation="required" onchange="" id="employment_information_22" type="text" value="<?php echo $employment_info->divided_6; ?>" name="divided_6" class="form-input small-field total" "0">



                             <p class="msg msg3">e.g. practice group management, <br>hospital committees</p>



                         </div>



                    </div>



                    



                    <div class="row">



                         <div class="col4 left-align">



                             <label>Other</label>



                             <input data-validation="required" onchange="" id="employment_information_23" type="text" value="<?php echo $employment_info->divided_7; ?>" name="divided_7" class="form-input small-field total" "1">



                         </div>



                     </div>



                     <div class="row">



                         <div class="col4 left-align">



                             <span class="radio-row"><input type="radio" class="radiobox">



                                <input onclick="other_data5()" id="employment_information_24" <?php if($employment_info->divided_8 == "emp_not_practicing"){ echo "Checked";} ?> value="emp_not_practicing" name="divided_8" type="radio" class="radiobox">



                             N/A: Not currently practicing</span>



                         </div>



                    </div>



                    



                    <div class="row">



                         <div class="col4">



                              <div class="total-row">



                              	   <span class="total-text">Total:</span>



                                   <span class="total-value">42</span>



                              </div>



                         </div>



                    </div>



                    



                    



                 



                                  



                 <div class="submit-row">



                     <button class="save-btn" type="submit" name="employer_compensation_submit" id="employer_compensation_submit" value="Save" class="form-control btn btn-primary"><span>(7/10)</span> SAVE</button>



                 </div>



             </form>



                </div><!--close tab7-->



                



                <div id="tab-8" class="tab-content <?php if($current == 'current8') { echo 'current'; }; ?>">



                    <form id="GeneralInfo_Form2" name="GeneralInfo_Form2"  action="process/tab1.php?tab=current9" enctype="multipart/form-data" method="POST">



                    <div class="row">



                         <div class="col12">



                         	<?php 



                         	if(!empty($employer_benefits->employer_offer_benefit))



                         	{



                         		$other_data_val = explode(',', $employer_benefits->employer_offer_benefit);



                         	}



                         	else



                         	{



                         		$other_data_val = [];



                         	}



                         	



                         	?>



                             <label>Which benefits does your employer offer? (Select all that apply)</label>



                             <span class="radio-row"><input  onchange="" type="radio" class="radiobox other6" <?php if (in_array("Stock Options in Company", $other_data_val)){ echo "Checked";} ?> name="employer_offer_benefit[0]" value="Stock Options in Company" id="Answer23">Stock Options in Company</span>



                             <span class="radio-row"><input  onchange="" type="radio" class="radiobox other6" <?php if (in_array("Health Insurance Plan", $other_data_val)){ echo "Checked";} ?> name="employer_offer_benefit[1]" value="Health Insurance Plan" id="Answer24">Health Insurance Plan</span>



                             <span class="radio-row"><input  onchange="" type="radio" class="radiobox other6" <?php if (in_array("Dental Insurance Plan", $other_data_val)){ echo "Checked";} ?> name="employer_offer_benefit[2]" value="Dental Insurance Plan" id="Answer25">Dental Insurance Plan</span>



                             <span class="radio-row"><input  onchange="" type="radio" class="radiobox other6" <?php if (in_array("Vision Insurance Plan", $other_data_val)){ echo "Checked";} ?> name="employer_offer_benefit[3]" value="Vision Insurance Plan" id="Answer26">Vision Insurance Plan</span>



                             <span class="radio-row"><input  onchange="" type="radio" class="radiobox other6" <?php if (in_array("Short Term Disability Plan", $other_data_val)){ echo "Checked";} ?> name="employer_offer_benefit[4]" value="Short Term Disability Plan" id="Answer27">Short Term Disability Plan</span>



                             <span class="radio-row"><input  onchange="" type="radio" class="radiobox other6" <?php if (in_array("Long Term Disability Plan", $other_data_val)){ echo "Checked";} ?> name="employer_offer_benefit[5]" value="Long Term Disability Plan" id="Answer28">Long Term Disability Plan</span>



                             <span class="radio-row"><input  onchange="" type="radio" class="radiobox other6" <?php if (in_array("Employer Compensated Retirement Plan", $other_data_val)){ echo "Checked";} ?> name="employer_offer_benefit[6]" value="Employer Compensated Retirement Plan" id="Answer29">Employer Compensated Retirement Plan</span>



                             <span class="radio-row"><input  onchange="" type="radio" class="radiobox other6" <?php if (in_array("Self-funded Retirement Plan", $other_data_val)){ echo "Checked";} ?> name="employer_offer_benefit[7]" value="Self-funded Retirement Plan" id="Answer30">Self-funded Retirement Plan</span>



                             <span class="radio-row"><input  onchange="" type="radio" class="radiobox other6" <?php if (in_array("Pension Plan", $other_data_val)){ echo "Checked";} ?> name="employer_offer_benefit[8]" value="Pension Plan" id="Answer31">Pension Plan</span>



                             <span class="radio-row"><input  onchange="" type="radio" class="radiobox other6" <?php if (in_array("Moving Expenses", $other_data_val)){ echo "Checked";} ?> name="employer_offer_benefit[9]" value="Moving Expenses" id="Answer32">Moving Expenses</span>



                             <span class="radio-row"><input  onchange="" type="radio" class="radiobox other6" <?php if (in_array("Life Insurance", $other_data_val)){ echo "Checked";} ?> name="employer_offer_benefit[10]" value="Life Insurance" id="Answer33">Life Insurance</span>



                         </div>



                    </div> 



                    



                    <div class="row">



                         <div class="col8">



                             <label>Other</label>



                             <input  type="text" id="benefit_field0" name="other_benefits" value="<?php echo $employer_benefits->other_benefits; ?>" class="form-input" "">



                         </div>



                    </div> 



                    



                    <div class="row">



                         <div class="col12">



                             <label>What is the anticipated year of your retirement?</label>



                         </div>



                    </div> 



                    



                    <div class="row">



                         <div class="col4">



                             <label>Actual Date</label>



                             <input data-validation="required" type="date" class="form-input" onchange="" id="retirement_field7" name="anticipated_month_retirement" value="<?php echo $employer_retirement->anticipated_month_retirement; ?>" "Month/Day/Year">



                         </div>



                         <div class="col4">



                             <span class="or">or</span>



                             <label>Year only</label>



                             <select data-validation="required" onchange="" id="retirement_field8" name="anticipated_year_retirement" class="form-input">



                                            <option value="">Select Year</option>



                                                <option <?php if($employer_retirement->anticipated_year_retirement == "1970") { echo "selected"; } ?> value="1970" name="day">1970</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "1971") { echo "selected"; } ?> value="1971" name="day">1971</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "1972") { echo "selected"; } ?> value="1972" name="day">1972</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "1973") { echo "selected"; } ?> value="1973" name="day">1973</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "1974") { echo "selected"; } ?> value="1974" name="day">1974</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "1975") { echo "selected"; } ?> value="1975" name="day">1975</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "1976") { echo "selected"; } ?> value="1976" name="day">1976</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "1977") { echo "selected"; } ?> value="1977" name="day">1977</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "1978") { echo "selected"; } ?> value="1978" name="day">1978</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "1979") { echo "selected"; } ?> value="1979" name="day">1979</option>    



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "1980") { echo "selected"; } ?> value="1980" name="day">1980</option>    



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "1981") { echo "selected"; } ?> value="1981" name="day">1981</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "1982") { echo "selected"; } ?> value="1982" name="day">1982</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "1983") { echo "selected"; } ?> value="1983" name="day">1983</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "1984") { echo "selected"; } ?> value="1984" name="day">1984</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "1985") { echo "selected"; } ?> value="1985" name="day">1985</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "1986") { echo "selected"; } ?> value="1986" name="day">1986</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "1987") { echo "selected"; } ?> value="1987" name="day">1987</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "1988") { echo "selected"; } ?> value="1988" name="day">1988</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "1989") { echo "selected"; } ?> value="1989" name="day">1989</option>    



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "1990") { echo "selected"; } ?> value="1990" name="day">1990</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "1991") { echo "selected"; } ?> value="1991" name="day">1991</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "1992") { echo "selected"; } ?> value="1992" name="day">1992</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "1993") { echo "selected"; } ?> value="1993" name="day">1993</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "1994") { echo "selected"; } ?> value="1994" name="day">1994</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "1995") { echo "selected"; } ?> value="1995" name="day">1995</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "1996") { echo "selected"; } ?> value="1996" name="day">1996</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "1997") { echo "selected"; } ?> value="1997" name="day">1997</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "1998") { echo "selected"; } ?> value="1998" name="day">1998</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "1999") { echo "selected"; } ?> value="1999" name="day">1999</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "2000") { echo "selected"; } ?> value="2000" name="day">2000</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "2001") { echo "selected"; } ?> value="2001" name="day">2001</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "2002") { echo "selected"; } ?> value="2002" name="day">2002</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "2003") { echo "selected"; } ?> value="2003" name="day">2003</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "2004") { echo "selected"; } ?> value="2004" name="day">2004</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "2005") { echo "selected"; } ?> value="2005" name="day">2005</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "2006") { echo "selected"; } ?> value="2006" name="day">2006</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "2007") { echo "selected"; } ?> value="2007" name="day">2007</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "2008") { echo "selected"; } ?> value="2008" name="day">2008</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "2009") { echo "selected"; } ?> value="2009" name="day">2009</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "2010") { echo "selected"; } ?> value="2010" name="day">2010</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "2011") { echo "selected"; } ?> value="2011" name="day">2011</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "2012") { echo "selected"; } ?> value="2012" name="day">2012</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "2013") { echo "selected"; } ?> value="2013" name="day">2013</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "2014") { echo "selected"; } ?> value="2014" name="day">2014</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "2015") { echo "selected"; } ?> value="2015" name="day">2015</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "2016") { echo "selected"; } ?> value="2016" name="day">2016</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "2017") { echo "selected"; } ?> value="2017" name="day">2017</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "2018") { echo "selected"; } ?> value="2018" name="day">2018</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "2019") { echo "selected"; } ?> value="2019" name="day">2019</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "2020") { echo "selected"; } ?> value="2020" name="day">2020</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "2021") { echo "selected"; } ?> value="2021" name="day">2021</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "2022") { echo "selected"; } ?> value="2022" name="day">2022</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "2023") { echo "selected"; } ?> value="2023" name="day">2023</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "2024") { echo "selected"; } ?> value="2024" name="day">2024</option>



                                        <option <?php if($employer_retirement->anticipated_year_retirement == "2025") { echo "selected"; } ?> value="2025" name="day">2025</option>



                                        </select>



                         </div>



                    </div> 



                    



                    <div class="row">



                         <div class="col12">



                         	<?php 



                         	if(!empty($employer_retirement->retirement_setup_plan))



                         	{



                         		$other_data_val_new = explode(',', $employer_retirement->retirement_setup_plan);



                         	}



                         	else



                         	{



                         		$other_data_val_new = [];



                         	}



                         	



                         	?>



                             <label>How is your employer retirement plan set up? (Select all that apply)</label>



                             <span class="radio-row"><input  onchange="" type="radio" class="radiobox other7" <?php if(in_array("Profit-sharing", $other_data_val_new)){ echo "Checked";} ?> name="retirement_setup_plan[0]" value="Profit-sharing" id="Answer38">Profit-sharing</span>



                             <span class="radio-row"><input  onchange="" type="radio" class="radiobox other7" <?php if(in_array("Employer Matching at", $other_data_val_new)){ echo "Checked";} ?> name="retirement_setup_plan[1]" value="Employer Matching at" id="Answer39">Employer Matching at</span>



                             <span class="radio-row"><input  onchange="" type="radio" class="radiobox other7" <?php if(in_array("Employer offers Lump Sum per year", $other_data_val_new)){ echo "Checked";} ?> name="retirement_setup_plan[2]" value="Employer offers Lump Sum per year" id="Answer40">Employer offers Lump Sum per year</span>



                             <span class="radio-row"><input  onchange="" type="radio" class="radiobox other7" <?php if(in_array("Pension of ______ after _____ years of service", $other_data_val_new)){ echo "Checked";} ?> name="retirement_setup_plan[3]" value="Pension of ______ after _____ years of service" id="Answer41">Pension of ______ after _____ years of service</span>



                             <span class="radio-row"><input  onchange="" type="radio" class="radiobox other7" <?php if(in_array("Retirement plans offered but without any employer compensation", $other_data_val_new)){ echo "Checked";} ?> name="retirement_setup_plan[4]" value="Retirement plans offered but without any employer compensation" id="Answer42">Retirement plans offered but without any employer compensation</span>



                             <span class="radio-row"><input  onchange="" type="radio" class="radiobox other7" <?php if(in_array("No retirement option offered even though I am a full-time employee", $other_data_val_new)){ echo "Checked";} ?> name="retirement_setup_plan[5]" value="No retirement option offered even though I am a full-time employee" id="Answer43">No retirement option offered even though I am a full-time employee</span>



                             <span class="radio-row"><input  onchange="" type="radio" class="radiobox other7" <?php if(in_array("No retirement option offered because I am a part time employee", $other_data_val_new)){ echo "Checked";} ?> name="retirement_setup_plan[6]" value="No retirement option offered because I am a part time employee" id="Answer44">No retirement option offered because I am a part time employee</span>



                         </div>



                    </div>



                    



                    <div class="row">



                         <div class="col8">



                             <label>Other</label>



                             <input  onchange="" type="text" id="retirement_field0" value="<?php echo $employer_retirement->retirement_setup_plan_other; ?>" name="retirement_setup_plan_other" class="form-input" "">



                         </div>



                    </div> 



                    



                     <div class="row">



                         <div class="col12">



                             <label>How is your employer retirement plan set up? <br>(Please enter a percentage value, dollar amount or corresponding number. Enter values for all fields that apply)</label>



                         </div>



                    </div>



                    



                    <div class="row">



                         <div class="col4 left-align">



                             <label>Profit Sharing %</label>



                             <input data-validation="required" onchange="" type="text" id="retirement_field1" value="<?php echo $employer_retirement->profit_sharing; ?>" name="profit_sharing" class="form-input small-field" "15">



                         </div>



                    </div>



                    



                    <div class="row">



                         <div class="col4 left-align">



                             <label>Employer Matching at %</label>



                             <input data-validation="required" onchange="" type="text" id="retirement_field2" value="<?php echo $employer_retirement->employer_matching; ?>" name="employer_matching" class="form-input small-field" "50">



                         </div>



                    </div>



                    



                    <div class="row">



                         <div class="col4 left-align">



                             <label class="two-line">Employer offers Lump <br>Sum per year of $</label>



                             <input data-validation="required" onchange="" type="text" id="retirement_field3" value="<?php echo $employer_retirement->employer_offer_lumpsum; ?>" name="employer_offer_lumpsum" class="form-input small-field" "1000">



                         </div>



                    </div>



                    



                    <div class="row">



                         <div class="col4 left-align">



                             <label>Pension of (%)</label>



                             <input data-validation="required" onchange="" type="text" id="retirement_field4" value="<?php echo $employer_retirement->pension_of; ?>" name="pension_of" class="form-input small-field" "100">



                         </div>



                    </div>



                    



                    <div class="row">



                         <div class="col4 left-align">



                             <label>Pension of (# of Years)</label>



                             <input data-validation="required" onchange="" type="text" id="retirement_field5" value="<?php echo $employer_retirement->after_service_years; ?>" name="after_service_years" class="form-input small-field" "10">



                         </div>



                    </div>



                    



                    <!-- <div class="row">



                         <div class="col4 left-align">



                             <label>Profit Sharing %</label>



                             <input data-validation="required" type="text" class="form-input small-field" "1" >



                         </div>



                    </div> -->



                    



                    <div class="row">



                         <div class="col4">



                             <label>Other</label>



                             <input  onchange="" type="text" id="retirement_field6" value="<?php echo $employer_retirement->service_offer_other; ?>" name="service_offer_other" class="form-input" "">



                         </div>



                    </div> 



                                  



                 <div class="submit-row">



                     <button class="save-btn" type="submit" name="employe_retirement_submit" id="employe_retirement_submit" value="Save"><span>(8/10)</span> SAVE</button>



                 </div>



             </form>



                </div><!--close tab8-->



                



                <div id="tab-9" class="tab-content  <?php if($current == 'current9') { echo 'current'; }; ?>">



                    <form id="GeneralInfo_Form" name="GeneralInfo_Form"  action="process/tab1.php?tab=current10" enctype="multipart/form-data" method="POST">



                    <div class="row">



                         <div class="col4">



                             <label class="big-label">How many languages do you speak?</label>



                             <select data-validation="required" onchange="" id="skills_field0" name="languages_speak" class="form-input">



                                        <option value="">Select Language</option>



                                        <option <?php if($employee_skills->languages_speak == "1" ){ echo "selected";} ?> value="1">1</option>



<option <?php if($employee_skills->languages_speak == "2" ){ echo "selected";} ?> value="2">2</option>



<option <?php if($employee_skills->languages_speak == "3" ){ echo "selected";} ?> value="3">3</option>



<option <?php if($employee_skills->languages_speak == "4" ){ echo "selected";} ?> value="4">4</option>



<option <?php if($employee_skills->languages_speak == "5" ){ echo "selected";} ?> value="5">5</option>



<option <?php if($employee_skills->languages_speak == "6" ){ echo "selected";} ?> value="6">6</option>



<option <?php if($employee_skills->languages_speak == "7" ){ echo "selected";} ?> value="7">7</option>



<option <?php if($employee_skills->languages_speak == "8" ){ echo "selected";} ?> value="8">8</option>



<option <?php if($employee_skills->languages_speak == "9" ){ echo "selected";} ?> value="9">9</option>



<option <?php if($employee_skills->languages_speak == "10" ){ echo "selected";} ?> value="10">10</option>



                                    </select>



                         </div>



                    </div> 



                    



                    <div class="row">



                         <div class="col12">



                             <label>Do you personally communicate with patients in a language other than English?</label>



                             <span class="radio-row yesno"><input data-validation="required" onchange="" id="skills_lang_1" class="skills_lang_communicate radiobox" type="radio" <?php if($employee_skills->other_than_english == "Yes"){ echo "checked";} ?> name="other_than_english" value="Yes" >Yes</span>



                             <span class="radio-row yesno"><input data-validation="required" onchange="" id="skills_lang_2" class="skills_lang_communicate radiobox" type="radio" <?php if($employee_skills->other_than_english == "No"){ echo "checked";} ?> name="other_than_english" value="No" >No</span>



                         </div>



                    </div>



                    



                    <div class="row">



                         <div class="col4">



                             <label>Language #1</label>



                             <select class="form-input" onchange="" id="skills_field1"  name="which_languages">



                                <option value="">Select One</option>



                             	<option <?php if($employee_skills->which_languages == "Arabic" ){ echo "selected";} ?> value="Arabic">Arabic</option>



<option <?php if($employee_skills->which_languages == "Bengali" ){ echo "selected";} ?> value="Bengali">Bengali</option>



<option <?php if($employee_skills->which_languages == "Chinese" ){ echo "selected";} ?> value="Chinese">Chinese</option>



<option <?php if($employee_skills->which_languages == "French" ){ echo "selected";} ?> value="French">French</option>



<option <?php if($employee_skills->which_languages == "German" ){ echo "selected";} ?> value="German">German</option>



<option <?php if($employee_skills->which_languages == "Hindi" ){ echo "selected";} ?> value="Hindi">Hindi</option>



<option <?php if($employee_skills->which_languages == "Japanese" ){ echo "selected";} ?> value="Japanese">Japanese</option>



<option <?php if($employee_skills->which_languages == "Java" ){ echo "selected";} ?> value="Java">Java</option>



<option <?php if($employee_skills->which_languages == "Korean" ){ echo "selected";} ?> value="Korean">Korean</option>



<option <?php if($employee_skills->which_languages == "Lahnda" ){ echo "selected";} ?> value="Lahnda">Lahnda</option>



<option <?php if($employee_skills->which_languages == "Mandarin" ){ echo "selected";} ?> value="Mandarin">Mandarin</option>



<option <?php if($employee_skills->which_languages == "Marathi" ){ echo "selected";} ?> value="Marathi">Marathi</option>



<option <?php if($employee_skills->which_languages == "Portuguese" ){ echo "selected";} ?> value="Portuguese">Portuguese</option>



<option <?php if($employee_skills->which_languages == "Russian" ){ echo "selected";} ?> value="Russian">Russian</option>



<option <?php if($employee_skills->which_languages == "Spanish" ){ echo "selected";} ?> value="Spanish">Spanish</option>



<option <?php if($employee_skills->which_languages == "Tamil" ){ echo "selected";} ?> value="Tamil">Tamil</option>



<option <?php if($employee_skills->which_languages == "Telugu" ){ echo "selected";} ?> value="Telugu">Telugu</option>



<option <?php if($employee_skills->which_languages == "Turkish" ){ echo "selected";} ?> value="Turkish">Turkish</option>



<option <?php if($employee_skills->which_languages == "Urdu" ){ echo "selected";} ?> value="Urdu">Urdu</option>



<option <?php if($employee_skills->which_languages == "Vietnamese" ){ echo "selected";} ?> value="Vietnamese">Vietnamese</option>



</select>



                         </div>



                         <div class="col4">



                             <label>Language #2</label>



                             <select  class="form-input" onchange="" id="skills_field1"  name="skills_languages2">



                                <option value="">Select One</option>



                                <option <?php if($employee_skills->skills_languages2 == "Arabic" ){ echo "selected";} ?> value="Arabic">Arabic</option>



<option <?php if($employee_skills->skills_languages2 == "Bengali" ){ echo "selected";} ?> value="Bengali">Bengali</option>



<option <?php if($employee_skills->skills_languages2 == "Chinese" ){ echo "selected";} ?> value="Chinese">Chinese</option>



<option <?php if($employee_skills->skills_languages2 == "French" ){ echo "selected";} ?> value="French">French</option>



<option <?php if($employee_skills->skills_languages2 == "German" ){ echo "selected";} ?> value="German">German</option>



<option <?php if($employee_skills->skills_languages2 == "Hindi" ){ echo "selected";} ?> value="Hindi">Hindi</option>



<option <?php if($employee_skills->skills_languages2 == "Japanese" ){ echo "selected";} ?> value="Japanese">Japanese</option>



<option <?php if($employee_skills->skills_languages2 == "Java" ){ echo "selected";} ?> value="Java">Java</option>



<option <?php if($employee_skills->skills_languages2 == "Korean" ){ echo "selected";} ?> value="Korean">Korean</option>



<option <?php if($employee_skills->skills_languages2 == "Lahnda" ){ echo "selected";} ?> value="Lahnda">Lahnda</option>



<option <?php if($employee_skills->skills_languages2 == "Mandarin" ){ echo "selected";} ?> value="Mandarin">Mandarin</option>



<option <?php if($employee_skills->skills_languages2 == "Marathi" ){ echo "selected";} ?> value="Marathi">Marathi</option>



<option <?php if($employee_skills->skills_languages2 == "Portuguese" ){ echo "selected";} ?> value="Portuguese">Portuguese</option>



<option <?php if($employee_skills->skills_languages2 == "Russian" ){ echo "selected";} ?> value="Russian">Russian</option>



<option <?php if($employee_skills->skills_languages2 == "Spanish" ){ echo "selected";} ?> value="Spanish">Spanish</option>



<option <?php if($employee_skills->skills_languages2 == "Tamil" ){ echo "selected";} ?> value="Tamil">Tamil</option>



<option <?php if($employee_skills->skills_languages2 == "Telugu" ){ echo "selected";} ?> value="Telugu">Telugu</option>



<option <?php if($employee_skills->skills_languages2 == "Turkish" ){ echo "selected";} ?> value="Turkish">Turkish</option>



<option <?php if($employee_skills->skills_languages2 == "Urdu" ){ echo "selected";} ?> value="Urdu">Urdu</option>



<option <?php if($employee_skills->skills_languages2 == "Vietnamese" ){ echo "selected";} ?> value="Vietnamese">Vietnamese</option>



                             </select>



                         </div>



                         <div class="col4">



                             <label>Language #3</label>



                             <select  class="form-input" onchange="" id="skills_field1"  name="skills_languages3">



                                <option value="">Select One</option>



                                <option <?php if($employee_skills->skills_languages3 == "Arabic" ){ echo "selected";} ?> value="Arabic">Arabic</option>



<option <?php if($employee_skills->skills_languages3 == "Bengali" ){ echo "selected";} ?> value="Bengali">Bengali</option>



<option <?php if($employee_skills->skills_languages3 == "Chinese" ){ echo "selected";} ?> value="Chinese">Chinese</option>



<option <?php if($employee_skills->skills_languages3 == "French" ){ echo "selected";} ?> value="French">French</option>



<option <?php if($employee_skills->skills_languages3 == "German" ){ echo "selected";} ?> value="German">German</option>



<option <?php if($employee_skills->skills_languages3 == "Hindi" ){ echo "selected";} ?> value="Hindi">Hindi</option>



<option <?php if($employee_skills->skills_languages3 == "Japanese" ){ echo "selected";} ?> value="Japanese">Japanese</option>



<option <?php if($employee_skills->skills_languages3 == "Java" ){ echo "selected";} ?> value="Java">Java</option>



<option <?php if($employee_skills->skills_languages3 == "Korean" ){ echo "selected";} ?> value="Korean">Korean</option>



<option <?php if($employee_skills->skills_languages3 == "Lahnda" ){ echo "selected";} ?> value="Lahnda">Lahnda</option>



<option <?php if($employee_skills->skills_languages3 == "Mandarin" ){ echo "selected";} ?> value="Mandarin">Mandarin</option>



<option <?php if($employee_skills->skills_languages3 == "Marathi" ){ echo "selected";} ?> value="Marathi">Marathi</option>



<option <?php if($employee_skills->skills_languages3 == "Portuguese" ){ echo "selected";} ?> value="Portuguese">Portuguese</option>



<option <?php if($employee_skills->skills_languages3 == "Russian" ){ echo "selected";} ?> value="Russian">Russian</option>



<option <?php if($employee_skills->skills_languages3 == "Spanish" ){ echo "selected";} ?> value="Spanish">Spanish</option>



<option <?php if($employee_skills->skills_languages3 == "Tamil" ){ echo "selected";} ?> value="Tamil">Tamil</option>



<option <?php if($employee_skills->skills_languages3 == "Telugu" ){ echo "selected";} ?> value="Telugu">Telugu</option>



<option <?php if($employee_skills->skills_languages3 == "Turkish" ){ echo "selected";} ?> value="Turkish">Turkish</option>



<option <?php if($employee_skills->skills_languages3 == "Urdu" ){ echo "selected";} ?> value="Urdu">Urdu</option>



<option <?php if($employee_skills->skills_languages3 == "Vietnamese" ){ echo "selected";} ?> value="Vietnamese">Vietnamese</option>



                             </select>



                         </div>



                    </div> 



                    



                    <div class="row">



                         <div class="col4">



                             <label>Language #4</label>



                             <select  class="form-input" onchange="" id="skills_field1"  name="skills_languages4">



                                <option value="">Select One</option>



                               <option <?php if($employee_skills->skills_languages4 == "Arabic" ){ echo "selected";} ?> value="Arabic">Arabic</option>



<option <?php if($employee_skills->skills_languages4 == "Bengali" ){ echo "selected";} ?> value="Bengali">Bengali</option>



<option <?php if($employee_skills->skills_languages4 == "Chinese" ){ echo "selected";} ?> value="Chinese">Chinese</option>



<option <?php if($employee_skills->skills_languages4 == "French" ){ echo "selected";} ?> value="French">French</option>



<option <?php if($employee_skills->skills_languages4 == "German" ){ echo "selected";} ?> value="German">German</option>



<option <?php if($employee_skills->skills_languages4 == "Hindi" ){ echo "selected";} ?> value="Hindi">Hindi</option>



<option <?php if($employee_skills->skills_languages4 == "Japanese" ){ echo "selected";} ?> value="Japanese">Japanese</option>



<option <?php if($employee_skills->skills_languages4 == "Java" ){ echo "selected";} ?> value="Java">Java</option>



<option <?php if($employee_skills->skills_languages4 == "Korean" ){ echo "selected";} ?> value="Korean">Korean</option>



<option <?php if($employee_skills->skills_languages4 == "Lahnda" ){ echo "selected";} ?> value="Lahnda">Lahnda</option>



<option <?php if($employee_skills->skills_languages4 == "Mandarin" ){ echo "selected";} ?> value="Mandarin">Mandarin</option>



<option <?php if($employee_skills->skills_languages4 == "Marathi" ){ echo "selected";} ?> value="Marathi">Marathi</option>



<option <?php if($employee_skills->skills_languages4 == "Portuguese" ){ echo "selected";} ?> value="Portuguese">Portuguese</option>



<option <?php if($employee_skills->skills_languages4 == "Russian" ){ echo "selected";} ?> value="Russian">Russian</option>



<option <?php if($employee_skills->skills_languages4 == "Spanish" ){ echo "selected";} ?> value="Spanish">Spanish</option>



<option <?php if($employee_skills->skills_languages4 == "Tamil" ){ echo "selected";} ?> value="Tamil">Tamil</option>



<option <?php if($employee_skills->skills_languages4 == "Telugu" ){ echo "selected";} ?> value="Telugu">Telugu</option>



<option <?php if($employee_skills->skills_languages4 == "Turkish" ){ echo "selected";} ?> value="Turkish">Turkish</option>



<option <?php if($employee_skills->skills_languages4 == "Urdu" ){ echo "selected";} ?> value="Urdu">Urdu</option>



<option <?php if($employee_skills->skills_languages4 == "Vietnamese" ){ echo "selected";} ?> value="Vietnamese">Vietnamese</option>



                             </select>



                         </div>



                    </div> 



                    



                   



                    <div class="row" style="margin-top: 15px;">



                         <div class="col12">



                             <label>Teaching</label>



                             <span class="radio-row"><input  onchange="" class="environment radiobox" type="radio" <?php if($employee_skills->teach_or_environment == "Yes"){ echo "checked";} ?> name="teach_or_environment" value="Yes" id="environment1">I’m teaching AA students in the operating room environment</span>



                             <span class="radio-row"><input   onchange="" class="healthcare radiobox"  type="radio" <?php if($employee_skills->teach_healthcare_or == "Yes"){ echo "checked";} ?> name="teach_healthcare_or" value="Yes" id="healthcare1">I’m teaching other healthcare learners in the operating room environment</span>



                         </div>



                    </div> 



                   



                    



                    <div class="row" style="margin-top: 15px;">



                         <div class="col12">



                             <label>Which surgical specialties and anesthetic techniques performed do you provide service for?</label>

             <!-- <script>

                             function checkAll(ele) {



                             	



                             	

     var checkboxes = document.getElementsByTagName('input');

     if (ele.checked) {

     	var j=16;

         for (var i = 0; i< var j; i++) {

             if (checkboxes[i].type == 'checkbox') {

                 checkboxes[i].checked = true;

             }

         }

     } else {

     	var k=16;

         for (var i = 0; i< var k; i++) {

             console.log(i)

             if (checkboxes[i].type == 'checkbox') {

                 checkboxes[i].checked = false;

             }

         }

     }

 }

 </script>  -->





                             <!-- <th><INPUT type="checkbox" onchange="checkAll(this)" name="chk[]" />Select All</th>

                          -->

<!-- <script>

                          $(function() {

    $('.chk_boxes').click(function() {

        $('.chk_boxes1').prop('checked', this.checked);

    });

});

</script>

                     -->      <div><input type="checkbox"  class="checkall" onclick="selectall(1)" id="ckbCheckAll" >Selectall</div>

                              <!-- <span class="row"><input  class="skills_techniqies checkbox" type="checkbox" name="all_specialities_techniques" value="select_all" id="SelectAll">&nbsp;Select all</span> --> 

 

                             <span class="row"><input  class="skills_techniqies checkbox" type="checkbox" <?php if("General OB" == $employee_skills->all_specialities_techniques){ echo "Checked";} ?> name="all_specialities_techniques[]" value="General OB" id="Answer71">&nbsp;General OB</span>



                             <span class="row"><input  class="skills_techniqies checkbox" type="checkbox" <?php if("GYN" == $employee_skills->all_specialities_techniques){ echo "Checked";} ?> name="all_specialities_techniques[]" value="GYN" id="Answer72"> &nbsp;GYN</span>



                             <span class="row"><input  class="skills_techniqies checkbox" type="checkbox" <?php if("ENT" == $employee_skills->all_specialities_techniques){ echo "Checked";} ?> name="all_specialities_techniques[]" value="ENT" id="Answer73">&nbsp;ENT</span>



                             <span class="row"><input  class="skills_techniqies checkbox" type="checkbox" <?php if("Vascular" == $employee_skills->all_specialities_techniques){ echo "Checked";} ?> name="all_specialities_techniques[]" value="Vascular" id="Answer74">&nbsp;Vascular</span>



                             <span class="row"><input  class="skills_techniqies checkbox" type="checkbox" <?php if("Thoracic" == $employee_skills->all_specialities_techniques){ echo "Checked";} ?> name="all_specialities_techniques[]" value="Thoracic" id="Answer75">&nbsp;Thoracic</span>



                             <span class="row"><input  class="skills_techniqies checkbox" type="checkbox" <?php if("Cardiac" == $employee_skills->all_specialities_techniques){ echo "Checked";} ?> name="all_specialities_techniques[]" value="Cardiac" id="Answer76">&nbsp;Cardiac</span>



                             <span class="row"><input  class="skills_techniqies checkbox" type="checkbox" <?php if("Neuro" == $employee_skills->all_specialities_techniques){ echo "Checked";} ?> name="all_specialities_techniques" value="Neuro" id="Answer77">&nbsp;Neuro</span>



                             <span class="row"><input  class="skills_techniqies checkbox" type="checkbox" <?php if("Orthopedics" == $employee_skills->all_specialities_techniques){ echo "Checked";} ?> name="all_specialities_techniques[]" value="Orthopedics" id="Answer77">&nbsp;Orthopedics</span>



                             <span class="row"><input  class="skills_techniqies checkbox" type="checkbox" <?php if("Pediatrics" == $employee_skills->all_specialities_techniques){ echo "Checked";} ?> name="all_specialities_techniques[]" value="Pediatrics" id="Answer78">&nbsp;Pediatrics</span>



                             <span class="row"><input  class="skills_techniqies checkbox" type="checkbox" <?php if("Out-of-OR (Radiology; EP; Cath Lab)" == $employee_skills->all_specialities_techniques){ echo "Checked";} ?> name="all_specialities_techniques" value="Out-of-OR (Radiology; EP; Cath Lab)" id="Answer79">&nbsp;Out-of-OR (Radiology; EP; Cath Lab)</span>



                             <span class="row"><input  class="skills_techniqies checkbox" type="checkbox" <?php if("GI procedures" == $employee_skills->all_specialities_techniques){ echo "Checked";} ?> name="all_specialities_techniques[]" value="GI procedures" id="Answer80">&nbsp;GI procedures</span>



                             <span class="row"><input  class="skills_techniqies checkbox" type="checkbox" <?php if("Neuraxial Blocks (Caudal; Epidural or Spinal)" == $employee_skills->all_specialities_techniques){ echo "Checked";} ?> name="all_specialities_techniques[]" value="Neuraxial Blocks (Caudal; Epidural or Spinal)" id="Answer81">&nbsp;Neuraxial Blocks (Caudal; Epidural or Spinal)</span>



                             <span class="row"><input  class="skills_techniqies checkbox" type="checkbox" <?php if("Advanced Neuraxial Blocks (Paravertebral; Cervical or Thoracic Epidural)" == $employee_skills->all_specialities_techniques){ echo "Checked";} ?> name="all_specialities_techniques[]" value="Advanced Neuraxial Blocks (Paravertebral; Cervical or Thoracic Epidural)" id="Answer81">&nbsp;Advanced Neuraxial Blocks (Paravertebral; Cervical or Thoracic Epidural)</span>



                             <span class="row"><input  class="skills_techniqies checkbox" type="checkbox" <?php if("Regional Nerve Blocks" == $employee_skills->all_specialities_techniques){ echo "Checked";} ?> name="all_specialities_techniques[]" value="Regional Nerve Blocks" id="Answer82">&nbsp;Regional Nerve Blocks</span>



                             <span class="row"><input  class="skills_techniqies checkbox" type="checkbox" <?php if("Central Venous Line Placement" == $employee_skills->all_specialities_techniques){ echo "Checked";} ?> name="all_specialities_techniques[]" value="Central Venous Line Placement" id="Answer83">&nbsp;Central Venous Line Placement</span>







<SCRIPT language="javascript">

	

$(document).ready(function () {

    $("#ckbCheckAll").click(function () {

        $(".skills_techniqies").prop('checked', $(this).prop('checked'));

    });

}); 





</SCRIPT>



                         </div>



                    </div>



                    



                    



                    



                    <div class="row">



                         <div class="col8">



                             <label>Other</label>



                             <input  onchange="" class="other_techniques form-input" type="text" name="all_specialities_techniques_other" value="<?php echo $employee_skills->all_specialities_techniques_other; ?>" id="other_techniques1" "">



                         </div>



                    </div> 



                                  



                 <div class="submit-row">



                     <button class="save-btn" type="submit" name="employe_skills_submit" id="employe_skills_submit" value="Save"><span>(9/10)</span> SAVE</button>



                 </div>



             </form>



                </div><!--close tab9-->



                



                <div id="tab-10" class="tab-content <?php if($current == 'current10') { echo 'current'; }; ?>">



                    <form id="GeneralInfo_Form" name="GeneralInfo_Form"  action="process/tab1.php?tab=current1" enctype="multipart/form-data" method="POST">



                    <div class="row">



                         <div class="col12">



                             <label>Do you belong to any other anesthesiology-related groups?</label>



                             <span class="radio-row yesno"><input  type="radio" class="radiobox" onchange="" id="radio_field0" <?php if($other_memberships->belong_to_othermembership == "Yes"){ echo "checked";} ?> name="belong_to_othermembership" value="Yes">Yes</span>



                             <span class="radio-row yesno"><input  type="radio" class="radiobox" onchange="" id="radio_field1" <?php if($other_memberships->belong_to_othermembership == "No"){ echo "checked";} ?> name="belong_to_othermembership" value="No"><label for="radio_field1">No</span>



                         </div>



                    </div>



                    



                    <div class="row">



                         <div class="col8">



                             <label>Enter name of the group</label>



                             <input  id="membership_field3" onchange="" type="text" value="<?php if(!empty($other_memberships->group_name)) {echo $other_memberships->group_name;} ?>" class="form-input" "" name="group_name">



                         </div>



                         <div class="col4">



                             <label>Date Joined</label>



                             <input  type="date" class="form-input" "07/15/1971" id="membership_field1" onchange="" value="<?php if(!empty($other_memberships->dated_joined)) {echo $other_memberships->dated_joined;} ?>" name="dated_joined">



                         </div>



                    </div> 



                    



                    <div class="row">



                         <div class="col4">



                             <label>Membership #</label>



                             <input  id="membership_field3" onchange="" type="text" value="<?php if(!empty($other_memberships->membership_number)) {echo $other_memberships->membership_number;} ?>" class="form-input" "" name="membership_number">



                         </div>



                    </div> 



                    



                    <div class="row">



                         <div class="col12">



                             <label>Insights, comments or notes regarding this group</label>



                             <input  type="text" class="form-input full-width" "" id="membership_field5" onchange="" name="comments" value="<?php if(!empty($other_memberships->comments)){echo $other_memberships->comments;} ?>">



                         </div>



                    </div> 



                    



                    <hr>



                   



                    <div class="row">



                         <div class="col8">



                             <label>Enter name of the group</label>



                             <input  id="membership_field3" onchange="" type="text" value="<?php if(!empty($other_memberships->group_name2)) {echo $other_memberships->group_name2;} ?>" class="form-input" "" name="group_name2">



                         </div>



                         <div class="col4">



                             <label>Date Joined</label>



                             <input  type="date" class="form-input" "07/15/1971" id="membership_field1" onchange="" value="<?php if(!empty($other_memberships->dated_joined2)) {echo $other_memberships->dated_joined2;} ?>" name="dated_joined2">



                         </div>



                    </div> 



                    



                    <div class="row">



                         <div class="col4">



                             <label>Membership #</label>



                             <input  id="membership_field3" onchange="" type="text" value="<?php if(!empty($other_memberships->membership_number2)) {echo $other_memberships->membership_number2;} ?>" class="form-input" "" name="membership_number2">



                         </div>



                    </div> 



                    



                    <div class="row">



                         <div class="col12">



                             <label>Insights, comments or notes regarding this group</label>



                             <input  type="text" class="form-input full-width" "" id="membership_field5" onchange="" name="comments2" value="<?php if(!empty($other_memberships->comments2)){echo $other_memberships->comments2;} ?>">



                         </div>



                    </div> 



                    



                    <hr>



                   



                    <div class="row">



                         <div class="col8">



                             <label>Enter name of the group</label>



                             <input  id="membership_field3" onchange="" type="text" value="<?php if(!empty($other_memberships->group_name3)) {echo $other_memberships->group_name3;} ?>" class="form-input" "" name="group_name3">



                         </div>



                         <div class="col4">



                             <label>Date Joined</label>



                             <input  type="date" class="form-input" "07/15/1971" id="membership_field1" onchange="" value="<?php if(!empty($other_memberships->dated_joined3)) {echo $other_memberships->dated_joined3;} ?>" name="dated_joined3">



                         </div>



                    </div> 



                    



                    <div class="row">



                         <div class="col4">



                             <label>Membership #</label>



                             <input  id="membership_field3" onchange="" type="text" value="<?php if(!empty($other_memberships->membership_number3)) {echo $other_memberships->membership_number3;} ?>" class="form-input" "" name="membership_number3">



                         </div>



                    </div> 



                    



                    <div class="row">



                         <div class="col12">



                             <label>Insights, comments or notes regarding this group</label>



                             <input  type="text" class="form-input full-width" "" id="membership_field5" onchange="" name="comments3" value="<?php if(!empty($other_memberships->comments3)){echo $other_memberships->comments3;} ?>">



                         </div>



                    </div> 



                                  



                 <div class="submit-row">



                     <button class="save-btn" type="submit" name="other_membership_submit" id="other_membership_submit" value="Save"><span>(10/10)</span> SAVE</button>



                 </div>



             </form>



                </div><!--close tab10-->



                



            </div>



            



       </div>



  </div><!--close content--> 



  



  



  



</div><!--close wrapper--> 



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







<script type="text/javascript">



$(document).ready(function(){



    $('.phone').inputmask({"mask": "(999) 999-9999"});



	



	$('ul.tabs li').click(function(){



		var tab_id = $(this).attr('data-tab');







		$('ul.tabs li').removeClass('current');



		$('.tab-content').removeClass('current');







		$(this).addClass('current');



		$("#"+tab_id).addClass('current');



	});







    $('.other6').click(function () {



       $('#benefit_field0').attr('data-validation', '');  



    });







    $('.other7').click(function () {



       $('#retirement_field0').attr('data-validation', '');  



    });















var allRadios = document.getElementsByName('teach_or_environment');



var booRadio;



var x = 0;



for(x = 0; x < allRadios.length; x++){



  allRadios[x].onclick = function() {



    if(booRadio == this){



      this.checked = false;



      booRadio = null;



    } else {



      booRadio = this;



    }



  };



}







var allRadios5 = document.getElementsByName('teach_healthcare_or');



var booRadio5;



var x5 = 0;



for(x5 = 0; x5 < allRadios5.length; x5++){



  allRadios5[x5].onclick = function() {



    if(booRadio5 == this){



      this.checked = false;



      booRadio5 = null;



    } else {



      booRadio5 = this;



    }



  };



}







var allRadios5 = document.getElementsByName('employer_offer_benefit[0]');



var booRadio5;



var x5 = 0;



for(x5 = 0; x5 < allRadios5.length; x5++){



  allRadios5[x5].onclick = function() {



    if(booRadio5 == this){



      this.checked = false;



      booRadio5 = null;



    } else {



      booRadio5 = this;



    }



  };



}







var allRadios5 = document.getElementsByName('employer_offer_benefit[1]');



var booRadio5;



var x5 = 0;



for(x5 = 0; x5 < allRadios5.length; x5++){



  allRadios5[x5].onclick = function() {



    if(booRadio5 == this){



      this.checked = false;



      booRadio5 = null;



    } else {



      booRadio5 = this;



    }



  };



}







var allRadios5 = document.getElementsByName('employer_offer_benefit[2]');



var booRadio5;



var x5 = 0;



for(x5 = 0; x5 < allRadios5.length; x5++){



  allRadios5[x5].onclick = function() {



    if(booRadio5 == this){



      this.checked = false;



      booRadio5 = null;



    } else {



      booRadio5 = this;



    }



  };



}







var allRadios5 = document.getElementsByName('employer_offer_benefit[3]');



var booRadio5;



var x5 = 0;



for(x5 = 0; x5 < allRadios5.length; x5++){



  allRadios5[x5].onclick = function() {



    if(booRadio5 == this){



      this.checked = false;



      booRadio5 = null;



    } else {



      booRadio5 = this;



    }



  };



}







var allRadios5 = document.getElementsByName('employer_offer_benefit[4]');



var booRadio5;



var x5 = 0;



for(x5 = 0; x5 < allRadios5.length; x5++){



  allRadios5[x5].onclick = function() {



    if(booRadio5 == this){



      this.checked = false;



      booRadio5 = null;



    } else {



      booRadio5 = this;



    }



  };



}







var allRadios5 = document.getElementsByName('employer_offer_benefit[5]');



var booRadio5;



var x5 = 0;



for(x5 = 0; x5 < allRadios5.length; x5++){



  allRadios5[x5].onclick = function() {



    if(booRadio5 == this){



      this.checked = false;



      booRadio5 = null;



    } else {



      booRadio5 = this;



    }



  };



}







var allRadios5 = document.getElementsByName('employer_offer_benefit[7]');



var booRadio5;



var x5 = 0;



for(x5 = 0; x5 < allRadios5.length; x5++){



  allRadios5[x5].onclick = function() {



    if(booRadio5 == this){



      this.checked = false;



      booRadio5 = null;



    } else {



      booRadio5 = this;



    }



  };



}







var allRadios5 = document.getElementsByName('employer_offer_benefit[8]');



var booRadio5;



var x5 = 0;



for(x5 = 0; x5 < allRadios5.length; x5++){



  allRadios5[x5].onclick = function() {



    if(booRadio5 == this){



      this.checked = false;



      booRadio5 = null;



    } else {



      booRadio5 = this;



    }



  };



}







var allRadios5 = document.getElementsByName('employer_offer_benefit[9]');



var booRadio5;



var x5 = 0;



for(x5 = 0; x5 < allRadios5.length; x5++){



  allRadios5[x5].onclick = function() {



    if(booRadio5 == this){



      this.checked = false;



      booRadio5 = null;



    } else {



      booRadio5 = this;



    }



  };



}







var allRadios5 = document.getElementsByName('employer_offer_benefit[10]');



var booRadio5;



var x5 = 0;



for(x5 = 0; x5 < allRadios5.length; x5++){



  allRadios5[x5].onclick = function() {



    if(booRadio5 == this){



      this.checked = false;



      booRadio5 = null;



    } else {



      booRadio5 = this;



    }



  };



}







var allRadios5 = document.getElementsByName('all_specialities_techniques');



var booRadio5;



var x5 = 0;



for(x5 = 0; x5 < allRadios5.length; x5++){



  allRadios5[x5].onclick = function() {



    if(booRadio5 == this){



      this.checked = false;



      booRadio5 = null;



    } else {



      booRadio5 = this;



    }



  };



}











var allRadios5 = document.getElementsByName('retirement_setup_plan[0]');



var booRadio5;



var x5 = 0;



for(x5 = 0; x5 < allRadios5.length; x5++){



  allRadios5[x5].onclick = function() {



    if(booRadio5 == this){



      this.checked = false;



      booRadio5 = null;



    } else {



      booRadio5 = this;



    }



  };



}







var allRadios5 = document.getElementsByName('retirement_setup_plan[1]');



var booRadio5;



var x5 = 0;



for(x5 = 0; x5 < allRadios5.length; x5++){



  allRadios5[x5].onclick = function() {



    if(booRadio5 == this){



      this.checked = false;



      booRadio5 = null;



    } else {



      booRadio5 = this;



    }



  };



}







var allRadios5 = document.getElementsByName('retirement_setup_plan[2]');



var booRadio5;



var x5 = 0;



for(x5 = 0; x5 < allRadios5.length; x5++){



  allRadios5[x5].onclick = function() {



    if(booRadio5 == this){



      this.checked = false;



      booRadio5 = null;



    } else {



      booRadio5 = this;



    }



  };



}



 



 var allRadios5 = document.getElementsByName('retirement_setup_plan[3]');



var booRadio5;



var x5 = 0;



for(x5 = 0; x5 < allRadios5.length; x5++){



  allRadios5[x5].onclick = function() {



    if(booRadio5 == this){



      this.checked = false;



      booRadio5 = null;



    } else {



      booRadio5 = this;



    }



  };



}







var allRadios5 = document.getElementsByName('retirement_setup_plan[4]');



var booRadio5;



var x5 = 0;



for(x5 = 0; x5 < allRadios5.length; x5++){



  allRadios5[x5].onclick = function() {



    if(booRadio5 == this){



      this.checked = false;



      booRadio5 = null;



    } else {



      booRadio5 = this;



    }



  };



}











var allRadios5 = document.getElementsByName('retirement_setup_plan[5]');



var booRadio5;



var x5 = 0;



for(x5 = 0; x5 < allRadios5.length; x5++){



  allRadios5[x5].onclick = function() {



    if(booRadio5 == this){



      this.checked = false;



      booRadio5 = null;



    } else {



      booRadio5 = this;



    }



  };



}







var allRadios5 = document.getElementsByName('retirement_setup_plan[6]');



var booRadio5;



var x5 = 0;



for(x5 = 0; x5 < allRadios5.length; x5++){



  allRadios5[x5].onclick = function() {



    if(booRadio5 == this){



      this.checked = false;



      booRadio5 = null;



    } else {



      booRadio5 = this;



    }



  };



}



 



});



</script>







<script src="js/owl.carousel.min.js"></script>







<script>



jQuery('.category-slider').owlCarousel({



		stagePadding: 1,



		responsiveClass:true,



		center: false,



		loop:true,



		margin:25,



		nav:true,



		autoWidth:true,



		dots: false,



		mouseDrag: false,



		responsive:{



			0:{



				items:2



			},



			600:{



				items:3



			},



			1000:{



				items:6



			}



		}



	});



</script>



<?php if($current == 'current2') { ?>



<script type="text/javascript">



$(".category-slider").trigger("to.owl.carousel", [1, 0]);



</script>



<style type="text/css">



/*.tab-link {



    left: -96px;



}*/



</style>



<?php } else if($current == 'current3') { ?>



<script type="text/javascript">



$(".category-slider").trigger("to.owl.carousel", [2, 0]);



</script>	



<style type="text/css">



/*.tab-link {



    left: -194px;



}*/



</style>



<?php } else if($current == 'current4') { ?>



<script type="text/javascript">



$(".category-slider").trigger("to.owl.carousel", [3, 0]);



</script>	



<style type="text/css">



/*.tab-link {



    left: -310px;



}*/



</style>



<?php } else if($current == 'current5') { ?>



<script type="text/javascript">



$(".category-slider").trigger("to.owl.carousel", [4, 0]);



</script>



<style type="text/css">	



/*.tab-link {







    left: -469px;







}*/



</style>



<?php } else if($current == 'current6') { ?>



<script type="text/javascript">



$(".category-slider").trigger("to.owl.carousel", [5, 0]);



</script>	



<style type="text/css">	



/*.tab-link {







    left: -591px;







}*/



</style>



<?php } else if($current == 'current7') { ?>



<script type="text/javascript">



$(".category-slider").trigger("to.owl.carousel", [6, 0]);



</script>	



<style type="text/css">	



/*.tab-link {







    left: -776px;







}*/



</style>



<?php } else if($current == 'current8') { ?>



<script type="text/javascript">



$(".category-slider").trigger("to.owl.carousel", [7, 0]);



</script>	



<style type="text/css">	



/*.tab-link {







    left: -927px;







}*/



</style>



<?php } else if($current == 'current9') { ?>



<script type="text/javascript">



$(".category-slider").trigger("to.owl.carousel", [8, 0]);



</script>	



<style type="text/css">	



/*.tab-link {







    left: -1144px;







}*/



</style>



<?php } else if($current == 'current10') { ?>



<script type="text/javascript">



$(".category-slider").trigger("to.owl.carousel", [9, 0]);



</script>	



<style type="text/css">	



/*.tab-link {







    left: -1211px;







}*/



</style>



<?php } ?>



<script type="text/javascript">



function logout(){



    if(confirm("Are you sure you want to logout?")){



        window.location = "logout.php";



    }else{



        //do your stuff on if press cancel          



    }



}



 $.validate();



 $('.bg-input').prop('readonly',true);



    var sum = 0;



    $(".total").each(function(){



        sum += +$(this).val();



    });



    $(".total-value").text(sum);



$('.total').change(function () {



    var sum = 0;



    $(".total").each(function(){



        sum += +$(this).val();



    });



    $(".total-value").text(sum);



});



$('#hide_img').click(function () {



    if($('#file-2').data('status') == 0)



    {



    $('#file-2').data('status',1);



    $(this).css('background-color','#ccc');



    $('.img-responsive').css('display','none');



    $('#img_data').val('0');



    }



    else



    {



     $('#file-2').data('status',0);



     $(this).css('background-color','#fff');



     $('.img-responsive').css('display','block');



     $('#img_data').val('1');



    }



    



});



 $("#file-2-lable").click(function (){



       



     $('#hide_img').css('background-color','#fff');



     $('#img_data').val('1');



       



     });



function ethnicity_val(value) {



    if(value == "Other")



    {



        $('#ethnicity_other').attr('data-validation', 'required');



    }



    else



    {



        $('#ethnicity_other').attr('data-validation', '');



    }



}











function other_data4(value) {



    if(value == "Other")



    {



        $('#employment_information_1925').attr('data-validation', 'required');



    }



    else



    {



        $('#employment_information_1925').attr('data-validation', '');



    }



}



if('<?php echo $employment_info_type_setting_1; ?>'.indexOf('Other') != -1)



{



$('#other_data2').hide();    



}



function other_data2(value) {



    if(value == "Other")



    {



        $('#other_data2').show();



    }



    else



    {



        $('#other_data2').hide();



    }



}



if('<?php echo $employment_info_type_setting_2; ?>'.indexOf('Other') != -1)



{



$('#other_data3').hide();



}



function other_data3(value) {



    if(value == "Other")



    {



        $('#other_data3').show();



    }



    else



    {



        $('#other_data3').hide();



    }



}







function employer_status(value) {



    if(value == "Not currently employed as a CAA")



    {



        $('#employment_information_7').attr('data-validation', '');



        $('#employment_information_8').attr('data-validation', '');



        $('#employment_information_9').attr('data-validation', '');



        $('#employment_information_9000').attr('data-validation', '');



        $('#employment_information_10').attr('data-validation', '');



        $('#employment_information_11').attr('data-validation', '');



        $('#address_info_field99').attr('data-validation', '');



    }



    else



    {



        $('#employment_information_7').attr('data-validation', 'required');



        $('#employment_information_8').attr('data-validation', 'required');



        $('#employment_information_9').attr('data-validation', 'required');



        $('#employment_information_9000').attr('data-validation', 'required');



        $('#employment_information_10').attr('data-validation', 'required');



        $('#employment_information_11').attr('data-validation', 'required');



        $('#address_info_field99').attr('data-validation', 'required');



    }



}







function other_data5() {



    $('.total').attr('data-validation', '');



    $('.total').val();



    $('.total').prop('readonly',true);



    $('.total-value').text('0');







}



</script>



<?php if($employment_info->divided_8 == "emp_not_practicing")



{



    ?>



    <script type="text/javascript">



      $('.total').attr('data-validation', '');



    $('.total').val();



    $('.total').prop('readonly',true);



    $('.total-value').text('0');



    </script>



    <?php



}



?>

<script src="js/custom-file-input.js"></script>



</body>



</html>

<script type="text/javascript">

  // $(document).ready(function(){

//    // Check or Uncheck All checkboxes

//    $("#RemoveAll").change(function(){

//      var checked = $(this).is(':checked');

//      if(checked){

//        $(".skills_techniqies").each(function(){

//          $(this).prop("checked",true);

//        });

//      }else{

//        $(".skills_techniqies").each(function(){

//          $(this).prop("checked",false);

//        });

//      }

//    });

//    //Changing state of CheckAll checkbox 

// $(".skills_techniqies").click(function(){

 

//     if($(".skills_techniqies").length == $(".skills_techniqies:checked").length) {

//       $("#RemoveAll").prop("checked", true);

//     } else {

//       $("#RemoveAll").removeAttr("checked");

//     }



//   });

// });

//  function checkAll(e) {

//   if (e.hasClass('allfirst'))

//     $('.first').prop('checked', true);

//   else

//     $('.second').prop('checked', true);

// }



// });

$(document).ready(function () {

            //Attach click event

            $('#RemoveAll').click(function () {

                //Uncheck all Radiobuttons inside div

                $('#YourDivID').find("input:radio:checked").prop('checked', true);

            });

});

</script>