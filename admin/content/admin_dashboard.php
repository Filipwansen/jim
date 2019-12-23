
                <div class="top-heading card">
                    <h2>Admin</h2>
                    <span class="toggler"><img src="images/arrow-doen.png" alt=""></span>
                </div>
                <div class="admin-cards card">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="adminCard member">
                                <h3>ITE Registration</h3>
                                <ul>
                                    <li>Total CAAs<span class="amount"><?php echo $dashboard_data->get_totalCAAs();?></span></li>
                                    <li>Decertified <span class="amount"><?php echo $dashboard_data->get_decertifiedCAAs();?></span></li>
                                    <li>Women <span class="percent"><?php echo $dashboard_data->get_women_persent()."%";?></span></li>
                                    <li>Men <span class="percent"><?php echo $dashboard_data->get_men_persent()."%";?></span></li>
                                    <li class="gap20"></li>
                                    <li>Total students <span class="amount"><?php echo $dashboard_data->get_total_student();?></span>
                                        <ul>
                                            <li>Class of <?php echo date('Y');?> <span class="amount"><?php echo $dashboard_data->get_student_classOf(date('Y'));?></span></li>
                                            <li>Class of <?php echo (date('Y') + 1);?> <span class="amount"><?php echo $dashboard_data->get_student_classOf((date('Y') + 1));?></span></li>
                                            <li>Class of <?php echo (date('Y') + 2);?> <span class="amount"><?php echo $dashboard_data->get_student_classOf((date('Y')) + 2);?></span></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="adminCard Eregistration">
                                <h3>Cert Registration</h3>
                                <ul>
                                    <li>Total Cert Due <?php echo date('Y');?> <span class="amount"><?php echo $dashboard_data->expected_students_count('Cert', date('Y'));?></span></li>
                                    <li>Total Cert Registered <span class="amount"><?php echo $dashboard_data->get_registered_student('Certification',date('Y'), '0');?></span></li>
                                    <li>Remaining <span class="amount"><?php echo ($dashboard_data->expected_students_count('Cert', date('Y')) - $dashboard_data->get_registered_student('Certification',date('Y'), '0'));?></span></li>
                                    <li class="gap20"></li>
                                    <li>- - Feb. <?php echo date('Y');?> Registered<span class="amount"><?php echo $dashboard_data->get_registered_student('Certification',date('Y'), '2');?></span></li>
                                    <li>- - June <?php echo date('Y');?> Registered<span class="amount"><?php echo $dashboard_data->get_registered_student('Certification',date('Y'), '6');?></span></li>
                                    <li>- - Oct. <?php echo date('Y');?> Registered<span class="amount"><?php echo $dashboard_data->get_registered_student('Certification',date('Y'), '10');?></span></li>
                                    <li>Remaining <span class="amount"><?php echo ($dashboard_data->expected_students_count('Cert', date('Y')) - $dashboard_data->get_registered_student('Certification',date('Y'), '0'));?></span></li>
                                    <li class="gap20"></li>
                                    <li>Total Cert Due <?php echo (date('Y') + 1);?><span class="amount"><?php echo $dashboard_data->expected_students_count('Cert', (date('Y') + 1));?></span></li>
                                    <li>-Total Cert Registered<span class="amount"><?php echo $dashboard_data->get_registered_student('Certification',(date('Y') + 1), '0');?></span></li>
                                    <li>Remaining <span class="amount"><?php echo ($dashboard_data->expected_students_count('Cert', (date('Y') + 1)) - $dashboard_data->get_registered_student('Certification',(date('Y') + 1), '0'));?></span></li>
                                    <li class="clix"><b>NBME </b><a href="#"> Click Here</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="adminCard Cregistration">
                                <h3>CDQ Registration</h3>
                                <ul>
                                    <li>Total CDQ Due <?php echo date('Y');?> <span class="amount"><?php echo $dashboard_data->expected_students_count('CDQ', date('Y'));?></span></li>
                                    <li>- - Feb. <?php echo date('Y');?> Registered<span class="amount"><?php echo $dashboard_data->get_registered_student('CDQ', date('Y'), '2');?></span></li>
                                    <li>- - June <?php echo date('Y');?> Registered<span class="amount"><?php echo $dashboard_data->get_registered_student('CDQ', date('Y'), '6');?></span></li>
                                    <li>Remaining <span class="amount"><?php echo ($dashboard_data->expected_students_count('CDQ', date('Y')) - $dashboard_data->get_registered_student('CDQ', date('Y'), '0'));?></span></li>
                                    <li class="gap20"></li>
                                    <li>Total CDQ Due <?php echo (date('Y') + 1);?><span class="amount"><?php echo $dashboard_data->expected_students_count('CDQ', (date('Y') + 1));?></span></li>
                                    <li>Total CDQ Due <?php echo (date('Y') + 2);?><span class="amount"><?php echo $dashboard_data->expected_students_count('CDQ', (date('Y') + 2));?></span></li>
                                    <li>Total CDQ Due <?php echo (date('Y') + 3);?><span class="amount"><?php echo $dashboard_data->expected_students_count('CDQ', (date('Y') + 3));?></span></li>
                                    <li>Total CDQ Due <?php echo (date('Y') + 4);?><span class="amount"><?php echo $dashboard_data->expected_students_count('CDQ', (date('Y') + 4));?></span></li>
                                    <li>Total CDQ Due <?php echo (date('Y') + 5);?><span class="amount"><?php echo $dashboard_data->expected_students_count('CDQ', (date('Y') + 5));?></span></li>
                                    <li class="gap20"></li>
                                    <li>Total All 6 Years <span class="amount">
									<?php 
									    $CDQ_6sum = 0;
										
										for($i=0; $i < 6; $i++){
											
											$CDQ_6sum = $CDQ_6sum + $dashboard_data->expected_students_count('CDQ', (date('Y') + $i));
											
										}
										
										echo $CDQ_6sum;
									
									?>
									</span></li>
                                    <li class="clix"><b>NBME </b><a href="#"> Click Here</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="adminCard financials">
                                <h3>CME Registration</h3>
                                <ul>
                                    <li>Total CME Due <?php echo date('Y');?><span class="amount"><?php echo $dashboard_data->expected_students_count('CME', date('Y'));?></span></li>
                                    <li>Total Registered<span class="amount"><?php echo $dashboard_data->get_registered_student('CME', date('Y'),'0');?></span></li>
                                    <li>Remaining <span class="amount"><?php echo ($dashboard_data->expected_students_count('CME', date('Y')) - $dashboard_data->get_registered_student('CME', date('Y'),'0'));?></span></li>
                                    <li class="gap20"></li>
                                    <li>Total CME Due <?php echo (date('Y') + 1);?> <span class="amount"><?php echo $dashboard_data->expected_students_count('CME', (date('Y') + 1));?></span></li>
                                    <li>Total Registered <span class="amount"><?php echo $dashboard_data->get_registered_student('CME', (date('Y') + 1),'0');?></span></li>
                                    <li>Remaining <span class="amount"><?php echo ($dashboard_data->expected_students_count('CME', (date('Y') + 1)) - $dashboard_data->get_registered_student('CME', (date('Y') + 1),'0'));?></span></li>
                                    <li class="gap20"></li>
                                    <li class="clix"><b>NBME </b><a href="#"> Click Here</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="adminCard member2">
                                <h3>Members</h3>
                                <ul>
                                    <li>Total CAAs<span class="amount"><?php echo $dashboard_data->get_totalCAAs();?></span></li>

                                    <li>Decertified <span class="amount"><?php echo $dashboard_data->get_decertifiedCAAs();?></span></li>

                                    <li>Women <span class="percent"><?php echo $dashboard_data->get_women_persent()."%";?></span></li>

                                    <li>Men <span class="percent"><?php echo $dashboard_data->get_men_persent()."%";?></span></li>

                                    <li class="gap20"></li>

                                    <li>Total students <span class="amount"><?php echo $dashboard_data->get_total_student();?></span>

                                        <ul>

                                            <li>Class of <?php echo date('Y');?> <span class="amount"><?php echo $dashboard_data->get_student_classOf(date('Y'));?></span></li>

                                            <li>Class of <?php echo (date('Y') + 1);?> <span class="amount"><?php echo $dashboard_data->get_student_classOf((date('Y') + 1));?></span></li>

                                            <li>Class of <?php echo (date('Y') + 2);?> <span class="amount"><?php echo $dashboard_data->get_student_classOf((date('Y')) + 2);?></span></li>

                                        </ul>

                                    </li>

                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="adminCard Eregistration2">
                                <h3>Income</h3>
                                <ul>
                                    <li>YTD Income <span class="amount">$<?php echo $dashboard_data->total_count_type('All', 'Year');?></span></li>
                                    <li>QTD Income <span class="amount">$<?php echo $dashboard_data->total_count_type('All', 'Quarter');?></span></li></span></li>
                                    <li>MTD Income <span class="amount">$<?php echo $dashboard_data->total_count_type('All', 'Month');?></span></li></span></li>
                                    <li class="gap20"></li>
                                    <li><b><?php echo date('Y');?> Income-to-Date</b></li>
                                    <li>ITE<span class="amount">$<?php echo $dashboard_data->total_count_type('ITE', 'Year');?></span></li>
                                    <li>Cert <span class="amount">$<?php echo $dashboard_data->total_count_type('Certification', 'Year');?></span></li>
                                    <li>CDQ<span class="amount">$<?php echo $dashboard_data->total_count_type('CDQ', 'Year');?></span></li>
                                    <li>CME<span class="amount">$<?php echo $dashboard_data->total_count_type('CME', 'Year');?></span></li>
                                    <li>Interest <span class="amount">$<?php echo $dashboard_data->total_count_type('Interest', 'Year');?></span></li>
                                    <li>Other<span class="amount">$<?php echo $dashboard_data->total_count_type('Other', 'Year');?></span></li>
                                    <li class="gap20"></li>
                                    <li>Ledger Balance<span class="amount">$<?php echo $dashboard_data->total_count_type('All', 'Year');?></span></li>
                                    <li class="gap20"></li>
                                    <li class="clix"><b>Forecast </b><a href="#"> Click Here</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="adminCard Cregistration2">
                                <h3>Expenses</h3>
                                <ul>
                                    <li>YTD Expenses <span class="amount">$<?php echo $dashboard_data->total_count_type('Admin', 'Year');?></span></li>
                                    <li>QTD Expenses <span class="amount">$<?php echo $dashboard_data->total_count_type('Admin', 'Quarter');?></span></li>
                                    <li>MTD Expenses <span class="amount">$<?php echo $dashboard_data->total_count_type('Admin', 'Month');?></span></li>
                                    <li class="gap20"></li>
                                    <li><b><?php echo date('Y');?> Income-to-Date</b></li>
                                    <li>ITE<span class="amount">$<?php echo $dashboard_data->total_count_type('ITE', 'Year');?></span></li>
                                    <li>Cert <span class="amount">$<?php echo $dashboard_data->total_count_type('Certification', 'Year');?></span></li>
                                    <li>CDQ<span class="amount">$<?php echo $dashboard_data->total_count_type('CDQ', 'Year');?></span></li>
                                    <li>CME<span class="amount">$<?php echo $dashboard_data->total_count_type('CME', 'Year');?></span></li>
                                    <li>Interest <span class="amount">$<?php echo $dashboard_data->total_count_type('Interest', 'Year');?></span></li>
                                    <li>Other<span class="amount">$<?php echo $dashboard_data->total_count_type('Other', 'Year');?></span></li>
                                    <li class="gap20"></li>
                                    <li><b>MTD Income</b><span class="amount">$<?php echo $dashboard_data->total_count_type('All', 'Month');?></span></li>
                                    <li><b>MTD Expenses</b><span class="amount">$<?php echo $dashboard_data->total_count_type('Admin', 'Month');?></span></li>
                                    <li class="gap20"></li>
                                    <li class="clix"><b>Forecast </b><a href="#"> Click Here</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="adminCard financials2">
                                <h3>Forecasting</h3>
                                <ul>
                                    <li><b><?php echo date('Y');?></b></li>
                                    <li>ITE Due<span class="amount">$0</span></li>
                                    <li>Cert Due<span class="amount">$<?php echo (doubleval(str_replace(",","",$dashboard_data->expected_students_count('Cert', date('Y')))) * 1327.5);?></span></li>
                                    <li>CDQ Due<span class="amount">$<?php echo (doubleval(str_replace(",","",$dashboard_data->expected_students_count('CDQ', date('Y')))) * 1000);?></span></li>
                                    <li>CME Due<span class="amount">$<?php echo (doubleval(str_replace(",","",$dashboard_data->expected_students_count('CME', date('Y')))) * 235);?></span></li>
                                    <li class="gap20"></li>
                                    <li><b><?php echo (date('Y') + 1);?></b></li>
                                    <li>ITE Due<span class="amount">$0</span></li>
                                    <li>Cert Due<span class="amount">$<?php echo (doubleval(str_replace(",","",$dashboard_data->expected_students_count('Cert', (date('Y') + 1)))) * 1327.5);?></span></li>
                                    <li>CDQ Due<span class="amount">$<?php echo (doubleval(str_replace(",","",$dashboard_data->expected_students_count('CDQ', (date('Y') + 1)))) * 1000);?></span></li>
                                    <li>CME Due<span class="amount">$<?php echo (doubleval(str_replace(",","",$dashboard_data->expected_students_count('CME', (date('Y') + 1)))) * 235);?></span></li>
                                    <li class="gap20"></li>
                                    <li class="clix"><b>XX </b><a href="#"> Click Here</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
