<?php        $cme_cycle = $addcme->readCMECycle();    	if(empty($_GET['cycle']) == false){				$cme_cycle = $_GET['cycle'];			}		$add_cme_historys = $addcme->readAllById($_SESSION['user_id'], $cme_cycle);		$select_cycle = $addcme->selectCMECycle($_SESSION['user_id']);		$cme_cycle_verify = $addcme->readCMECyclePayButton();		$cme_credit_verify = $addcme->readCreditsCompleted($_SESSION['user_id'], $cme_cycle_verify);//40hours.		$cme_payment_verify = $addcme->readCMEPaymentVerify($_SESSION['user_id'], $cme_cycle_verify);//payment verify for this cycle.		$cme_historys = $cmehistory->readAllAction($_SESSION['user_id']);	?><div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                         <div class="add-cme-form block-border ncca-right-padding">
                           <div class="midium-title title-bottom-border "><div class="row"><div class="col-sm-6"><p class="text-uppercase">CME History</p></div><div class="col-sm-6 text-right"><p><a href="?content=content/cmehelp">Help</a></p></div><div class="clearfix"></div></div></div>
							<div class="row align-items-center mb-3">															<div class="col-sm-6">									<button onclick="window.location.href='?content=content/cmeadd'" type="button" class="btn nobg" id="cme_first_add">Add CME</button>																</div>																<div class="col-sm-6 text-right">																<?php if($cme_credit_verify >= 40)									{										if($cme_payment_verify > 0){																						echo '<button type="button" class="btn" id="cme_first_pay" style="display:none">Pay Now</button>';																				}else{																						echo '<button type="button" class="btn" id="cme_first_pay">Pay Now</button>';										}																			}else{																				echo '<button type="button" class="btn" id="cme_first_pay" style="display:none">Pay Now</button>';																			}								?>								</div>																<div class="clearfix"></div>														</div>
                            <div class="form-group">
                                <p>CMEs are managed on this page. The default CME cycle will always show the current cycle; going forward you will also  be able to retrieve past cycles, including uploaded documents. If you do not see previous cycles, we do not have sufficient digital information since moving from paper submissions to digital submissions. We have streamlined CME Submissions for both the desktop and mobile versions. Simply click on Add CME and upload the actual certificate or document. The document must display all the required information, enabling us to verify the practitioner name, dates, titles, and awarded CMEs. Once submitted, we will keep track of your hours earned and documents, wherein you can review 24/7 on both desktop and mobile. The Pay Now button above will activate once you have entered 40 approved hours in the system (minimum 30 Anesthesia, plus 10 Other Medical Related) and have uploaded all necessary CME documents or certificates.</p>
							</div>
                              <form>
								<div class="row">
									<div class="col-sm-6 align-self-center form-group form-text" style="max-width:280px">                                      
									  <select class="form-control" id="select_cycle_id" onchange="javascript:select_cycle();">                                        <?php 										if(empty($select_cycle) == false){											foreach($select_cycle as $val){ ?>												<option value="<?php echo $val?>" 														<?php														if(empty($_GET['cycle']) == false){															if($val == $_GET['cycle']){																echo " selected='selected'";															}														}														?>												>CME Credit Cycle <?php echo ($val . "-" . ($val + 2))?>																								</option>											<?php }										}else if(empty($select_cycle) == true){											$get_year = getdate();											?>																						<option value="<?php echo $get_year['year']?>">CME Credit Cycle <?php echo ($get_year['year']."-".($get_year['year'] + 2))?></option>										<?php										}										?>

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
										  <tbody>										  										  <?php 											  if ($add_cme_historys) {													foreach ($add_cme_historys as $cme_index=>$cme) {														$add_date = getdate($cme['date_submitted']);										  ?>														<tr>
														  <td scope="row"><?php echo $add_date['mon']."/".$add_date['mday']."/".$add_date['year']; ?></td>
														  <td align="left"><?php 														  														  if($cme['cme_hours'] == 0.25){															  															  echo "<sup>1</sup>&frasl;<sub>4</sub>";															  														  }else if($cme['cme_hours'] == 0.5){															  															  echo "<sup>1</sup>&frasl;<sub>2</sub>";															  														  }else if($cme['cme_hours'] == 0.75){															  															  echo "<sup>3</sup>&frasl;<sub>4</sub>";															  														  }else{															  															  echo $cme['cme_hours'];														  }														  														  ?></td>
														  <td align="left"><?php echo $addcme->readCMEType($cme['cme_type'])?></td>
														  <td align="left"><a href="<?php echo $cme['cme_doc']?>" data-toggle="modal" data-target="#myModal<?php echo $cme_index?>">View</a></td>
														</tr>														<div id="myModal<?php echo $cme_index?>" class="modal fade" role="dialog">														  <div class="modal-dialog modal-lg">																<!-- Modal content-->																<div class="modal-content">																	  <div class="modal-header">																		 <h4 class="modal-title">View Certificate</h4>																		<button type="button" class="close" data-dismiss="modal">&times;</button>																																			  </div>																	  <div class="modal-body">																			<iframe src="<?php echo $cme['cme_doc']?>" style="width:100%;height:650px;text-align:center !important;" ></iframe>																	  </div>																	  <div class="modal-footer">																		<button type="button" class="btn btn-blue" data-dismiss="modal">Close</button>																	  </div>																</div>														   </div>														</div>																											<?php }											  }else{ ?>												  <tr><td scope="row" colspan="4" align="center">No registered data</td></tr>											<?php }											?>
										  </tbody>
										</table>
									</div>
									<div class="col-sm-12" align="right">										<button type="button" onclick="window.location.href='?content=content/cmeadd'" class="btn btn-blue">Add CME</button>									</div>
								</div>                                <div style="height:30px"></div>								<p><strong>Previous CME History</strong></p>								<div class="row">									<div class="col-sm-12 align-self-center">										<table class="credit table">											<tbody>											<thead>												<tr>													<th scope="col">Date</th>													<th scope="col">Amount</th>													<th scope="col">Action</th>													<th scope="col">Document</th>												</tr>											</thead>											<?php											if(empty($cme_historys) == true)											{												$out = "<tr style=\"background-color:#e2efd9; text-align:center;\">												<td colspan='4'>No registered data</td>												</tr>";												echo $out;											}											if(empty($cme_historys) == false)											{												if (count($cme_historys) > 0) {																										for ($i = 0;$i<count($cme_historys);$i++){																												$get_date = getdate($cme_historys[$i]['action_date']);																													if($cme_historys[$i]['action_num'] == 0){																																	$action_number[$i] = $cmehistory->readActionContent($cme_historys[$i]['action_num']);																																		$out = "<tr style=\"text-align:left;\">																		<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>																																				<td></td>																																				<td scope=\"row\">" . $action_number[$i] . "</td>																																				<td></td>																	</tr>";															}																														if($cme_historys[$i]['action_num'] == 1){																																	$action_number[$i] = $cmehistory->readActionContent($cme_historys[$i]['action_num']);																																		$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">																		<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>																																				<td></td>																																				<td scope=\"row\">" . $action_number[$i] . "</td>																																				<td></td>																	</tr>";															}																														if($cme_historys[$i]['action_num'] == 2){																																	$action_number[$i] = $cmehistory->readActionContent($cme_historys[$i]['action_num']);																																		$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">																		<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>																																				<td></td>																																				<td scope=\"row\"><i>" . $action_number[$i]	. "</i></td>																																				<td></td>																	</tr>";															}																														if($cme_historys[$i]['action_num'] == 3){																																	$action_number[$i] = $cmehistory->readActionContent($cme_historys[$i]['action_num']);																																		$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">																		<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>																																				<td></td>																																				<td scope=\"row\">" . $action_number[$i] . "</td>																																				<td></td>																	</tr>";															}																														if($cme_historys[$i]['action_num'] == 4){																																	$action_number[$i] = $cmehistory->readActionContent($cme_historys[$i]['action_num']);																																		$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">																		<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>																																				<td></td>																																				<td scope=\"row\">" . $action_number[$i] . "</td>																																				<td></td>																	</tr>";															}																														if($cme_historys[$i]['action_num'] == 5){																																$action_number[$i] = $cmehistory->readActionContent(5)." (".$cme_historys[$i]['cme_cycle_start']."-".($cme_historys[$i]['cme_cycle_start'] + 2).")";																																	$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">																		<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>																		<td scope=\"row\">$" . $cmehistory->readActionAmount($cme_historys[$i]['amount_num']) . "</td>																		<td scope=\"row\">" . $action_number[$i] . "</td>																		<td scope=\"row\"><a href=\"receipt/cme.php?&receipt_id=". $cme_historys[$i]['id'] ."\">View Receipt</a></td>																	</tr>";															}															if($cme_historys[$i]['action_num'] == 6){																																$action_number[$i] = $cmehistory->readActionContent(6)." (".$cme_historys[$i]['cme_cycle_start']."-".($cme_historys[$i]['cme_cycle_start'] + 2).")";																																	$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">																		<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>																		<td scope=\"row\">$" . $cmehistory->readActionAmount($cme_historys[$i]['amount_num']) . "</td>																		<td scope=\"row\">" . $action_number[$i]	. "</td>																		<td scope=\"row\"><a href=\"receipt/cme.php?&receipt_id=". $cme_historys[$i]['id'] ."\">View Receipt</a></td>																	</tr>";															}																														if($cme_historys[$i]['action_num'] == 7){																																$action_number[$i] = $cmehistory->readActionContent(7)." (".$cme_historys[$i]['cme_cycle_start']."-".($cme_historys[$i]['cme_cycle_start'] + 2).")";																																	$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">																		<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>																		<td scope=\"row\">$" . $cmehistory->readActionAmount($cme_historys[$i]['amount_num']) . "</td>																		<td scope=\"row\">" . $action_number[$i]	. "</td>																		<td scope=\"row\"><a href=\"receipt/cme.php?&receipt_id=". $cme_historys[$i]['id'] ."\">View Receipt</a></td>																	</tr>";															}																												echo $out;													}												}											}                                            ?>											</tbody>										</table>									</div>								</div>                              							  							  </form>
                          </div>                         
                        </div>
                      </div>					  <script>	function select_cycle(){				var default_cycle = $("#select_cycle_id").val();				location.href="?content=content/cmehistory&cycle=" + parseInt(default_cycle);			}  </script>