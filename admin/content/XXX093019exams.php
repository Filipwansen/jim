<?php

    if(isset($_GET["select_exam_date"])){

		$result = $exam->readAll($_GET["select_exam_date"]);
		
    }else{
		
		$result = $exam->readAll('');
		
	}
	
	$select_exam_date = getdate();

require_once("admin_dashboard.php");

?>

				<div class="member-cards card">

                    <h3 class="exam-title">Exams</h3>
					
					<div class="form-group">
					
						<div class="row">

							<div class="col-md-12">
							
								<div class="col-md-4">
								
									<a href="?content=content/cmes" class="btn select_exams" id="select_cme">CMEs</a>
									
								</div>
								
								<div class="col-md-4">
								
									<a href="?content=content/exams" class="btn select_exams" id="select_cdq" align="center" style="background: rgb(36,96,139); color: white;">CDQs</a>
									
								</div>
								
								<div class="col-md-4">
								
									<a href="?content=content/certification" class="btn select_exams" id="select_certification">Certification</a>
									
								</div>
								
							</div>

						</div>
						
						<div class="row" style="margin-top:20px">
						
							<div class="col-md-12">
							
								<div class="col-md-1">
								
								</div>
								
								<div class="col-md-2">
								
									<a href="?content=content/exams&select_exam_date=21">Feb. 6, <?php echo ($select_exam_date['year'] + 1);?></a>
								
								</div>
								
								<div class="col-md-2">
								
									<a href="?content=content/exams&select_exam_date=61">June. 1, <?php echo ($select_exam_date['year'] + 1);?></a>
								
								</div>
								
								<div class="col-md-2">
								
									<a href="?content=content/exams&select_exam_date=22">Feb. 7, <?php echo ($select_exam_date['year'] + 2);?></a>
								
								</div>
								
								<div class="col-md-2">
								
									<a href="?content=content/exams&select_exam_date=62">June. 2, <?php echo ($select_exam_date['year'] + 2);?></a>
								
								</div>
								
								<div class="col-md-2">
								
									<a href="?content=content/exams&select_exam_date=23">Feb. 4, <?php echo ($select_exam_date['year'] + 3);?></a>
								
								</div>
								
								<div class="col-md-1">
								
								</div>
								
							</div>
							
						</div>
						
					    <div class="clearfix"></div>
				    </div>

                    <table id="memberTable" class="table stable table-striped table-bordered nowrap" style="width:100%; text-align:center; font-size:14px !important">

                        <thead>

                            <tr>

                                <th>First Name</th>

                                <th>Last Name</th>

                                <th>Date Paid</th>

                                <th>Amount</th>

                                <th>Exam Date</th>

                                <th>Show/No Show</th>
                                
								<th>Pass/Fail</th>

                            </tr>

                        </thead>

                        <tbody>



                            <?php

                            if ($result) {

                                foreach ($result as $rec) {

                            ?>

                            <tr>

                                <td><?php echo $rec[0]['first_name']?></td>

                                <td><?php echo $rec[0]['last_name'] ?></td>

                                <td><?php $date = getdate($rec[0]['action_date']); echo $date['mon']."/".$date['mday']."/".$date['year']; ?></td>

                                <td><?php echo ("$".$exam->readActionAmount($rec[0]['amount_num'])); ?></td>

                                <td><?php echo ($exam->readActionExamMon($rec[0]['exam_mon']).".1. ".$rec[0]['exam_year']);?></td>

                                <td>
									<select class = "form-control" style = "width:100%; font-size:16px; padding-left:5px;" id = "show_allow_id<?php echo $rec[0]['user_id'];?>" onchange = "javascript:show_allow(<?php echo $rec[0]['user_id'] ?>);">
									
										<?php
										
										$show_set = array("Select", "Show", "No Show");
										
										foreach ($show_set as $key) { ?>
										
											<option 
											
											<?php
											
                                             if($rec[0]['show_allow'] == 0){
												 
												 $key_value = "Select";
												 
											 }
											 
                                             if($rec[0]['show_allow'] == 1){
												 
												 $key_value = "Show";
												 
											 }
											 
                                             if($rec[0]['show_allow'] == 2){
												 
												 $key_value = "No Show";
												 
											 }
											 
											if($key_value == $key){ echo 'selected = "selected"'; }
											
											?> 
											
											value = "<?php echo array_search($key, $show_set);?>">
											
												<?php echo $key?> 
												
											</option>
											
										<?php } ?>

									</select>
								</td>
								
                                <td>
									<select class = "form-control" style = "width:100%; font-size:16px;padding-left:5px;" id = "admin_select_id<?php echo $rec[0]['user_id'];?>" onchange = "javascript:admin_select(<?php echo $rec[0]['user_id'] ?>);">

										<?php 
										
										$order_set = array("Select","Pass","Fail");
										
										foreach ($order_set as $key) { ?>
										
											<option 
											
											<?php
											
                                             if($rec[0]['action_num']<2){
												 
												 $key_value = "Pass";
												 
											 }
											 
                                             if($rec[0]['action_num'] == 2){
												 
												 $key_value = "Select";
												 
											 }
											 
                                             if($rec[0]['action_num']>2){
												 
												 $key_value = "Fail";
												 
											 }
											 
											if($key_value == $key){ echo 'selected = "selected"'; }
											
											?> 
											
											value = "<?php echo array_search($key, $order_set);?>">
											
												<?php echo $key?> 
												
											</option>
											
										<?php } ?>


									</select>
								</td>

                            </tr>

                            <?php

                                }

                            }else{
								
							?>	
							
								<tr><td colspan = "7" align = "center">No registered data</td></tr>
								
							<?php
							
							}

                            ?>



                        </tbody>

                    </table>
					
					<div class="row">
					
						<div class="col-md-4" align="center" style="padding-top:10px;">
						
							<span id="date_time" class="date_time"></span>
						
						</div>
						
						<div class="col-md-6"></div>
						
						<div class="col-md-2">
						
							<button class="save_data" id="save_data">SAVE</button>
							
						</div>
					
                    </div>
<script type="text/javascript">
			
		window.onload = date_time('date_time');
		function date_time(id)
		{
			date = new Date;
			year = date.getFullYear();
			month = date.getMonth();
			// months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'Jully', 'August', 'September', 'October', 'November', 'December');
			months = new Array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
			d = date.getDate();
			day = date.getDay();
			days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
			h = date.getHours();
			if(h<10)
			{
					h = "0"+h;
			}
			m = date.getMinutes();
			if(m<10)
			{
					m = "0"+m;
			}
			s = date.getSeconds();
			if(s<10)
			{
					s = "0"+s;
			}
			result = ''+days[day]+' '+months[month]+'/'+d+'/'+year+'   '+h+':'+m+':'+s;
			document.getElementById(id).innerHTML = result;
			setTimeout('date_time("'+id+'");','1000');
			return true;
		}		
</script>					

