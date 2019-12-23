
<style type="text/css">
  .survery-title {
    font-family: circe;font-weight: normal;font-size: 17px;margin-bottom: 10px;
  }
</style>
<div class="modal fade modal-form" id="all-modal"  role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <div class="modal-body search-form pt-0">

				<section>
						<div class="page-block ncca-section">
						  <div class="container">
							<div class="ncca-section-inner">
							
							
<?php
if(count($total_ques_list) > 3){
	
	$cycle_count = 4;
	
}else{
	
	$cycle_count = count($total_ques_list);
	
}

for($i = 0; $i < $cycle_count; $i++){
	$choice_list = "";
	$choice_list = $SurveyObject->readChoiceList($total_ques_list[$i]['id']);
?>							
									<div id="content_<?=$i + 1?>"  class="col-lg-12 main-container page-block block-border page-block-margin close" <?php if($i != 0) echo 'style="display: none;"';?>>
										<div class="main-contant-border">
											<h5 class="title">SURVEY</h5>
										</div>
										<h3 class="panel-title" style="margin-bottom: 20px;">Please answer the following <?=$cycle_count?> questions to help us gather more information from our membership to better serve you. Thanks</h3>
										<div class="container question" style="margin-left: 20px;margin-bottom: 20px;">
											<div class="row">
												<div class="col-md-12 col-md-offset-3">
													<div class="panel panel-primary">
														
														<div class="panel-heading panel">
															<h3 class="panel-title">Question <?=($i + 1)?></h3>
															<p> &nbsp;</p>
															<h3 class="panel-title">
															<?=$total_ques_list[$i]['question']?>
															</h3>
															<p> &nbsp;</p>
														</div>
														<div class="panel-body">
														<input type="hidden" id="question_type_<?=$i?>" value="<?=$total_ques_list[$i]['question_type']?>">
														<input type="hidden" id="question_id_<?=$i?>" value="<?=$total_ques_list[$i]['id']?>">
														<input type="hidden" id="choice_id_<?=$i?>">
														<input type="hidden" id="choice_answer_<?=$i?>">
<?php
if($total_ques_list[$i]['question_type'] == 'Text'){

?>
														<textarea type="text" class="form-control" id="member_text_<?=$i?>" rows="6" maxlength="5000"  required ></textarea>	
<?php
}else{
?>													
															<ul class="list-group">
<?php 
for($c = 0; $c < count($choice_list); $c++){

?>															   
																<li class="list-group-item ">
																	<label class="check-box-container panel-body"><?=$choice_list[$c]['choice_answer']?>
																		<input type="hidden" id="choice_<?=$i?>_<?=$c?>" value="<?=$choice_list[$c]['choice_id']?>" >
																		<input type="hidden" id="choice_answer_<?=$i?>_<?=$c?>" value="<?=$choice_list[$c]['choice_answer']?>" >
																		<input type="radio" name="radio" id="radio_<?=$i?>_<?=$c?>" onclick="check_radio(<?=$i?>, <?=$c?>)">
																		<span class="checkmark"></span>
																	</label>
																</li>
															</ul>
<?php 
}
}
?>															
														</div>
														<div class="panel-footer">
															<a href="javascript:void(0);" onclick="tab('<?php 
if(($i +1) == $cycle_count){
	
	echo "content_5', '". $i;                                                                         
	
}
else{
	
	echo "content_".($i + 2)."', '".$i;
	
}
?>')"															class="btn btn-primary float-right btn-sm nextQuestion">SUBMIT</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
<?php }?>									
									
									<div id="content_5" class="col-lg-12 main-container page-block block-border page-block-margin close" style="display: none;">
										<div class="main-contant-border">
											<h5 class="title">SURVEY <button type="button" class="close no header-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></h5>
										</div>
										<div class="container question" style="margin-left: 20px;margin-bottom: 20px;">
											<div class="row">
												<div class="col-md-12 col-md-offset-3">
													<div class="panel panel-primary">
														
														<div class="panel-heading panel">
															<h3 class="panel-title" style="text-align: center;">Thank you for your participation</h3>    
														</div>
														<div class="panel-footer">
															<button  class="btn btn-primary float-right btn-sm nextQuestion" class="close no close_x" data-dismiss="modal" aria-label="Close">CLOSE</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
							</div>  
						  </div>
						</div>
				</section>  
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!--all-->
<script type="text/javascript">

$( document ).ready(function() {

    if(localStorage.getItem('popState') != 'shown'){

	   $('#all-modal').modal({
			show: true,
			backdrop: 'static',
			keyboard: false
		});

	   $('#all-modal').on('hidden.bs.modal', function() {
      window.location.href = 'logout.php';
     });
	}
});
function check_radio(id, choice_id) {
	
	var check = $('#radio_' + id + '_' + choice_id + ':checked').length;
	
	if(check > 0){
		
		$("#choice_id_" + id).val($("#choice_" + id + "_" + choice_id).val());
		
		$("#choice_answer_" + id).val($("#choice_answer_" + id + "_" + choice_id).val());
		
	}
	
}

function tab(id, num) {
	
	if(!$("#member_text_" + num).val() && !$("#choice_answer_" + num).val()){
		
		return alert("Please answer the following question.");
		
	}
		
	var answer_data = {
		
		question_type: $("#question_type_" + num).val(),
		
		question_id: $("#question_id_" + num).val(),
		
		member_text: $("#member_text_" + num).val(),
		
		choice_id: $("#choice_id_" + num).val(),
		
		choice_answer: $("#choice_answer_" + num).val()
		
	};
	
	$.ajax({
		
		url: './admin/classes/survey_member.php',
		
		type: 'POST',
		
		dataType: 'json',
		
		data: answer_data,
		
		async: true,
		
		headers: {
		  "cache-control": "no-cache"
		},
		
		success: function(data) {
			
			if(data['statusCode'] == 1){
				
				if(id == 'content_5')
				{
					$('.close').hide();
					$('.no').show();
					$('#'+id).show();
					$('#all-modal').modal({
						backdrop: false,
						keyboard: true
					}); 

					localStorage.setItem('popState','shown');
				}
				else
				{

					$('.close').hide();
					$('#'+id).show();
					
				}
			}
			
		},
		
		error: function(data) {
			
			false;
			
		}
	});
	
}

</script>
<style type="text/css">
  .panel-title {
    margin-left: 0px;
}
</style>