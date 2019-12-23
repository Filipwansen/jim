var fieldData = {};
var filter = {};
var count_student = 0;
var student_id = [];

$(document).ready(function() {
	
	$('.datepicker').datepicker({
		
		autoclose: true,
		
	});
	
	$('#sub_link1').attr('class', 'active');
	
	$('#overview_section').show();
	
	filter = {
		
		class_of: $('#get_year').val()

		
	};
	
	load_overview_student();
	
});

//select sub_link
function sub_link1(year) {
	
    $('#sub_link1').attr('class', 'active');
    $('#sub_link2').attr('class', '');
    $('#sub_link3').attr('class', '');
    $('#sub_link4').attr('class', '');
	
	$('#overview_section').show();
	$('#ite_section').hide();
	$('#cert_section').hide();
	$('#graduation_section').hide();
	
	filter = {
		
		class_of: year
		
	};
	
	load_overview_student();
	
}

function sub_link2(year) {
	
    $('#sub_link1').attr('class', '');
    $('#sub_link2').attr('class', 'active');
    $('#sub_link3').attr('class', '');
    $('#sub_link4').attr('class', '');
	
	$('#overview_section').hide();
	$('#ite_section').show();
	$('#cert_section').hide();
	$('#graduation_section').hide();
	
	filter = {
		
		class_of: year
		
	};
	
	load_ite_student();
	
}

function sub_link3(year) {
	
    $('#sub_link1').attr('class', '');
    $('#sub_link2').attr('class', '');
	$('#sub_link3').attr('class', 'active');
    $('#sub_link4').attr('class', '');
	
	$('#overview_section').hide();
	$('#ite_section').hide();
	$('#cert_section').show();
	$('#graduation_section').hide();
	
	filter = {
		
		class_of: year
		
	};
	
	load_cert_student();
	
}

function sub_link4(year) {
	
    $('#sub_link1').attr('class', '');
    $('#sub_link2').attr('class', '');
    $('#sub_link3').attr('class', '');
	$('#sub_link4').attr('class', 'active');
	
	$('#overview_section').hide();
	$('#ite_section').hide();
	$('#cert_section').hide();
	$('#graduation_section').show();
	
	filter = {
		
		class_of: year
		
	};
	
	load_graduation_student();
	
}

//change backcolor of tr tag when click checkbox
function tr_baground(e){
	
	if($("#check_overview_student" + e).is(':checked')){
		
		$("#overview_tr" + e).css('background-color', '#B0BED9');
		
	}else{
		
		$("#overview_tr" + e).css('background-color', '');
		
	}
	
	if($("#check_ite_student" + e).is(':checked')){
		
		$("#ite_tr" + e).css('background-color', '#B0BED9');
		
	}else{
		
		$("#ite_tr" + e).css('background-color', '');
		
	}
	
	if($("#check_cert_student" + e).is(':checked')){
		
		$("#cert_tr" + e).css('background-color', '#B0BED9');
		
	}else{
		
		$("#cert_tr" + e).css('background-color', '');
		
	}
	
	if($("#check_graduation_student" + e).is(':checked')){
		
		$("#graduation_tr" + e).css('background-color', '#B0BED9');
		
	}else{
		
		$("#graduation_tr" + e).css('background-color', '');
		
	}
	
}

//only allow number Class of
$('#classof').on('change keyup', function() {
	
  var sanitized = $(this).val().replace(/[^0-9/]/g, '');
  
  $(this).val(sanitized);
    
});

//Add New Student
$('#add_button').click(function() {
	
	if($('#firstname').val() == ""){
		
		alert('Please type first name');
		
		$('#firstname').focus();
		
	}else if($('#lastname').val() == ""){
		
		alert('Please type last name');
		
		$('#lastname').focus();
		
	}else if($('#classof').val() == ""){
		
		alert('Please type class of');
		
		$('#classof').focus();
		
	}else if($('#student_email').val() == ""){
		
		alert('Please type email');
		
		$('#student_email').focus();
		
	}
	
	fieldData = {
		
		firstname: $('#firstname').val(),
		
		lastname: $('#lastname').val(),
		
		classof: $('#classof').val(),
		
		student_email: $('#student_email').val()
		
	};
	
	$.ajax({
		
		url: '/member/programportalWeb/php/add_student.php',
		
		type: 'POST',
		
		dataType: 'json',
		
		data: fieldData,
		
		success: function(data) {
			
			if(data['statusCode'] == 1){
				
				init_input();
		
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
				
				$('#firstname').focus();
				
			}else if(data['statusCode'] == 0){
				
				alert('Please check internet connection.');
				
			}
			
		},
		
		error: function(data) {
			
			alert('Please check internet connection.');
			
		}
	});
	
});


