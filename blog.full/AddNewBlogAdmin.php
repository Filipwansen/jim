<?php
    require_once "classes/blog.class.php";

    $blog = new BlogObject();
    
    if(isset($_POST) && !empty($_POST)) {
        if($_POST["blog_id"] == "") {
            $blog->created = $_POST['created'];
            $blog->author = $_POST['author'];
            $blog->title = $_POST['title'];
            $blog->contents = $_POST['editor'];
            $blog->publish = $_POST['publish'];

            $result = $blog->create();
            
            if($result) {
                header("Location: ViewAllBlogsAdmin.php");
                exit;
            }
        }else{
            $blog->id = $_POST["blog_id"];
            $blog->created = $_POST['created'];
            $blog->author = $_POST['author'];
            $blog->title = $_POST['title'];
            $blog->contents = $_POST['editor'];
            $blog->publish = $_POST['publish'];

            $result = $blog->update();
            
            if($result) {
                header("Location: ViewAllBlogsAdmin.php");
                exit;
            }
        }
    }

    if(isset($_GET["act"]) && $_GET["act"] == "edit"){
        $blog->id = $_GET['id'];
        $result = $blog->readWithWhere("id = ".$_GET['id']);
        $rec = $result[0];
    }
    
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta xmlns="" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <link rel="stylesheet" type="text/css" href="./admin/fonts/fonts.css">
    <link rel="stylesheet" href="./admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="./admin/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="./admin/css/select.dataTables.min.css">
    <link rel="stylesheet" href="./admin/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="./admin/css/jquery-ui.css">
    <link href="./admin/css/style.css" type="text/css" rel="stylesheet" />

    <title>NCCAA</title>
</head>
<body>

