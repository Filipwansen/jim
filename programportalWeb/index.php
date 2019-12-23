<?php 

	require_once("header.php");
	
    // ini_set('session.gc_maxlifetime', 86400);
    // session_set_cookie_params(86400);

	
	$class_of_year = date('Y');
	
	if(empty($_GET['class_of_year']) == false){
		
		$class_of_year = $_GET['class_of_year'];
		
	}
	
	$this_year_dates = $pdObject->readExpectedDate($university_id, $class_of_year);
	
	if(empty($this_year_dates) == false){
		
		$matriculation_date1 = $this_year_dates[0]['Matriculation_Date'];
		
		$ite_exam_date1 = $this_year_dates[0]['Expected_ITE_Exam'];
		
		$cert_date1 = $this_year_dates[0]['Expected_Cert_Exam'];
		
		$graduation_date1 = $this_year_dates[0]['Expected_Graduation'];
		
		$ite_begins_date1 = $this_year_dates[0]['ITE_Registration_Begins'];
		
		$ite_ends_date1 = $this_year_dates[0]['ITE_Registration_Ends'];
		
		$cert_begins_date1 = $this_year_dates[0]['Cert_Registration_Begins'];
		
		$cert_ends_date1 = $this_year_dates[0]['Cert_Registration_Ends'];
		
	}else{
		
		$matriculation_date1 = "";
		
		$ite_exam_date1 = "";
		
		$cert_date1 = "";
		
		$graduation_date1 = "";
		
		$ite_begins_date1 = "";
		
		$ite_ends_date1 = "";
		
		$cert_begins_date1 = "";
		
		$cert_ends_date1 = "";
		
	}
	
	if(empty($matriculation_date1) == true){
		
		$matriculation_date = "00/00/00";
	
	}else{
		
		$matriculation_date = substr($matriculation_date1,0,-4).substr($matriculation_date1,-2,2);
	
	}
	
	if(empty($ite_exam_date1) == true){
		
		$ite_exam_date = "00/00/00";
	
	}else{
		
		$ite_exam_date = substr($ite_exam_date1,0,-4).substr($ite_exam_date1,-2,2);
	
	}
	
	if(empty($cert_date1) == true){
		
		$cert_date = "00/00/00";
	
	}else{
		
		$cert_date = substr($cert_date1,0,-4).substr($cert_date1,-2,2);
	
	}
	
	if(empty($graduation_date1) == true){
		
		$graduation_date = "00/00/00";
	
	}else{
		
		$graduation_date = substr($graduation_date1,0,-4).substr($graduation_date1,-2,2);
	
	}
	
	if(empty($ite_begins_date1) == true){
		
		$ite_begins_date = "00/00/00";
	
	}else{
		
		$ite_begins_date = substr($ite_begins_date1,0,-4).substr($ite_begins_date1,-2,2);
	
	}
	
	if(empty($ite_ends_date1) == true){
		
		$ite_ends_date = "00/00/00";
	
	}else{
		
		$ite_ends_date = substr($ite_ends_date1,0,-4).substr($ite_ends_date1,-2,2);
	
	}
	
	if(empty($cert_begins_date1) == true){
		
		$cert_begins_date = "00/00/00";
	
	}else{
		
		$cert_begins_date = substr($cert_begins_date1,0,-4).substr($cert_begins_date1,-2,2);
	
	}
	
	if(empty($cert_ends_date1) == true){
		
		$cert_ends_date = "00/00/00";
	
	}else{
		
		$cert_ends_date = substr($cert_ends_date1,0,-4).substr($cert_ends_date1,-2,2);
	
	}
