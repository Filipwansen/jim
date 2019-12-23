<?phpsession_start();//print_r($_SESSION);if($_SESSION['user_id'] == "" || empty($_SESSION['user_id'])){    header('Location: ../logincaamember.php');}   ?><!DOCTYPE html><html lang="en"><head>    <meta charset="UTF-8">    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">    <meta http-equiv="X-UA-Compatible" content="ie=edge">    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">    <link rel="stylesheet" href="./assets/fonts/font-awesome/fontawesome-all.min.css">    <link rel="stylesheet" href="./assets/fonts/fonts.css">    <link rel="stylesheet" href="./assets/css/stylesheet.css">    <title>index</title></head><body>    <div class="wrapper">	    <header class="header">        <div class="header-top">          <div class="container">            <div class="header-top-inner d-sm-flex justify-content-between align-items-center">              <div class="header-logo">                <a href="/member/home.php"><img src="./assets/images/logo2.png" alt="" class="img-fluid"></a>              </div>              <div class="header-top-right">                <p>National Commission for Certification of Anesthesiologist Assistants</p>              </div>            </div>          </div>        </div>        <div class="header-bottom">          <div class="container">            <div class="header-bottom-inner">              <div class="heade-menu">                  <nav class="navbar navbar-expand-md">                    <div class="header-search">                      <form class="form-inline position-relative">                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">                        <div class="header-search-icon">                            <i class="fas fa-search"></i>                        </div>                      </form>                    </div>                    <div class="collapse navbar-collapse" id="navbardropdown">                      <div class="mobile-logo d-md-none">                        <a href="#"><img src="./assets/images/logo2.png" alt="" class="img-fluid"></a>                      </div>                      <ul class="navbar-nav ml-auto">                        <li class="nav-item">                          <a class="nav-link" href="home.php">Home</a>                        </li>                        <li class="nav-item">                          <a class="nav-link" href="blogviewall.php">Blog</a>                        </li>                        <li class="nav-item active">                          <li <?php if(isset($_GET['item'])){	if($_GET['item'] == 'emailpage'){		echo 'class="nav-item active"';	}else{		echo 'class="nav-item"';	}}else{		echo 'class="nav-item"';}?>						>                          <a class="nav-link" href="?content=content/emailviewall&item=emailpage">Email</a>                        </li>                        </li>                        <li class="nav-item">                          <a class="nav-link" href="cmehistory.php">History</a>                        </li>                        <li class="nav-item">                          <a class="nav-link" href="homesurvey1.php">Surveys</a>                        </li>                        <li class="nav-item">                          <a class="nav-link logout-btn" href="logout.php">Log Out</a>                        </li>                      </ul>                    </div>                    <button class="navbar-toggler pr-0" type="button" data-toggle="collapse" data-target="#navbardropdown" aria-controls="navbardropdown" aria-expanded="false" aria-label="Toggle navigation">                        <i class="fas fa-bars"></i>                    </button>                  </nav>              </div>            </div>          </div>        </div>    	</header>    	<section>        <div class="page-block ncca-section">          <div class="container">            <div class="ncca-section-inner">              <div class="row">                <div class="col-lg-4 left-side-bar">                  <div class="page-block block-border page-block-margin">                    <div class="ncca-left-section page-block">                      <div class="ncca-profile ncca-left-block">                          <img src="./assets/images/profile-img.png" alt="" class="img-fluid">                          <p>Soren Campbell</p>                          <span>The Christ Hospital</br>2139 Auburn Ave.Cincinnati, OH 45219</span>                          <a href="#">Edit Profile</a>                      </div>                      <div class="ncca-left-info ncca-left-block">                        <div class="accordion" id="accordionExample">                            <div class="accorion-header" id="headingOne">                              <button class="btn btn-link midium-title p-0" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">                                  NCCA INFO <i class="far fa-question-circle"></i>                              </button>                            </div>                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">                              <div class="accordion-body">                                <ul>                                  <li><b>Employed since: </b> <span>11/18/1999</span></li>                                  <li><b>Time: </b> <span>10 years/11 months</span></li>                                  <li><b>Status:</b> <span>CAA</span></li>                                  <li><b>Certified Through: </b> <span>6/1/2019</span></li>                                  <li><b>CME Due Date: </b> <span>6/1/2019</span></li>                                  <li><b>CDQ Due Date: </b> <span>6/1/2020</span></li>                                </ul>                              </div>                            </div>                        </div>                      </div>                      <div class="ncca-left-info ncca-left-block">                        <div class="accordion" id="accordionExample">                            <div class="accorion-header" id="headingOne">                              <button class="btn btn-link midium-title p-0" type="button" data-toggle="collapse" data-target="#education_info" aria-expanded="true" aria-controls="education_info">                                  EDUCATION INFO <i class="far fa-question-circle"></i>                              </button>                            </div>                            <div id="education_info" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">                              <div class="accordion-body">                                <ul>                                  <li><b>Graduation: </b> <span>5/11/1997</span></li>                                  <li><b>School: </b> <span>Univ.of Colorado - Denver </span></li>                                  <li><b>Year 1: </b> <span>1997</span></li>                                  <li><b># of Year: </b> <span>17</span></li>                                  <li><b>Designation: </b> <span>HHSc</span></li>                                  <li><b>Certificate #: </b> <span>584</span></li>                                  </ul>                              </div>                            </div>                        </div>                      </div>                    </div>                    <div class="ncca-contact">                      <p class="midium-title text-uppercase pb-4">NCCA CONTACT</p>                      <ul>                        <li>Cynthia Maraugha</li>                        <li><a href="#">612-859-4415</a></li>                        <li><a href="#">cynthia@nccaa.org</a></li>                      </ul>                    </div>                  </div>                  <div class="facebook-icon page-block">                    <a href="#" class="facebook"><i class="fab fa-facebook-square"></i> <span>Share on facebook</span></a>                  </div>                </div>                <div class="col-lg-8 main-container">                  <div class="ncca-right-section page-block">                    <div class="ncca-right-block block-border ncca-right-padding page-block-margin">                      <div class="row">                        <div class="col-sm-6 pr-0 jk-60">                          <div class="ncca-welcome">                            <h3 class="big-title">Welcome back, Soren.</h3>                            <p>                              NCCAA Internal Email:                              <a href="#">soren.campbell@nccaa.org</a>                            </p>                          </div>                        </div>                        <div class="col-6 col-sm-3 jk-20">                          <div class="mail-status">                            <h2 class="big-title">4</h2>                            <p>Unread mails</p>                            <a href="#" class="text-blue">Click here</a>                          </div>                        </div>                        <div class="col-6 col-sm-3 jk-20">                          <div class="mail-status">                            <h2 class="big-title">4</h2>                            <p>Unread posts</p>                            <a href="#" class="text-blue">Click here</a>                          </div>                        </div>                        <div class="col-sm-12">                          <div class="ncca-reminders">                            <div class="accordion" id="accordionExample">                                <div class="accorion-header" id="headingOne">                                  <button class="btn btn-link midium-title text-uppercase p-0" type="button" data-toggle="collapse" data-target="#reminder_accordion" aria-expanded="true" aria-controls="reminder_accordion">REMINDERS</button>                                </div>                                <div id="reminder_accordion" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">                                  <div class="accordion-body">                                    <ul>                                      <li class="dots-pink"><span>You have completed only 10% of your profile</span> <a href="#" class="text-blue">Click here</a></li>                                      <li class="dots-green"><span>"New Blog Posts Name" has been published today.</span><a href="#" class="text-blue">Click here</a></li>                                    </ul>                                  </div>                                </div>                            </div>                           </div>                        </div>                      </div>                    </div>                   <div class="ncca-right-block cme-block-main">                      <div class="row">                        <div class="col-sm-6">                          <div class="page-block block-border page-block-margin">                            <div class="cme-block-head ncca-right-padding">                              <p class="midium-title text-uppercase">CME</p>                              <b>Deadline:</b>                              <span>June 1, 2019 - only 25 weeks left to register</span>                            </div>                            <div class="cme-block-bottom page-block">                              <ul class="nav nav-tabs" id="myTab" role="tablist">                                <li class="nav-item">                                  <a class="nav-link  text-blue" href="cmehistory.php">History</a>                                </li>                                <li class="nav-item">                                  <a class="nav-link text-blue" href="cmeadd.php">Add CME</a>                                </li>                                <li class="nav-item">                                  <a class="nav-link text-blue" id="contact-tab" data-toggle="tab" href="#" role="tab" aria-controls="contact" aria-selected="false">NCCAA CMEs</a>                                </li>                              </ul>                            </div>                          </div>                        </div>                        <div class="col-sm-6">                          <div class="page-block block-border page-block-margin">                            <div class="cme-block-head ncca-right-padding">                              <p class="midium-title ">CDQ Exam</p>                              <b>Deadline:</b>                              <span>June 1, 2020 - only 18 months left to register</span>                            </div>                            <div class="cme-block-bottom page-block">                              <ul class="nav nav-tabs" id="myTab" role="tablist">                                <li class="nav-item">                                  <a class="nav-link text-blue" href="cdqhistory.php" role="tab">History</a>                                </li>                                <li class="nav-item">                                  <a class="nav-link text-blue" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">NCCAA Prep Course</a>                                </li>                              </ul>                            </div>                          </div>                        </div>                      </div>                    </div>                    <div class="ncca-right-block ">                      <div class="tab-content" id="myTabContent">                         <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">                          <div class="block-border ncca-right-padding">                            <p class="midium-title title-bottom-border text-uppercase">EMAIL</p>                                                                                <div class = "sub-block-header" style="min-height: 65px">                              <a href="emailnew.php"><button class="btn btn-blue compose" style="float: left;"><span class='big-font'>+</span><span>Compose new message</span></button></a>                              <div class="header-search" style="float: right;">                                <form class="form-inline position-relative">                                  <input class="form-control mr-sm-2" type="search" style="margin-right: 0px !important;" placeholder="Search" aria-label="Search">                                  <div class="header-search-icon">                                      <i class="fas fa-search"></i>                                  </div>                                </form>                              </div>                                                          </div>                            <div class = "sub-block-header" style="min-height: 50px">                              <div class="form-group row">                                                                <select class="col-sm-5 col-md-3 align-self-center form-control">                                  <option value="">View only mails</option>                                  <option value="">View all</option>                                                                  </select>                                                              <label class="col-sm-4 col-md-7 text-right align-self-center" style="padding-top: 9px;">Jump To</label>                                <select class="col-sm-3 col-md-2 align-self-center form-control">                                  <option value="">Page 1</option>                                  <option value="">Page 2</option>                                  <option value="">Page 3</option>                                </select>                              </div>                               <div class="row pagenation">                                <div class="col-6">                                  <p>1-20 from 302 emails</p>                                </div>                                <div class="col-6 text-right">                                  <span class="left-arrow"><a href="#"><img src="./assets/images/next.png"></a></span><span class="active"><a href="#" class="active">1</a></span><span>...</span><span><a href="#">3 </a><a href="#">4 </a><a href="#">5 </a></span><span>...</span><span><a href="#">16</a></span><span class="right-arrow"><a href="#"><img src="./assets/images/next.png"></a></span>                                </div>                              </div>                                             </div>                            <div class="email-content">                              <table class="table table-striped">                                <thead>                                                                    <tr>                                    <th>From</th>                                    <th>Subject</th>                                    <th>Date</th>                                    <th>Size</th>                                  </tr>                                </thead>                                <tbody>                                  <tr class="active">                                    <td>Cynthia Maraugha</td>                                    <td>Upcoming Meeting in Ft.Lauderdale</td>                                    <td>9/9/2018</td>                                    <td>350kb</td>                                  </tr>                                  <tr class="active">                                    <td>Cynthia Maraugha</td>                                    <td>Upcoming Meeting in Ft.Lauderdale</td>                                    <td>9/9/2018</td>                                    <td>350kb</td>                                  </tr>                                  <tr>                                    <td>Cynthia Maraugha</td>                                    <td>Upcoming Meeting in Ft.Lauderdale</td>                                    <td>9/9/2018</td>                                    <td>350kb</td>                                  </tr>                                  <tr>                                    <td>Cynthia Maraugha</td>                                    <td>Upcoming Meeting in Ft.Lauderdale</td>                                    <td>9/9/2018</td>                                    <td>350kb</td>                                  </tr>                                  <tr>                                    <td>Cynthia Maraugha</td>                                    <td>Upcoming Meeting in Ft.Lauderdale</td>                                    <td>9/9/2018</td>                                    <td>350kb</td>                                  </tr>                                  <tr>                                    <td>Cynthia Maraugha</td>                                    <td>Upcoming Meeting in Ft.Lauderdale</td>                                    <td>9/9/2018</td>                                    <td>350kb</td>                                  </tr>                                  <tr>                                    <td>Cynthia Maraugha</td>                                    <td>Upcoming Meeting in Ft.Lauderdale</td>                                    <td>9/9/2018</td>                                    <td>350kb</td>                                  </tr>                                  <tr>                                    <td>Cynthia Maraugha</td>                                    <td>Upcoming Meeting in Ft.Lauderdale</td>                                    <td>9/9/2018</td>                                    <td>350kb</td>                                  </tr>                                  <tr>                                    <td>Cynthia Maraugha</td>                                    <td>Upcoming Meeting in Ft.Lauderdale</td>                                    <td>9/9/2018</td>                                    <td>350kb</td>                                  </tr>                                  <tr>                                    <td>Cynthia Maraugha</td>                                    <td>Upcoming Meeting in Ft.Lauderdale</td>                                    <td>9/9/2018</td>                                    <td>350kb</td>                                  </tr>                                  <tr>                                    <td>Cynthia Maraugha</td>                                    <td>Upcoming Meeting in Ft.Lauderdale</td>                                    <td>9/9/2018</td>                                    <td>350kb</td>                                  </tr>                                  <tr>                                    <td>Cynthia Maraugha</td>                                    <td>Upcoming Meeting in Ft.Lauderdale</td>                                    <td>9/9/2018</td>                                    <td>350kb</td>                                  </tr>                                  <tr>                                    <td>Cynthia Maraugha</td>                                    <td>Upcoming Meeting in Ft.Lauderdale</td>                                    <td>9/9/2018</td>                                    <td>350kb</td>                                  </tr>                                  <tr>                                    <td>Cynthia Maraugha</td>                                    <td>Upcoming Meeting in Ft.Lauderdale</td>                                    <td>9/9/2018</td>                                    <td>350kb</td>                                  </tr>                                  <tr>                                    <td>Cynthia Maraugha</td>                                    <td>Upcoming Meeting in Ft.Lauderdale</td>                                    <td>9/9/2018</td>                                    <td>350kb</td>                                  </tr>                                  <tr>                                    <td>Cynthia Maraugha</td>                                    <td>Upcoming Meeting in Ft.Lauderdale</td>                                    <td>9/9/2018</td>                                    <td>350kb</td>                                  </tr>                                </tbody>                              </table>                            </div>                            <div class="form-group row email-footer">                                 <label class="col-4 col-sm-6 text-right align-self-center" style="padding-top: 9px;">Jump To</label>                                  <select class="col-3 col-sm-3 align-self-center form-control">                                  <option value="">Page 1</option>                                  <option value="">Page 2</option>                                  <option value="">Page 3</option>                                </select>                                                               <div class="col-5 col-md-3 text-right">                                  <span class="left-arrow"><a href="#"><img src="./assets/images/next.png"></a></span><span class="active"><a href="#" class="active">1</a></span><span>...</span><span><a href="#">3 </a><a href="#">4 </a><a href="#">5 </a></span><span>...</span><span><a href="#">16</a></span><span class="right-arrow"><a href="#"><img src="./assets/images/next.png"></a></span>                                </div>                              </div>                                           </div>                        </div>                         </div>                    </div>                  </div>                </div>              </div>            </div>            </div>        </div>      </section>		    	<footer class="footer">      </footer>    </div><script src="./assets/js/jquery.min.js" type="text/javascript"></script><script src="./assets/js/bootstrap.min.js" type="text/javascript"></script><script src="./assets/js/script.js" type="text/javascript"></script></body></html>