
                </div>
				
			</div>

        </div>

    </div>

</section>

<div id="add_new_modal" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width:400px; -webkit-transform: translate(0,50%); -o-transform: translate(0,50%); transform: translate(0,50%);">

		<!-- Modal content-->
		<div class="modal-content">
			  <div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
				 <h2 class="modal-title" style="margin-top:10px; font-size:28px !important;">Add New Student</h2>
				 <h5 class="modal-title" style="margin-top:10px"><?php echo $university_name;?></h5>
				
			  </div>
			  <div class="modal-body" style="height:220px;">
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-4">
								<label>First Name</label>
							</div>
							<div class="col-md-8">
								<input type="text" class="form-control reducesize" id="firstname" >
							</div>
						</div>
						
						<div class="col-md-12" style="margin-top:15px;">
							<div class="col-md-4">
								<label>Last Name</label>
							</div>
							<div class="col-md-8">
								<input type="text" class="form-control reducesize" id="lastname">
							</div>
						</div>  

						<div class="col-md-12" style="margin-top:15px;">
							<div class="col-md-4">
								<label>Class of</label>
							</div>
							<div class="col-md-8">
								<input type="text" class="form-control reducesize" id="classof" value="<?php echo $class_of_year;?>" >
							</div>
						</div>  

						<div class="col-md-12" style="margin-top:15px; margin-bottom:15px;">
							<div class="col-md-4">
								<label>Email</label>
							</div>
							<div class="col-md-8">
								<input type="email" class="form-control reducesize" id="student_email" >
							</div>
						</div>  
					</div>
			  </div>	
			  <div class="modal-footer">
				<a type="button" class="btn btn-primary" id="add_button" style="width:67px;" >Add</a>
				<a type="button" class="btn btn-primary" data-dismiss="modal">Cancel</a>
			  </div>
		</div>
	</div>
</div>														

<div id="edit_modal" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width:400px; -webkit-transform: translate(0,50%); -o-transform: translate(0,50%); transform: translate(0,50%);">

		<!-- Modal content-->
		<div class="modal-content">
			  <div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
				 <h2 class="modal-title" style="margin-top:10px; font-size:28px !important;">Edit Student</h2>
				 <h5 class="modal-title" style="margin-top:10px"><?php echo $university_name;?></h5>
				
			  </div>
			  <div class="modal-body" style="height:220px;">
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-4">
								<label>First Name</label>
							</div>
							<div class="col-md-8">
								<input type="text" class="form-control reducesize" id="edit_firstname">
							</div>
						</div>
						
						<div class="col-md-12" style="margin-top:15px;">
							<div class="col-md-4">
								<label>Last Name</label>
							</div>
							<div class="col-md-8">
								<input type="text" class="form-control reducesize" id="edit_lastname">
							</div>
						</div>  

						<div class="col-md-12" style="margin-top:15px;">
							<div class="col-md-4">
								<label>Class of</label>
							</div>
							<div class="col-md-8">
								<input type="text" class="form-control reducesize" id="edit_classof" >
							</div>
						</div>  

						<div class="col-md-12" style="margin-top:15px; margin-bottom:15px;">
							<div class="col-md-4">
								<label>Email</label>
							</div>
							<div class="col-md-8">
								<input type="email" class="form-control reducesize" id="edit_student_email">
							</div>
						</div>  
					</div>
			  </div>	
			  <div class="modal-footer">
			    <input type="hidden" id="edit_student_id" /> 
				<a type="button" class="btn btn-primary" id="edit_button" style="width:67px;" >Update</a>
				<a type="button" class="btn btn-primary" id="delete_button" style="width:67px;" >Delete</a>
			  </div>
		</div>
	</div>
</div>														

