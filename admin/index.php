<?php
//define( IS_ADMIN, 'TRUE' );
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once("../config.php");
//print_r($_SESSION);
if(empty($_SESSION['user_id']) || $_SESSION['user_id'] == "")
{
  header('Location: /logincaamember.php');
}
require_once( BASE_PATH . "../includes/util.php");
require_once( BASE_PATH . "../classes/user.class.php");
$userObject = new userObject();
$userObject->init( $_SESSION['user_id'] );
require_once( BASE_PATH . "classes/database.class.php");
global $db;
$db = new Database();
require_once ("classes/admin_dashboard.class.php");
require_once ("classes/exam.class.php"); // include modules class file
require_once ("classes/audit.class.php");
require_once ("classes/certification.class.php");
require_once ("classes/audit_member.class.php");
require_once ("classes/financial.class.php");
require_once ("classes/survey.class.php");
require_once ("classes/visitor.class.php");
require_once ("classes/users.class.php");

require_once( BASE_PATH . "blog/blog.php");

require_once("../email/classes/email.class.php");

global $email;

$email = new EmailObject($db);


global $dashboard_data; 

$dashboard_data = new adminDashboardObject();
global $exam;
$exam = new ExamObject();
global $certification;
$certification = new CertificationExamObject();
global $audit;
$audit = new AuditObject();
global $membercme;
$membercme = new MemberCMEObject();
global $financial;
$financial = new FinancialObject();
global $survey;
$survey = new SurveyObject();
global $visitors;
$visitors = new VisitorsObject();

