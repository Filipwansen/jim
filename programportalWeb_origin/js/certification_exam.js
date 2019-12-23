var fieldData = {};
var filter = {};
var count_student = 0;
var student_id = [];

$(document).ready(function() {
	
	$('.datepicker').datepicker();
	
	$('#class_of1').attr('class', 'active');
	
	load_student();
	
});

//select class year
function class_of1(year){
	
    $('#class_of1').attr('class', 'active');
    $('#class_of2').attr('class', '');
    $('#class_of3').attr('class', '');
	
	filter = {
		
		class_of: year
		
	};
	
	load_student();
	
}

function class_of2(year){
	
    $('#class_of2').attr('class', 'active');
    $('#class_of1').attr('class', '');
    $('#class_of3').attr('class', '');
	
	filter = {
		
		class_of: year
		
	};
	
	load_student();
	
}

function class_of3(year){
	
    $('#class_of3').attr('class', 'active');
    $('#class_of1').attr('class', '');
    $('#class_of2').attr('class', '');
	
	filter = {
		
		class_of: year
		
	};
	
	load_student();
	
}

//change backcolor of tr tag when click checkbox
function tr_baground(e){
	
	if($("#check" + e).is(':checked')){
		
		$("#tr" + e).css('background-color', '#B0BED9');
		
	}else{
		
		$("#tr" + e).css('background-color', '');
		
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
		
				load_student();
				
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
	
	$('#classof').val('');
	
	$('#student_email').val('');
}

function load_student(){
	
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
						
						td_value += "<tr align='center' style='cursor:pointer;' role='row' id='tr" + i + "'><td><input type='checkbox' id='check" + i + "' onclick='javascript:tr_baground(" + i + ")' style='width:20px; height:20px; cursor:pointer;' /></td>";
					
					}else if(data['value'][i]['Cert_exam_active'] == 1){
						
						td_value += "<tr align='center' style='cursor:pointer; background-color: #B0BED9' role='row' id='tr" + i + "'><td><input type='checkbox' id='check" + i + "' onclick='javascript:tr_baground(" + i + ")' style='width:20px; height:20px; cursor:pointer;' checked /></td>";
					
					}
					td_value += "<td onclick='javascript:edit_student_info(" + data['value'][i]['id'] + ")'>" + data['value'][i]['First_Name'] + "</td>";
					
					td_value += "<td onclick='javascript:edit_student_info(" + data['value'][i]['id'] + ")'>" + data['value'][i]['Last_Name'] + "</td>";
					
					td_value += "<td onclick='javascript:edit_student_info(" + data['value'][i]['id'] + ")'>" + data['value'][i]['class_of'] + "</td>";
					
					td_value += "<td><a href='mailto:" + data['value'][i]['email'] + "'>" + data['value'][i]['email'] + "</a></td>";
					
					if(data['value'][i]['Certification_score'] == 0){
						
						td_value += "<td><select class='form-control' id='Cert_score" + data['value'][i]['id'] + "' onchange = 'javascript:cert_score(" + data['value'][i]['id'] + ")'><option value='0' selected = 'selected'>Select</option><option value='1'>Pass</option><option value='2'>Failed</option></select></td>";
						
					}
					
					if(data['value'][i]['Certification_score'] == 1){
						
						td_value += "<td><select class='form-control' id='Cert_score" + data['value'][i]['id'] + "' onchange = 'javascript:cert_score(" + data['value'][i]['id'] + ")'><option value='0'>Select</option><option value='1'  selected = 'selected'>Pass</option><option value='2'>Failed</option></select></td>";
						
					}
					
					if(data['value'][i]['Certification_score'] == 2){
						
						td_value += "<td><select class='form-control' id='Cert_score" + data['value'][i]['id'] + "' onchange = 'javascript:cert_score(" + data['value'][i]['id'] + ")'><option value='0'>Select</option><option value='1'>Pass</option><option value='2' selected = 'selected'>Failed</option></select></td>";
						
					}
					
					td_value += "</tr>";
					
				}
				
				$('#load_data').html(td_value);
				
				$('#count_student').html(count_student);
				
			}else if(data['statusCode'] == 0){
				
				td_value = "<tr align='center'><td colspan='6'>No registered data</td></tr>";
				
				$('#load_data').html(td_value);
				
				$('#count_student').html(0);
				
			}
			
			
		},
		
		error: function(data) {
			
			alert('Please check internet connection.');
			
		}
	});

}

function check_submit(){
	
	var checked_options = [];
	
	if(count_student > 0){
		
		for(var i = 0; i < count_student; i++){
			
			checked_options[i] = $('#check'+i+':checked').length;
		
		}
		
		filter = {
			
			cert_exam_check: checked_options,
			
			cert_exam_id: student_id
			
		};
		
		$.ajax({
			
			url: '/member/programportalWeb/php/update_student.php',
			
			type: 'POST',
			
			dataType: 'json',
			
			data: filter,
			
			success: function(data) {
				
				if(data['statusCode'] == 1){
					
					load_student();
					
					alert('Submitted successfully!');
					
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
					
					load_student();
					
					init_edit_input();
					
					alert('Updated successfully!');
					
				}else if(data['statusCode'] == 0){
					
					alert('Please check internet connection.');
					
					init_edit_input();
					
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
					
					load_student();
					
					init_edit_input();
					
					alert('Deleted successfully!');
					
				}else if(data['statusCode'] == 0){
					
					alert('Please check internet connection.');
					
					init_edit_input();
					
				}
				
				
			},
			
			error: function(data) {
				
				alert('Please check internet connection.');
				
			}
		});
	
});

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
					
					load_student();
					
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