<div id="setting_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			  <div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
				 <h2 class="modal-title" style="margin-top:10px; font-size:28px !important;">Settings</h3>
				 <h5 class="modal-title" style="margin-top:5px"><?php echo $university_name;?></h5>
				
			  </div>
			  <div class="modal-body" style="overflow-y:auto; height:640px;">
					<div class="row">
				
						<div class="col-md-12" style="margin-top:25px;">
							<div class="col-md-3">
								<label>Regional Director</label>
								<div class="col-md-12">
									<img id="rd_photo" src="<?php
									if(empty($rd_info[0]) == false){
										
										if(empty($rd_info[0]['Photo']) == false){
											
											echo $rd_info[0]['Photo'];
										
										}else{
											
											echo"../admin/images/photo.png";
											
										}
									} 
									else echo"../admin/images/photo.png";
									?>" 
									style="width:100%;height:auto;" alt="Regional Director Image" />
								</div>
								
								<div class="col-md-12" align="center" style="margin-top:5px;">
								
								    <button id="remove_rd_photo" >Remove</button>
								
								</div>
								
							</div>
							
							<div class="col-md-9">
							
								<div class="col-md-12">
								    <label style="margin-bottom:-5px">Full Name</label>
									<input type="text" class="form-control reducesize" id="rd_fullname" 
									value="<?php if(empty($rd_info[0]) == false) echo $rd_info[0]['First_Name']." ".$rd_info[0]['Last_Name'];?>">
								</div>
								
								<div class="col-md-12">
									<label style="margin-bottom:-5px">Designations</label>
									<input type="text" class="form-control reducesize" id="rd_designations" 
									value="<?php if(empty($rd_info[0]) == false) echo $rd_info[0]['Designation'];?>">
								</div>
								
								<div class="col-md-12">
								    <label style="margin-bottom:-5px">Program Name</label>
									<input type="text" class="form-control reducesize" id="rd_program_name" 
									value="<?php if(empty($rd_info[0]) == false) echo $rd_info[0]['Program_Name'];?>">
								</div>
								
								<div class="col-md-12">
								    <label style="margin-bottom:-5px">Program Address</label>
									<input type="text" class="form-control reducesize" id="rd_program_address" 
									value="<?php if(empty($rd_info[0]) == false) echo $rd_info[0]['Program_Address'];?>">
								</div>
								
								<div class="col-md-12">
								    <label style="margin-bottom:-5px">Phone Number</label>
									<input type="text" class="form-control reducesize" id="rd_phone" 
									value="<?php if(empty($rd_info[0]) == false) echo $rd_info[0]['Cell_Phone'];?>">
								</div>
								
								<div class="col-md-12">
								    <label style="margin-bottom:-5px">Email</label>
									<input type="text" class="form-control reducesize" id="rd_email" 
									value="<?php if(empty($rd_info[0]) == false) echo $rd_info[0]['Email'];?>">
								</div>
								
								<div class="col-md-12">
								    <label style="margin-bottom:-5px">Picture</label>
									<input type="file" class="form-control reducesize" id="rd_picture" accept="image/x-png,image/gif,image/jpeg">
								</div>
							</div>
						</div>
						
						<div class="col-md-12" style="margin-top:25px;">
							<div class="col-md-3">
								<label>Program Director</label>
								<div class="col-md-12">
									<img id="pd_photo" 
									src="<?php 
									if(empty($pd_info[0]) == false){
										
										if(empty($pd_info[0]['Photo']) == false){
											
											echo $pd_info[0]['Photo'];
										
										}else{
											
											echo"../admin/images/photo.png";
											
										}
									} 
									else echo"../admin/images/photo.png";
									?>" 
									style="width:100%;height:auto;" alt="Program Director Image" />
								</div>
								
								<div class="col-md-12" align="center" style="margin-top:5px;">
								
								    <button id="remove_pd_photo" >Remove</button>
								
								</div>
								
							</div>
							
							<div class="col-md-9">
							
								<div class="col-md-12">
								    <label style="margin-bottom:-5px">Full Name</label>
									<input type="text" class="form-control reducesize" id="pd_fullname" 
									value="<?php if(empty($pd_info[0]) == false) echo $pd_info[0]['First_Name']." ".$pd_info[0]['Last_Name'];?>">
								</div>
								
								<div class="col-md-12">
									<label style="margin-bottom:-5px">Designations</label>
									<input type="text" class="form-control reducesize" id="pd_designations" 
									value="<?php if(empty($pd_info[0]) == false) echo $pd_info[0]['Designation'];?>">
								</div>
								
								<div class="col-md-12">
								    <label style="margin-bottom:-5px">Program Name</label>
									<input type="text" class="form-control reducesize" id="pd_program_name" 
									value="<?php if(empty($pd_info[0]) == false) echo $pd_info[0]['Program_Name'];?>">
								</div>
								
								<div class="col-md-12">
								    <label style="margin-bottom:-5px">Program Address</label>
									<input type="text" class="form-control reducesize" id="pd_program_address" 
									value="<?php if(empty($pd_info[0]) == false) echo $pd_info[0]['Program_Address'];?>">
								</div>
								
								<div class="col-md-12">
								    <label style="margin-bottom:-5px">Phone Number</label>
									<input type="text" class="form-control reducesize" id="pd_phone" 
									value="<?php if(empty($pd_info[0]) == false) echo $pd_info[0]['Cell_Phone'];?>">
								</div>
								
								<div class="col-md-12">
								    <label style="margin-bottom:-5px">Email</label>
									<input type="text" class="form-control reducesize" id="pd_email" 
									value="<?php if(empty($pd_info[0]) == false) echo $pd_info[0]['Email'];?>">
								</div>
								
								<div class="col-md-12">
								    <label style="margin-bottom:-5px">Picture</label>
									<input type="file" class="form-control reducesize" id="pd_picture" accept="image/x-png,image/gif,image/jpeg" placeholder="Type picture">
								</div>
							</div>
						</div>
						
						<div class="col-md-12" style="margin-top:25px;">
							<div class="col-md-3">
								<label>Assistant Program Director</label>
								<div class="col-md-12">
									<img id="apd_photo" src="<?php 
									if(empty($apd_info[0]) == false){
										
										if(empty($apd_info[0]['Photo']) == false){
											
											echo $apd_info[0]['Photo'];
										
										}else{
											
											echo"../admin/images/photo.png";
											
										}
									} 
									else echo"../admin/images/photo.png";
									?>" 
									style="width:100%;height:auto;" alt="Assistant Program Director Image" />
								</div>
								
								<div class="col-md-12" align="center" style="margin-top:5px;">
								
								    <button id="remove_apd_photo" >Remove</button>
								
								</div>
								
							</div>
							
							<div class="col-md-9">
							
								<div class="col-md-12">
								    <label style="margin-bottom:-5px">Full Name</label>
									<input type="text" class="form-control reducesize" id="apd_fullname" 
									value="<?php if(empty($apd_info[0]) == false) echo $apd_info[0]['First_Name']." ".$apd_info[0]['Last_Name'];?>">
								</div>
								
								<div class="col-md-12">
									<label style="margin-bottom:-5px">Designations</label>
									<input type="text" class="form-control reducesize" id="apd_designations" 
									value="<?php if(empty($apd_info[0]) == false) echo $apd_info[0]['Designation'];?>">
								</div>
								
								<div class="col-md-12">
								    <label style="margin-bottom:-5px">Program Name</label>
									<input type="text" class="form-control reducesize" id="apd_program_name" 
									value="<?php if(empty($apd_info[0]) == false) echo $apd_info[0]['Program_Name'];?>">
								</div>
								
								<div class="col-md-12">
								    <label style="margin-bottom:-5px">Program Address</label>
									<input type="text" class="form-control reducesize" id="apd_program_address" 
									value="<?php if(empty($apd_info[0]) == false) echo $apd_info[0]['Program_Address'];?>">
								</div>
								
								<div class="col-md-12">
								    <label style="margin-bottom:-5px">Phone Number</label>
									<input type="text" class="form-control reducesize" id="apd_phone" 
									value="<?php if(empty($apd_info[0]) == false) echo $apd_info[0]['Cell_Phone'];?>">
								</div>
								
								<div class="col-md-12">
								    <label style="margin-bottom:-5px">Email</label>
									<input type="text" class="form-control reducesize" id="apd_email" 
									value="<?php if(empty($apd_info[0]) == false) echo $apd_info[0]['Email'];?>">
								</div>
								
								<div class="col-md-12">
								    <label style="margin-bottom:-5px">Picture</label>
									<input type="file" class="form-control reducesize" id="apd_picture" accept="image/x-png,image/gif,image/jpeg">
								</div>
							</div>
						</div>
						
						<div class="col-md-12" style="margin-top:25px;">
							<div class="col-md-3">
								<label>Admin Assistant</label>
								<div class="col-md-12">
									    <img id="aa_photo" src="<?php 
									if(empty($aa_info[0]) == false){
										
										if(empty($aa_info[0]['Photo']) == false){
											
											echo $aa_info[0]['Photo'];
										
										}else{
											
											echo"../admin/images/photo.png";
											
										}
									} 
									else echo"../admin/images/photo.png";
									?>" 
									style="width:100%;height:auto;" alt="Admin Assistant Image" />
								</div>
								
								<div class="col-md-12" align="center" style="margin-top:5px;">
								
								    <button id="remove_aa_photo" >Remove</button>
								
								</div>
								
							</div>
							
							<div class="col-md-9">
							
								<div class="col-md-12">
								    <label style="margin-bottom:-5px">Full Name</label>
									<input type="text" class="form-control reducesize" id="aa_fullname" 
									value="<?php if(empty($aa_info[0]) == false) echo $aa_info[0]['First_Name']." ".$aa_info[0]['Last_Name'];?>">
								</div>
								
								<div class="col-md-12">
									<label style="margin-bottom:-5px">Designations</label>
									<input type="text" class="form-control reducesize" id="aa_designations" 
									value="<?php if(empty($aa_info[0]) == false) echo $aa_info[0]['Designation'];?>">
								</div>
								
								<div class="col-md-12">
								    <label style="margin-bottom:-5px">Program Name</label>
									<input type="text" class="form-control reducesize" id="aa_program_name" 
									value="<?php if(empty($aa_info[0]) == false) echo $aa_info[0]['Program_Name'];?>">
								</div>
								
								<div class="col-md-12">
								    <label style="margin-bottom:-5px">Program Address</label>
									<input type="text" class="form-control reducesize" id="aa_program_address" 
									value="<?php if(empty($aa_info[0]) == false) echo $aa_info[0]['Program_Address'];?>">
								</div>
								
								<div class="col-md-12">
								    <label style="margin-bottom:-5px">Phone Number</label>
									<input type="text" class="form-control reducesize" id="aa_phone" 
									value="<?php if(empty($aa_info[0]) == false) echo $aa_info[0]['Cell_Phone'];?>">
								</div>
								
								<div class="col-md-12">
								    <label style="margin-bottom:-5px">Email</label>
									<input type="text" class="form-control reducesize" id="aa_email" 
									value="<?php if(empty($aa_info[0]) == false) echo $aa_info[0]['Email'];?>">
								</div>
								
								<div class="col-md-12">
								    <label style="margin-bottom:-5px">Picture</label>
									<input type="file" class="form-control reducesize" id="aa_picture" accept="image/x-png,image/gif,image/jpeg">
								</div>
							</div>
						</div>
						
						<div class="col-md-12" style="margin-top:25px;"><!-- border-top: 1px solid #e5e5e5;"-->
							<div class="col-md-3">
								<label>ITE Coordinator</label>
								<div class="col-md-12">
									    <img id="coordinator_photo" src="<?php 
									if(empty($ite_info[0]) == false){
										
										if(empty($ite_info[0]['Photo']) == false){
											
											echo $ite_info[0]['Photo'];
										
										}else{
											
											echo"../admin/images/photo.png";
											
										}
									} 
									else echo"../admin/images/photo.png";
									?>" 
									style="width:100%;height:auto;" alt="ITE Coordinator Image" />
								</div>
								
								<div class="col-md-12" align="center" style="margin-top:5px;">
								
								    <button id="remove_ite_photo" >Remove</button>
								
								</div>
								
							</div>
							
							<div class="col-md-9">
							
								<div class="col-md-12">
								    <label style="margin-bottom:-5px">Full Name</label>
									<input type="text" class="form-control reducesize" id="coordinator_fullname" 
									value="<?php if(empty($ite_info[0]) == false) echo $ite_info[0]['First_Name']." ".$ite_info[0]['Last_Name'];?>">
								</div>
								
								<div class="col-md-12">
									<label style="margin-bottom:-5px">Designations</label>
									<input type="text" class="form-control reducesize" id="coordinator_designations" 
									value="<?php if(empty($ite_info[0]) == false) echo $ite_info[0]['Designation'];?>">
								</div>
								
								<div class="col-md-12">
								    <label style="margin-bottom:-5px">Program Name</label>
									<input type="text" class="form-control reducesize" id="coordinator_program_name" 
									value="<?php if(empty($ite_info[0]) == false) echo $ite_info[0]['Program_Name'];?>">
								</div>
								
								<div class="col-md-12">
								    <label style="margin-bottom:-5px">Program Address</label>
									<input type="text" class="form-control reducesize" id="coordinator_program_address" 
									value="<?php if(empty($ite_info[0]) == false) echo $ite_info[0]['Program_Address'];?>">
								</div>
								
								<div class="col-md-12">
								    <label style="margin-bottom:-5px">Phone Number</label>
									<input type="text" class="form-control reducesize" id="coordinator_phone" 
									value="<?php if(empty($ite_info[0]) == false) echo $ite_info[0]['Cell_Phone'];?>">
								</div>
								
								<div class="col-md-12">
								    <label style="margin-bottom:-5px">Email</label>
									<input type="text" class="form-control reducesize" id="coordinator_email" 
									value="<?php if(empty($ite_info[0]) == false) echo $ite_info[0]['Email'];?>">
								</div>
								
								<div class="col-md-12">
								    <label style="margin-bottom:-5px">Picture</label>
									<input type="file" class="form-control reducesize" id="coordinator_picture" accept="image/x-png,image/gif,image/jpeg">
								</div>
							</div>
						</div>
	
						<div class="col-md-12" style="margin-top:30px;">
						
							<div class="col-md-12" align="center">
									<img id="portal_photo" 
									src="<?php 
									if(empty($portal_picture) == false) echo $portal_picture;
									else echo "../admin/images/picture.png";
									?>" 
									style="width:350px;height:135px;" alt="Main Portal Picture" />
							</div>
								
							<div class="col-md-12" align="center" style="margin-top:5px;">
							
								<button style="width:350px;" id="remove_portal_picture" >Remove</button>
							
							</div>
								
							
							<div class="col-md-4" style="margin-top:15px;">
								<label>Main Portal Picture</label>
							</div>
							
							<div class="col-md-8" style="margin-top:15px;">
							
								<div class="col-md-12">
									<input type="file" class="form-control reducesize" id="university_picture" accept="image/x-png,image/gif,image/jpeg">
								</div>
						    </div>
						</div>
						
						<div class="col-md-12" style="margin-top:15px;">
							<div class="col-md-6">
								<label>Matriculation Date</label>
							</div>
							
							<div class="col-md-6">
								<div class="col-md-12">
									<input type="text" class="form-control reducesize datepicker" id="matriculation_date" 
									value="<?php if(empty($matriculation_date1) == false) echo $matriculation_date1;?>"
									 autocomplete="off" >
								</div>
							</div>
						</div>  
						
						<div class="col-md-12" style="margin-top:15px;">
							<div class="col-md-6">
								<label>Expected ITE Exam Date</label>
							</div>
							
							<div class="col-md-6">
								<div class="col-md-12">
									<input type="text" class="form-control reducesize datepicker" id="ite_date" 
									value="<?php if(empty($ite_exam_date1) == false) echo $ite_exam_date1;?>"
									autocomplete="off" >
								</div>
							</div>
						</div>  
						
						<div class="col-md-12" style="margin-top:15px;">
							<div class="col-md-6">
								<label>Expected Certification Date</label>
							</div>
							
							<div class="col-md-6">
								<div class="col-md-12">
									<input type="text" class="form-control reducesize datepicker" id="cert_date" 
									value="<?php if(empty($cert_date1) == false) echo $cert_date1;?>"
									autocomplete="off" >
								</div>
							</div>
						</div>  
						
						<div class="col-md-12" style="margin-top:15px;">
							<div class="col-md-6">
								<label>Expected Graduation Date</label>
							</div>
							
							<div class="col-md-6">
								<div class="col-md-12">
									<input type="text" class="form-control reducesize datepicker" id="graguation_date" 
									value="<?php if(empty($graduation_date1) == false) echo $graduation_date1;?>"
									autocomplete="off" >
								</div>
							</div>
						</div> 
						
						<div class="col-md-12">
						
							<div class="col-md-1"></div>
							
							<div class="col-md-10"><hr></hr></div>
						
							<div class="col-md-1"></div>
							
						</div>
						
						<div class="col-md-12">
							<div class="col-md-6">
								<label>ITE Registration Begins</label>
							</div>
							
							<div class="col-md-6">
								<div class="col-md-12">
									<input type="text" class="form-control reducesize datepicker" id="ite_begins_date" 
									value="<?php if(empty($ite_begins_date1) == false) echo $ite_begins_date1;?>"
									autocomplete="off" >
								</div>
							</div>
						</div>  
						
						<div class="col-md-12" style="margin-top:15px;">
							<div class="col-md-6">
								<label>ITE Registration Ends</label>
							</div>
							
							<div class="col-md-6">
								<div class="col-md-12">
									<input type="text" class="form-control reducesize datepicker" id="ite_ends_date" 
									value="<?php if(empty($ite_ends_date1) == false) echo $ite_ends_date1;?>"
									autocomplete="off" >
								</div>
							</div>
						</div>  

						<div class="col-md-12">
						
							<div class="col-md-1"></div>
							
							<div class="col-md-10"><hr></hr></div>
						
							<div class="col-md-1"></div>
							
						</div>

						<div class="col-md-12">
							<div class="col-md-6">
								<label>Certification Exam Registration Begins</label>
							</div>
							
							<div class="col-md-6">
								<div class="col-md-12">
									<input type="text" class="form-control reducesize datepicker" id="cert_begins_date" 
									value="<?php if(empty($cert_begins_date1) == false) echo $cert_begins_date1;?>"
									autocomplete="off" >
								</div>
							</div>
						</div>  
						
						<div class="col-md-12" style="margin-top:15px;">
							<div class="col-md-6">
								<label>Certification Exam Registration Ends</label>
							</div>
							
							<div class="col-md-6">
								<div class="col-md-12">
									<input type="text" class="form-control reducesize datepicker" id="cert_ends_date" 
									value="<?php if(empty($cert_ends_date1) == false) echo $cert_ends_date1;?>"
									autocomplete="off" >
								</div>
							</div>
						</div> 
						
					</div>
			  </div>
			  <div class="modal-footer">
				<a type="button" class="btn btn-primary" id="save_setting" style="width:67px;" >Save</a>
				<a type="button" class="btn btn-primary" data-dismiss="modal">Cancel</a>
			  </div>
		</div>

   </div>
</div>	

			
<script src="../admin/js/jquery-1.10.2.min.js"></script>

<script src="../admin/js/jquery-ui.js"></script>

<script src="../admin/js/bootstrap.min.js"></script>

<script src="../admin/js/jquery.dataTables.min.js"></script>

<script src="../admin/js/dataTables.bootstrap.min.js"></script>

<script src="../admin/js/dataTables.responsive.min.js"></script>

<script src="../admin/js/dataTables.buttons.min.js"></script>

<script src="../admin/js/buttons.print.min.js"></script>

<script src="../admin/js/dataTables.select.min.js"></script>

<script src="js/programportal.js"></script>

<script src="../admin/js/bootstrap-datepicker.js"></script>

<script src="../admin/js/bootstrap-datepicker.min.js"></script>

<script src="../admin/js/jquery.gritter.min.js"></script>

<script src="./js/owl.carousel.min.js"></script>

<script src="./js/settings.js"></script>

