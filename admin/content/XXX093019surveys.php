<?php
	
if(isset($_POST["survey_title"]) && empty($_POST["survey_title"]) == false){
	
	$survey->addNewSurvey($_POST["survey_title"]);
	
}

if(isset($_GET["edit_id"]) && empty($_GET["edit_id"]) == false){
	
	$survey->editSurvey($_POST['edit_survey_title_'.$_GET["edit_id"]], $_GET["edit_id"]);
	
}

$survey_list = $survey->readAllSurvey();


?>
                <div class="member-card card">

                    <h4>View All Surveys</h4>
                    <div class="form-group">

                        <div class="right">
                            <a class="btn btn-primary" style="cursor: pointer;" onclick="survey_add_modal()">Add Survey</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <table id="allSurveyTable" class="table stable table-striped table-bordered nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Surveys </th>
                                <th># Questions</th>
                                <th>Date Created</th>
                                <th>Report</th>
                            </tr>
                        </thead>
                        <tbody><?php 
if(count($survey_list) > 0){
	
	for($i = 0; $i < count($survey_list); $i++){
		
?>		
                            
							<tr>

                                <td><a style="cursor: pointer;" onclick="survey_edit_modal(<?=$survey_list[$i]['id']?>)"><?=$survey_list[$i]['survey_title']?></a></td>

                                <td><a href="?content=content/surveyViewQuestions&s_id=<?=$survey_list[$i]['id']?>"><?=$survey->countQuestions($survey_list[$i]['id'])?></a></td>

                                <td><?=$survey_list[$i]['created']?></td>

                                <td><a href="?content=content/surveyViewQuestions&s_id=<?=$survey_list[$i]['id']?>">Click Here</a></td>

                            </tr>
							
							<div id="edit_survey_modal_<?=$survey_list[$i]['id']?>" class="modal fade" role="dialog">
							  <div class="modal-dialog" style="width:500px; -webkit-transform: translate(0,50%); -o-transform: translate(0,50%); transform: translate(0,50%);">

									<!-- Modal content-->
									<div class="modal-content">

										  <div class="modal-header">
										  <button type="button" class="close" data-dismiss="modal">&times;</button>
											 <h2 class="modal-title" style="margin-top:10px; font-size:28px !important;">EDIT SURVEY</h2>
										  </div>
										  
											<form id="frmEditsurvey_<?=$survey_list[$i]['id']?>" action="?content=content/surveys&edit_id=<?=$survey_list[$i]['id']?>" method="post" enctype="multipart/form-data" autocomplete="off" >
											  <div class="modal-body" style="height:100px;">
													<div class="row">
														<div class="col-md-12" style="margin-top: 25px;">
															<div class="col-md-1">
																<label>Title:</label>
															</div>
															<div class="col-md-11">
																<input type="text" class="form-control reducesize" id="edit_survey_title_<?=$survey_list[$i]['id']?>" name="edit_survey_title_<?=$survey_list[$i]['id']?>" value="<?=$survey_list[$i]['survey_title']?>" required >
															</div>
														</div>
													</div>
													
											  </div>	
											  <div class="modal-footer">
												<input type="submit" class="btn btn-primary" style="width:67px;" value="Save" >
												<input type="button" class="btn btn-primary" data-dismiss="modal" value="Cancel">
											  </div>
										  </form>
									</div>
								</div>
							</div>														
							
							
<?php		
	}
	
}else{
?>
							<tr><td colspan="4" align="center">No Survey history available</td></tr>

<?php	
}
?>

                        </tbody>
                    </table>
                </div>
<div id="add_survey_modal" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width:500px; -webkit-transform: translate(0,50%); -o-transform: translate(0,50%); transform: translate(0,50%);">

		<!-- Modal content-->
		<div class="modal-content">

			  <div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
				 <h2 class="modal-title" style="margin-top:10px; font-size:28px !important;">ADD SURVEY</h2>
			  </div>
			  
				<form id="frmAddsurvey" action="?content=content/surveys" method="post" enctype="multipart/form-data" autocomplete="off" >
				  <div class="modal-body" style="height:100px;">
						<div class="row">
							<div class="col-md-12" style="margin-top: 25px;">
								<div class="col-md-1">
									<label>Title:</label>
								</div>
								<div class="col-md-11">
									<input type="text" class="form-control reducesize" id="survey_title" name="survey_title" required >
								</div>
							</div>
						</div>
						
				  </div>	
				  <div class="modal-footer">
					<input type="submit" class="btn btn-primary" style="width:67px;" value="Add" >
					<input type="button" class="btn btn-primary" data-dismiss="modal" value="Cancel">
				  </div>
			  </form>
		</div>
	</div>
</div>														

<script>
function survey_add_modal(){
    
    $("#add_survey_modal").modal('show');
    
}

function survey_edit_modal(id){
    
    $("#edit_survey_modal_" + id).modal('show');
    
}

</script>
    