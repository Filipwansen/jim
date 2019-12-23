$('#save_setting').click(function() {
	
	var rd_file_data = $('#rd_picture').prop('files')[0]; 
	var pd_file_data = $('#pd_picture').prop('files')[0]; 
	var apd_file_data = $('#apd_picture').prop('files')[0]; 
	var aa_file_data = $('#aa_picture').prop('files')[0]; 
	var coordinator_file_data = $('#coordinator_picture').prop('files')[0]; 
	var university_file_data = $('#university_picture').prop('files')[0]; 
	
    var form_data = new FormData();   
	
	//Regional Director 
    form_data.append('rd_fullname', $('#rd_fullname').val());
    form_data.append('rd_designations', $('#rd_designations').val());
    form_data.append('rd_program_name', $('#rd_program_name').val());
    form_data.append('rd_program_address', $('#rd_program_address').val());
    form_data.append('rd_phone', $('#rd_phone').val());
    form_data.append('rd_email', $('#rd_email').val());
    form_data.append('rd_file', rd_file_data);
	
	//Program Director
    form_data.append('pd_fullname', $('#pd_fullname').val());
    form_data.append('pd_designations', $('#pd_designations').val());
    form_data.append('pd_program_name', $('#pd_program_name').val());
    form_data.append('pd_program_address', $('#pd_program_address').val());
    form_data.append('pd_phone', $('#pd_phone').val());
    form_data.append('pd_email', $('#pd_email').val());
    form_data.append('pd_file', pd_file_data);
	
	//Assistant Program Director 
    form_data.append('apd_fullname', $('#apd_fullname').val());
    form_data.append('apd_designations', $('#apd_designations').val());
    form_data.append('apd_program_name', $('#apd_program_name').val());
    form_data.append('apd_program_address', $('#apd_program_address').val());
    form_data.append('apd_phone', $('#apd_phone').val());
    form_data.append('apd_email', $('#apd_email').val());
    form_data.append('apd_file', apd_file_data);
	
	//Admin Assistant
    form_data.append('aa_fullname', $('#aa_fullname').val());
    form_data.append('aa_designations', $('#aa_designations').val());
    form_data.append('aa_program_name', $('#aa_program_name').val());
    form_data.append('aa_program_address', $('#aa_program_address').val());
    form_data.append('aa_phone', $('#aa_phone').val());
    form_data.append('aa_email', $('#aa_email').val());
    form_data.append('aa_file', aa_file_data);
	
	//ITE Coordinator 
    form_data.append('coordinator_fullname', $('#coordinator_fullname').val());
    form_data.append('coordinator_designations', $('#coordinator_designations').val());
    form_data.append('coordinator_program_name', $('#coordinator_program_name').val());
    form_data.append('coordinator_program_address', $('#coordinator_program_address').val());
    form_data.append('coordinator_phone', $('#coordinator_phone').val());
    form_data.append('coordinator_email', $('#coordinator_email').val());
    form_data.append('coordinator_file', coordinator_file_data);
	
	//others
    form_data.append('university_photo', university_file_data);
    form_data.append('matriculation_date', $('#matriculation_date').val());
    form_data.append('ite_date', $('#ite_date').val());
    form_data.append('ite_begins_date', $('#ite_begins_date').val());
    form_data.append('ite_ends_date', $('#ite_ends_date').val());
    form_data.append('cert_date', $('#cert_date').val());
    form_data.append('cert_begins_date', $('#cert_begins_date').val());
    form_data.append('cert_ends_date', $('#cert_ends_date').val());
    form_data.append('graguation_date', $('#graguation_date').val());
	
	$.ajax({
		
		url: '/member/programportalWeb/php/setting.php',
		
		type: 'POST',
		
		dataType: 'json',
		
		cache: false,
		
        contentType: false,
		
        processData: false,	
		
		data: form_data,
		
		success: function(data) {
			
			if(data['statusCode'] == 1){
				
				load_student();
				
				alert('Saved successfully!');
				
				location.reload();
				
			}else if(data['statusCode'] == 0){
				
				alert('Please check internet connection.');
				
			}
			
		},
		
		error: function(data) {
			
			alert('Please check internet connection.');
			
		}
	});
});