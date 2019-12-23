<?php$survey_title = "";if(isset($_GET["s_id"]) && empty($_GET["s_id"]) == false){		$survey_title = $survey->readSurveyTitle($_GET["s_id"]);	}if(isset($_GET["edit_ques_id"]) && empty($_GET["edit_ques_id"]) == false){		$survey->editQuestion($_GET["s_id"], $_GET["edit_ques_id"], $_GET["type"], $_POST);	}if(isset($_GET["del_ques_id"]) && empty($_GET["del_ques_id"]) == false){		$survey->delQuestion($_GET["s_id"], $_GET["del_ques_id"]);	}if(isset($_POST["text_question"]) && empty($_POST["text_question"]) == false){		$survey->addNewQuestion($_POST, 'text', $_GET["s_id"]);	}if(isset($_POST["radio_question"]) && empty($_POST["radio_question"]) == false){		$survey->addNewQuestion($_POST, 'radio', $_GET["s_id"]);	}$question_list = $survey->readAllQuestions($_GET["s_id"]);$key_answer = array("Select Key Answer", "Answer 1", "Answer 2", "Answer 3", "Answer 4", "Answer 5");?><style type="text/css" media="print">@page {	size:  auto;   	margin: 0mm;  }html{	background-color: #FFFFFF; 	margin: 0px;  }body{		margin: 10mm 10mm 10mm 10mm; 	}</style>                <div class="member-card card">
                    <h4>View All Questions Under "<?=$survey_title?>"</h4>
                    <a href="?content=content/surveys&li_class=Surveys" class="backbtn"><span class="glyphicon glyphicon-chevron-left"></span>Back</a>                   				   <div class="form-group">                        <div class="right">                            <a class="btn btn-primary" style="cursor: pointer;" onclick="javascript:view_question_print(document.getElementById('question_print'));" >Print</a>                        </div>                        <div class="right" style="margin-right: 15px;">                            <a class="btn btn-primary"  href="?content=content/surveyAddQuestion&li_class=Surveys&s_id=<?=$_GET["s_id"]?>">Add Question</a>                        </div>						                        <div class="clearfix"></div>                    </div>
                    <table id="view_question" class="table stable table-striped table-bordered nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th style="vertical-align: top;">ID</th>
                                <th>Question<br>Type</th>
                                <th style="vertical-align: top;">Question</th>
                                <th style="vertical-align: top;">Key</th>
                                <th style="vertical-align: top;">Result</th>
                                <th style="vertical-align: top;">Date</th>
                            </tr>
                        </thead>
                        <tbody>												<?php if(count($question_list) > 0){		for($i = 0; $i < count($question_list); $i++){				$answers_info = $survey->readAnswersInfo($question_list[$i]['question_type'], $question_list[$i]['id']);		?>	                            <tr>
                                <td><?=($i + 1)?></td>
                                <td><?=$question_list[$i]['question_type']?></td>
                                <td  style="cursor: pointer;" onclick="edit_question(<?=$question_list[$i]['id']?>)">									<a><?=$question_list[$i]['question']?></a>																	</td>
                                <!--td align="center"><span class="glyphicon glyphicon-remove red"></span></td--><?php if($question_list[$i]['question_type'] == 'Text'){	?>
                                <td style="width:20%"><b>Answer: </b>Text answers</td><?php }else{	        if(empty($question_list[$i]['key_answer']) == true){?>                                <td style="width:20%"><b>Answer: </b>Radio answers</td><?php       }else{?>									<td style="width:20%"><b>Answer <?=$question_list[$i]['key_id'].":</b> ".$question_list[$i]['key_answer']?></td><?php       }       }?>                                								<td style="width:19%">																	<p><a href="?content=content/surveyReport&li_class=Surveys&s_id=<?=$_GET["s_id"]?>&type=<?=$question_list[$i]['question_type']?>&ques_id=<?=$question_list[$i]['id']?>"><?=$answers_info['members_answered']?> answered</a></p>																		<p><?=$answers_info['answer_p']?>% of total</p>									<?php if($question_list[$i]['question_type'] == 'Radio' && empty($question_list[$i]['key_answer']) == false){?>									<p><?=$answers_info['correct_p']?>% correct (<?=$answers_info['correct_members']?>)</p>																		<p><?=$answers_info['incorrect_p']?>% incorrect (<?=$answers_info['incorrect_members']?>)</p><?php }?>																	</td>
                                <td style="width:11%"><?=$question_list[$i]['created']?></td>
                            </tr>							<?php if($question_list[$i]['question_type'] == 'Text'){?>							<div id="edit_question_modal_<?=$question_list[$i]['id']?>" class="modal fade" role="dialog">															<div class="modal-dialog" style="width:600px; -webkit-transform: translate(0,50%); -o-transform: translate(0,50%); transform: translate(0,50%);">									<!-- Modal content-->									<div class="modal-content">										  <div class="modal-header">											<button type="button" class="close" data-dismiss="modal">&times;</button>											 <h2 class="modal-title" style="margin-top:10px; font-size:24px !important;">EDIT QUESTION</h2>										  </div>										  											<form id="frmEditQuestion_<?=$question_list[$i]['id']?>" action="?content=content/surveyViewQuestions&li_class=Surveys&s_id=<?=$_GET["s_id"]?>&edit_ques_id=<?=$question_list[$i]['id']?>&type=Text" method="post" enctype="multipart/form-data" autocomplete="off" >											  											  <div class="modal-body" style="padding-bottom: 30px;">																										<div class="row" style="margin-top: 30px;">																												<div class="form-group">																<div class="row">																	<label class="col-lg-3">Question Type</label>																	<div class="col-lg-8">																		<input type="text" class="form-control" value="Text" readonly />																	</div>																</div>															</div>																												<div class="form-group">																<div class="row">																	<label class="col-lg-3">Question</label>																	<div class="col-lg-8">																		<textarea class="form-control" id="text_question_<?=$question_list[$i]['id']?>" name="text_question_<?=$question_list[$i]['id']?>" rows="6" required><?=$question_list[$i]['question']?></textarea>																	</div>																</div>															</div>															<div class="form-group"  style="display: none">																<div class="row">																	<label class="col-lg-3">Other Option</label>																	<div class="col-lg-8">																		<input type="checkbox" />																	</div>																</div>															</div>															<div class="form-group" style="display: none;">																<div class="row">																	<label class="col-lg-3">Answer</label>																	<div class="col-lg-8">																		<input type="hidden" class="form-control" id="text_answer_<?=$question_list[$i]['id']?>" name="text_answer_<?=$question_list[$i]['id']?>" value="Text answers" />																	</div>																</div>															</div>													</div>																								  </div>												  <div class="modal-footer">											  												<input type="submit" class="btn btn-primary" style="width:67px;" value="Save" >																								<a href="?content=content/surveyViewQuestions&li_class=Surveys&s_id=<?=$_GET["s_id"]?>&del_ques_id=<?=$question_list[$i]['id']?>" class="btn btn-primary">Delete</a>											  											  </div>											  										  </form>									</div>								</div>							</div>														<?php }else{?>														<div id="edit_question_modal_<?=$question_list[$i]['id']?>" class="modal fade" role="dialog">							  							  <div class="modal-dialog" style="width:600px; -webkit-transform: translate(0,25%); -o-transform: translate(0,25%); transform: translate(0,25%);">									<!-- Modal content-->									<div class="modal-content">										  <div class="modal-header">										  										  <button type="button" class="close" data-dismiss="modal">&times;</button>											 <h2 class="modal-title" style="margin-top:10px; font-size:24px !important;">EDIT QUESTION</h2>										  										  </div>										  											<form id="frmEditQuestion_<?=$question_list[$i]['id']?>" action="?content=content/surveyViewQuestions&li_class=Surveys&s_id=<?=$_GET["s_id"]?>&edit_ques_id=<?=$question_list[$i]['id']?>&type=Radio" method="post" enctype="multipart/form-data" autocomplete="off" >											  											  <div class="modal-body" style="padding-bottom: 30px;">																										<div class="row" style="margin-top:30px;">																											<div class="form-group">															<div class="row">																<label class="col-lg-3">Question Type</label>																<div class="col-lg-8">																	<input type="text" class="form-control" value="Radio" readonly />																</div>															</div>														</div>																												<div class="form-group">															<div class="row">																<label class="col-lg-3">Question</label>																<div class="col-lg-8">																	<textarea class="form-control" id="radio_question_<?=$question_list[$i]['id']?>" name="radio_question_<?=$question_list[$i]['id']?>" rows="6" required><?=$question_list[$i]['question']?></textarea>																</div>															</div>														</div>														<div class="form-group">															<div class="row">																<label class="col-lg-3">Answer 1</label>																<div class="col-lg-8">																	<input type="text" class="form-control" id="radio1_<?=$question_list[$i]['id']?>" name="radio1_<?=$question_list[$i]['id']?>" value="<?=$survey->readAnswerById($_GET["s_id"], $question_list[$i]['id'], 1)?>" onclick = "init_key(<?=$question_list[$i]['id']?>)" required />																</div>															</div>														</div>														<div class="form-group">															<div class="row">																<label class="col-lg-3">Answer 2</label>																<div class="col-lg-8">																	<input type="text" class="form-control" id="radio2_<?=$question_list[$i]['id']?>" name="radio2_<?=$question_list[$i]['id']?>" value="<?=$survey->readAnswerById($_GET["s_id"], $question_list[$i]['id'], 2)?>" onclick = "init_key(<?=$question_list[$i]['id']?>)" required />																</div>															</div>														</div>														<div class="form-group">															<div class="row">																<label class="col-lg-3">Answer 3</label>																<div class="col-lg-8">																	<input type="text" class="form-control" id="radio3_<?=$question_list[$i]['id']?>" name="radio3_<?=$question_list[$i]['id']?>" value="<?=$survey->readAnswerById($_GET["s_id"], $question_list[$i]['id'], 3)?>" onclick = "init_key(<?=$question_list[$i]['id']?>)" />																</div>															</div>														</div>														<div class="form-group">															<div class="row">																<label class="col-lg-3">Answer 4</label>																<div class="col-lg-8">																	<input type="text" class="form-control" id="radio4_<?=$question_list[$i]['id']?>" name="radio4_<?=$question_list[$i]['id']?>" value="<?=$survey->readAnswerById($_GET["s_id"], $question_list[$i]['id'], 4)?>" onclick = "init_key(<?=$question_list[$i]['id']?>)" />																</div>															</div>														</div>														<div class="form-group">															<div class="row">																<label class="col-lg-3">Answer 5</label>																<div class="col-lg-8">																	<input type="text" class="form-control" id="radio5_<?=$question_list[$i]['id']?>" name="radio5_<?=$question_list[$i]['id']?>" value="<?=$survey->readAnswerById($_GET["s_id"], $question_list[$i]['id'], 5)?>" onclick = "init_key(<?=$question_list[$i]['id']?>)" />																</div>															</div>														</div>														<div class="form-group" style="display: none">															<div class="row">																<label class="col-lg-3">Other Option</label>																<div class="col-lg-8">																	<input type="checkbox" />																</div>															</div>														</div>														<div class="form-group">															<div class="row">																<label class="col-lg-3">Key</label>																<div class="col-lg-4">																	<select class="form-control"  id="radio_key_<?=$question_list[$i]['id']?>" name="radio_key_<?=$question_list[$i]['id']?>" onchange="insert_answer(<?=$question_list[$i]['id']?>)"><?php		for($k = 0; $k < count($key_answer); $k++){?>																																								<option 																				value="<?php 																				if($k == 0) echo "";																				else echo $k;																				 ?>" <?php if($question_list[$i]['key_id'] == $k) echo "selected";?>><?=$key_answer[$k]?></option><?php		}	?>																	</select>																</div>																																<div class="col-lg-4">																																	<input type="text" class="form-control" id="radio_answer_<?=$question_list[$i]['id']?>" name="radio_answer_<?=$question_list[$i]['id']?>" value="<?=$question_list[$i]['key_answer']?>" readonly />																																</div>															</div>														</div>																											</div>																								  </div>												  <div class="modal-footer">											  												<input type="submit" class="btn btn-primary" style="width:67px;" value="Save" >																								<a href="?content=content/surveyViewQuestions&li_class=Surveys&s_id=<?=$_GET["s_id"]?>&del_ques_id=<?=$question_list[$i]['id']?>" class="btn btn-primary">Delete</a>											  											  </div>										  										  </form>									</div>								</div>							</div>																					<?php}			}	}else{?>							<tr><td colspan="7" align="center">No Survey history available</td></tr><?php	}?>
                        </tbody>
                    </table>
                </div>								<table id="question_print" class="table table-striped table-bordered nowrap" style="width:100%;display:none;">					<thead>						<tr>							<th>ID</th>							<th>Question<br>Type</th>							<th>Question</th>							<th>Key</th>							<th>Result</th>							<th>Date</th>						</tr>					</thead>					<tbody>										<?php if(count($question_list) > 0){for($i = 0; $i < count($question_list); $i++){		$answers_info = $survey->readAnswersInfo($question_list[$i]['question_type'], $question_list[$i]['id']);	?>	                            <tr>							<td><?=($i + 1)?></td>							<td><?=$question_list[$i]['question_type']?></td>							<td><?=$question_list[$i]['question']?></td>							<!--td align="center"><span class="glyphicon glyphicon-remove red"></span></td-->							<td  style="width:20%"><b>Answer<?php							if($question_list[$i]['question_type'] == 'Text'){																echo ":</b> ".$question_list[$i]['key_answer'];															}else{																if(empty($question_list[$i]['key_answer']) == true){																		echo " :</b> Radio answers";																	}else{																		echo " ".$question_list[$i]['key_id'].":</b> ".$question_list[$i]['key_answer'];																}															}														?></td>														<td style="width:19%">															<p><?=$answers_info['members_answered']?> answered</p>																<p><?=$answers_info['answer_p']?>% of total</p><?php if($question_list[$i]['question_type'] == 'Radio' && empty($question_list[$i]['key_answer']) == false){?>																<p><?=$answers_info['correct_p']?>% correct (<?=$answers_info['correct_members']?>)</p>																<p><?=$answers_info['incorrect_p']?>% incorrect (<?=$answers_info['incorrect_members']?>)</p><?php }?>															</td>							<td style="width:12%"><?=$question_list[$i]['created']?></td>						</tr><?php}			}else{?>							<tr><td colspan="7" align="center">No Survey history available</td></tr><?php	}?>                        </tbody>                    </table><script>function edit_question(id){		$("#edit_question_modal_" + id).modal('show');    	}function insert_answer(id){		var key = $('#radio_key_' + id).val();		var key_answer = $('#radio' + key + '_' + id).val();		$('#radio_answer_' + id).val(key_answer);	}function init_key(id){		$('#radio_key_' + id).val("");		$('#radio_answer_' + id).val("");	}function view_question_print(elem) {	// $(".close").hide();		 $("div").hide();	 	 	 $("#question_print").show();	 	 	    var domClone = elem.cloneNode(true);        var $printSection = document.getElementById("printSection");        if (!$printSection) {		        var $printSection = document.createElement("div");		        $printSection.id = "printSection";		        document.body.appendChild($printSection);		    }        $printSection.innerHTML = "";	    $printSection.appendChild(domClone);	    window.print();		window.history.replaceState({}, '', '?content=content/surveyViewQuestions&li_class=Surveys&s_id=<?=$_GET["s_id"]?>');		window.location.reload(true);}</script>