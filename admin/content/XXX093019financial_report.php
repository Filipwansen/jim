<?php 

	$info = $financial->readAllCertFinancial();
	
	require_once("admin_dashboard.php");


?>

                <div class="member-card card">
                    <h4>(Report) June <?php echo date('Y');?> Student Certification Exam List</h4>
                    <a href="?content=content/financial" class="backbtn"><span class="glyphicon glyphicon-chevron-left"></span>Back</a>
                    <table id="financialReport" class="table stable table-striped table-bordered nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>First Name </th>
                                <th>Last Name </th>
                                <th>Paid</th>
                                <th>Amount</th>
                                <th>Program</th>
                                <th>Type</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
						
						<?php 
						
						if(empty($info) == false){
							
							for($i=0; $i < count($info); $i++){
								
						?>	
                            <tr id="financial_tr<?php echo $i?>" style="cursor:pointer;">

                                <td><?php echo $info[$i]['first_name']; ?></td>
                                
								<td><?php echo $info[$i]['last_name']; ?></td>

                                <td><?php echo $financial->convert_date($info[$i]['action_date']);?></td>

                                <td><?php echo $financial->pay_amount($info[$i]['amount_num'], $info[$i]['exam_type']); ?></td>

                                <td><?php echo $financial->get_programName($info[$i]['user_id']);?></td>
                                
								<td>Group</td>
                                
								<td>1st</td>

                            </tr>
						
						<?php	}
							
						}else{
							
						?>	
						
						<tr style="cursor:pointer;"><td colspan="7" align="center">No registered data</td></tr>
							
						<?php 
						
						}
						
						?>

                        </tbody>
                    </table>
                </div>