?>
				<div class="yearsmain ">

                    <ul class="yeartabs clearfix owl-carousel owl-theme">
					
					<?php if($class_of_year == (date('Y') - 1) || $class_of_year == date('Y') || $class_of_year == (date('Y') + 1)){?>

                        <li class="item">
							
							<a href="./?class_of_year=<?php echo (date('Y') - 1);?>" <?php if($class_of_year == (date('Y') - 1)) echo "class='active'";?>>
							
								Class of <?php echo (date('Y') - 1);?>
								
							</a> 
						
						</li>

                        <li class="item">
						
							<a href="./?class_of_year=<?php echo date('Y');?>" <?php if($class_of_year == date('Y')) echo "class='active'";?>>
							
								Class of <?php echo date('Y');?>
								
							</a>
							
						</li>

                        <li class="item">
						
							<a href="./?class_of_year=<?php echo (date('Y') + 1);?>" <?php if($class_of_year == (date('Y') + 1)) echo "class='active'";?>>
								
								Class of <?php echo (date('Y') + 1);?>
								
							</a>
							
						</li>
                        
						<li class="item">
						
							<a href="./?class_of_year=<?php echo (date('Y') + 2);?>" <?php if($class_of_year == (date('Y') + 2)) echo "class='active'";?>>
							
								Class of <?php echo (date('Y') + 2);?>
								
							</a>
						
						</li>
                       
 					    <li class="item">
						
							<a href="./?class_of_year=<?php echo (date('Y') + 3);?>" <?php if($class_of_year == (date('Y') + 3)) echo "class='active'";?>>
							
								Class of <?php echo (date('Y') + 3);?>
								
							</a>
							
						</li>
						
					<?php }?>
					
					<?php if($class_of_year == (date('Y') + 2)){?>

                        <li class="item">
						
							<a href="./?class_of_year=<?php echo date('Y');?>" <?php if($class_of_year == date('Y')) echo "class='active'";?>>
							
								Class of <?php echo date('Y');?>
								
							</a>
							
						</li>

                        <li class="item">
						
							<a href="./?class_of_year=<?php echo (date('Y') + 1);?>" <?php if($class_of_year == (date('Y') + 1)) echo "class='active'";?>>
								
								Class of <?php echo (date('Y') + 1);?>
								
							</a>
							
						</li>
                        
						<li class="item">
						
							<a href="./?class_of_year=<?php echo (date('Y') + 2);?>" <?php if($class_of_year == (date('Y') + 2)) echo "class='active'";?>>
							
								Class of <?php echo (date('Y') + 2);?>
								
							</a>
						
						</li>
                       
 					    <li class="item">
						
							<a href="./?class_of_year=<?php echo (date('Y') + 3);?>" <?php if($class_of_year == (date('Y') + 3)) echo "class='active'";?>>
							
								Class of <?php echo (date('Y') + 3);?>
								
							</a>
							
						</li>
						
                        <li class="item">
							
							<a href="./?class_of_year=<?php echo (date('Y') - 1);?>" <?php if($class_of_year == (date('Y') - 1)) echo "class='active'";?>>
							
								Class of <?php echo (date('Y') - 1);?>
								
							</a> 
						
						</li>
						
					<?php }?>
					
					<?php if($class_of_year == (date('Y') + 3)){?>

                        <li class="item">
						
							<a href="./?class_of_year=<?php echo (date('Y') + 1);?>" <?php if($class_of_year == (date('Y') + 1)) echo "class='active'";?>>
								
								Class of <?php echo (date('Y') + 1);?>
								
							</a>
							
						</li>
                        
						<li class="item">
						
							<a href="./?class_of_year=<?php echo (date('Y') + 2);?>" <?php if($class_of_year == (date('Y') + 2)) echo "class='active'";?>>
							
								Class of <?php echo (date('Y') + 2);?>
								
							</a>
						
						</li>
                       
 					    <li class="item">
						
							<a href="./?class_of_year=<?php echo (date('Y') + 3);?>" <?php if($class_of_year == (date('Y') + 3)) echo "class='active'";?>>
							
								Class of <?php echo (date('Y') + 3);?>
								
							</a>
							
						</li>
						
                        <li class="item">
							
							<a href="./?class_of_year=<?php echo (date('Y') - 1);?>" <?php if($class_of_year == (date('Y') - 1)) echo "class='active'";?>>
							
								Class of <?php echo (date('Y') - 1);?>
								
							</a> 
						
						</li>

                        <li class="item">
						
							<a href="./?class_of_year=<?php echo date('Y');?>" <?php if($class_of_year == date('Y')) echo "class='active'";?>>
							
								Class of <?php echo date('Y');?>
								
							</a>
							
						</li>
						
					<?php }?>
						
                    </ul>
					
						<input type="hidden" id="get_year" value="<?php echo $class_of_year; ?>" />

                </div>
				
                <div class="member-card card border-top-0">

                    <div class="yearsinnerlinks">

                        <ul class="clearfix">

                            <li><a id="sub_link1" onclick="javascript:sub_link1(<?php echo $class_of_year;?>);">Overview</a> </li>

                            <li><a id="sub_link2" onclick="javascript:sub_link2(<?php echo $class_of_year;?>);">ITE Exam</a> </li>

                            <li><a id="sub_link3" onclick="javascript:sub_link3(<?php echo $class_of_year;?>);">Certification Exam</a> </li>

                            <li><a id="sub_link4" onclick="javascript:sub_link4(<?php echo $class_of_year;?>);">Graduation</a> </li>

                        </ul>

                    </div>
                    
<?php 

	require_once("content.php");
	
	require_once("modals.php");
	
	require_once("footer.php");
	
?>
