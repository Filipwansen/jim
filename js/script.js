function GeneralInfoCompleted() {
  var c = 0;

  for (i = 0; i < 6; i++) {
    if (document.getElementById("general_info_form_field" + i).value !== '') {
      c = c + 1;
    }
  }
  document.getElementById("general_info_count").innerHTML = c + " of 6 Completed";
  if(c == 6){
      document.getElementById("general_info_icon").innerHTML = '<i class="fa fa-check"></i>';
  }else{
      document.getElementById("general_info_icon").innerHTML = '<i class="fa fa-plus"></i>';
  }
  //alert(c);
}



function AddressInfoCompleted() {
  var c = 0;

  for (i = 0; i < 14; i++) {
    if (document.getElementById("address_info_field" + i).value !== '') {
      c = c + 1;
    }
  }
  document.getElementById("address_contact_count").innerHTML = c + " of 14 Completed";
  if(c == 14){
      document.getElementById("address_contact_icon").innerHTML = '<i class="fa fa-check"></i>';
  }else{
      document.getElementById("address_contact_icon").innerHTML = '<i class="fa fa-plus"></i>';
  }
  //alert(c);
}

function AccountSecurityInfoCompleted() {
  var c = 0;

  for (i = 0; i < 11; i++) {
    if (document.getElementById("account_security_field" + i).value !== '') {
      c = c + 1;
    }
  }
  document.getElementById("account_security_count").innerHTML = c + " of 11 Completed";
  if(c == 11){
      document.getElementById("account_security_icon").innerHTML = '<i class="fa fa-check"></i>';
      //alert(c);
  }else{
      document.getElementById("account_security_icon").innerHTML = '<i class="fa fa-plus"></i>';
     // alert(c);
  }
  //alert(c);
}

function PersonalInfoCompleted() {
  var c = 0;

  for (i = 0; i < 8; i++) {
    if (document.getElementById("personal_form_info" + i).value !== '') {
      c = c + 1;
    }
  }
  document.getElementById("personal_information_count").innerHTML = c + " of 8 Completed";
  if(c == 8){
      document.getElementById("personal_info_icon").innerHTML = '<i class="fa fa-check"></i>';
      //alert(c);
  }else{
      document.getElementById("personal_info_icon").innerHTML = '<i class="fa fa-plus"></i>';
     // alert(c);
  }
  //alert(c);
}


function OtherMembershipCompleted() {
	
	var totalRadioFields = 0;
	
	var inputElems = document.getElementsByClassName("radio_field"), radio_field_count = 0;

    for (var i=0; i<inputElems.length; i++) {       
       if (inputElems[i].type == "radio" && inputElems[i].checked == true){
          radio_field_count++;
       }
    }
	
	if(radio_field_count >= 1){
		totalRadioFields = totalRadioFields+1;
	}
	
	
	
  var c = 0;

  for (i = 0; i < 6; i++) {
    if (document.getElementById("membership_field" + i).value !== '') {
      c = c + 1;
    }
  }
  
   c = totalRadioFields + c;
   
  document.getElementById("membership_count").innerHTML = c + " of 7 Completed";
  
 
  if(c == 7){
      document.getElementById("membership_icon").innerHTML = '<i class="fa fa-check"></i>';
      //alert(c);
  }else{
      document.getElementById("membership_icon").innerHTML = '<i class="fa fa-plus"></i>';
     // alert(c); 
  }
  //alert(c);
}


