<?php 
<html xmlns="http://www.w3.org/1999/xhtml">
    <meta xmlns="" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <link rel="stylesheet" type="text/css" href="../admin/fonts/fonts.css">
    <link rel="stylesheet" href="../admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="../admin/css/select.dataTables.min.css">
    <link rel="stylesheet" href="../admin/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="../admin/css/jquery-ui.css">
    <link href="../admin/css/style.css" type="text/css" rel="stylesheet" />
	<link rel="stylesheet" href="../admin/css/bootstrap-datepicker.css">
    <title>NCCAA</title>
</head>
<body>

<header>
    <div class="container">
        <div class="headerLogo">
            <a href="../admin/"><img src="../admin/images/logo.png" alt="" /> </a>
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

                    <div class="innerlogo">
                        <img src="../admin/images/inner-logo.png" alt="" class="img-responsive" />
                    </div>
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
                            <div class="card clearfix">
                                <div class="profpic">
                                    <img src="<?php echo $pd_info[0]['Photo']?>" alt="" class="img-responsive" />
                                </div>
                                <div class="profpicinner">
                                    <h4><?php echo $pd_info[0]['Title']?></h4>
                                    <p><?php echo $pd_info[0]['First_Name']." ".$pd_info[0]['Last_Name']. " " . $pd_info[0]['Designation']?></p>
                                    <p><?php echo $university_name;?></p>
                                    <p><?php echo $pd_info[0]['Cell_Phone']?> (<a href="mailto:<?php echo $pd_info[0]['Email']?>"><?php echo $pd_info[0]['Email']?></a> ) </p>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-6">
                            <div class="card clearfix">
                                <div class="profpic">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card clearfix">
                                <div class="profpic">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="yearsmain ">
                    <ul class="yeartabs clearfix ">
                        <li><a id="class_of1" onclick="javascript:class_of1(<?php echo date('Y');?>)">Class of <?php echo date('Y');?></a> </li>
                        <li><a id="class_of2" onclick="javascript:class_of2(<?php echo (date('Y') + 1);?>)">Class of <?php echo (date('Y') + 1);?></a></li>
                        <li><a id="class_of3" onclick="javascript:class_of3(<?php echo (date('Y') + 2);?>)">Class of <?php echo (date('Y') + 2);?></a></li>
                    </ul>
                </div>
                <div class="member-card card border-top-0">
                    <div class="yearsinnerlinks">
                        <ul class="clearfix">
                            <li><a href="./" class="active">Overview</a> </li>
                            <li><a href="./programPortalITEexamWeb.php">ITE Exam</a> </li>
                            <li><a href="./programPortalCertExamWeb.php">Certification Exam</a> </li>
                            <li><a href="./programPortalGraduationWeb.php">Graduation</a> </li>
                        </ul>
                    </div>
                        <div class="col-md-4">
                            <div class="yeardetialblock">
                                <ul>
                                    <li><p># Students <span id="count_student"></span></p></li>
                                    <li><p>Matriculation <span>6/5/17</span></p></li>
                                    <li><p>Expected ITE Exam <span>6/1/18</span></p></li>
                                    <li><p>Expected Cert Exam <span>6/10/19</span></p></li>
                                    <li><p>Expected Graduation<span>8/10/19</span></p></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-8 padding-l-0">
                            <table id="overviewTable" class="table ntable table-striped table-bordered nowrap whiteheading" style="width:100%">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Class</th>
                                        <th>Email</th>
                                </thead>
                                <tbody id="load_data">
                                    <!--tr>
                                        <td></td>
                                        <td>Emily</td>
                                        <td>Allan</td>
                                        <td>2019</td>
                                        <td>eallan@iu.edu</td>
                                    </tr-->
                                </tbody>
                            </table>
                            <div class="form-group tablebtn whitesubmit">
                                <input type="button" value="Submit" class="btn btn-primary" onclick="javascript:check_submit()" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="../admin/js/jquery-ui.js"></script>
<script src="../admin/js/bootstrap.min.js"></script>
<script src="../admin/js/jquery.dataTables.min.js"></script>
<script src="../admin/js/dataTables.bootstrap.min.js"></script>
<script src="../admin/js/dataTables.responsive.min.js"></script>
<script src="../admin/js/dataTables.buttons.min.js"></script>
<script src="../admin/js/buttons.print.min.js"></script>
<script src="../admin/js/dataTables.select.min.js"></script>
<script src="js/programportal.js"></script>
</html>