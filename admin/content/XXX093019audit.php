<?php

//pass/fail
if(isset($_POST['id']) && isset($_POST['audit_result_id'])){
	
	$audit->updateActionNum($_POST);
	
}


//data save
if(isset($_POST['id']) && isset($_POST['issues_text'])){
	
	$audit->saveIssuesText($_POST);
	
}

    $result = $audit->readAll('');
	
require_once("admin_dashboard.php");


?>
			
				<div class="member-cards card">
                    
					<h3 class="cme-title">CME AUDIT</h3>
					
                    <div class="form-group">

                        <div class="right">

                            <a href="#" class="btn btn-primary" style="display:none">Report</a>

                        </div>

                        <div class="clearfix"></div>

                    </div>
					
					
					

                    <table id="memberTable" class="table stable table-striped table-bordered nowrap" style="width:100%; text-align:center; font-size:14px !important">

                        <thead>

                            <tr>

                                <th>Date Added</th>
                                
								<th>First Name</th>

                                <th>Last Name</th>

                                <th>Action</th>

                                <th>Issues</th>

                                <th>Completed</th>

                            </tr>

                        </thead>

                        <tbody>



                            <?php

                            if ($result) {
                                for($i = 0; $i < count($result); $i++) {

                            ?>

                            <tr>

                                <td><?php $date = getdate($result[$i][0]['action_date']); echo $date['mon']."/".$date['mday']."/".$date['year']; ?></td>

                                <td><?php echo $result[$i][0]['first_name']?></td>

                                <td><?php echo $result[$i][0]['last_name'] ?></td>

                                <td><a href="?content=content/audit_member&member_id=<?php echo $result[$i][0]['user_id'];?>&cycle=<?php echo $result[$i][0]['cme_cycle_start'];?>">View</a></td>
                                  
                                <td><input type="text" name="issues_text<?php echo $result[$i][0]['user_id'];?>" id="issues_text<?php echo $result[$i][0]['id'];?>" class="form-control reducesize" value="<?php echo $result[$i][0]['issues_text']?>" /></td>
                                 <input type="hidden" id="<?php echo $i;?>" value="<?php echo $result[$i][0]['id'];?>">
                                <td>
									<select class = "form-control" style = "width:100%; font-size:16px;padding-left:5px;" id = "cme_audit_id<?php echo $result[$i][0]['user_id'];?>" onchange = "javascript:cme_audit(<?php echo $result[$i][0]['user_id'] ?>);">

										<?php 
										
										$order_set = array("Select","Pass","Fail");
										
										foreach ($order_set as $key) { ?>
										
											<option 
											
											<?php
											
                                             if($result[$i][0]['action_num']<2){
												 
												 $key_value = "Pass";
												 
											 }
											 
                                             if($result[$i][0]['action_num'] == 2){
												 
												 $key_value = "Select";
												 
											 }
											 
                                             if($result[$i][0]['action_num']>2){
												 
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
						     <input type="hidden" id="id_count" value="<?php echo count($result);?>">
							<button  class="save_data" onclick="javascript:save_cme_audit()">SAVE</button>
							
						</div>
					
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