function SkillsInformationCompleted() {
	
	var totalRadioFields = 0;
	
	var inputElems = document.getElementsByClassName("skills_techniqies"), skills_specialties_count = 0;

    for (var i=0; i<inputElems.length; i++) {       
       if (inputElems[i].type == "checkbox" && inputElems[i].checked == true){
          skills_specialties_count++;
       }
    }
	
	if(skills_specialties_count >= 1){
		totalRadioFields = totalRadioFields+1;
	}
	
	
	//console.log(skills_specialties_count+" skills specialties");
	
	var inputElems_communicate = document.getElementsByClassName("skills_lang_communicate"), skills_communicate_count = 0;
	for (var i=0; i<inputElems_communicate.length; i++) {       
       if (inputElems_communicate[i].type == "radio" && inputElems_communicate[i].checked == true){
          skills_communicate_count++;
       }
    }
	
	if(skills_communicate_count >= 1){
		totalRadioFields = totalRadioFields+1;
	}
	
	
	//console.log(skills_communicate_count +" skills communicate count");
	
	var inputElems_environment = document.getElementsByClassName("environment"), inputElems_environment_count = 0;
	for (var i=0; i<inputElems_environment.length; i++) {       
       if (inputElems_environment[i].type == "radio" && inputElems_environment[i].checked == true){
          inputElems_environment_count++;
       }
    }
	
	if(inputElems_environment_count >= 1){
		totalRadioFields = totalRadioFields+1;
	}
	//console.log(inputElems_environment_count +" skills environment count");
	
	
	
	var inputElems_healthcare = document.getElementsByClassName("healthcare"), inputElems_healthcare_count = 0;
	for (var i=0; i<inputElems_healthcare.length; i++) {       
       if (inputElems_healthcare[i].type == "radio" && inputElems_healthcare[i].checked == true){
          inputElems_healthcare_count++;
       }
    }
	
	if(inputElems_healthcare_count >= 1){
		totalRadioFields = totalRadioFields+1;
	}
	
	//console.log(inputElems_healthcare_count +" skills healthcare count");
	
	
	
	var inputElems_other_techniques = document.getElementsByClassName("other_techniques"), inputElems_other_techniques_count = 0;
	for (var i=0; i<inputElems_other_techniques.length; i++) {       
       if (inputElems_other_techniques[i].type == "radio" && inputElems_other_techniques[i].checked == true){
          inputElems_other_techniques_count++;
       }
    }
	
	if(inputElems_other_techniques_count >= 1){
		totalRadioFields = totalRadioFields+1;
	}
	
	//console.log(inputElems_other_techniques_count +" skills other_techniques count");
	//console.log("total Radio value is "+totalRadioFields);
	

  var c = 0;

  for (i = 0; i < 2; i++) {
    if (document.getElementById("skills_field" + i).value !== '') {
      c = c + 1;
    }
  }
	c = totalRadioFields + c;
	
  document.getElementById("skills_count").innerHTML = c + " of 7 Completed";
  
  
  if(c == 7){
      document.getElementById("skills_icon").innerHTML = '<i class="fa fa-check"></i>';
      //alert(c);
  }else{
      document.getElementById("skills_icon").innerHTML = '<i class="fa fa-plus"></i>';
     // alert(c);
  }
  //alert(c);
  
  

}

function EmployerRetirementCompleted() {
	
	
	var totalRadioFields = 0;
	
	var inputElems = document.getElementsByClassName("retirement_plan_checkbox"), retirement_plan_count = 0;

    for (var i=0; i<inputElems.length; i++) {       
       if (inputElems[i].type == "checkbox" && inputElems[i].checked == true){
          retirement_plan_count++;
       }
    }
	
	if(retirement_plan_count >= 1){
		totalRadioFields = totalRadioFields+1;
	}
	
	
	var c = 0;

  for (i = 0; i < 8; i++) {
    if (document.getElementById("retirement_field" + i).value !== '') {
      c = c + 1;
    }
  }
  
  c = totalRadioFields + c;
  
  document.getElementById("retirement_count").innerHTML = c + " of 9 Completed";
  if(c == 9){
      document.getElementById("retirement_icon").innerHTML = '<i class="fa fa-check"></i>';
      //alert(c);
  }else{
      document.getElementById("retirement_icon").innerHTML = '<i class="fa fa-plus"></i>';
     // alert(c);
  }
  //alert(c);
  
	
	
}

