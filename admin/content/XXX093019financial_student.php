<?php 

$info = "";

$total_amount = "";

$member_email = "";

$member_name = "";

if(empty($_GET['financial_id']) == false || $_GET['financial_id'] > 0){
	
	$info = $financial->readFinancialById($_GET['financial_id']);
	
	$total_amount = $financial->total_count_id($_GET['financial_id']);
	
	$member_email = $financial->get_email_id($_GET['financial_id']);

}

if(empty($_GET['member_name']) == false){
	
	$member_name = $_GET['member_name'];
	
}

require_once("admin_dashboard.php");

?>

                <div class="member-card card">
                    <h4><font style="font-size:15px; text-transform: capitalize; align:center;font-weight: 600; text-align:center;color:#A3162C;"><?php echo $member_name .": </font>". date('Y') ." Financial Ledger";?></h4>
                    <a href="?content=content/financial" class="backbtn"><span class="glyphicon glyphicon-chevron-left"></span>Back</a>
                    
					<div class="right">

						<a href="../receipt/financial_pdf_student.php?&financial_id=<?php echo $_GET['financial_id'];?>" class="btn btn-primary">Save as PDF</a>
					   
					</div>

                    <table id="financialLedgerDetail" class="table ptable table-striped table-bordered nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Full Name</th>
                                
								<th>Email</th>
								
								<th>Type</th>
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

									<td><?php echo $info[$i]['first_name']." ".$info[$i]['last_name'];?></td>
									
									<td><a href="mailto:<?php if($member_email != "") echo $member_email;?>"><?php echo $member_email;?></a></td>
									
									<td><?php echo $info[$i]['exam_type'];?></td>

									<td <?php if($info[$i]['exam_type'] == 'Admin') echo "onclick='javascript:edit_financial_modal(". $info[$i]['id'] .")'";?>><?php echo $financial->pay_amount($info[$i]['amount_num'], $info[$i]['exam_type']); ?></td>

								</tr>

		
							<?php	}
								
							}else{
								
							?>	
							
							<tr style="cursor:pointer;"><td colspan="6" align="center">No registered data</td></tr>
							
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