function init_input(){
	
	$('#firstname').val('');
	
	$('#lastname').val('');
	
	$('#student_email').val('');
}

//overview content start

function load_overview_student(){
	
	$.ajax({
		
		url: '/member/programportalWeb/php/load_student.php',
		
		type: 'POST',
		
		dataType: 'json',
		
		data: filter,
		
		success: function(data) {
			
			var td_value = [];
			
			if(data['statusCode'] == 1){
				
				count_student = data['value'].length;
				
				for(var i = 0; i < data['value'].length; i++){
					
					student_id[i] = data['value'][i]['id'];
					
					if(data['value'][i]['overview_active'] == 0){
						
						td_value += "<tr align='center' style='cursor:pointer;' role='row' id='overview_tr" + i + "'><td style='width:7%;'><input type='checkbox' id='check_overview_student" + i + "' onclick='javascript:tr_baground(" + i + ")' style='width:20px; height:20px; cursor:pointer;' /></td>";
					
					}else if(data['value'][i]['overview_active'] == 1){
						
						td_value += "<tr align='center' style='cursor:pointer; background-color: #B0BED9' role='row' id='overview_tr" + i + "'><td style='width:7%;'><input type='checkbox' id='check_overview_student" + i + "' onclick='javascript:tr_baground(" + i + ")' style='width:20px; height:20px; cursor:pointer;' checked /></td>";
					
					}
					td_value += "<td style='width:19%;' onclick='javascript:edit_student_info(" + data['value'][i]['id'] + ")'>" + data['value'][i]['First_Name'] + "</td>";
					
					td_value += "<td style='width:19%;' onclick='javascript:edit_student_info(" + data['value'][i]['id'] + ")'>" + data['value'][i]['Last_Name'] + "</td>";
					
					td_value += "<td style='width:13%;' onclick='javascript:edit_student_info(" + data['value'][i]['id'] + ")'>" + data['value'][i]['class_of'] + "</td>";
					
					td_value += "<td style='width:42%;' ><a href='mailto:" + data['value'][i]['email'] + "'>" + data['value'][i]['email'] + "</a></td>";
					
					td_value += "</tr>";
					
				}
				
				$('#load_overview_data').html(td_value);
				
				$('#count_student').html(count_student);
				
			}else if(data['statusCode'] == 0){
				
				td_value = "<tr align='center'><td colspan='5'>No registered data</td></tr>";
				
				$('#load_overview_data').html(td_value);
				
				$('#count_student').html(0);
				
			}
			
			
		},
		
		error: function(data) {
			
			alert('Please check internet connection.');
			
		}
	});

}


//ITE Exam content start

function load_ite_student(){
	
	$.ajax({
		
		url: '/member/programportalWeb/php/load_student.php',
		
		type: 'POST',
		
		dataType: 'json',
		
		data: filter,
		
		success: function(data) {
			
			var td_value = [];
			
			if(data['statusCode'] == 1){
				
				count_student = data['value'].length;
				
				for(var i = 0; i < data['value'].length; i++){
					
					student_id[i] = data['value'][i]['id'];
					
					if(data['value'][i]['ITE_exam_active'] == 0){
						
						td_value += "<tr align='center' style='cursor:pointer;' role='row' id='ite_tr" + i + "'><td style='width:5%;'><input type='checkbox' id='check_ite_student" + i + "' onclick='javascript:tr_baground(" + i + ")' style='width:20px; height:20px; cursor:pointer;' /></td>";
					
					}else if(data['value'][i]['ITE_exam_active'] == 1){
						
						td_value += "<tr align='center' style='cursor:pointer; background-color: #B0BED9' role='row' id='ite_tr" + i + "'><td style='width:7%;'><input type='checkbox' id='check_ite_student" + i + "' onclick='javascript:tr_baground(" + i + ")' style='width:20px; height:20px; cursor:pointer;' checked /></td>";
					
					}
					td_value += "<td style='width:19%;' onclick='javascript:edit_student_info(" + data['value'][i]['id'] + ")'>" + data['value'][i]['First_Name'] + "</td>";
					
					td_value += "<td style='width:19%;' onclick='javascript:edit_student_info(" + data['value'][i]['id'] + ")'>" + data['value'][i]['Last_Name'] + "</td>";
					
					td_value += "<td style='width:13%;' onclick='javascript:edit_student_info(" + data['value'][i]['id'] + ")'>" + data['value'][i]['class_of'] + "</td>";
					
					td_value += "<td style='width:26%;'><a href='mailto:" + data['value'][i]['email'] + "'>" + data['value'][i]['email'] + "</a></td>";
					
					if(data['value'][i]['ITE_score'] == 0){
						
						td_value += "<td style='width:16%;'><select class='form-control' id='ITE_score" + data['value'][i]['id'] + "' onchange = 'javascript:ite_score(" + data['value'][i]['id'] + ")' style='padding: 6px 6px;'><option value='0' selected = 'selected'>Select</option><option value='1'>Pass</option><option value='2'>Failed</option></select></td>";
						
					}
					
					if(data['value'][i]['ITE_score'] == 1){
						
						td_value += "<td style='width:16%;'><select class='form-control' id='ITE_score" + data['value'][i]['id'] + "' onchange = 'javascript:ite_score(" + data['value'][i]['id'] + ")' style='padding: 6px 6px;'><option value='0'>Select</option><option value='1'  selected = 'selected'>Pass</option><option value='2'>Failed</option></select></td>";
						
					}
					
					if(data['value'][i]['ITE_score'] == 2){
						
						td_value += "<td style='width:16%;'><select class='form-control' id='ITE_score" + data['value'][i]['id'] + "' onchange = 'javascript:ite_score(" + data['value'][i]['id'] + ")' style='padding: 6px 6px;'><option value='0'>Select</option><option value='1'>Pass</option><option value='2' selected = 'selected'>Failed</option></select></td>";
						
					}
					
					td_value += "</tr>";
					
				}
				
				$('#load_ite_data').html(td_value);
				
				$('#count_student').html(count_student);
				
			}else if(data['statusCode'] == 0){
				
				td_value = "<tr align='center'><td colspan='6'>No registered data</td></tr>";
				
				$('#load_ite_data').html(td_value);
				
				$('#count_student').html(0);
				
			}
			
			
		},
		
		error: function(data) {
			
			alert('Please check internet connection.');
			
		}
	});

}