function EmployerBenefitsCompleted() {
	
	
	var totalRadioFields = 0;
	
	var inputElems = document.getElementsByClassName("benefits_checkbox"), benefits_checkbox_count = 0;

    for (var i=0; i<inputElems.length; i++) {       
       if (inputElems[i].type == "checkbox" && inputElems[i].checked == true){
          benefits_checkbox_count++;
       }
    }
	
	if(benefits_checkbox_count >= 1){
		totalRadioFields = totalRadioFields+1;
	}
	
	
	var c = 0;

  for (i = 0; i < 1; i++) {
    if (document.getElementById("benefit_field" + i).value !== '') {
      c = c + 1;
    }
  }
  
  c = totalRadioFields + c;
  
  document.getElementById("benefits_counts").innerHTML = c + " of 2 Completed";
  if(c == 2){
      document.getElementById("benefits_icon").innerHTML = '<i class="fa fa-check"></i>';
      //alert(c);
  }else{
      document.getElementById("benefits_icon").innerHTML = '<i class="fa fa-plus"></i>';
     // alert(c);
  }
  //alert(c);
  
	
	
}

function EmployerCompensationCompleted() {
	
	var totalRadioFields = 0;
	
	var inputElems = document.getElementsByClassName("basic_compensation"), basic_compensation_count = 0;

    for (var i=0; i<inputElems.length; i++) {       
       if (inputElems[i].type == "checkbox" && inputElems[i].checked == true){
          basic_compensation_count++;
       }
    }
	
	if(basic_compensation_count >= 1){
		totalRadioFields = totalRadioFields+1;
	}
	
	var inputElems_full_compension = document.getElementsByClassName("full_compension"), full_compension_count = 0;

    for (var i=0; i<inputElems_full_compension.length; i++) {       
       if (inputElems_full_compension[i].type == "radio" && inputElems_full_compension[i].checked == true){
          full_compension_count++;
       }
    }
	
	if(full_compension_count >= 1){
		totalRadioFields = totalRadioFields+1;
	}
	
	console.log(totalRadioFields);
	var c = 0;

  for (i = 0; i < 2; i++) {
    if (document.getElementById("compensation_field" + i).value !== '') {
      c = c + 1;
    }
  }
  
  c = totalRadioFields + c;
  //console.log(c);
  document.getElementById("compensation_count").innerHTML = c + " of 4 Completed";
  if(c == 4){
      document.getElementById("compensation_icon").innerHTML = '<i class="fa fa-check"></i>';
      //alert(c);
  }else{
      document.getElementById("compensation_icon").innerHTML = '<i class="fa fa-plus"></i>';
     // alert(c);
  }
  //alert(c);
 
}


function EmploymentInformationCompleted() {
	var totalRadioFields = 0;
	
	var inputElems = document.getElementsByClassName("select_3_state"), employment_info_select_3_state_count = 0;

    for (var i=0; i<inputElems.length; i++) {       
       if (inputElems[i].type == "checkbox" && inputElems[i].checked == true){
          employment_info_select_3_state_count++;
       }
    }
	
	if(employment_info_select_3_state_count >= 1){
		totalRadioFields = totalRadioFields+1;
	}
	
	
	var inputElems_type_of_setting = document.getElementsByClassName("type_of_setting"), employment_type_of_setting_count = 0;

    for (var i=0; i<inputElems_type_of_setting.length; i++) {       
       if (inputElems_type_of_setting[i].type == "checkbox" && inputElems_type_of_setting[i].checked == true){
          employment_type_of_setting_count++;
       }
    }
	
	if(employment_type_of_setting_count >= 1){
		totalRadioFields = totalRadioFields+1;
	}
	
	var inputElems_weekly_schedule = document.getElementsByClassName("weekly_schedule"), employment_weekly_schedule_count = 0;

    for (var i=0; i<inputElems_weekly_schedule.length; i++) {       
       if (inputElems_weekly_schedule[i].type == "checkbox" && inputElems_weekly_schedule[i].checked == true){
          employment_weekly_schedule_count++;
       }
    }
	
	if(employment_weekly_schedule_count >= 1){
		totalRadioFields = totalRadioFields+1;
	}
	
	
	
	var c = 0;

  for (i = 0; i < 25; i++) {
    if (document.getElementById("employment_information_" + i).value !== '') {
      c = c + 1;
    }
  }
  
  c = totalRadioFields + c;
  
  document.getElementById("employment_count").innerHTML = c + " of 28 Completed";
  if(c == 28){
      document.getElementById("employment_icon").innerHTML = '<i class="fa fa-check"></i>';
      //alert(c);
  }else{
      document.getElementById("employment_icon").innerHTML = '<i class="fa fa-plus"></i>';
     // alert(c);
  }
  //alert(c);
	
}


