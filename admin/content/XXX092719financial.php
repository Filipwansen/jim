<?php 

if(empty($_POST['edit_id']) == false && $_POST['edit_id'] > 0){
	
	$financial->update_financial($_POST);
	
	$_POST = array();
	
}

if(empty($_POST['delete_id']) == false && $_POST['delete_id'] > 0){
	
	$financial->delete_financial($_POST);
	
	$_POST = array();
	
}

if(empty($_POST['add_amount']) == false){
	
	$financial->add_financial($_POST);
	
	$_POST = array();
}

$info = $financial->readAllFinancial();

if(empty($_GET['s_year']) == false || empty($_GET['s_term']) == false || empty($_GET['s_type']) == false){
	
	$info = $financial->load_financial_filter($_GET);
	
}


if(empty($info) == false){
	
	if(count($info) > 10){
		
?>
	<style>

	thead, tbody { display: block; }

	tbody {
		height: 411px;       
		overflow-y: auto;   
		overflow-x: auto;  
	}

	thead th:nth-child(1){
		width:38px !important;
	}

	thead th:nth-child(2){
		width:100px !important;
	}

	thead th:nth-child(3){
		width:120px !important;
	}

	thead th:nth-child(4){
		width:240px !important;
	}

	thead th:nth-child(5){
		width:100px !important;
	}




	tbody td:nth-child(1){
		width:68px !important;
	}

	tbody td:nth-child(2){
		width:120px !important;
	}

	tbody td:nth-child(3){
		width:141px !important;
	}

	tbody td:nth-child(4){
		width:258px !important;
	}

	tbody td:nth-child(5){
		width:104px !important;
	}

	</style>

<?php
	}
}