//Certification Exam content start

function load_cert_student(){
	
	$.ajax({
		
		url: '/member/programportalWeb/php/load_student.php',
		
		type: 'POST',
		
		dataType: 'json',
		
		data: filter,
		
		success: function(data) {
			
			var td_value = [];
			
			if(data['statusCode'] == 1){
				
				count_student = data['value'].length;
				
				for(var i = 0; i < data['value'].length; i++){
					
					student_id[i] = data['value'][i]['id'];
					if(data['value'][i]['Cert_exam_active'] == 0){
						
						td_value += "<tr align='center' style='cursor:pointer;' role='row' id='cert_tr" + i + "'><td style='width:5%;'><input type='checkbox' id='check_cert_student" + i + "' onclick='javascript:tr_baground(" + i + ")' style='width:20px; height:20px; cursor:pointer;' /></td>";
					
					}else if(data['value'][i]['Cert_exam_active'] == 1){
						
						td_value += "<tr align='center' style='cursor:pointer; background-color: #B0BED9' role='row' id='cert_tr" + i + "'><td style='width:7%;'><input type='checkbox' id='check_cert_student" + i + "' onclick='javascript:tr_baground(" + i + ")' style='width:20px; height:20px; cursor:pointer;' checked /></td>";
					
					}
					td_value += "<td style='width:19%;' onclick='javascript:edit_student_info(" + data['value'][i]['id'] + ")'>" + data['value'][i]['First_Name'] + "</td>";
					
					td_value += "<td style='width:19%;' onclick='javascript:edit_student_info(" + data['value'][i]['id'] + ")'>" + data['value'][i]['Last_Name'] + "</td>";
					
					td_value += "<td style='width:13%;' onclick='javascript:edit_student_info(" + data['value'][i]['id'] + ")'>" + data['value'][i]['class_of'] + "</td>";
					
					td_value += "<td style='width:26%;'><a href='mailto:" + data['value'][i]['email'] + "'>" + data['value'][i]['email'] + "</a></td>";
					
					if(data['value'][i]['Certification_score'] == 0){
						
						td_value += "<td style='width:16%;'><select class='form-control' id='Cert_score" + data['value'][i]['id'] + "' onchange = 'javascript:cert_score(" + data['value'][i]['id'] + ")' style='padding: 6px 6px;'><option value='0' selected = 'selected'>Select</option><option value='1'>Pass</option><option value='2'>Failed</option></select></td>";
						
					}
					
					if(data['value'][i]['Certification_score'] == 1){
						
						td_value += "<td style='width:16%;'><select class='form-control' id='Cert_score" + data['value'][i]['id'] + "' onchange = 'javascript:cert_score(" + data['value'][i]['id'] + ")' style='padding: 6px 6px;'><option value='0'>Select</option><option value='1'  selected = 'selected'>Pass</option><option value='2'>Failed</option></select></td>";
						
					}
					
					if(data['value'][i]['Certification_score'] == 2){
						
						td_value += "<td style='width:16%;'><select class='form-control' id='Cert_score" + data['value'][i]['id'] + "' onchange = 'javascript:cert_score(" + data['value'][i]['id'] + ")' style='padding: 6px 6px;'><option value='0'>Select</option><option value='1'>Pass</option><option value='2' selected = 'selected'>Failed</option></select></td>";
						
					}
					
					td_value += "</tr>";
					
				}
				
				$('#load_cert_data').html(td_value);
				
				$('#count_student').html(count_student);
				
			}else if(data['statusCode'] == 0){
				
				td_value = "<tr align='center'><td colspan='6'>No registered data</td></tr>";
				
				$('#load_cert_data').html(td_value);
				
				$('#count_student').html(0);
				
			}
			
			
		},
		
		error: function(data) {
			
			alert('Please check internet connection.');
			
		}
	});

}