function CertificationInformationCompleted() {
	
	var c = 0;

  for (i = 0; i < 30; i++) {
    if (document.getElementById("certification_information_" + i).value !== '') {
      c = c + 1;
    }
  }
  
  //c = totalRadioFields + c;
  
  document.getElementById("exam_certification_count").innerHTML = c + " of 30 Completed";
  if(c == 30){
      document.getElementById("exam_certification_icon").innerHTML = '<i class="fa fa-check"></i>';
      //alert(c);
  }else{
      document.getElementById("exam_certification_icon").innerHTML = '<i class="fa fa-plus"></i>';
     // alert(c);
  }
  //alert(c);

	
}


function ProgramUniversityCompleted() {
	var totalRadioFields = 0;
	
	var inputElems = document.getElementsByClassName("program_university_techniqies"), program_university_techniqies_count = 0;

    for (var i=0; i<inputElems.length; i++) {       
       if (inputElems[i].type == "checkbox" && inputElems[i].checked == true){
          program_university_techniqies_count++;
       }
    }
	
	if(program_university_techniqies_count >= 1){
		totalRadioFields = totalRadioFields+1;
	}
	
	var inputElems_clicnic = document.getElementsByClassName("clinical_hours"), program_university_clinical_hours_count = 0;

    for (var i=0; i<inputElems_clicnic.length; i++) {       
       if (inputElems_clicnic[i].type == "radio" && inputElems_clicnic[i].checked == true){
          program_university_clinical_hours_count++;
       }
    }
	
	if(program_university_clinical_hours_count >= 1){
		totalRadioFields = totalRadioFields+1;
	}
	
	
	
	var c = 0;

  for (i = 0; i < 25; i++) {
    if (document.getElementById("program_university_" + i).value !== '') {
      c = c + 1;
    }
  }
  
  c = totalRadioFields + c;
  
  document.getElementById("program_university_count").innerHTML = c + " of 27 Completed";
  if(c == 27){
      document.getElementById("program_university_icon").innerHTML = '<i class="fa fa-check"></i>';
      //alert(c);
  }else{
      document.getElementById("program_university_icon").innerHTML = '<i class="fa fa-plus"></i>';
     // alert(c);
  }
  //alert(c);
	
}

