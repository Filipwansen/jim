                      <div class="tab-content" id="myTabContent">
                          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                          <div class="home-main block-border ncca-right-padding">
                            <p class="midium-title title-bottom-border text-uppercase">CERTIFICATE
                              <button class="print"><img src="./assets/images/white version.png"> Print</button>
                              <button class="share"><img src="./assets/images/share white.png"> Share</button>
                              <button class="email"><img src="./assets/images/mail white.png"> Email</button> 
                            </p>
                            <div class="home-main-container <?php if ( ( $userObject->status["certificate"]=="" ) || ( $userObject->status["certificate"]=="COMING SOON!" )) echo "watermarked"; ?>" data-watermark="COMING SOON!">
                              <div class="home-inner-container" >
                              	
                                <p class="center"><img class="logo" src="./assets/images/logo2.png"></p>
                                <h2 class="center">National Commission for CERTIFICATION of Anesthesiologist Assistants</h2>
                                <p class="center">Be It Known That</p>
                                <h3 class="center title-1"><?php echo $userObject->data["generalinfo"]["f_name"]." ".$userObject->data["generalinfo"]["l_name"]; ?></h3>
                                  	<?php 
                                  	if ( $userObject->status["certificate"] > 0 ) { 
																		?>
                                <p class="center">Successfully Completed Certifying Examination for Anesthesiologist Assistants in</p>
                                <h3 class="center title-2"><?php echo $userObject->status["certification_year"]; ?></h3>
                                <p class="center">Has met all requirements for maintaining continued certification and hereby is designated</p>
                                <h3 class="center title-3">Certified Anesthesiologist Assistants Certificate #<?php echo $userObject->status["certificate"]; ?></h3>
                                <?PHP
                              		} else {
                              	?>
                              	<center><h2>CERTIFICATE<br><?php echo $userObject->status["certificate"]; ?></h2></center>
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
                                  <div class="col-sm-5 text-right sm-center">                                    <img src="./assets/images/signature.png" style="width:200px;">
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
