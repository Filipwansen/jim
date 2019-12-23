<?php

	$history_info = $certificationhistory->readAllHistory($_SESSION['user_id']);
	
?>
                      
                      <div class="tab-content" id="myTabContent">

                        <div class="tab-pane fade show active" id="cdq-history" role="tabpanel" aria-labelledby="cdq-history-tab">

                          <div class="add-cme-form block-border ncca-right-padding">

							   <div class="midium-title" style="padding-bottom:10px;">
								   <div class="row">
									   <div class="col-sm-6">
											<p>HISTORY</p>
									   </div>
									   <div class="clearfix">
									   </div>
								   </div>
							   </div>

                            <div class="cme-content-block">

								<div class="row">

									<div class="col-sm-12 align-self-center">

										<table class="credit table">

											<tbody>

											<thead>

												<tr>

													<th scope="col">Date</th>

													<th scope="col">Amount</th>

													<th scope="col">Action</th>

													<th scope="col">Document</th>

												</tr>

											</thead>
											<?php
											
											if(empty($history_info) == true)
											{
												$out = "<tr style=\"background-color:#e2efd9; text-align:center;\">
												<td colspan='4'>No registered data</td>
												</tr>";
												echo $out;
											}
											if(empty($history_info) == false)
											{
												if (count($history_info) > 0) {
													
													for ($i = 0;$i<count($history_info);$i++){
														$get_date = getdate($history_info[$i]['action_date']);
														//CDQ history
														if($history_info[$i]['exam_type'] == 'CDQ')
														{
															if($history_info[$i]['action_num'] == 0){
																
																	$action_number[$i] = $cdqhistory->readActionContent($history_info[$i]['action_num']);
																	
																	$out = "<tr style=\"text-align:left;\">

																		<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>
																		
																		<td></td>
																		
																		<td scope=\"row\">" . $action_number[$i] . "</td>
																		
																		<td></td>

																	</tr>";
															}
															
															if($history_info[$i]['action_num'] == 1){
																
																	$action_number[$i] = $cdqhistory->readActionContent($history_info[$i]['action_num']);
																	
																	$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">

																		<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>
																		
																		<td></td>
																		
																		<td scope=\"row\">" . $action_number[$i] . "</td>
																		
																		<td></td>

																	</tr>";
															}
															
															if($history_info[$i]['action_num'] == 2){
																
																	$action_number[$i] = $cdqhistory->readActionContent($history_info[$i]['action_num']);
																	
																	$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">

																		<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>
																		
																		<td></td>
																		
																		<td scope=\"row\"><i>" . $action_number[$i]	. "</i></td>
																		
																		<td></td>

																	</tr>";
															}
															
															if($history_info[$i]['action_num'] == 3){
																
																	$action_number[$i] = $cdqhistory->readActionContent($history_info[$i]['action_num']);
																	
																	$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">

																		<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>
																		
																		<td></td>
																		
																		<td scope=\"row\">" . $action_number[$i] . "</td>
																		
																		<td></td>

																	</tr>";
															}
															
															if($history_info[$i]['action_num'] == 4){
																
																	$action_number[$i] = $cdqhistory->readActionContent($history_info[$i]['action_num']);
																	
																	$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">

																		<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>
																		
																		<td></td>
																		
																		<td scope=\"row\">" . $action_number[$i] . "</td>
																		
																		<td></td>
																	</tr>";
															}
															
															if($history_info[$i]['action_num'] == 5){
																
																	$action_number[$i] = $cdqhistory->readActionContent($history_info[$i]['action_num']);
																	
																	$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">

																		<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>
																		
																		<td></td>
																		
																		<td scope=\"row\">" . $action_number[$i] . "</td>
																		
																		<td></td>
																		
																	</tr>";
															}
															if($history_info[$i]['action_num'] == 6){
																
																$action_number[$i] = $cdqhistory->readActionContent(6). " " . $history_info[$i]['exam_year']." CDQ Exam";
																
																	$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">

																		<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>
																		<td scope=\"row\">$" . $cdqhistory->readActionAmount($history_info[$i]['amount_num']) . "</td>

																		<td scope=\"row\">" . $action_number[$i] . "</td>

																		<td scope=\"row\"><a href=\"receipt/cdq.php?exam_type=CDQ&receipt_id=". $history_info[$i]['id'] ."\">View Receipt</a></td>

																	</tr>";
															}
															if($history_info[$i]['action_num'] == 7){
																
																$action_number[$i] = $cdqhistory->readActionContent(7). " " . $history_info[$i]['exam_year']." CDQ Exam(LATE FEE)";
																
																	$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">

																		<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>
																		<td scope=\"row\">$" . $cdqhistory->readActionAmount($history_info[$i]['amount_num']) . "</td>

																		<td scope=\"row\">" . $action_number[$i]	. "</td>

																		<td scope=\"row\"><a href=\"receipt/cdq.php?exam_type=CDQ&receipt_id=". $history_info[$i]['id'] ."\">View Receipt</a></td>

																	</tr>";
															}
															
															if($history_info[$i]['action_num'] == 8){
																
																$action_number[$i] = $cdqhistory->readActionContent(8). " " . $history_info[$i]['exam_year']." CDQ Exam";
																
																	$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">

																		<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>
																		<td scope=\"row\">$" . $cdqhistory->readActionAmount($history_info[$i]['amount_num']) . "</td>

																		<td scope=\"row\">" . $action_number[$i]	. "</td>

																		<td scope=\"row\"><a href=\"receipt/cdq.php?exam_type=CDQ&receipt_id=". $history_info[$i]['id'] ."\">View Receipt</a></td>

																	</tr>";
															}
															
															if($history_info[$i]['action_num'] == 9){
																
																$action_number[$i] = $cdqhistory->readActionContent(9). " " . $history_info[$i]['exam_year']." CDQ Exam(LATE FEE)";
																
																	$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">

																		<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>
																		<td scope=\"row\">$" . $cdqhistory->readActionAmount($history_info[$i]['amount_num']) . "</td>

																		<td scope=\"row\">" . $action_number[$i]	. "</td>

																		<td scope=\"row\"><a href=\"receipt/cdq.php?exam_type=CDQ&receipt_id=". $history_info[$i]['id'] ."\">View Receipt</a></td>

																	</tr>";
															}
															
															if($history_info[$i]['action_num'] == 10){
																
																$action_number[$i] = $cdqhistory->readActionContent(10). " " . $history_info[$i]['exam_year']." CDQ Exam";
																
																	$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">

																		<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>
																		<td scope=\"row\">$" . $cdqhistory->readActionAmount($history_info[$i]['amount_num']) . "</td>

																		<td scope=\"row\">" . $action_number[$i]	. "</td>

																		<td scope=\"row\"><a href=\"receipt/cdq.php?exam_type=CDQ&receipt_id=". $history_info[$i]['id'] ."\">View Receipt</a></td>

																	</tr>";
															}
															
															if($history_info[$i]['action_num'] == 11){
																
																$action_number[$i] = $cdqhistory->readActionContent(11). " " . $history_info[$i][' CDQ exam_year']." Exam";
																
																	$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">

																		<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>
																		<td scope=\"row\">$" . $cdqhistory->readActionAmount($history_info[$i]['amount_num']) . "</td>

																		<td scope=\"row\">" . $action_number[$i] . "</td>

																		<td scope=\"row\"><a href=\"receipt/cdq.php?exam_type=CDQ&receipt_id=". $history_info[$i]['id'] ."\">View Receipt</a></td>

																	</tr>";
															}
														
															echo $out;
														}
														
														//CME history
														if($history_info[$i]['exam_type'] == 'CME')
														{
															if($history_info[$i]['action_num'] == 0){
																
																	$action_number[$i] = $cmehistory->readActionContent($history_info[$i]['action_num']);
																	
																	$out = "<tr style=\"text-align:left;\">

																		<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>
																		
																		<td></td>
																		
																		<td scope=\"row\">" . $action_number[$i] . "</td>
																		
																		<td></td>

																	</tr>";
															}
															
															if($history_info[$i]['action_num'] == 1){
																
																	$action_number[$i] = $cmehistory->readActionContent($history_info[$i]['action_num']);
																	
																	$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">

																		<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>
																		
																		<td></td>
																		
																		<td scope=\"row\">" . $action_number[$i] . "</td>
																		
																		<td></td>

																	</tr>";
															}
															
															if($history_info[$i]['action_num'] == 2){
																
																	$action_number[$i] = $cmehistory->readActionContent($history_info[$i]['action_num']);
																	
																	$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">

																		<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>
																		
																		<td></td>
																		
																		<td scope=\"row\"><i>" . $action_number[$i]	. "</i></td>
																		
																		<td></td>

																	</tr>";
															}
															
															if($history_info[$i]['action_num'] == 3){
																
																	$action_number[$i] = $cmehistory->readActionContent($history_info[$i]['action_num']);
																	
																	$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">

																		<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>
																		
																		<td></td>
																		
																		<td scope=\"row\">" . $action_number[$i] . "</td>
																		
																		<td></td>

																	</tr>";
															}
															
															if($history_info[$i]['action_num'] == 4){
																
																	$action_number[$i] = $cmehistory->readActionContent($history_info[$i]['action_num']);
																	
																	$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">

																		<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>
																		
																		<td></td>
																		
																		<td scope=\"row\">" . $action_number[$i] . "</td>
																		
																		<td></td>
																	</tr>";
															}
															
															if($history_info[$i]['action_num'] == 5){
																
																$action_number[$i] = $cmehistory->readActionContent(5)." (".$history_info[$i]['cme_cycle_start']."-".($history_info[$i]['cme_cycle_start'] + 2).")";
																
																	$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">

																		<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>
																		<td scope=\"row\">$" . $cmehistory->readActionAmount($history_info[$i]['amount_num']) . "</td>

																		<td scope=\"row\">" . $action_number[$i] . "</td>

																		<td scope=\"row\"><a href=\"receipt/cme.php?exam_type=CME&receipt_id=". $history_info[$i]['id'] ."\">View Receipt</a></td>

																	</tr>";
															}
															if($history_info[$i]['action_num'] == 6){
																
																$action_number[$i] = $cmehistory->readActionContent(6)." (".$history_info[$i]['cme_cycle_start']."-".($history_info[$i]['cme_cycle_start'] + 2).")";
																
																	$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">

																		<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>
																		<td scope=\"row\">$" . $cmehistory->readActionAmount($history_info[$i]['amount_num']) . "</td>

																		<td scope=\"row\">" . $action_number[$i]	. "</td>

																		<td scope=\"row\"><a href=\"receipt/cme.php?exam_type=CME&receipt_id=". $history_info[$i]['id'] ."\">View Receipt</a></td>

																	</tr>";
															}
															
															if($history_info[$i]['action_num'] == 7){
																
																$action_number[$i] = $cmehistory->readActionContent(7)." (".$history_info[$i]['cme_cycle_start']."-".($history_info[$i]['cme_cycle_start'] + 2).")";
																
																	$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">

																		<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>
																		<td scope=\"row\">$" . $cmehistory->readActionAmount($history_info[$i]['amount_num']) . "</td>

																		<td scope=\"row\">" . $action_number[$i]	. "</td>

																		<td scope=\"row\"><a href=\"receipt/cme.php?exam_type=CME&receipt_id=". $history_info[$i]['id'] ."\">View Receipt</a></td>

																	</tr>";
															}
														
															echo $out;
														}
														
														//Certification history
														if($history_info[$i]['exam_type'] == 'Certification')
														{
															
															if($history_info[$i]['action_num'] == 0){
																
																	$action_number[$i] = $certificationhistory->readActionContent($history_info[$i]['action_num']);
																	
																	$out = "<tr style=\"text-align:left;\">

																		<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>
																		
																		<td></td>
																		
																		<td scope=\"row\">" . $action_number[$i] . "</td>
																		
																		<td></td>

																	</tr>";
															}
															
															if($history_info[$i]['action_num'] == 1){
																
																	$action_number[$i] = $certificationhistory->readActionContent($history_info[$i]['action_num']);
																	
																	$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">

																		<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>
																		
																		<td></td>
																		
																		<td scope=\"row\">" . $action_number[$i] . "</td>
																		
																		<td></td>

																	</tr>";
															}
															
															if($history_info[$i]['action_num'] == 2){
																
																	$action_number[$i] = $certificationhistory->readActionContent($history_info[$i]['action_num']);
																	
																	$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">

																		<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>
																		
																		<td></td>
																		
																		<td scope=\"row\"><i>" . $action_number[$i]	. "</i></td>
																		
																		<td></td>

																	</tr>";
															}
															
															if($history_info[$i]['action_num'] < 14){
																
																	$action_number[$i] = $certificationhistory->readActionContent($history_info[$i]['action_num']);
																	
																	$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">

																		<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>
																		
																		<td></td>
																		
																		<td scope=\"row\">" . $action_number[$i] . "</td>
																		
																		<td></td>

																	</tr>";
															}
															
															if(($history_info[$i]['action_num'] > 13) && ($history_info[$i]['action_num'] % 2 == 0) && ($history_info[$i]['action_num'] < 20)){
																
																$action_number[$i] = $certificationhistory->readActionContent($history_info[$i]['action_num']). " " . $history_info[$i]['exam_year']." Certification Exam";
																
																	$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">

																		<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>
																		<td scope=\"row\">$" . $certificationhistory->readActionAmount($history_info[$i]['amount_num']) . "</td>

																		<td scope=\"row\">" . $action_number[$i] . "</td>

																		<td scope=\"row\"><a href=\"receipt/certification.php?exam_type=Certification&receipt_id=". $history_info[$i]['id'] ."\">View Receipt</a></td>

																	</tr>";
															}
														
															if(($history_info[$i]['action_num'] > 13) && ($history_info[$i]['action_num'] % 2 != 0)  && ($history_info[$i]['action_num'] < 20)){
																
																$action_number[$i] = $certificationhistory->readActionContent($history_info[$i]['action_num']). " " . $history_info[$i]['exam_year']." Certification Exam <br>(Late Fee)";
																
																	$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">

																		<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>
																		<td scope=\"row\">$" . $certificationhistory->readActionAmount($history_info[$i]['amount_num']) . "</td>

																		<td scope=\"row\">" . $action_number[$i] . "</td>

																		<td scope=\"row\"><a href=\"receipt/certification.php?exam_type=Certification&receipt_id=". $history_info[$i]['id'] ."\">View Receipt</a></td>

																	</tr>";
															}
															
															if($history_info[$i]['action_num'] > 19){
																
																$action_number[$i] = $certificationhistory->readActionContent($history_info[$i]['action_num']). " " . $history_info[$i]['exam_year']." Certification Exam";
																
																	$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">

																		<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>
																		<td scope=\"row\">$" . $certificationhistory->readActionAmount($history_info[$i]['amount_num']) . "</td>

																		<td scope=\"row\">" . $action_number[$i] . "</td>

																		<td scope=\"row\"><a href=\"receipt/certification.php?exam_type=Certification&receipt_id=". $history_info[$i]['id'] ."\">View Receipt</a></td>

																	</tr>";
															}
																
															echo $out;
														}
													}
												}
											}

                                            ?>

											<!--tr style="background-color:#e2efd9">

												<td scope="row">3/2/19</td>

												<td scope="row" class="text-right"></td>

												<td scope="row"><i>Waiting for CDQ Exam results</i></td>

												<td scope="row"></td>

											</tr>

											<tr style="background-color:#e2efd9">

												<td scope="row">10/20/18</td>

												<td scope="row" class="text-right">$1,327.50</td>

												<td scope="row">Registered Feb. 2019 Exam (LATE FEE)</td>

												<td scope="row"><a href="receipt/CDQ.pdf">View Receipt</a></td>

											</tr>	

											<tr style="background-color:#fff2cc">

												<td scope="row">4/2/13</td>

												<td scope="row" class="text-right"></td>

												<td scope="row">Results: Passed</td>

												<td scope="row"><a href="#"></a></td>

											</tr>	

											<tr style="background-color:#fff2cc">

												<td scope="row">11/16/12</td>

												<td scope="row" class="text-right">$742.50</td>

												<td scope="row">Registered Feb. 2013 Exam</td>

												<td scope="row"><a href="receipt/CDQ.pdf">View Receipt</a></td>

											</tr>

											<tr>

												<td scope="row">1/1/08</td>

												<td scope="row" class="text-right"></td>

												<td scope="row">Became an AAAA member</td>

												<td scope="row"><a href="receipt/CDQ.pdf">View Document</a></td>

											</tr>

											<tr style="background-color:#e2efd9">

												<td scope="row">7/2/07</td>

												<td scope="row" class="text-right"></td>

												<td scope="row">Results: Passed</td>

												<td scope="row"><a href="#"></a></td>

											</tr>

											<tr style="background-color:#e2efd9">

												<td scope="row">2/19/07</td>

												<td scope="row" class="text-right">$75.00</td>

												<td scope="row">Registered June 2007 Exam</td>

												<td scope="row"><a href="receipt/CDQ.pdf">View Receipt</a></td>

											</tr>

											<tr style="background-color:#e2efd9">

												<td scope="row">2/2/07</td>

												<td scope="row" class="text-right"></td>

												<td scope="row">Failed to Show (2 exams remaining)</td>

												<td scope="row"><a href="#"></a></td>

											</tr>

											<tr style="background-color:#e2efd9">

												<td scope="row">10/15/06</td>

												<td scope="row" class="text-right">$1,000.00</td>

												<td scope="row">Registered Feb. 2007 Exam</td>

												<td scope="row"><a href="receipt/CDQ.pdf">View Receipt</a></td>

											</tr-->

											</tbody>

										</table>

									</div>

								</div>

							</div>

                          </div>                        

                        </div>

                      </div>

