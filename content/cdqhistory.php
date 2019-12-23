<?php



	$cdq_historys = $cdqhistory->readAllAction($_SESSION['user_id']);
  $receipt_cdq = $cdqhistory->NewreadAllReceipt($_SESSION['user_id']);

	

?>

                      

                      <div class="tab-content" id="myTabContent">



                        <div class="tab-pane fade show active" id="cdq-history" role="tabpanel" aria-labelledby="cdq-history-tab">



                          <div class="add-cme-form block-border ncca-right-padding">



							   <div class="midium-title title-bottom-border">

								   <div class="row">

									   <div class="col-sm-6">

											<p>CDQ EXAM HISTORY</p>

									   </div>

									   <div class="col-sm-6 text-right">

											<p><a href="?content=content/cdqhelp">Help</a></p>

									   </div>

									   <div class="clearfix">

									   </div>

								   </div>

							   </div>



								<div class="row align-items-center mb-3">

									<div class="col-sm-12 text-right">

									<div id="pay_now_inactive">

											  <button type="button" class="btn" id="cdq_first_pay">Pay Now</button>

										</div>

									</div>

									<div class="clearfix"></div>

								</div>

                            <div class="cme-content-block">



								
								<p>Your Next CDQ Exam Date: 1) <a href="#"><?php if(!empty($userObject->CDQ_income)) echo $userObject->CDQ_income['exam_month_year']; ?> </a>or 2) <a href="#"><?php if(!empty($userObject->CDQ_income_june)) echo $userObject->CDQ_income_june['exam_month_year']; ?></a></p>




                               	<ul class="exam-padding">



									<li>1) Registration Windows for <?php if(!empty($userObject->CDQ_income)) echo $userObject->CDQ_income['exam_month_year']; ?> CDQ Exam (<?php if(!empty($userObject->CDQ_income)) echo $userObject->CDQ_income['start_reg']; ?> – <?php if(!empty($userObject->CDQ_income)) echo $userObject->CDQ_income['end_reg']; ?>)<br>



										 &nbsp;  &nbsp; Late Registration Windows for <?php if(!empty($userObject->CDQ_income)) echo $userObject->CDQ_income['exam_month_year']; ?> CDQ Exam (<?php if(!empty($userObject->CDQ_income)) echo $userObject->CDQ_income['start_late_reg']; ?> – <?php if(!empty($userObject->CDQ_income)) echo $userObject->CDQ_income['end_late_reg']; ?>)</li>



									<li>2) Registration Windows for <?php if(!empty($userObject->CDQ_income_june)) echo $userObject->CDQ_income_june['exam_month_year']; ?> CDQ Exam (<?php if(!empty($userObject->CDQ_income)) echo $userObject->CDQ_income_june['start_reg']; ?> – <?php if(!empty($userObject->CDQ_income)) echo $userObject->CDQ_income_june['end_reg']; ?>)<br>



										 &nbsp;  &nbsp; Late Registration Windows for <?php if(!empty($userObject->CDQ_income_june)) echo $userObject->CDQ_income_june['exam_month_year']; ?> CDQ Exam (<?php if(!empty($userObject->CDQ_income)) echo $userObject->CDQ_income_june['start_late_reg']; ?> – <?php if(!empty($userObject->CDQ_income)) echo $userObject->CDQ_income_june['end_late_reg']; ?>)</li>


	</ul><br>



								<p><strong>CDQ Examination</strong><br>The Examination for Continued Demonstration of Qualifications of Anesthesiologist Assistants (CDQ Examination) is one component of the ongoing certification process for anesthesiologist assistants in the United States. The CDQ Examination is designed to test the cognitive and deductive skills of the practicing certified anesthesiologist assistant who has successfully entered and continues to participate in the certification process for anesthesiologist assistants administered by NCCAA.</p>



								<p><strong>Eligibility for CDQ Examination</strong><br>To be eligible to apply for the CDQ Examination, a candidate must be currently certified as an anesthesiologist assistant by the National Commission for Certification of Anesthesiologist Assistants, where current means at the time of application. Upon receipt of a complete application, the National Commission for Certification of Anesthesiologist Assistants will rule on an applicant's eligibility and so notify him/her within 30 days.</p>



								<p><strong>Scheduling an Examination</strong><br>Once an application for an examination has been approved, the candidate will be mailed a scheduling permit by the National Board of Medical Examiners. The candidate should follow the directions on the scheduling permit to obtain a seat at a Prometric testing center. Prometric is solely responsible for scheduling and rescheduling examinations.</p>



								<p>Once permit has been received, to schedule or reschedule an examination or to report a problem with scheduling, rescheduling, or a test center, contact Prometric at www.prometric.com - choose Testing Program "National Commission for Certification of Anesthesiologist Assistants" or via telephone at  (800) 490-6504</p>



                                <div style="height:30px"></div>



								<p><strong>Previous CDQ Exam</strong></p>



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

											

											// if(empty($cdq_historys) == true)

											// {

											// 	$out = "<tr style=\"background-color:#e2efd9; text-align:center;\">

											// 	<td colspan='4'>No registered data</td>

											// 	</tr>";

											// 	echo $out;

											// }

											// if(empty($cdq_historys) == false)

											// {

											// 	if (count($cdq_historys) > 0) {

													

											// 		for ($i = 0;$i<count($cdq_historys);$i++){

														

											// 			$get_date = getdate($cdq_historys[$i]['action_date']);

														

											// 				if($cdq_historys[$i]['action_num'] == 0){

																

											// 						$action_number[$i] = $cdqhistory->readActionContent($cdq_historys[$i]['action_num']);

																	

											// 						$out = "<tr style=\"text-align:left;\">



											// 							<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>

																		

											// 							<td></td>

																		

											// 							<td scope=\"row\">" . $action_number[$i] . "</td>

																		

											// 							<td></td>



											// 						</tr>";

											// 				}

															

											// 				if($cdq_historys[$i]['action_num'] == 1){

																

											// 						$action_number[$i] = $cdqhistory->readActionContent($cdq_historys[$i]['action_num']);

																	

											// 						$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">



											// 							<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>

																		

											// 							<td></td>

																		

											// 							<td scope=\"row\">" . $action_number[$i] . "</td>

																		

											// 							<td></td>



											// 						</tr>";

											// 				}

															

											// 				if($cdq_historys[$i]['action_num'] == 2){

																

											// 						$action_number[$i] = $cdqhistory->readActionContent($cdq_historys[$i]['action_num']);

																	

											// 						$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">



											// 							<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>

																		

											// 							<td></td>

																		

											// 							<td scope=\"row\"><i>" . $action_number[$i]	. "</i></td>

																		

											// 							<td></td>



											// 						</tr>";

											// 				}

															

											// 				if($cdq_historys[$i]['action_num'] == 3){

																

											// 						$action_number[$i] = $cdqhistory->readActionContent($cdq_historys[$i]['action_num']);

																	

											// 						$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">



											// 							<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>

																		

											// 							<td></td>

																		

											// 							<td scope=\"row\">" . $action_number[$i] . "</td>

																		

											// 							<td></td>



											// 						</tr>";

											// 				}

															

											// 				if($cdq_historys[$i]['action_num'] == 4){

																

											// 						$action_number[$i] = $cdqhistory->readActionContent($cdq_historys[$i]['action_num']);

																	

											// 						$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">



											// 							<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>

																		

											// 							<td></td>

																		

											// 							<td scope=\"row\">" . $action_number[$i] . "</td>

																		

											// 							<td></td>

											// 						</tr>";

											// 				}

															

											// 				if($cdq_historys[$i]['action_num'] == 5){

																

											// 						$action_number[$i] = $cdqhistory->readActionContent($cdq_historys[$i]['action_num']);

																	

											// 						$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">



											// 							<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>

																		

											// 							<td></td>

																		

											// 							<td scope=\"row\">" . $action_number[$i] . "</td>

																		

											// 							<td></td>

																		

											// 						</tr>";

											// 				}

											// 				if($cdq_historys[$i]['action_num'] == 6){

																

											// 					$action_number[$i] = $cdqhistory->readActionContent(6). " " . $cdq_historys[$i]['exam_year']." CDQ Exam";

																

											// 						$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">



											// 							<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>

											// 							<td scope=\"row\">$" . $cdqhistory->readActionAmount($cdq_historys[$i]['amount_num']) . "</td>



											// 							<td scope=\"row\">" . $action_number[$i] . "</td>



											// 							<td scope=\"row\"><a href=\"receipt/cdq.php?&receipt_id=". $cdq_historys[$i]['id'] ."\">View Receipt</a></td>



											// 						</tr>";

											// 				}

											// 				if($cdq_historys[$i]['action_num'] == 7){

																

											// 					$action_number[$i] = $cdqhistory->readActionContent(7). " " . $cdq_historys[$i]['exam_year']." CDQ Exam(LATE FEE)";

																

											// 						$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">



											// 							<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>

											// 							<td scope=\"row\">$" . $cdqhistory->readActionAmount($cdq_historys[$i]['amount_num']) . "</td>



											// 							<td scope=\"row\">" . $action_number[$i]	. "</td>



											// 							<td scope=\"row\"><a href=\"receipt/cdq.php?&receipt_id=". $cdq_historys[$i]['id'] ."\">View Receipt</a></td>



											// 						</tr>";

											// 				}

															

											// 				if($cdq_historys[$i]['action_num'] == 8){

																

											// 					$action_number[$i] = $cdqhistory->readActionContent(8). " " . $cdq_historys[$i]['exam_year']." CDQ Exam";

																

											// 						$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">



											// 							<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>

											// 							<td scope=\"row\">$" . $cdqhistory->readActionAmount($cdq_historys[$i]['amount_num']) . "</td>



											// 							<td scope=\"row\">" . $action_number[$i]	. "</td>



											// 							<td scope=\"row\"><a href=\"receipt/cdq.php?&receipt_id=". $cdq_historys[$i]['id'] ."\">View Receipt</a></td>



											// 						</tr>";

											// 				}

															

											// 				if($cdq_historys[$i]['action_num'] == 9){

																

											// 					$action_number[$i] = $cdqhistory->readActionContent(9). " " . $cdq_historys[$i]['exam_year']." CDQ Exam(LATE FEE)";

																

											// 						$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">



											// 							<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>

											// 							<td scope=\"row\">$" . $cdqhistory->readActionAmount($cdq_historys[$i]['amount_num']) . "</td>



											// 							<td scope=\"row\">" . $action_number[$i]	. "</td>



											// 							<td scope=\"row\"><a href=\"receipt/cdq.php?&receipt_id=". $cdq_historys[$i]['id'] ."\">View Receipt</a></td>



											// 						</tr>";

											// 				}

															

											// 				if($cdq_historys[$i]['action_num'] == 10){

																

											// 					$action_number[$i] = $cdqhistory->readActionContent(10). " " . $cdq_historys[$i]['exam_year']." CDQ Exam";

																

											// 						$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">



											// 							<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>

											// 							<td scope=\"row\">$" . $cdqhistory->readActionAmount($cdq_historys[$i]['amount_num']) . "</td>



											// 							<td scope=\"row\">" . $action_number[$i]	. "</td>



											// 							<td scope=\"row\"><a href=\"receipt/cdq.php?&receipt_id=". $cdq_historys[$i]['id'] ."\">View Receipt</a></td>



											// 						</tr>";

											// 				}

															

											// 				if($cdq_historys[$i]['action_num'] == 11){

																

											// 					$action_number[$i] = $cdqhistory->readActionContent(11). " " . $cdq_historys[$i][' CDQ exam_year']." Exam";

																

											// 						$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">



											// 							<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>

											// 							<td scope=\"row\">$" . $cdqhistory->readActionAmount($cdq_historys[$i]['amount_num']) . "</td>



											// 							<td scope=\"row\">" . $action_number[$i] . "</td>



											// 							<td scope=\"row\"><a href=\"receipt/cdq.php?&receipt_id=". $cdq_historys[$i]['id'] ."\">View Receipt</a></td>



											// 						</tr>";

											// 				}

														

											// 			echo $out;

											// 		}

											// 	}

											// }



                      if(!empty($receipt_cdq)) {
                        foreach($receipt_cdq as $receipt_cd) {
                        ?>
											<tr style="background-color:#e2efd9">



												<td scope="row"><?php echo date('d/m/Y',$receipt_cd['action_date']); ?></td>



												<td scope="row" class="text-right"><?php echo $receipt_cd['paid_amount']; ?></td>



												<td scope="row"><?php echo $receipt_cd['receipt_title']; ?> </td>



												  <td scope="row"><a href="receipt/cdq.php?exam_type=CDQ&receipt_id=<?php echo $receipt_cd['id']; ?>">View Receipt</a></td>



											</tr>

                      <?php } }?>

                                            



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



