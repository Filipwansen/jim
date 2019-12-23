<?php

	if(empty($_GET['member_id']) == true && empty($_GET['cycle']) == true){
		
		echo"<script>window.history.back();</script>";
	
	}else if(empty($_GET['member_id']) == false && empty($_GET['cycle']) == false){
		
		$id = $_GET['member_id'];
		
		$cme_cycle = $_GET['cycle'];
		
		$add_cme_historys = $membercme->readAllById($id, $cme_cycle);
		
		$member_name = $membercme->readMemberName($id);
	
	}
	
require_once("admin_dashboard.php");

?>
				
				<div class="member-cards card">
                    
					<div class="cme-title">CME AUDIT : <font style="font-size:15px; text-transform: capitalize; align:center;font-weight: 600; text-align:center;color:#A3162C;"><?php echo $member_name . " (" . $cme_cycle . "-" . ($cme_cycle + 2) . ")";?></font></div>
					
                    <div class="form-group">

                        <div class="left">

                            <a href="?content=content/audit&li_class=CME" class="btn btn-primary">< Back</a>

                        </div>
						<div class="right">
						</div>

                        <div class="clearfix"></div>

                    </div>
					
					
					

                    <table id="memberTable" class="table stable table-striped table-bordered nowrap" style="width:100%; text-align:center; font-size:14px !important">

                        <thead>

                            <tr>

                                <th>Date Added</th>
                                
								<th>Full Name</th>

                                <th># Credits</th>

                                <th>Type</th>

                                <th>Certificate</th>

                            </tr>

                        </thead>

                        <tbody>

						  <?php 
							  if ($add_cme_historys) {

									foreach ($add_cme_historys as $cme_index=>$cme) {
										$add_date = getdate($cme['date_submitted']);
						  ?>
										<tr>

										  <td scope="row"><?php echo $add_date['mon']."/".$add_date['mday']."/".$add_date['year']; ?></td>
										  
										  <td><?php echo $member_name;?></td>
										  
										  <td align="center"><?php 
										  
										  if($cme['cme_hours'] == 0.25){
											  
											  echo "<sup>1</sup>&frasl;<sub>4</sub>";
											  
										  }else if($cme['cme_hours'] == 0.5){
											  
											  echo "<sup>1</sup>&frasl;<sub>2</sub>";
											  
										  }else if($cme['cme_hours'] == 0.75){
											  
											  echo "<sup>3</sup>&frasl;<sub>4</sub>";
											  
										  }else{
											  
											  echo $cme['cme_hours'];
										  }
										  
										  ?></td>

										  <td align="center"><?php echo $membercme->readCMEType($cme['cme_type'])?></td>

										  <td align="center"><a href="" data-toggle="modal" data-target="#myModal<?php echo $cme_index?>">View</a></td>

										</tr>
										<div id="myModal<?php echo $cme_index?>" class="modal fade" role="dialog">
										  <div class="modal-dialog modal-lg">

												<!-- Modal content-->
												<div class="modal-content">
													  <div class="modal-header">
													  <button type="button" class="close" data-dismiss="modal">&times;</button>
														 <h3 class="modal-title" style="margin-top:20px">View Certificate</h3>
														
														
													  </div>
													  <div class="modal-body" style="height:670px !important;">
															<iframe src="../<?php echo $cme['cme_doc']?>" style="width:100%;height:640px;text-align:center !important;" ></iframe>
													  </div>
													  <div class="modal-footer">
														<a type="button" class="btn btn-primary" data-dismiss="modal">Close</a>
													  </div>
												</div>

										   </div>
										</div>														
									<?php }
							  }else{ ?>
								  <tr><td scope="row" colspan="5" align="center">No registered data</td></tr>
							<?php }
							?>


                        </tbody>

                    </table>
					
					<div class="row">
					
					
                    </div>
				</div>	


