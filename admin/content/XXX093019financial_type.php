<?php 

$info = "";

$total_amount = "";

if(empty($_GET['financial_exam_type']) == false){
	
	$info = $financial->readFinancialByExamType($_GET['financial_exam_type']);
	
	$total_amount = $financial->total_count_type($_GET['financial_exam_type']);
	
}

require_once("admin_dashboard.php");

?>

                <div class="member-card card">
                    <h4>
					<?php 
						if(empty($_GET['financial_exam_type']) == false){
							
							if($_GET['financial_exam_type'] == 'Admin'){
								
								echo"Income: ". date('Y') ." Registered by Admin";
								
							}else{
								
								echo"Income: ". date('Y') ." ". $_GET['financial_exam_type'] ." Registration";
								
							}
						}
								
					?></h4>
                    <a href="?content=content/financial" class="backbtn"><span class="glyphicon glyphicon-chevron-left"></span>Back</a>
                    
					<div class="right">

						<a href="../receipt/financial_pdf_type.php?&financial_exam_type=<?php echo $_GET['financial_exam_type'];?>" class="btn btn-primary">Save as PDF</a>
					   
					</div>

                    <table id="financialLedgerDetail" class="table ptable table-striped table-bordered nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Member</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
						<?php 
						if($info != ""){
							if(count($info) > 0){
								
								for($i=0; $i < count($info); $i++){
									
							?>		<input class="hidden" id="count_tr" value="<?php echo count($info); ?>" />
								<tr id="financial_tr<?php echo $i?>" style="cursor:pointer;">

									<td style="cursor:pointer;"><?php echo $i + 1?></td>

									<td><?php echo $financial->convert_date($info[$i]['action_date']);?></td>

									<td><a href="?content=content/financial_student&financial_id=<?php echo $info[$i]['user_id'];?>&member_name=<?php echo $info[$i]['first_name']." ".$info[$i]['last_name'];?>"><?php echo $info[$i]['first_name']." ".$info[$i]['last_name'];?></a></td>

									<td><?php echo $financial->pay_amount($info[$i]['amount_num'], $info[$i]['exam_type']); ?></td>

								</tr>

		
							<?php	}
								
							}else{
								
							?>	
							
							<tr style="cursor:pointer;"><td colspan="4" align="center">No registered data</td></tr>
							
						<?php 
						
							}
						}
						?>

                        </tbody>
                    </table>
                    <div class="total">
                        <h2>Total <span><?php if($total_amount != "") echo "$".number_format($total_amount, 2);?></span></h2>
                    </div>
                </div>