global $email;
$email = new EmailObject($db);
//Show/no show
if(isset($_POST['id']) && isset($_POST['show_id'])){
  $exam->updateShowAllow($_POST);
}
//pass/fail
if(isset($_POST['id']) && isset($_POST['select_id'])){
  $exam->updateActionNum($_POST);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta xmlns="" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="../css/owl.carousel.css" rel="stylesheet" type="text/css">
  <!-- Jquery Core Js -->
    <script src="../plugins/jquery/jquery.min.js"></script>



    <!-- Bootstrap Core Js -->

    <script src="../plugins/bootstrap/js/bootstrap.js"></script>



    <!-- Select Plugin Js -->

    <script src="../plugins/bootstrap-select/js/bootstrap-select.js"></script>



    <!-- Slimscroll Plugin Js -->

    <script src="../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>



    <!-- Waves Effect Plugin Js -->

    <script src="../plugins/node-waves/waves.js"></script>



    <!-- Jquery Validation Plugin Css -->

    <script src="../plugins/jquery-validation/jquery.validate.js"></script>





    <!-- Jquery CountTo Plugin Js -->

    <script src="../plugins/jquery-countto/jquery.countTo.js"></script>



    <!-- Morris Plugin Js -->

    <script src="../plugins/raphael/raphael.min.js"></script>

    <script src="../plugins/morrisjs/morris.js"></script>

    

    <script src="../plugins/dropzone/4.3.0/dropzone.js"></script>



    <!-- Jquery DataTable Plugin Js -->

    <script src="../plugins/jquery-datatable/jquery.dataTables.js"></script>

    <script src="../plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>

    <script src="../plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>

    <script src="../plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>

    <script src="../plugins/jquery-datatable/extensions/export/jszip.min.js"></script>

    <script src="../plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>

    <script src="../plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>

    <script src="../plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>

    <script src="../plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>





    <!-- Bootstrap Notify Plugin Js -->

    <script src="../plugins/bootstrap-notify/bootstrap-notify.js"></script>



    <!-- SweetAlert Plugin Js -->

		<script src="../plugins/sweetalert/sweetalert.min.js"></script>



		<!-- Wait Me Plugin Js -->

		<script src="../plugins/waitme/waitMe.js"></script>





		<!-- Editable Table Plugin Js -->

		<script src="../plugins/editable-table/mindmup-editabletable.js"></script>
    <script src="../plugins/jquery-datatable/dataTables.checkboxes.min.js"></script>

		<script src="../plugins/bootstrap-select/js/bootstrap-select.js"></script>



  	<script src="../js/jquery-ui.min.js"></script>



	<link href="../css/jquery-ui.min.css" rel="stylesheet" type="text/css">

	<link href="../css/jquery-ui.structure.min.css" rel="stylesheet" type="text/css">

	<link href="../css/jquery-ui.theme.min.css" rel="stylesheet" type="text/css">



    <link rel="stylesheet" href="./css/bootstrap.min.css">

    <link rel="stylesheet" href="./css/dataTables.bootstrap.min.css">

    <link rel="stylesheet" href="./css/select.dataTables.min.css">

    <link rel="stylesheet" href="./css/buttons.dataTables.min.css">
    
    <link rel="stylesheet" href="./css/dataTables.checkboxes.css">

    <link rel="stylesheet" href="./css/jquery-ui.css">

    <link rel="stylesheet" href="./css/jquery.gritter.css">

    <link rel="stylesheet" type="text/css" href="./fonts/fonts.css">

    <link href="./css/style.css" type="text/css" rel="stylesheet" />

    <link rel="stylesheet" href="./css/bootstrap-datepicker.css">

    <link rel="stylesheet" href="../assets/fonts/font-awesome/fontawesome-all.min.css">



    <title>NCCAA</title>

</head>
<body>
<header>
  <div class="container">
    <div class="headerLogo">
      <a href="/member/"><img src="./images/logo.png" alt="" /> </a>
    </div>
    <div class="headerContent">
      <p>National Commission for Certification of Anesthesiologist Assistants</p>
      <a href="../../logout.php">Logout</a>
    </div>
  </div>
</header>
<section class="mainContent">
  <div class="innerContainer">
    <div class="row">
      <div class="col-lg-2">
        <div class="sidebar card">
          <nav id="sidebar" class="_bgdark">
            <ul class="list-unstyled components">
              <li
                  <?php
                  if(isset($_GET['li_class'])){
                    if($_GET['li_class'] == 'Dashboard'){
                      echo 'class="active"';
                    }
                  }else{
                    echo 'class="active"';
                  }
                  ?>
              >
                <a href="?content=content/admin_dashboard&li_class=Dashboard">
                  Dashboard
                </a>
              </li>
              <li
                  <?php
                  if(isset($_GET['li_class'])){
                    if($_GET['li_class'] == 'Members'){
                      echo 'class="active"';
                    }
                  }
                  ?>
              >
                <a href="?content=content/members&li_class=Members">
                  Members
                </a>
              </li>
              <li
                  <?php
                  if(isset($_GET['li_class'])){
                    if($_GET['li_class'] == 'Programs'){
                      echo 'class="active"';
                    }
                  }
                  ?>
              >
                <a href="?content=content/programs&li_class=Programs">
                  Programs
                </a>
              </li>
              <li
                  <?php
                  if(isset($_GET['li_class'])){
                    if($_GET['li_class'] == 'Employers'){
                      echo 'class="active"';
                    }
                  }
                  ?>
              >
                <a href="?content=content/employers&li_class=Employers">
                  Employers
                </a>
              </li>
              <li
                  <?php
                  if(isset($_GET['li_class'])){
                    if($_GET['li_class'] == 'CME'){
                      echo 'class="active"';
                    }
                  }
                  ?>
              >
                <a href="?content=content/audit&li_class=CME">
                  CME Audit
                </a>
              </li>
              <li
                  <?php
                  if(isset($_GET['li_class'])){
                    if($_GET['li_class'] == 'Exams'){
                      echo 'class="active"';
                    }
                  }
                  ?>
              >
                <a href="?content=content/exams&li_class=Exams">
                  Exams
                </a>
              </li>
              <li
                  <?php
                  if(isset($_GET['li_class'])){
                    if($_GET['li_class'] == 'Financials'){
                      echo 'class="active"';
                    }
                  }
                  ?>
              >
                <a href="?content=content/financial&li_class=Financials">
                  Financials
                </a>
              </li>
              <li
                  <?php
                  if(isset($_GET['li_class'])){
                    if($_GET['li_class'] == 'Email'){
                      echo 'class="active"';
                    }
                  }
                  ?>
              >
                <a href="?content=../email/admin/ViewAllEmail&li_class=Email">
                  Email
                </a>
              </li>
<!-- >> Email Blast -->
              <li <?php
                  if(isset($_GET['li_class'])){
                    if($_GET['li_class'] == 'EmailBlast'){
                      echo 'class="active"';
                    }
                  }
                  ?>
              >
                <a href="?content=../emailblast/admin/ViewAllBlastEmail&li_class=EmailBlast">Blast Email</a>
              </li>
<!-- << Email Blast  -->

              <li
                  <?php
                  if(isset($_GET['li_class'])){
                    if($_GET['li_class'] == 'Blog'){
                      echo 'class="active"';
                    }
                  }
                  ?>
              >
                <a href="?content=../blog/admin/ViewAllBlogs&li_class=Blog">
                  Blog
                </a>
              </li>
              <li
                  <?php
                  if(isset($_GET['li_class'])){
                    if($_GET['li_class'] == 'Surveys'){
                      echo 'class="active"';
                    }
                  }
                  ?>
              >
                <a href="?content=content/surveys&li_class=Surveys">
                  Surveys
                </a>
              </li>
              <li
                  <?php
                  if(isset($_GET['li_class'])){
                    if($_GET['li_class'] == 'Settings'){
                      echo 'class="active"';
                    }
                  }
                  ?>
              >
                <a href="?content=content/settings&li_class=Settings">
                  Settings
                </a>
              </li>
              <li
                  <?php
                  if(isset($_GET['li_class'])){
                    if($_GET['li_class'] == 'Visitors'){
                      echo 'class="active"';
                    }
                  }
                  ?>
              >
                <a href="?content=content/visitors&li_class=Visitors">
                  Visitors
                </a>
              </li>
              <li
                  <?php
                  if(isset($_GET['li_class'])){
                    if($_GET['li_class'] == 'Help'){
                      echo 'class="active"';
                    }
                  }
                  ?>
              >
                <a href="?content=content/help&li_class=Help">
                  Help
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
      <div class="col-lg-10">
        <?PHP
        if ( ( ! isset( $_REQUEST["content"] ) ) ||  ( $_REQUEST["content"]=="" ) ) $content="dashboard.php";
        else $content = $_REQUEST["content"].".php";
        if ( $content!="" ) include( $content );
        ?>
      </div>
    </div>
  </div>
</section>

<script src="https://cdn.ckeditor.com/4.11.4/standard-all/ckeditor.js"></script>
<script src="./js/custom.js"></script>
<script src="./js/jquery.gritter.min.js"></script>
<script src="./js/bootstrap-datepicker.js"></script>
<script src="./js/bootstrap-datepicker.min.js"></script>
<script>

    function confirmDelete(anchor)

    { 

        var conf = confirm('Are you sure want to delete this?');

        if(conf) {

            window.location=anchor.attr("href");

        }

            

    }

	

</script>
</body>
</html>