//Graduation content start

function load_graduation_student(){
	
	$.ajax({
		
		url: '/member/programportalWeb/php/load_student.php',
		
		type: 'POST',
		
		dataType: 'json',
		
		data: filter,
		
		success: function(data) {
			
			var td_value = [];
			
			if(data['statusCode'] == 1){
				
				count_student = data['value'].length;
				
				for(var i = 0; i < data['value'].length; i++){
					
					student_id[i] = data['value'][i]['id'];
					
					if(data['value'][i]['Graduation_active'] == 0){
						
						td_value += "<tr align='center' style='cursor:pointer;' role='row' id='graduation_tr" + i + "'><td style='width:7%;'><input type='checkbox' id='check_graduation_student" + i + "' onclick='javascript:tr_baground(" + i + ")' style='width:20px; height:20px; cursor:pointer;' /></td>";
					
					}else if(data['value'][i]['Graduation_active'] == 1){
						
						td_value += "<tr align='center' style='cursor:pointer; background-color: #B0BED9' role='row' id='graduation_tr" + i + "'><td style='width:5%;'><input type='checkbox' id='check_graduation_student" + i + "' onclick='javascript:tr_baground(" + i + ")' style='width:20px; height:20px; cursor:pointer;' checked /></td>";
					
					}
					td_value += "<td style='width:19%;' onclick='javascript:edit_student_info(" + data['value'][i]['id'] + ")'>" + data['value'][i]['First_Name'] + "</td>";
					
					td_value += "<td style='width:19%;' onclick='javascript:edit_student_info(" + data['value'][i]['id'] + ")'>" + data['value'][i]['Last_Name'] + "</td>";
					
					td_value += "<td style='width:13%;' onclick='javascript:edit_student_info(" + data['value'][i]['id'] + ")'>" + data['value'][i]['class_of'] + "</td>";
					
					td_value += "<td style='width:26%;'><a href='mailto:" + data['value'][i]['email'] + "'>" + data['value'][i]['email'] + "</a></td>";
					
					if(data['value'][i]['Graduation_score'] == 0){
						
						td_value += "<td style='width:16%;'><select class='form-control' id='Graduation_score" + data['value'][i]['id'] + "' onchange = 'javascript:Graduation_score(" + data['value'][i]['id'] + ")' style='padding: 6px 6px;'><option value='0' selected = 'selected'>Select</option><option value='1'>Pass</option><option value='2'>Failed</option></select></td>";
						
					}
					
					if(data['value'][i]['Graduation_score'] == 1){
						
						td_value += "<td style='width:16%;'><select class='form-control' id='Graduation_score" + data['value'][i]['id'] + "' onchange = 'javascript:Graduation_score(" + data['value'][i]['id'] + ")' style='padding: 6px 6px;'><option value='0'>Select</option><option value='1'  selected = 'selected'>Pass</option><option value='2'>Failed</option></select></td>";
						
					}
					
					if(data['value'][i]['Graduation_score'] == 2){
						
						td_value += "<td style='width:16%;'><select class='form-control' id='Graduation_score" + data['value'][i]['id'] + "' onchange = 'javascript:Graduation_score(" + data['value'][i]['id'] + ")' style='padding: 6px 6px;'><option value='0'>Select</option><option value='1'>Pass</option><option value='2' selected = 'selected'>Failed</option></select></td>";
						
					}
					
					td_value += "</tr>";
					
				}
				
				$('#load_graduation_data').html(td_value);
				
				$('#count_student').html(count_student);
				
			}else if(data['statusCode'] == 0){
				
				td_value = "<tr align='center'><td colspan='6'>No registered data</td></tr>";
				
				$('#load_graduation_data').html(td_value);
				
				$('#count_student').html(0);
				
			}
			
			
		},
		
		error: function(data) {
			
			alert('Please check internet connection.');
			
		}
	});

}

