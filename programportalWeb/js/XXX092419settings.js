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
    form_data.append('class_of_year', $('#get_year').val());
	
	$.ajax({
		
		url: './php/setting.php',
		
		type: 'POST',
		
		dataType: 'json',
		
		cache: false,
		
        contentType: false,
		
        processData: false,	
		
		data: form_data,
		
		async: true,
		
		headers: {
		  "cache-control": "no-cache"
		},
		
		success: function(data) {
			
			if(data['statusCode'] == 1){
				
				load_overview_student();
				
				load_ite_student();
				
				load_cert_student();
				
				load_graduation_student();
					
				jQuery.gritter.add({
					title: 'Success!',
					text: 'Saved successfully!',
					sticky: false,
					class_name: 'bg-success',
					time: '1000'				
				});
				
				location.reload();
				
			}else if(data['statusCode'] == 0){
				
				alert('Please check internet connection.');
				
			}else if(data['statusCode'] == 4){
				
				alert('Sorry, your file is too large than 2M.');
				
			}
			
		},
		
		error: function(data) {
			
			alert('Please check internet connection.');
			
		}
	});
});

$('#remove_rd_photo').click(function() {
	
	var remove_data = {
		
		remove_object: 'rd_photo'
		
	};
	
	$.ajax({
		
		url: './php/remove_photo.php',
		
		type: 'POST',
		
		dataType: 'json',
		
		data: remove_data,
		
		async: true,
		
		headers: {
		  "cache-control": "no-cache"
		},
		
		success: function(data) {
			
			if(data['statusCode'] == 1){
				
				// $("#rd_fullname").val("");
				// $("#rd_designations").val("");
				// $("#rd_program_name").val("");
				// $("#rd_program_address").val("");
				// $("#rd_phone").val("");
				// $("#rd_email").val("");
				$("#rd_photo").attr("src", "../admin/images/photo.png");
	
				jQuery.gritter.add({
					title: 'Success!',
					text: 'Removed successfully!',
					sticky: false,
					class_name: 'bg-success',
					time: '1000'				
				});
				
			}else if(data['statusCode'] == 0){
				
				alert('Please check internet connection.');
				
			}
			
		},
		
		error: function(data) {
			
			alert('Please check internet connection.');
			
		}
	});
	
});

$('#remove_pd_photo').click(function() {
	
	var remove_data = {
		
		remove_object: 'pd_photo'
		
	};
	
	$.ajax({
		
		url: './php/remove_photo.php',
		
		type: 'POST',
		
		dataType: 'json',
		
		data: remove_data,
		
		async: true,
		
		headers: {
		  "cache-control": "no-cache"
		},
		
		success: function(data) {
			
			if(data['statusCode'] == 1){
				
				// $("#pd_fullname").val("");
				// $("#pd_designations").val("");
				// $("#pd_program_name").val("");
				// $("#pd_program_address").val("");
				// $("#pd_phone").val("");
				// $("#pd_email").val("");
				$("#pd_photo").attr("src", "../admin/images/photo.png");
	
				jQuery.gritter.add({
					title: 'Success!',
					text: 'Removed successfully!',
					sticky: false,
					class_name: 'bg-success',
					time: '1000'				
				});
				
			}else if(data['statusCode'] == 0){
				
				alert('Please check internet connection.');
				
			}
			
		},
		
		error: function(data) {
			
			alert('Please check internet connection.');
			
		}
	});
	
});

$('#remove_apd_photo').click(function() {
	
	var remove_data = {
		
		remove_object: 'apd_photo'
		
	};
	
	$.ajax({
		
		url: './php/remove_photo.php',
		
		type: 'POST',
		
		dataType: 'json',
		
		data: remove_data,
		
		async: true,
		
		headers: {
		  "cache-control": "no-cache"
		},
		
		success: function(data) {
			
			if(data['statusCode'] == 1){
				
				// $("#apd_fullname").val("");
				// $("#apd_designations").val("");
				// $("#apd_program_name").val("");
				// $("#apd_program_address").val("");
				// $("#apd_phone").val("");
				// $("#apd_email").val("");
				$("#apd_photo").attr("src", "../admin/images/photo.png");
	
				jQuery.gritter.add({
					title: 'Success!',
					text: 'Removed successfully!',
					sticky: false,
					class_name: 'bg-success',
					time: '1000'				
				});
				
			}else if(data['statusCode'] == 0){
				
				alert('Please check internet connection.');
				
			}
			
		},
		
		error: function(data) {
			
			alert('Please check internet connection.');
			
		}
	});
	
});

