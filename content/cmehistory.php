<?php
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                         <div class="add-cme-form block-border ncca-right-padding">
                           <div class="midium-title title-bottom-border "><div class="row"><div class="col-sm-6"><p class="text-uppercase">CME History</p></div><div class="col-sm-6 text-right"><p><a href="?content=content/cmehelp">Help</a></p></div><div class="clearfix"></div></div></div>
							<div class="row align-items-center mb-3">
                            <div class="form-group">
                                <p>CMEs are managed on this page. The default CME cycle will always show the current cycle; going forward you will also  be able to retrieve past cycles, including uploaded documents. If you do not see previous cycles, we do not have sufficient digital information since moving from paper submissions to digital submissions. We have streamlined CME Submissions for both the desktop and mobile versions. Simply click on Add CME and upload the actual certificate or document. The document must display all the required information, enabling us to verify the practitioner name, dates, titles, and awarded CMEs. Once submitted, we will keep track of your hours earned and documents, wherein you can review 24/7 on both desktop and mobile. The Pay Now button above will activate once you have entered 40 approved hours in the system (minimum 30 Anesthesia, plus 10 Other Medical Related) and have uploaded all necessary CME documents or certificates.</p>
							</div>
                              <form>
								<div class="row">
									<div class="col-sm-6 align-self-center form-group form-text" style="max-width:280px">
									  <select class="form-control" id="select_cycle_id" onchange="javascript:select_cycle();">

									  </select>
									</div>
									<!--div class="col-sm-6 align-self-center form-group form-text" style="max-width:200px; display:none;">
									  <select class="form-control">
										<option value="">View Credit Cycle</option>
										<option value="">View Credit Cycle</option>
										<option value="">View Credit Cycle</option>
										<option value="">View Credit Cycle</option>
									  </select>
									</div-->
									<div class="clearfix"></div>
									<div class="col-sm-8 align-self-center">
										<p>Credit needed for this cycle (<font id="selected_this_cycle1"></font>)</p>
									</div>
									<div class="col-sm-4 align-self-center">
										<p>40</p>
									</div>
									<div class="clearfix"></div>
									<div class="col-sm-8 align-self-center">
										<p>Credits Completed and Added</p>
									</div>
									<div class="col-sm-4 align-self-center">
										<p><?php echo $addcme->readCreditsCompleted($_SESSION['user_id'], $cme_cycle);?></p>
									</div>
									<div class="clearfix"></div>
									<div class="col-sm-8 align-self-center">
										<p>Credit still needed</p>
									</div>
									<div class="col-sm-4 align-self-center">
										<p><?php echo $addcme->readCreditsNeeded($_SESSION['user_id'], $cme_cycle);?></p>
									</div>
									<div class="clearfix"></div>
								</div>
								<hr style="margin: 5px 0;">
								<div class="row form-group">
									<div class="col-sm-3 align-self-center"></div>
									<div class="col-sm-5 align-self-center">
										<p>Anesthesia credits still needed</p>
									</div>
									<div class="col-sm-4 align-self-center">
										<p><?php echo $addcme->readCreditsType($_SESSION['user_id'], 1, $cme_cycle);?></p>
									</div>
									<div class="clearfix"></div>
									<div class="col-sm-3 align-self-center"></div>
									<div class="col-sm-5 align-self-center">
										<p>Other credits still needed</p>
									</div>
									<div class="col-sm-4 align-self-center">
										<p><?php echo $addcme->readCreditsType($_SESSION['user_id'], 2, $cme_cycle);?></p>
									</div>
									<div class="clearfix"></div>  
								</div>
								<div class="row">
									<div class="col-sm-12 align-self-center">
										<br><p><b>Credit Cycle - <font id="selected_this_cycle2"></font></b></p>
										<table class="credit table table-striped">
										  <thead>
											<tr>
											  <th scope="col">Date</th>
											  <th class="text-left" scope="col"># Credits</th>
											  <th class="text-left" scope="col">Type</th>
											  <th class="text-left" scope="col">Certificate</th>
											</tr>
										  </thead>
										  <tbody>
														  <td scope="row"><?php echo $add_date['mon']."/".$add_date['mday']."/".$add_date['year']; ?></td>
														  <td align="left"><?php 
														  <td align="left"><?php echo $addcme->readCMEType($cme['cme_type'])?></td>
														  <td align="left"><a href="<?php echo $cme['cme_doc']?>" data-toggle="modal" data-target="#myModal<?php echo $cme_index?>">View</a></td>
														</tr>
										  </tbody>
										</table>
									</div>
									<div class="col-sm-12" align="right">
								</div>
                          </div>                         
                        </div>
                      </div>