function check_submit(){
	
	var checked_options1 = [];
	var checked_options2 = [];
	var checked_options3 = [];
	var checked_options4 = [];
	
	if(count_student > 0){
		
		for(var i = 0; i < count_student; i++){
			
			checked_options1[i] = $('#check_overview_student'+i+':checked').length;
			
			checked_options2[i] = $('#check_ite_student'+i+':checked').length;
			
			checked_options3[i] = $('#check_cert_student'+i+':checked').length;
			
			checked_options4[i] = $('#check_graduation_student'+i+':checked').length;
		
		}
		
		filter = {
			
			class_of: $('#get_year').val(),
			
			overview_check: checked_options1,
			
			overview_id: student_id,
			
			
			
			ITE_exam_check: checked_options2,
			
			ITE_exam_id: student_id,
			
			
			
			cert_exam_check: checked_options3,
			
			cert_exam_id: student_id,
			
			
			
			Graduation_check: checked_options4,
			
			Graduation_id: student_id
			
		};
		
		$.ajax({
			
			url: '/member/programportalWeb/php/update_student.php',
			
			type: 'POST',
			
			dataType: 'json',
			
			data: filter,
			
			success: function(data) {
				
				if(data['statusCode'] == 1){
					
		
					load_overview_student();
					
					load_ite_student();
					
					load_cert_student();
					
					load_graduation_student();
				
					
					jQuery.gritter.add({
						title: 'Success!',
						text: 'Submitted successfully!',
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
		
	}else{
		
		alert('No registered data');
		
	}
}


//ITE score change
function ite_score(id){
	
		var score_data = {
			
			ITE_score_id: id,
			
			ITE_score_value: $('#ITE_score' + id).val()
			
		};
		
		$.ajax({
			
			url: '/member/programportalWeb/php/update_student.php',
			
			type: 'POST',
			
			dataType: 'json',
			
			data: score_data,
			
			success: function(data) {
				
				if(data['statusCode'] == 1){
					
					load_overview_student();
					
					load_ite_student();
					
					load_cert_student();
					
					load_graduation_student();
					
					jQuery.gritter.add({
						title: 'Success!',
						text: 'Detail saved successfully.',
						//image: 'assets/images/user-profile-2.jpg',			
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
}

//Certification score change
function cert_score(id){
	
		var score_data = {
			
			cert_score_id: id,
			
			cert_score_value: $('#Cert_score' + id).val()
			
		};
		
		$.ajax({
			
			url: '/member/programportalWeb/php/update_student.php',
			
			type: 'POST',
			
			dataType: 'json',
			
			data: score_data,
			
			success: function(data) {
				
				if(data['statusCode'] == 1){
					
					load_overview_student();
					
					load_ite_student();
					
					load_cert_student();
					
					load_graduation_student();
					
					jQuery.gritter.add({
						title: 'Success!',
						text: 'Detail saved successfully.',
						//image: 'assets/images/user-profile-2.jpg',			
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
}

//Graduation score change
function Graduation_score(id){
	
		var score_data = {
			
			Graduation_score_id: id,
			
			Graduation_score_value: $('#Graduation_score' + id).val()
			
		};
		
		$.ajax({
			
			url: '/member/programportalWeb/php/update_student.php',
			
			type: 'POST',
			
			dataType: 'json',
			
			data: score_data,
			
			success: function(data) {
				
				if(data['statusCode'] == 1){
					
					load_overview_student();
					
					load_ite_student();
					
					load_cert_student();
					
					load_graduation_student();
					
					jQuery.gritter.add({
						title: 'Success!',
						text: 'Detail saved successfully.',
						//image: 'assets/images/user-profile-2.jpg',			
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
}


function init_edit_input(){
	
	$('#edit_firstname').val('');
	
	$('#edit_lastname').val('');
	
	$('#edit_classof').val('');
	
	$('#edit_student_email').val('');
}

function edit_student_info(id){
	
	$.ajax({
		
		url: '/member/programportalWeb/php/load_student.php',
		
		type: 'POST',
		
		dataType: 'json',
		
		data: {edit_id: id},
		
		success: function(data) {
			
			if(data['statusCode'] == 1){
				
				$('#edit_firstname').val(data['value'][0]['First_Name']);
				
				$('#edit_lastname').val(data['value'][0]['Last_Name']);
				
				$('#edit_classof').val(data['value'][0]['class_of']);
				
				$('#edit_student_email').val(data['value'][0]['email']);
				
				$('#edit_student_id').val(data['value'][0]['id']);
				
			}else if(data['statusCode'] == 0){
				
				alert('Please check internet connection.');
				
			}
			
		},
		
		error: function(data) {
			
			alert('Please check internet connection.');
			
		}
	});
	
	 $('#edit_modal').modal('show');
	 
}

//update student
$('#edit_button').click(function() {
	
		var edit_data = {
			
			edit_id: $('#edit_student_id').val(),
			
			firstname: $('#edit_firstname').val(),
			
			lastname: $('#edit_lastname').val(),
			
			classof: $('#edit_classof').val(),
			
			email: $('#edit_student_email').val()
			
			
		};
		
		$.ajax({
			
			url: '/member/programportalWeb/php/update_student.php',
			
			type: 'POST',
			
			dataType: 'json',
			
			data: edit_data,
			
			success: function(data) {
				
				if(data['statusCode'] == 1){
					
					load_overview_student();
					
					load_ite_student();
					
					load_cert_student();
					
					load_graduation_student();
					
					init_edit_input();
					
					jQuery.gritter.add({
						title: 'Success!',
						text: 'Updated successfully!',
						sticky: false,
						class_name: 'bg-success',
						time: '1000'				
					});
					
					$('#edit_modal').modal('hide');
					
				}else if(data['statusCode'] == 0){
					
					alert('Please check internet connection.');
					
					init_edit_input();
					
					$('#edit_modal').modal('hide');
					
				}
				
				
			},
			
			error: function(data) {
				
				alert('Please check internet connection.');
				
			}
		});
	
});
	
//delete student
$('#delete_button').click(function() {
	
		var delete_data = {
			
			edit_id: $('#edit_student_id').val(),
			
		};
		
		$.ajax({
			
			url: '/member/programportalWeb/php/delete_student.php',
			
			type: 'POST',
			
			dataType: 'json',
			
			data: delete_data,
			
			success: function(data) {
				
				if(data['statusCode'] == 1){
					
					load_overview_student();
					
					load_ite_student();
					
					load_cert_student();
					
					load_graduation_student();
					
					init_edit_input();
					
					jQuery.gritter.add({
						title: 'Success!',
						text: 'Deleted successfully!',
						sticky: false,
						class_name: 'bg-success',
						time: '1000'				
					});
					
					$('#edit_modal').modal('hide');
					
				}else if(data['statusCode'] == 0){
					
					alert('Please check internet connection.');
					
					init_edit_input();
					
					$('#edit_modal').modal('hide');
					
				}
				
				
			},
			
			error: function(data) {
				
				alert('Please check internet connection.');
				
			}
		});
	
});

//////////////////////////////////////sorting date by first name overview
function sort_overview_firstname(){
	
	var click_num = $('#name_click_num').val();
	
	if(click_num == 0 || click_num == 2){
		
		$('#name_click_num').val(1);
		
	}else if(click_num == 1){
		
		$('#name_click_num').val(2);
		
	}
	
	filter = {
		
		sort_by_firstname: $('#name_click_num').val(),
		
		class_of: $('#get_year').val()
		
	};
	
	load_overview_student();
	
}

function sort_overview_lastname(){
	
	var click_num = $('#name_click_num').val();
	
	if(click_num == 0 || click_num == 2){
		
		$('#name_click_num').val(1);
		
	}else if(click_num == 1){
		
		$('#name_click_num').val(2);
		
	}
	
	filter = {
		
		sort_by_lastname: $('#name_click_num').val(),
		
		class_of: $('#get_year').val()
		
	};
	
	load_overview_student();
	
}

//sorting date by class overview
function sort_overview_class(){
	
	var click_num = $('#class_click_num').val();
	
	if(click_num == 0 || click_num == 2){
		
		$('#class_click_num').val(1);
		
	}else if(click_num == 1){
		
		$('#class_click_num').val(2);
		
	}
	
	filter = {
		
		class_of: $('#get_year').val(),
		
		sort_by_class: $('#class_click_num').val()
		
	};
	
	load_overview_student();
	
}

//sorting date by email overview
function sort_overview_email(){
	
	var click_num = $('#email_click_num').val();
	
	if(click_num == 0 || click_num == 2){
		
		$('#email_click_num').val(1);
		
	}else if(click_num == 1){
		
		$('#email_click_num').val(2);
		
	}
	
	filter = {
		
		class_of: $('#get_year').val(),
		
		sort_by_email: $('#email_click_num').val()
		
	};
	
	load_overview_student();
	
}

//////////////////////////////////////sorting date by name ITE Exam
function sort_ite_firstname(){
	
	var click_num = $('#name_click_num').val();
	
	if(click_num == 0 || click_num == 2){
		
		$('#name_click_num').val(1);
		
	}else if(click_num == 1){
		
		$('#name_click_num').val(2);
		
	}
	
	filter = {
		
		class_of: $('#get_year').val(),
		
		sort_by_firstname: $('#name_click_num').val()
		
	};
	
	load_ite_student();
	
}

function sort_ite_lastname(){
	
	var click_num = $('#name_click_num').val();
	
	if(click_num == 0 || click_num == 2){
		
		$('#name_click_num').val(1);
		
	}else if(click_num == 1){
		
		$('#name_click_num').val(2);
		
	}
	
	filter = {
		
		class_of: $('#get_year').val(),
		
		sort_by_lastname: $('#name_click_num').val()
		
	};
	
	load_ite_student();
	
}

//sorting date by class ITE Exam
function sort_ite_class(){
	
	var click_num = $('#class_click_num').val();
	
	if(click_num == 0 || click_num == 2){
		
		$('#class_click_num').val(1);
		
	}else if(click_num == 1){
		
		$('#class_click_num').val(2);
		
	}
	
	filter = {
		
		class_of: $('#get_year').val(),
		
		sort_by_class: $('#class_click_num').val()
		
	};
	
	load_ite_student();
	
}

//sorting date by email ITE Exam
function sort_ite_email(){
	
	var click_num = $('#email_click_num').val();
	
	if(click_num == 0 || click_num == 2){
		
		$('#email_click_num').val(1);
		
	}else if(click_num == 1){
		
		$('#email_click_num').val(2);
		
	}
	
	filter = {
		
		class_of: $('#get_year').val(),
		
		sort_by_email: $('#email_click_num').val()
		
	};
	
	load_ite_student();
	
}

//sorting date by score ITE Exam
function sort_ite_score(){
	
	var click_num = $('#ite_score_click').val();
	
	if(click_num == 0 || click_num == 2){
		
		$('#ite_score_click').val(1);
		
	}else if(click_num == 1){
		
		$('#ite_score_click').val(2);
		
	}
	
	filter = {
		
		class_of: $('#get_year').val(),
		
		sort_ite_score: $('#ite_score_click').val()
		
	};
	
	load_ite_student();
	
}

//////////////////////////////////////sorting date by name Cert Exam
function sort_cert_firstname(){
	
	var click_num = $('#name_click_num').val();
	
	if(click_num == 0 || click_num == 2){
		
		$('#name_click_num').val(1);
		
	}else if(click_num == 1){
		
		$('#name_click_num').val(2);
		
	}
	
	filter = {
		
		class_of: $('#get_year').val(),
		
		sort_by_firstname: $('#name_click_num').val()
		
	};
	
	load_cert_student();
	
}

function sort_cert_lastname(){
	
	var click_num = $('#name_click_num').val();
	
	if(click_num == 0 || click_num == 2){
		
		$('#name_click_num').val(1);
		
	}else if(click_num == 1){
		
		$('#name_click_num').val(2);
		
	}
	
	filter = {
		
		class_of: $('#get_year').val(),
		
		sort_by_lastname: $('#name_click_num').val()
		
	};
	
	load_cert_student();
	
}

//sorting date by class Cert Exam
function sort_cert_class(){
	
	var click_num = $('#class_click_num').val();
	
	if(click_num == 0 || click_num == 2){
		
		$('#class_click_num').val(1);
		
	}else if(click_num == 1){
		
		$('#class_click_num').val(2);
		
	}
	
	filter = {
		
		class_of: $('#get_year').val(),
		
		sort_by_class: $('#class_click_num').val()
		
	};
	
	load_cert_student();
	
}

//sorting date by email Cert Exam
function sort_cert_email(){
	
	var click_num = $('#email_click_num').val();
	
	if(click_num == 0 || click_num == 2){
		
		$('#email_click_num').val(1);
		
	}else if(click_num == 1){
		
		$('#email_click_num').val(2);
		
	}
	
	filter = {
		
		class_of: $('#get_year').val(),
		
		sort_by_email: $('#email_click_num').val()
		
	};
	
	load_cert_student();
	
}

//sorting date by score Cert Exam
function sort_cert_score(){
	
	var click_num = $('#cert_score_click').val();
	
	if(click_num == 0 || click_num == 2){
		
		$('#cert_score_click').val(1);
		
	}else if(click_num == 1){
		
		$('#cert_score_click').val(2);
		
	}
	
	filter = {
		
		class_of: $('#get_year').val(),
		
		sort_cert_score: $('#cert_score_click').val()
		
	};
	
	load_cert_student();
	
}

//////////////////////////////////////sorting date by name Graduation Exam
function sort_graduation_firstname(){
	
	var click_num = $('#name_click_num').val();
	
	if(click_num == 0 || click_num == 2){
		
		$('#name_click_num').val(1);
		
	}else if(click_num == 1){
		
		$('#name_click_num').val(2);
		
	}
	
	filter = {
		
		class_of: $('#get_year').val(),
		
		sort_by_firstname: $('#name_click_num').val()
		
	};
	
	load_graduation_student();
	
}

function sort_graduation_lastname(){
	
	var click_num = $('#name_click_num').val();
	
	if(click_num == 0 || click_num == 2){
		
		$('#name_click_num').val(1);
		
	}else if(click_num == 1){
		
		$('#name_click_num').val(2);
		
	}
	
	filter = {
		
		class_of: $('#get_year').val(),
		
		sort_by_lastname: $('#name_click_num').val()
		
	};
	
	load_graduation_student();
	
}

//sorting date by class Graduation Exam
function sort_graduation_class(){
	
	var click_num = $('#class_click_num').val();
	
	if(click_num == 0 || click_num == 2){
		
		$('#class_click_num').val(1);
		
	}else if(click_num == 1){
		
		$('#class_click_num').val(2);
		
	}
	
	filter = {
		
		class_of: $('#get_year').val(),
		
		sort_by_class: $('#class_click_num').val()
		
	};
	
	load_graduation_student();
	
}

//sorting date by email Graduation Exam
function sort_graduation_email(){
	
	var click_num = $('#email_click_num').val();
	
	if(click_num == 0 || click_num == 2){
		
		$('#email_click_num').val(1);
		
	}else if(click_num == 1){
		
		$('#email_click_num').val(2);
		
	}
	
	filter = {
		
		class_of: $('#get_year').val(),
		
		sort_by_email: $('#email_click_num').val()
		
	};
	
	load_graduation_student();
	
}

//sorting date by score Graduation Exam
function sort_graduation_score(){
	
	var click_num = $('#graduation_score_click').val();
	
	if(click_num == 0 || click_num == 2){
		
		$('#graduation_score_click').val(1);
		
	}else if(click_num == 1){
		
		$('#graduation_score_click').val(2);
		
	}
	
	filter = {
		
		class_of: $('#get_year').val(),
		
		sort_graduation_score: $('#graduation_score_click').val()
		
	};
	
	load_graduation_student();
	
}

function readURL1(input) {
	
  if (input.files && input.files[0]) {
	  
	var reader = new FileReader();
	
	reader.onload = function(e) {
		
		$('#rd_photo').attr('src', e.target.result);
		
	}
	
	reader.readAsDataURL(input.files[0]);
	
  }
  
}
 
function readURL2(input) {
	
  if (input.files && input.files[0]) {
	  
	var reader = new FileReader();
	
	reader.onload = function(e) {
		
		$('#pd_photo').attr('src', e.target.result);
		
	}
	
	reader.readAsDataURL(input.files[0]);
	
  }
  
}
 
function readURL3(input) {
	
  if (input.files && input.files[0]) {
	  
	var reader = new FileReader();
	
	reader.onload = function(e) {
		
		$('#apd_photo').attr('src', e.target.result);
		
	}
	
	reader.readAsDataURL(input.files[0]);
	
  }
  
}
 
function readURL4(input) {
	
  if (input.files && input.files[0]) {
	  
	var reader = new FileReader();
	
	reader.onload = function(e) {
		
		$('#aa_photo').attr('src', e.target.result);
		
	}
	
	reader.readAsDataURL(input.files[0]);
	
  }
  
}
 
function readURL5(input) {
	
  if (input.files && input.files[0]) {
	  
	var reader = new FileReader();
	
	reader.onload = function(e) {
		
		$('#coordinator_photo').attr('src', e.target.result);
		
	}
	
	reader.readAsDataURL(input.files[0]);
	
  }
  
}
 
function readURL6(input) {
	
  if (input.files && input.files[0]) {
	  
	var reader = new FileReader();
	
	reader.onload = function(e) {
		
		$('#portal_photo').attr('src', e.target.result);
		
	}
	
	reader.readAsDataURL(input.files[0]);
	
  }
  
}
 
$("#rd_picture").change(function() {
	
  readURL1(this);
  
});

$("#pd_picture").change(function() {
	
  readURL2(this);
  
});

$("#apd_picture").change(function() {
	
  readURL3(this);
  
});

$("#aa_picture").change(function() {
	
  readURL4(this);
  
});

$("#coordinator_picture").change(function() {
	
  readURL5(this);
  
});

$("#university_picture").change(function() {
	
  readURL6(this);
  
});
