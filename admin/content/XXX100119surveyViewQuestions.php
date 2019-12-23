<?php
                    <h4>View All Questions Under "<?=$survey_title?>"</h4>
                    <a href="?content=content/surveys&li_class=Surveys" class="backbtn"><span class="glyphicon glyphicon-chevron-left"></span>Back</a>
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
                        <tbody>
                                <td><?=($i + 1)?></td>
                                <td><?=$question_list[$i]['question_type']?></td>
                                <td  style="cursor: pointer;" onclick="edit_question(<?=$question_list[$i]['id']?>)">
                                <!--td align="center"><span class="glyphicon glyphicon-remove red"></span></td-->
                                <td style="width:20%"><b>Answer: </b>Text answers</td>
                                <td style="width:11%"><?=$question_list[$i]['created']?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>