require_once("admin_dashboard.php");
?>


                <div class="member-card card">
                    <h3>Financial General Ledger</h3>
                    <div class="form-group">
                        <div class="left">
                            <a href="?content=content/financial_report" class="btn btn-default">Report</a>
                           
  						    <!--a href="?content=content/financial_report" class="btn btn-default">Print</a-->
                        </div>
                        <div class="right">

                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-4">
                                <select class="form-control" id="select_year" onchange="javascript:financial_filter_year();">
								
								<?php 
								$array_year = array('Select Year', (date('Y') - 1), date('Y'), (date('Y') + 1), (date('Y') + 2), (date('Y') + 3), (date('Y') + 4));
								
								$year_val = array('null', (date('Y') - 1), date('Y'), (date('Y') + 1), (date('Y') + 2), (date('Y') + 3), (date('Y') + 4));
								
								for($i=0; $i < count($array_year); $i++){ ?>
									
									<option value="<?php echo $year_val[$i]; ?>" 
									<?php 
									if(empty($_GET['s_year']) == false && $year_val[$i] == $_GET['s_year']){
										
										echo " selected='selected'";
										
									}
									
									?>><?php echo $array_year[$i]; ?></option>
								<?php	
								}
								?>
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <select class="form-control" id="select_term" onchange="javascript:financial_filter_term();">								<?php 
								$array_term = array('Select Term', 'Today', 'Week-to-Date', 'Month-to-Date', 'Quarter-to-Date', 'Year-to-Date', 'Last Year', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
								
								$term_val = array('null', 'Today', 'Week', 'Month', 'Quarter', 'Year', 'Last_Year', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
								
								for($i=0; $i < count($array_term); $i++){ ?>
									
									<option value="<?php echo $term_val[$i]; ?>" 
									<?php 
									if(empty($_GET['s_term']) == false && $term_val[$i] == $_GET['s_term']){
										
										echo " selected='selected'";
										
									}
									
									?>><?php echo $array_term[$i]; ?></option>
								<?php	
								}
								?>
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <select class="form-control" id="select_type" onchange="javascript:financial_filter_type();">
								<?php 
								$array_type = array('Select Type', 'All Types', 'ITE Only', 'Certification only', 'CDQ only', 'CME only', 'Interest only', 'Other only');
								
								$type_val = array('null', 'All', 'ITE', 'Certification', 'CDQ', 'CME', 'Interest', 'Other');
								
								for($i=0; $i < count($array_type); $i++){ ?>
									
									<option value="<?php echo $type_val[$i]; ?>" 
									<?php 
									if(empty($_GET['s_type']) == false && $type_val[$i] == $_GET['s_type']){
										
										echo " selected='selected'";
										
									}
									
									?>><?php echo $array_type[$i]; ?></option>
								<?php	
								}
								?>

                                </select>
                            </div>
                        </div>
                    </div>
                    <table id="financialLedger" class="table table-striped table-bordered nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th style="text-align:center; width:70px;"><input type="button" onclick="javascript:print_admin_financial(document.getElementById('print_financialLedger'))" value="Print" /></th>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
						
						<?php 
						
						if(empty($info) == false){
							
							for($i=0; $i < count($info); $i++){
								
						?>		<input class="hidden" id="count_tr" value="<?php echo count($info); ?>" />
                            <tr id="financial_tr<?php echo $i?>" style="cursor:pointer;">

                                <td align="center"><input type="checkbox" id="check_financial<?php echo $i?>" onclick='javascript:tr_baground(<?php echo $i?>)' style="width:20px; height:20px; cursor:pointer;" /></td>

                                <td <?php if($info[$i]['exam_type'] == 'Admin') echo "onclick='javascript:edit_financial_modal(". $info[$i]['id'] .")'";?>><?php echo $financial->convert_date($info[$i]['action_date']);?></td>

                                <td><a href="?content=content/financial_student&financial_id=<?php echo $info[$i]['user_id'];?>&member_name=<?php echo $info[$i]['first_name']." ".$info[$i]['last_name'];?>"><?php echo $info[$i]['first_name']." ".$info[$i]['last_name'];?></a></td>

                                <?php if($info[$i]['exam_type'] == 'Admin'){?>
								
									<td><a href="?content=content/financial_type&financial_exam_type=<?php echo $info[$i]['exam_type'];?>">
									<?php echo $info[$i]['receipt_title']; ?>
									</a></td>
									
								<?php }else{?>
							
									<td><a href="?content=content/financial_type&financial_exam_type=<?php echo $info[$i]['exam_type'];?>">
									<?php echo $financial->category_title($info[$i]['exam_mon'], $info[$i]['exam_year'], $info[$i]['cme_cycle_start'], $info[$i]['exam_type'], $info[$i]['receipt_title']); ?>
									</a></td>
									
								<?php }?>

                                <td <?php if($info[$i]['exam_type'] == 'Admin') echo "onclick='javascript:edit_financial_modal(". $info[$i]['id'] .")'";?>><?php echo $financial->pay_amount($info[$i]['amount_num'], $info[$i]['exam_type']); ?></td>

                            </tr>

							<div id="edit_financial<?php echo $info[$i]['id'];?>" class="modal fade" role="dialog">
							  <div class="modal-dialog" style="width:400px; -webkit-transform: translate(0,50%); -o-transform: translate(0,50%); transform: translate(0,50%);">

									<!-- Modal content-->
									<div class="modal-content">
										  <div class="modal-header">
										  <button type="button" class="close" data-dismiss="modal">&times;</button>
											 <div class="edit_financial_title" style="margin-top:10px">Edit financial</div>
											
										  </div>
										  <div class="modal-body" style="height:220px;">
										  
													<div class="row">
														<div class="col-md-12">
															<div class="col-md-4">
																<label>Date</label>
															</div>
															<div class="col-md-8">
																<input type="text" class="form-control reducesize datepicker" name="edit_date<?php echo $info[$i]['id'];?>" id="edit_date<?php echo $info[$i]['id'];?>" value="<?php echo $financial->admin_date($info[$i]['action_date']);?>" >
															</div>
														</div>
														
														<div class="col-md-12" style="margin-top:15px;">
															<div class="col-md-4">
																<label>Description</label>
															</div>
															<div class="col-md-8">
																<input type="text" class="form-control reducesize" name="edit_description<?php echo $info[$i]['id'];?>" id="edit_description<?php echo $info[$i]['id'];?>" value="<?php echo $info[$i]['first_name'];?>" >
															</div>
														</div>  

														<div class="col-md-12" style="margin-top:15px;">
															<div class="col-md-4">
																<label>Category</label>
															</div>
															<div class="col-md-8">
																<input type="text" class="form-control reducesize" name="edit_category<?php echo $info[$i]['id'];?>" id="edit_category<?php echo $info[$i]['id'];?>" value="<?php echo $info[$i]['receipt_title']; ?>" >
															</div>
														</div>  

														<div class="col-md-12" style="margin-top:15px; margin-bottom:15px;">
															<div class="col-md-4">
																<label>Amount</label>
															</div>
															<div class="col-md-8">
																<input type="text" class="form-control reducesize" name="edit_amount<?php echo $info[$i]['id'];?>" id="edit_amount<?php echo $info[$i]['id'];?>" value="<?php echo "$".number_format($info[$i]['amount_num'], 2); ?>" >
															</div>
														</div>  
													</div>
										  </div>	
										  <div class="modal-footer">
											<a type="button" class="btn btn-primary" onclick="javascript:update_financial(<?php echo $info[$i]['id'];?>);" style="width:67px;" >Update</a>
											<a type="button" class="btn btn-primary" onclick="javascript:delete_financial(<?php echo $info[$i]['id'];?>);" style="width:67px;" >Delete</a>
										  </div>
									</div>
								</div>
							</div>														





						
						<?php	}
							
						}else{
							
						?>	
						
						<tr style="cursor:pointer;"><td colspan="5" align="center">No registered data</td></tr>
							
						<?php 
						
						}
						
						?>

                        </tbody>
                    </table>				
				
                    <table id="print_financialLedger" class="table table-striped table-bordered nowrap" style="width:100%; display:none;">

                        <thead>

                            <tr>

                                <th style="width:20%;">Date</th>

                                <th style="width:20%;">Description</th>

                                <th style="width:40%;">Category</th>

                                <th style="width:20%;">Amount</th>

                            </tr>

                        </thead>

                        <tbody>
						
						<?php 
						if(empty($info) == false){
							for($i=0; $i < count($info); $i++){
								
						?>		
                            <tr id="print_financial_tr<?php echo $i?>" style="cursor:pointer;">

                                <td  style="width:20%;" <?php if($info[$i]['exam_type'] == 'Admin') echo "onclick='javascript:edit_financial_modal(". $info[$i]['id'] .")'";?>><?php echo $financial->convert_date($info[$i]['action_date']);?></td>

                                <td  style="width:20%;" <?php if($info[$i]['exam_type'] == 'Admin') echo "onclick='javascript:edit_financial_modal(". $info[$i]['id'] .")'";?>><?php echo $info[$i]['first_name']." ".$info[$i]['last_name'];?></td>

                                <td  style="width:40%;">
								<?php echo $financial->category_title($info[$i]['exam_mon'], $info[$i]['exam_year'], $info[$i]['cme_cycle_start'], $info[$i]['exam_type'], $info[$i]['receipt_title']); ?>
								</td>

                                <td  style="width:20%;" <?php if($info[$i]['exam_type'] == 'Admin') echo "onclick='javascript:edit_financial_modal(". $info[$i]['id'] .")'";?>><?php echo $financial->pay_amount($info[$i]['amount_num'], $info[$i]['exam_type']); ?></td>

                            </tr>

						
						<?php	}
							
						}else{
							
						?>	
						
						<tr style="cursor:pointer;"><td colspan="4" align="center">No registered data</td></tr>
							
						<?php 
						
						}
						
						?>


                        </tbody>

                    </table>
				
				
				
				
				
				
				
                    <form id="frmAddfinancial" action="?content=content/financial" method="post" enctype="multipart/form-data" autocomplete="off" >
					
						<div class="form-group">
							<div class="coll coll1">
								<input type="text" class="form-control datepicker" name="add_date" id="add_date" placeholder="Date" required />
							</div>
							<div class="coll coll2">
								<input type="text" class="form-control" name="add_name" id="add_name" placeholder="Description" required />
							</div>
							<div class="coll coll3">
								<input type="text" class="form-control" name="add_category" placeholder="Category" list="add_category" required />
								
									<datalist id="add_category">
									
											<?php 
											$array_category = array(
												
												'Certification Income Exam', 
												'Certification Income Late Fee', 
												'Certification Income Retake #1', 
												'Certification Income Retake #2', 
												'Certification Income Retake #3', 
												'Certification Income Retake #4', 
												'Certification Income Retake #5', 
												'CDQ Exam Income', 
												'CDQ Exam Income Late Fee', 
												'CDQ Income Retake #1', 
												'CDQ Income Retake #2', 
												'CME Submission', 
												'CME Income Late Fee', 
												'Contractor Expense', 
												'Merchant Expenses', 
												'NBME(Exam Administration)', 
												'Office Expenses', 
												'Management & Administration', 
												'Insurance',
												'Taxes & Titles',
												'Test Committee Meeting Expenses',
												'Test Committee Expense',
												'Board of Director Expenses',
												'Accreditation'
												
											);
											
											$category_val = array(
											
												'Certification Income Exam', 
												'Certification Income Late Fee', 
												'Certification Income Retake #1', 
												'Certification Income Retake #2', 
												'Certification Income Retake #3', 
												'Certification Income Retake #4', 
												'Certification Income Retake #5', 
												'CDQ Exam Income', 
												'CDQ Exam Income Late Fee', 
												'CDQ Income Retake #1', 
												'CDQ Income Retake #2', 
												'CME Submission', 
												'CME Income Late Fee', 
												'Contractor Expense', 
												'Merchant Expenses', 
												'NBME(Exam Administration)', 
												'Office Expenses', 
												'Management & Administration', 
												'Insurance',
												'Taxes & Titles',
												'Test Committee Meeting Expenses',
												'Test Committee Expense',
												'Board of Director Expenses',
												'Accreditation'
											
											);
											
											for($i=0; $i < count($array_category); $i++){ ?>
												
												<option value="<?php echo $category_val[$i]; ?>"><?php echo $array_category[$i]; ?></option>
											<?php	
											}
											?>
											
									</datalist>
							</div>
							<div class="coll coll4">
								<input type="text" class="form-control" name="add_amount" id="add_amount" placeholder="Amount" required />
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="clearfix">
							<div class="right">
								<input type="submit" class="btn btn-primary" value="Save" />
							</div>
						</div>
					</form>
                </div>
				
<script>

$(document).ready(function() {
	
	$('.datepicker').datepicker({
		
		autoclose: true,
		
	});
	
    $('#financialLedger').DataTable( {
        //"pagingType": "full_numbers",
		// dom: 'Bfrtip',
		// "lengthMenu": [[10, 15, 25, 50, -1], [10, 15, 25, 50, "All"]],
		// buttons: [ 'pageLength' ],
		searching: true,
		//"pageLength": 20,
		// "bFilter": true,
		paging: false
		//searchable: true

    } );

} );

function tr_baground(e){
	
	if($("#check_financial" + e).is(':checked')){
		
		$("#financial_tr" + e).css('background-color', '#B0BED9');
		
	}else{
		
		$("#financial_tr" + e).css('background-color', '');
		
	}
}

function edit_financial_modal(e){
	
	$('#edit_financial' + e).modal('show');
	
}

function update_financial(e){
	
	var fieldData = {
		
		edit_id: e,
		
		edit_date: $('#edit_date' + e).val(),
		
		edit_description: $('#edit_description' + e).val(),
		
		edit_category: $('#edit_category' + e).val(),
		
		edit_amount: $('#edit_amount' + e).val(),
		
		add_amount: ''
		
	};
	$.ajax({
		
		url: '?content=content/financial',
		
		type: 'POST',
		
		dataType: 'json',
		
		data: fieldData,
		
		success: function(data) {
			
				location.href = '?content=content/financial';
		},
		
		error: function(data) {
			
				location.href = '?content=content/financial';
			
		}
	});
	
}

function delete_financial(e){
	
	var fieldData = {
		
		delete_id: e,
		
		add_amount: ''
		
	};
	
	$.ajax({
		
		url: '?content=content/financial',
		
		type: 'POST',
		
		dataType: 'json',
		
		data: fieldData,
		
		success: function(data) {
			
				location.href = '?content=content/financial';
		},
		
		error: function(data) {
				
				location.href = '?content=content/financial';
			
		}
	});
	
}

function financial_filter_year(){
	
	var select_year = $('#select_year').val();
	var select_term = $('#select_term').val();
	var select_type = $('#select_type').val();
	
	if(select_year != 'null'){
		
		if((select_year != new Date().getFullYear()) && (select_year != (new Date().getFullYear() - 1))){
			
			select_term = 'null';
			
		}else if(select_year == new Date().getFullYear()){
			
			select_term = 'null';
			
		}else if(select_year == (new Date().getFullYear() - 1)){
			
			select_term = 'Last_Year';
			
		}
		
	}else if(select_year == 'null'){
		
			select_term = 'null';
		
	}
	
	location.href = "?content=content/financial&s_year=" + select_year + "&s_term=" + select_term + "&s_type=" + select_type + "";
	
}

function financial_filter_term(){
	
	var select_year = new Date().getFullYear();
	var select_term = $('#select_term').val();
	var select_type = $('#select_type').val();
	if(select_term == 'Last_Year'){
		
		select_year = (new Date().getFullYear() - 1);
		
	}
	
	location.href = "?content=content/financial&s_year=" + select_year + "&s_term=" + select_term + "&s_type=" + select_type + "";
	
}

function financial_filter_type(){
	
	var select_year = $('#select_year').val();
	var select_term = $('#select_term').val();
	var select_type = $('#select_type').val();;
	
	location.href = "?content=content/financial&s_year=" + select_year + "&s_term=" + select_term + "&s_type=" + select_type + "";
	
}


//newWin.document.write("<style> td:nth-child(2){display:none;} </style>");
function checked_tr_hide(){
	
	for(var i = 0; i < $("#count_tr").val(); i++){
		
		if($("#check_financial" + i).is(':checked')){
			
			true;
			
		}else{
			
			$("#print_financial_tr" + i).css('display', 'none');
			
		}
		
	}
	
}


function print_admin_financial(elem){
	
	// $(".close").hide();
	
	checked_tr_hide();
	
	$("#print_financialLedger").show();
	
	$("div").hide();
	
    var domClone = elem.cloneNode(true);
    
    var $printSection = document.getElementById("printSection");
    
    if (!$printSection) {
		
        var $printSection = document.createElement("div");
		
        $printSection.id = "printSection";
		
        document.body.appendChild($printSection);
		
    }
    
    $printSection.innerHTML = "";
	
    $printSection.appendChild(domClone);
	
    window.print();
	
	location.href = "http://localhost/member/admin/?content=content/financial";
	
}


</script>