function FormFinalSubmit(){
	var formFieldsCount = 0;
	
    var formGeneral = $('form[name="GeneralInfo_Form"]').serialize();
    var personal_info = $('form[name="personal_info"]').serialize();
    var Contact_information = $('form[name="Contact_information"]').serialize();
    var account_security = $('form[name="account_security"]').serialize();
    var program_uni_form = $('form[name="program_uni_form"]').serialize();
    var certification_form = $('form[name="certification_form"]').serialize();
    var employment_form = $('form[name="employment_form"]').serialize();
    var employer_compensation_form = $('form[name="employer_compensation_form"]').serialize();
    var employer_benefit_form = $('form[name="employer_benefit_form"]').serialize();
    var employe_retirement_form = $('form[name="employe_retirement_form"]').serialize();
    var employe_skills_form = $('form[name="employe_skills_form"]').serialize();
    var other_membership_form = $('form[name="other_membership_form"]').serialize();

    /* console.log(formGeneral);
    console.log(personal_info);
    console.log(Contact_information);
    console.log(account_security);
    console.log(program_uni_form);
    console.log(certification_form);
    console.log(employment_form);
    console.log(employment_form);
    console.log(formGeneral);
    console.log(employer_compensation_form);
    console.log(employer_benefit_form);
    console.log(employe_retirement_form);
    console.log(employe_skills_form);
    console.log(other_membership_form);
    */
    console.log('Final Submit triggered');
   /* $('input').each(function() {
        if(!$(this).val()){
            alert('Some fields are not filled Text');
			formFieldsCount = formFieldsCount + 1;
            return false;
        }
    });
	
	*/
	
	
	$("form#GeneralInfo_Form :input").each(function(){
	var input = $(this); // This is the jquery object of the input, do what you will
	if(!input.val()){
            //alert('Some fields are not filled General Information');
			formFieldsCount = formFieldsCount + 1;
            return false;
        }
	
	});
	
	$("form#personal_info :input").each(function(){
	var input = $(this); // This is the jquery object of the input, do what you will
	if(!input.val()){
            //alert('Some fields are not filled Personal Information');
			formFieldsCount = formFieldsCount + 1;
            return false;
        }
	
	});
	
	$("form#Contact_information :input").each(function(){
	var input = $(this); // This is the jquery object of the input, do what you will
	if(!input.val()){
            //alert('Some fields are not filled Contact Information');
			formFieldsCount = formFieldsCount + 1;
            return false;
        }
	
	});
	
	$("form#account_security :input").each(function(){
	var input = $(this); // This is the jquery object of the input, do what you will
	if(!input.val()){
            //alert('Some fields are not filled account_security Information');
			formFieldsCount = formFieldsCount + 1;
            return false;
        }
	
	});
	
	$("form#program_uni_form :input").each(function(){
	var input = $(this); // This is the jquery object of the input, do what you will
	if(!input.val()){
            //alert('Some fields are not filled program_uni_form Information');
			formFieldsCount = formFieldsCount + 1;
            return false;
        }
	
	});
	
	$("form#certification_form :input").each(function(){
	var input = $(this); // This is the jquery object of the input, do what you will
	if(!input.val()){
            //alert('Some fields are not filled certification_form Information');
			formFieldsCount = formFieldsCount + 1;
            return false;
        }
	
	});
	
	$("form#employment_form :input").each(function(){
	var input = $(this); // This is the jquery object of the input, do what you will
	if(!input.val()){
            //alert('Some fields are not filled employment_form Information');
			formFieldsCount = formFieldsCount + 1;
            return false;
        }
	
	});
	
	$("form#employer_compensation_form :input").each(function(){
	var input = $(this); // This is the jquery object of the input, do what you will
	if(!input.val()){
           // alert('Some fields are not filled employer_compensation_form Information');
			formFieldsCount = formFieldsCount + 1;
            return false;
        }
	
	});
	
	$("form#employer_benefit_form :input").each(function(){
	var input = $(this); // This is the jquery object of the input, do what you will
	if(!input.val()){
            //alert('Some fields are not filled employer_benefit_form Information');
			formFieldsCount = formFieldsCount + 1;
            return false;
        }
	
	});
	
	$("form#employe_retirement_form :input").each(function(){
	var input = $(this); // This is the jquery object of the input, do what you will
	if(!input.val()){
            //alert('Some fields are not filled employe_retirement_form Information');
			formFieldsCount = formFieldsCount + 1;
            return false;
        }
	
	});
	
	$("form#employe_skills_form :input").each(function(){
	var input = $(this); // This is the jquery object of the input, do what you will
	if(!input.val()){
            //alert('Some fields are not filled employe_skills_form Information');
			formFieldsCount = formFieldsCount + 1;
            return false;
        }
	
	});
	
	$("form#other_membership_form :input").each(function(){
	var input = $(this); // This is the jquery object of the input, do what you will
	if(!input.val()){
            //alert('Some fields are not filled other_membership_form Information');
			formFieldsCount = formFieldsCount + 1;
            return false;
        }
	
	});
	
	console.log(formFieldsCount);
    //console.log(input[name='skills_answers[]']);
    //console.log(jQuery.isEmptyObject("input[name='skills_answers[]']"));

    /**
     * Check if checkboxes have 1 checked
     * **/
	
	//console.log(formFieldsCount);
	
	
    var skills_answers = $('input[name="skills_answers[]"]:checked').length > 0;
    //console.log(skills_answers+" number of skills checked");
	if(skills_answers == false || skills_answers == ""){
		formFieldsCount = formFieldsCount +1;
	}

    var retirement_plan_setup = $('input[name="retirement_plan_setup[]"]:checked').length > 0;
    //console.log(retirement_plan_setup+" number of retirement plan checked");
	if(retirement_plan_setup == false || retirement_plan_setup == ""){
		formFieldsCount = formFieldsCount +1;
	}

    var employer_benefits = $('input[name="employer_benefits[]"]:checked').length > 0;
    //console.log(employer_benefits+" number of employer_benefits checked");
	if(employer_benefits == false || employer_benefits == ""){
		formFieldsCount = formFieldsCount +1;
	}

    var emp_work_schedule = $('input[name="emp_work_schedule[]"]:checked').length > 0;
   // console.log(emp_work_schedule+" number of emp_work_schedule checked");
	if(emp_work_schedule == false || emp_work_schedule == ""){
		formFieldsCount = formFieldsCount +1;
	}

    var type_of_setting = $('input[name="type_of_setting[]"]:checked').length > 0;
    //console.log(type_of_setting+" number of type_of_setting checked");
	if(type_of_setting == false || type_of_setting == ""){
		formFieldsCount = formFieldsCount +1;
	}

    var select_3_states = $('input[name="select_3_states[]"]:checked').length > 0;
   // console.log(select_3_states+" number of select states checked");
	if(select_3_states == false || select_3_states == ""){
		formFieldsCount = formFieldsCount +1;
	}

    var answers = $('input[name="answers[]"]:checked').length > 0;
    //console.log(answers+" number of answers checked");
	if(answers == false || answers == ""){
		formFieldsCount = formFieldsCount +1;
	}

	//console.log(formFieldsCount);
	if(formFieldsCount > 1 || formFieldsCount != 0){
		console.log('Some fields are not filled');
		alert('Some fields are not filled');
	}
	else{
	
	var dataString = $('form[name="GeneralInfo_Form"], form[name="personal_info"],form[name="Contact_information"],form[name="account_security"],form[name="program_uni_form"],form[name="certification_form"],form[name="employment_form"],form[name="employer_compensation_form"],form[name="employer_benefit_form"],form[name="employe_retirement_form"],form[name="employe_skills_form"],form[name="other_membership_form"]').serialize();

    // Log in console so you can see the final serialized data sent to AJAX
    //console.log(dataString);

    // Do AJAX
    $.ajax( {
        type: 'POST',
        url: 'process/final_submit.php',
        data: dataString,
        success: function(data) {
           // console.log(data);
			 data = JSON.parse(data);
			if(data.code == 200){
				$('#ResponseMsg').html('<p style="color:green;text-align:center;">'+data.message+'</p>');
				alert(data.message);
				location.reload();
				
			}else{
				//$('#ResponseMsg').html(data);
				$('#ResponseMsg').html('<p style="color:red;text-align:center;">'+data.message+'</p>');
				alert(data.message);
			}

        }
    });
		
	}
}
