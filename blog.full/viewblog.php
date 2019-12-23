<?php
    require_once "classes/blog.class.php";

    $blog = new BlogObject();

    // page given in URL parameter, default page is one
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    // set number of records per page
    $records_per_page = 3;
    // calculate for the query LIMIT clause
    $from_record_num = ($records_per_page * $page) - $records_per_page;

    $result = $blog->readPaging($from_record_num, $records_per_page);
    $total_rows = $blog->countAll();
    
    // $result = $blog->readWithWhere("publish = 'Yes'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/fonts/font-awesome/fontawesome-all.min.css">
    <link rel="stylesheet" href="./assets/fonts/fonts.css">
    <link rel="stylesheet" href="./assets/css/stylesheet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>index</title>
</head>

<body>
    <div class="wrapper">
	    <header class="header">
            <div class="header-top">
                <div class="container">
                    <div class="header-top-inner d-sm-flex justify-content-between align-items-center">
                        <div class="header-logo">
                            <a href="#"><img src="./assets/images/logo2.png" alt="" class="img-fluid"></a>
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
                                        <li class="nav-item">
                                            <a class="nav-link" href="home.html">Home</a>
                                        </li>
                                        <li class="nav-item  active">
                                            <a class="nav-link" href="blog.html">Blog</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="email.html">Email</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">History</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Surveys</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link logout-btn" href="#">Log Out</a>
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
                                            <img src="./assets/images/profile-img.png" alt="" class="img-fluid">
                                            <p>Soren Campbell</p>
                                            <span>The Christ Hospital</br>2139 Auburn Ave.Cincinnati, OH 45219</span>
                                            <a href="#">Edit Profile</a>
                                        </div>
                                        <div class="ncca-left-info ncca-left-block">
                                            <div class="accordion" id="accordionExample">
                                                <div class="accorion-header" id="headingOne">
                                                    <button class="btn btn-link midium-title p-0" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        NCCA INFO <i class="far fa-question-circle"></i>
                                                    </button>
                                                </div>
                                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <ul>
                                                            <li><b>Employed since: </b> <span>11/18/1999</span></li>
                                                            <li><b>Time: </b> <span>10 years/11 months</span></li>
                                                            <li><b>Status: </b> <span>CAA</span></li>
                                                            <li><b>Certified Through: </b> <span>6/1/2019</span></li>
                                                            <li><b>CME Due Date: </b> <span>6/1/2019</span></li>
                                                            <li><b>CDQ Due Date: </b> <span>6/1/2020</span></li>
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
                                                            <li><b>Graduation: </b> <span>5/11/1997</span></li>
                                                            <li><b>School: </b> <span>Univ.of Colorado - Denver </span></li>
                                                            <li><b>Year 1: </b> <span>1997</span></li>
                                                            <li><b># of Year: </b> <span>17</span></li>
                                                            <li><b>Designation: </b> <span>HHSc</span></li>
                                                            <li><b>Certificate #: </b> <span>584</span></li>  
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ncca-contact">
                                        <p class="midium-title text-uppercase pb-4">NCCA CONTACT</p>
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
                                                    <h3 class="big-title">Welcome back, Soren.</h3>
                                                    <p>
                                                        NCCAA Internal Email:
                                                        <a href="#">soren.campbell@nccaa.org</a>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-6 col-sm-3 jk-20">
                                                <div class="mail-status">
                                                    <h2 class="big-title">4</h2>
                                                    <p>Unread mails</p>
                                                    <a href="#" class="text-blue">Click here</a>
                                                </div>
                                            </div>
                                            <div class="col-6 col-sm-3 jk-20">
                                                <div class="mail-status">
                                                    <h2 class="big-title">4</h2>
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
                                                                    <li class="dots-pink"><span>You have completed only 10% of your profile</span> <a href="#" class="text-blue">Click here</a></li>
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
                                                        <span>June 1, 2019 - only 25 weeks left to register</span>
                                                    </div>
                                                    <div class="cme-block-bottom page-block">
                                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                            <li class="nav-item">
                                                                <a class="nav-link text-blue" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false">History</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link text-blue" id="profile-tab"  href="addcme.html" >Add CME</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link text-blue" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Take</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link text-blue" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Payment</a>
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
                                                        <span>June 1, 2020 - only 18 months left to register</span>
                                                    </div>
                                                    <div class="cme-block-bottom page-block">
                                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                            <li class="nav-item">
                                                                <a class="nav-link text-blue" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">View</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link text-blue" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Prep Course</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link text-blue" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Payment</a>
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
                                                <div class="blog-main block-border ncca-right-padding" style="border-bottom:1px solid #e5e5e5;">
                                                    <p class="midium-title title-bottom-border text-uppercase">VIEW BLOG POST</p>
                                                    <div class="blog-main-container">
                                
                                                        <?php
                                                        if ($result) {
                                                            foreach ($result as $rec) {
                                                        ?>

                                                        <div class="author-time row">
                                                            <div class="col-12">
                                                                <img src="./assets/images/profile-img.png" alt="" class="img-fluid">
                                                                <span class="author-name2"><h4> <?php echo $rec['author'] ?> </h4><p>NCCAA Director</p></span>
                                                            </div>                              
                                                        </div>
                                                        <div class="blog-content con">
                                                            <h3> <?php echo $rec['title'] ?> </h3>
                                                            <?php echo $rec['contents'] ?> 
                                                            <div class="row">
                                                                <div class="col-4 cad"><a href="blog.php?id=<?php echo $rec['id'] ?>">Read More.....</a></div>                              
                                                                <div class="col-8"> 
                                                                    <!-- AddToAny BEGIN -->
                                                                    <div class="a2a_kit a2a_kit_size_32 a2a_default_style shre">
                                                                        <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                                                                        <a class="a2a_button_facebook"></a>
                                                                        <a class="a2a_button_twitter"></a>
                                                                        <a class="a2a_button_google_plus"></a>
                                                                    </div>
                                                                    <script async src="https://static.addtoany.com/menu/page.js"></script>

                                                                    <i onclick="myFunction(this)" class="fa fa-thumbs-up like"></i>
                                                                    <!-- AddToAny END -->
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <?php
                                                            }
                                                        }
                                                        ?>

                                                        <div class="row">
                                                            <div class="col-md-6 col-xs-0"></div>
                                                            <div class="col-md-6 col-xs-12">
                                                                <div class="pagination">
                                                                    <a href="viewblog.php?">&laquo;</a>

                                                                    <?php
                                                                    // calculate total pages
                                                                    $total_pages = ceil($total_rows / $records_per_page);
                                                                    // range of links to show
                                                                    $range = 2;                                                                    
                                                                    // display links to 'range of pages' around 'current page'
                                                                    $initial_num = $page - $range;
                                                                    $condition_limit_num = ($page + $range)  + 1;
                                                                    
                                                                    for ($x=$initial_num; $x<$condition_limit_num; $x++) {
                                                                        // be sure '$x is greater than 0' AND 'less than or equal to the $total_pages'
                                                                        if (($x > 0) && ($x <= $total_pages)) {    
                                                                            // current page
                                                                            if ($x == $page) {
                                                                                echo "<a class='active' href=\"#\">$x <span class=\"sr-only\">(current)</span></a>";
                                                                            } 
                                                                            // not current page
                                                                            else {
                                                                                echo "<a href='viewblog.php?page=$x'>$x</a>";
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>
                                                        
                                                                    <a href="viewblog.php?page=<?php echo $total_pages; ?>">&raquo;</a>
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

</body>
</html>