<header>
    <div class="container">
        <div class="headerLogo">
            <a href=""><img src="./admin/images/logo.png" alt="" /> </a>
        </div>
        <div class="headerContent">
            <p>National Commission for Certification of Anesthesiologist Assistants</p>
            <a href="">Logout</a>
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
                            <li>
                                <a href="./admin/Dashboard.html">
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                <a href="./admin/members.html">
                                    Members
                                </a>
                            </li>
                            <li>
                                <a href="./admin/allPrograms.html">
                                    Programs
                                </a>
                            </li>
                            <li>
                                <a href="./admin/allEmployers.html">
                                    Employers
                                </a>
                            </li>
                            <li>
                                <a href="./admin/CMEauditAdmin/CMEauditAdmin.html">
                                    CME Audit
                                </a>
                            </li>
                            <li>
                                <a href="./admin/EmailTextAdmin/AllEmailsAdmin.html">
                                    Email
                                </a>
                            </li>
                            <li>
                                <a href="./admin/ExamAdmin/ExamDatesAdmin.html">
                                    Exams
                                </a>
                            </li>
                            <li class="active">
                                <a href="ViewAllBlogsAdmin.html">
                                    Blog
                                </a>
                            </li>
                            <li>
                                <a href="./admin/allSurveys.html">
                                    Surveys
                                </a>
                            </li>
                            <li>
                                <a href="./admin/financialLedger.html">
                                    Financials
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Settings
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Help
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="top-heading card">
                    <h2>Admin</h2>
                    <span class="toggler"><img src="./admin/images/arrow-doen.png" alt=""></span>
                </div>
                <div class="admin-cards card">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="adminCard member">
                                <h3>ITE Registration</h3>
                                <ul>
                                    <li>Total CAAs<span class="amount">2,497</span></li>
                                    <li>Decertified <span class="amount">9</span></li>
                                    <li>Women <span class="percent">52%</span></li>
                                    <li>Men <span class="percent">48%</span></li>
                                    <li class="gap20"></li>
                                    <li>Total students <span class="amount">330</span>
                                        <ul>
                                            <li>Class of 2019 <span class="amount">162</span></li>
                                            <li>Class of 2020 <span class="amount">168</span></li>
                                            <li>Class of 2021 <span class="amount">168</span></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="adminCard Eregistration">
                                <h3>Cert Registration</h3>
                                <ul>
                                    <li>Total Cert Due 2019 <span class="amount">300</span></li>
                                    <li>Total Cert Registered <span class="amount">250</span></li>
                                    <li>Remaining <span class="amount">500</span></li>
                                    <li class="gap20"></li>
                                    <li>- - Feb. 2019 Registered<span class="amount">208</span></li>
                                    <li>- - June 2019 Registered<span class="amount"> 56</span></li>
                                    <li>- - Oct. 2019 Registered<span class="amount"> 56</span></li>
                                    <li>Remaining <span class="amount"> 13</span></li>
                                    <li class="gap20"></li>
                                    <li>Total Cert Due 2020<span class="amount">1,250</span></li>
                                    <li>-Total Cert Registered<span class="amount"> 750</span></li>
                                    <li>Remaining <span class="amount"> 500</span></li>
                                    <li class="clix"><b>NBME </b><a href="#"> Click Here</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="adminCard Cregistration">
                                <h3>CDQ Registration</h3>
                                <ul>
                                    <li>Total CDQ Due 2019 <span class="amount">276</span></li>
                                    <li>- - Feb. 2019 Registered<span class="amount">208</span></li>
                                    <li>- - June 2019 Registered<span class="amount">56</span></li>
                                    <li>Remaining <span class="amount">13</span></li>
                                    <li class="gap20"></li>
                                    <li>Total CDQ Due 2020<span class="amount">446</span></li>
                                    <li>Total CDQ Due 2021<span class="amount">463</span></li>
                                    <li>Total CDQ Due 2022<span class="amount">414</span></li>
                                    <li>Total CDQ Due 2023<span class="amount">465</span></li>
                                    <li>Total CDQ Due 2024<span class="amount">422</span></li>
                                    <li class="gap20"></li>
                                    <li>Total All 6 Years <span class="amount">2,446</span></li>
                                    <li class="clix"><b>NBME </b><a href="#"> Click Here</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="adminCard financials">
                                <h3>CME Registration</h3>
                                <ul>
                                    <li>Total CME Due 2019<span class="amount">1,250</span></li>
                                    <li>Total Registered<span class="amount">1,000</span></li>
                                    <li>Remaining <span class="amount">250</span></li>
                                    <li class="gap20"></li>
                                    <li>Total CME Due 2020 <span class="amount">1,250</span></li>
                                    <li>Total Registered <span class="amount"> 750</span></li>
                                    <li>Remaining <span class="amount"> 500</span></li>
                                    <li class="gap20"></li>
                                    <li class="clix"><b>NBME </b><a href="#"> Click Here</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="adminCard member2">
                                <h3>Members</h3>
                                <ul>
                                    <li>Total CAAs <span class="amount">2,497</span></li>
                                    <li>Decertified <span class="amount">25</span></li>
                                    <li>Retired <span class="amount">10</span></li>
                                    <li>Women <span class="percent">52%</span></li>
                                    <li>Men <span class="percent">48%</span></li>
                                    <li class="gap20"></li>
                                    <li>Total students <span class="amount">330</span>
                                        <ul>
                                            <li>Class of 2019 <span class="amount">162</span></li>
                                            <li>Class of 2020 <span class="amount">168</span></li>
                                            <li>Class of 2021 <span class="amount">168</span></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="adminCard Eregistration2">
                                <h3>Income</h3>
                                <ul>
                                    <li>YTD Income <span class="amount">$3,729,449.10</span></li>
                                    <li>QTD Income <span class="amount">$1,978,559.83</span></li>
                                    <li>MTD Income <span class="amount">$1,978,559.60</span></li>
                                    <li class="gap20"></li>
                                    <li><b>2019 Income-to-Date</b></li>
                                    <li>ITE<span class="amount">$385,945.47</span></li>
                                    <li>Cert <span class="amount">$289,555.98</span></li>
                                    <li>CDQ<span class="amount">$1,385,945.55</span></li>
                                    <li>CME<span class="amount">$289,555.69</span></li>
                                    <li>Interest <span class="amount">$1,385,945.55</span></li>
                                    <li>Other<span class="amount">$289,555.69</span></li>
                                    <li class="gap20"></li>
                                    <li>Ledger Balance<span class="amount">$2, 289,555</span></li>
                                    <li class="gap20"></li>
                                    <li class="clix"><b>Forecast </b><a href="#"> Click Here</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="adminCard Cregistration2">
                                <h3>Expenses</h3>
                                <ul>
                                    <li>YTD Expenses <span class="amount">$3,729,449.10</span></li>
                                    <li>QTD Expenses <span class="amount">$1,978,559.83</span></li>
                                    <li>MTD Expenses <span class="amount">$385,945</span></li>
                                    <li class="gap20"></li>
                                    <li><b>2019 Income-to-Date</b></li>
                                    <li>ITE<span class="amount">$385,945.47</span></li>
                                    <li>Cert <span class="amount">$289,555.98</span></li>
                                    <li>CDQ<span class="amount">$1,385,945.55</span></li>
                                    <li>CME<span class="amount">$289,555.69</span></li>
                                    <li>Interest <span class="amount">$1,385,945.55</span></li>
                                    <li>Other<span class="amount">$289,555.69</span></li>
                                    <li class="gap20"></li>
                                    <li><b>MTD Income</b><span class="amount">$79,555</span></li>
                                    <li><b>MTD Expenses</b><span class="amount">$55,978</span></li>
                                    <li class="gap20"></li>
                                    <li class="clix"><b>Forecast </b><a href="#"> Click Here</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="adminCard financials2">
                                <h3>Forecasting</h3>
                                <ul>
                                    <li><b>2019</b></li>
                                    <li>ITE Due<span class="amount">$385,945.47</span></li>
                                    <li>Cert Due<span class="amount">$289,555.98</span></li>
                                    <li>CDQ Due<span class="amount">$1,385,945.55</span></li>
                                    <li>CME Due<span class="amount">$289,555.69</span></li>
                                    <li class="gap20"></li>
                                    <li><b>2020</b></li>
                                    <li>ITE Due<span class="amount">$385,945.47</span></li>
                                    <li>Cert Due<span class="amount">$289,555.98</span></li>
                                    <li>CDQ Due<span class="amount">$1,385,945.55</span></li>
                                    <li>CME Due<span class="amount">$289,555.69</span></li>
                                    <li class="gap20"></li>
                                    <li class="clix"><b>XX </b><a href="#"> Click Here</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="member-card card">
                    <h3>Add New Blog</h3>

                    <div class="row">
                        <div class="col-md-12">
                            <form action="AddNewBlogAdmin.php" method="post" id="blogForm">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group border-b-1">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <label>Date:</label>
                                            </div>
                                            <div class="col-md-11">
                                                <input type="hidden" name="blog_id" id="blog_id" class="form-control border-0" value="<?php echo isset($rec["id"]) ? $rec["id"] : "" ?>" />
                                                <input type="text" name="created" id="created" class="form-control border-0" value="<?php echo isset($rec["created"]) ? $rec["created"] : "" ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group border-b-1">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <label>From:</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" name="author" id="author" class="form-control border-0" value="<?php echo isset($rec["author"]) ? $rec["author"] : "" ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group border-b-1">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <label>Title:</label>
                                            </div>
                                            <div class="col-md-11">
                                                <input type="text" name="title" id="title" class="form-control border-0" value="<?php echo isset($rec["title"]) ? $rec["title"] : "" ?>" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="blogsetting card">
                                        <h4>Setting</h4>
                                        <ul>
                                            <li><a href="">Visibility</a> </li>
                                            <li><a href="">Publish Date</a></li>
                                            <li><a href="">Allow Comments</a></li>
                                            <li><a href="">Allow Comments</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group border-b-1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <textarea id="editor" name="editor" class="editor form-control border-0">
                                            <?php echo isset($rec["contents"]) ? $rec["contents"] : "" ?>
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="publish" id="publish" class="form-control border-0" value="No" />
                            <div class="form-group clearfix">
                                <div class="right">
                                    <div class="right margin-l-30">
                                        <button class="btn btn-success" id="publishBlog">Publish</button>
                                        <button class="btn btn-primary" id="saveBlog">Save</button>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="./admin/js/jquery-1.10.2.min.js"></script>
<script src="./admin/js/jquery-ui.js"></script>
<script src="./admin/js/bootstrap.min.js"></script>
<script src="./admin/js/jquery.dataTables.min.js"></script>
<script src="./admin/js/dataTables.bootstrap.min.js"></script>
<script src="./admin/js/dataTables.responsive.min.js"></script>
<script src="./admin/js/dataTables.select.min.js"></script>
<script src="./admin/ckeditor/ckeditor.js"></script>
<script src="./admin/js/custom.js"></script>

<script>
    $(document).ready(function() {
        $("#publishBlog").on("click", function(){
            $("#publish").val("Yes");

            blogForm.submit();
        })
        
        $("#saveBlog").on("click", function(){
            blogForm.submit();
        })
    })
</script>

</body>
</html>