$('#remove_aa_photo').click(function() {
	
	var remove_data = {
		
		remove_object: 'aa_photo'
		
	};
	
	$.ajax({
		
		url: './php/remove_photo.php',
		
		type: 'POST',
		
		dataType: 'json',
		
		data: remove_data,
		
		async: true,
		
		headers: {
		  "cache-control": "no-cache"
		},
		
		success: function(data) {
			
			if(data['statusCode'] == 1){
				
				// $("#aa_fullname").val("");
				// $("#aa_designations").val("");
				// $("#aa_program_name").val("");
				// $("#aa_program_address").val("");
				// $("#aa_phone").val("");
				// $("#aa_email").val("");
				$("#aa_photo").attr("src", "../admin/images/photo.png");
	
				jQuery.gritter.add({
					title: 'Success!',
					text: 'Removed successfully!',
					sticky: false,
					class_name: 'bg-success',
					time: '1000'				
				});
				
			}else if(data['statusCode'] == 0){
				
				alert('Please check internet connection.');
				
			}
			
		},
		
		error: function(data) {
			
			alert('Please check internet connection.');
			
		}
	});
	
});

$('#remove_ite_photo').click(function() {
	
	var remove_data = {
		
		remove_object: 'ite_photo'
		
	};
	
	$.ajax({
		
		url: './php/remove_photo.php',
		
		type: 'POST',
		
		dataType: 'json',
		
		data: remove_data,
		
		async: true,
		
		headers: {
		  "cache-control": "no-cache"
		},
		
		success: function(data) {
			
			if(data['statusCode'] == 1){
				
				// $("#coordinator_fullname").val("");
				// $("#coordinator_designations").val("");
				// $("#coordinator_program_name").val("");
				// $("#coordinator_program_address").val("");
				// $("#coordinator_phone").val("");
				// $("#coordinator_email").val("");
				$("#coordinator_photo").attr("src", "../admin/images/photo.png");
	
				jQuery.gritter.add({
					title: 'Success!',
					text: 'Removed successfully!',
					sticky: false,
					class_name: 'bg-success',
					time: '1000'				
				});
				
			}else if(data['statusCode'] == 0){
				
				alert('Please check internet connection.');
				
			}
			
		},
		
		error: function(data) {
			
			alert('Please check internet connection.');
			
		}
	});
	
});

$('#remove_portal_picture').click(function() {
	
	var remove_data = {
		
		remove_object: 'portal_picture'
		
	};
	
	$.ajax({
		
		url: './php/remove_photo.php',
		
		type: 'POST',
		
		dataType: 'json',
		
		data: remove_data,
		
		async: true,
		
		headers: {
		  "cache-control": "no-cache"
		},
		
		success: function(data) {
			
			if(data['statusCode'] == 1){
				
				$("#portal_photo").attr("src", "../admin/images/picture.png");
	
				jQuery.gritter.add({
					title: 'Success!',
					text: 'Removed successfully!',
					sticky: false,
					class_name: 'bg-success',
					time: '1000'				
				});
				
			}else if(data['statusCode'] == 0){
				
				alert('Please check internet connection.');
				
			}
			
		},
		
		error: function(data) {
			
			alert('Please check internet connection.');
			
		}
	});
	
});


$(document).ready(function(){
  var owl = $('.owl-carousel');
  owl.owlCarousel({
    loop:true,
    margin:10,
    nav:true,	
    items: 3
  });
    
});
