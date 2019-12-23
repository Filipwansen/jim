<?php

if(isset($_GET["ques_id"]) && empty($_GET["ques_id"]) == false){
	
	$report_list = $survey->readReportList($_GET["type"], $_GET["ques_id"]);
	
}

$question_info = $survey->readQuestionInfo($_GET["ques_id"]);

$choice_list = $survey->readChoiceList($_GET["ques_id"]);

$answers_info = $survey->readAnswersInfo($_GET["type"], $_GET["ques_id"]);

?>
<style type="text/css" media="print">

@page 
{
	size:  auto;   
	margin: 0mm;  
}

html
{
	background-color: #FFFFFF; 
	margin: 0px;  
}

body
{
	
	margin: 10mm 10mm 10mm 10mm; 
	
}

</style>

                <div class="member-card card">

                    <h4>Report: from Knowledge Base Survey</h4>					
					<a href="?content=content/surveyViewQuestions&s_id=<?=$_GET["s_id"]?>" class="backbtn"><span class="glyphicon glyphicon-chevron-left"></span>Back</a>
                    
					<div class="form-group">

                        <div class="right">
                            <a class="btn btn-primary" style="cursor: pointer;" onclick="javascript:report_print(document.getElementById('viewReportTable'));" >Print</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <table id="viewReportTable" class="table ptable table-striped table-bordered nowrap" style="width:100%">
                        <thead>

                            <tr>

                                <th colspan="3">Question and Answer </th>

                                <th colspan="1">Result</th>

                            </tr>

                        </thead>
						
						<tbody>
						
							<tr>
							
								<td colspan="3">
									<p><?=$question_info['question']?></p>
<?php
if($_GET["type"] == 'Text'){
?>	
									<p><b>Answer:</b> Text answers</p>				
									<p><b>Key:</b> N/A all answers are below</p>
<?php	
	
}else{
	
	for($c = 0; $c < count($choice_list); $c++){
		
		echo "<p><b>Answer ". $choice_list[$c]['choice_id'] .":</b> ". $choice_list[$c]['choice_answer'] ."</p>"; 
		
	}
?>
	
									<p><b>Key: Answer <?=$question_info['key_id'].":</b> ".$question_info['key_answer']?></p>
	
<?php
	
}

?>									
								
								</td>
								
								<td colspan="1" style="width:19%">

									<p><?=$answers_info['members_answered']?> answered</p>
									
									<p><?=$answers_info['answer_p']?>% of total</p>
<?php
if($_GET["type"] == 'Radio'){
?>
									
									<p><?=$answers_info['correct_p']?>% correct (<?=$answers_info['correct_members']?>)</p>
									
									<p><?=$answers_info['incorrect_p']?>% incorrect (<?=$answers_info['incorrect_members']?>)</p>
<?php 
}
?>								
								</td>
								
							</tr>
						
						</tbody>
						
						<thead>
                            <tr>
                                <th>First Name </th>
                                <th>Last Name</th>
                                <th>Answer</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody><?php 
if(count($report_list) > 0){
	
	for($i = 0; $i < count($report_list); $i++){
		
		$fullname = $survey->readFullName($report_list[$i]['user_id']);
		
?>		
                            
							<tr>

                                <td><?=$fullname['f_name']?></td>

                                <td><?=$fullname['l_name']?></td>

                                <td>
<?php
   if($_GET["type"] == 'Text'){
	   
	   echo $report_list[$i]['choice_answer'];
	   
   }else if($_GET["type"] == 'Radio'){
	   
	   echo "Answer ".$report_list[$i]['choice_id'];
	   
   }

?>
								</td>

                                <td style="width:19%"><?=$report_list[$i]['created']?></td>

                            </tr>
							
							
<?php		
	}
	
}else{
?>
							<tr><td colspan="4" align="center">No Report history available</td></tr>

<?php	
}
?>

                        </tbody>
                    </table>
                </div>
<script>

function report_print(elem) {
	// $(".close").hide();
	
	 $("div").hide();
	
    var domClone = elem.cloneNode(true);
    
    var $printSection = document.getElementById("printSection");
    
    if (!$printSection) {
		
        var $printSection = document.createElement("div");
		
        $printSection.id = "printSection";
		
        document.body.appendChild($printSection);
		
    }
    
    $printSection.innerHTML = "";
	
    $printSection.appendChild(domClone);
	
    window.print();
	
	window.history.replaceState({}, '', '?content=content/surveyReport&s_id=<?=$_GET["s_id"]."&type=".$_GET["type"]."&ques_id=".$_GET["ques_id"]?>');
	
	window.location.reload(true);
	
}


</script>