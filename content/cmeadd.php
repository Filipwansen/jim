<?php

	global $addcme;

	if (empty($_POST) == false){
		
		$addcme->insert_cme($_POST);
		
	}
	
	$cme_cycle_verify = $addcme->readCMECyclePayButton();
	
	$cme_credit_verify = $addcme->readCreditsCompleted($_SESSION['user_id'], $cme_cycle_verify);//40hours.
	
	$cme_payment_verify = $addcme->readCMEPaymentVerify($_SESSION['user_id'], $cme_cycle_verify);//payment verify for this cycle.

?>
					  <div class="tab-content" id="myTabContent">

                        <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                            <div class="add-cme-form block-border ncca-right-padding">

                                <div class="midium-title title-bottom-border"><div class="row"><div class="col-sm-6"><p class="text-uppercase">ADD CME</p></div><div class="col-sm-6 text-right"><p><a href="?content=content/cmehelp">Help</a></p></div><div class="clearfix"></div></div></div>

								<div class="row align-items-center mb-3"><div class="col-sm-6"><a href="?content=content/cmehistory">< Back</a></div><div class="col-sm-6 text-right">
								
								<?php if($cme_credit_verify >= 40)
									{
										if($cme_payment_verify > 0){
											
											echo '<button type="button" class="btn" id="cme_first_pay" style="display:none">Pay Now</button>';
										
										}else{
											
											echo '<button type="button" class="btn" id="cme_first_pay">Pay Now</button>';
										}
										
									}else{
										
										echo '<button type="button" class="btn" id="cme_first_pay" style="display:none">Pay Now</button>';
										
									}
								?>
								
								</div><div class="clearfix"></div></div>

								<div class="cme-content-block form-group">

                                    <p>CME Submission is now easier than ever and NCCAA has gone completely digital (no more paper!). Upload the CME certificate awarded, which displays the hours granted, attendance date, name of accreditor issuing the CME, and title of meeting or CME as proof you earned the CME credit.. Click on Help above to get tips on how to upload or turn your paper CME into a photo. You may enter credits in increments of 1/4 hour. NCCAA accepts CME credits provided by the AMA, AAPA, and ACCME.</p>

                                    <p>The content for thirty (30) hours of each registration period must be in the field of anesthesia or one of its sub-specialties. The content for the remaining ten (10) hours may be in any medical topic. ACLS and PALS instruction will be tabulated as anesthesia-related content.  ACLS and PALS certification qualify for 4 CME credit hours per course.</p>

                                    <p>NCCAA will accept ACLS and/or PALS credit provided by the AHA, however all other CME credit must be provided by the above listed CME providers.  Upload a photo of the card(s) you received upon completion of the ACLS and/or PALS instruction.</p>

                                    <p><b>Important Dates!</b></p>

                                    <p>During the two-year registration cycle, CME credit must be earned and awarded between June 2 of the initial year and June 1 of the second year.</p>

                                </div>

                                <div style="height:30px"></div>

                                <div class="cme-form-block fullwidth">

                                  <form id="frmAddCME" action="?content=content/cmeadd" method="post" enctype="multipart/form-data">

                                    <div class="form-group row">

                                      <label class="col-sm-5 text-right align-self-center">Select + Upload Image to attach your CME document or certificate</label>

                                      <div class="col-sm-7 align-self-center upload-btn-wrapper">

                                        <input type="file" name="upload_file" id="upload_file" placeholder="Type Number of hours" class="form-control" required autofocus >

                                        <button class="btn">Upload File(s) <span>+</span> </button>

                                      </div>

                                    </div>

                                    <div class="form-group row">

                                      <label class="col-sm-5 text-right align-self-center">How many Anesthesia credits does this document show?</label>

										<div class="col-sm-7 align-self-center">

                                      		<input type="text" name="anesthesia_credits" id="anesthesia_credits" maxlength="3" class="form-control reducesize" onclick="javascript:anesthesia_field()">

										</div>

                                    </div>

                                    <div class="form-group row">

                                      <label class="col-sm-5 text-right align-self-center">How many Other credits does this document show?</label>

										<div class="col-sm-7 align-self-center">

                                      		<input type="text" name="other_credits" id="other_credits" maxlength="3" class="form-control reducesize" onclick="javascript:other_field()">

										</div>

                                    </div>

                                    <div class="form-group row">

                                      <label class="col-sm-5 text-right align-self-center">I hereby acknowledge that the document attached is from an actual approved CME provider</label>

										<div class="col-sm-7 align-self-center">

										  <select name="cme_provider" id="cme_provider"  class="form-control">
                                            <?php 
												$cme_provider = array("Select", "AMA", "ACCME", "AAPA", "AHA - include note ACLS or PALS instruction only");
												foreach ($cme_provider as $key) { ?>
												
													<option value = "<?php echo array_search($key, $cme_provider);?>">
													
														<?php echo $key?> 
														
													</option>
													
												<?php } ?>

										  </select>

										</div>	

                                    </div>

    

                                    <div class="form-group row">

                                      <label class="col-sm-5 text-right align-self-center">I hereby attest that I personally took the CME course for which the<br> credit is entered</label>

                                      <div class="col-sm-7 align-self-center">

                                      	<input type="checkbox" name="cme_check1" id="cme_check1" class="form-control" style="max-width:42px" required autofocus>

                                      </div>

                                    </div>

    

                                    <div class="form-group row">

                                      <label class="col-sm-5 text-right align-self-center add-cme-padding">I hereby acknowledge that the information submitted may be audited at any time and the  entire CME document is clearly legible, containing all required information.</label>

                                      <div class="col-sm-7 align-self-center">

                                      	<input type="checkbox" name="cme_check2" id="cme_check2" class="form-control" style="max-width:42px" required autofocus>

                                      </div>

                                    </div>

                                    <div class="form-group row form-btn d-flex align-items-center justify-content-end">

										<div class="col-sm-10 align-self-center text-center" id="success_text">

											<p style="margin-top:10px">Your CME information has been successfully submitted</p>

										</div>
										
										<div class="col-sm-10 align-self-center text-center" id="error_text">

											<p style="margin-top:10px">Your CME information has bee failed</p>

										</div>
										
										<div class="col-sm-2 align-self-center text-right">

                                      		<button type="submit" class="btn btn-blue">Submit</button>

										</div>

                                    </div>
									
                                  </form>

                                </div>

							</div>

                          </div>

                      </div>

<script>

function other_field(){
	
	$('#other_credits').attr('readonly', false);
	$("#anesthesia_credits").val("");
	$('#anesthesia_credits').attr('readonly', true);
	
}

function anesthesia_field(){
	
	$('#anesthesia_credits').attr('readonly', false);
	$("#other_credits").val("");
	$('#other_credits').attr('readonly', true);
}
</script>