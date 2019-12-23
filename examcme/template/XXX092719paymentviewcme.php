<?php
global $incomecme;

include_once "examcme/classes/historycme.class.php";

$cmehistory = new PaymentHistoryCME();

$action_title = $cmehistory->pay_title($_SESSION['user_id']);

$arr = explode("Late", $action_title);

$pay_num = '0';

$pay_amount = '0';

$main_amount = '0';

$late_amount = '0';

$pay_now_view = 0;

$cme_year = $cmehistory->readCMECycle();

if(count($arr) > 1){
	
	$pay_amount = $cmehistory->readActionAmount('2');
	
	$main_amount = $cmehistory->readActionAmount('2');
	
	$pay_num = 2;
	
	$cme_year = ($cme_year - 2);
	
}else{
	
	$pay_amount = $cmehistory->readActionAmount('1');
	
	$main_amount = $cmehistory->readActionAmount('1');
	
	$pay_num = 1;
	
	if(count(explode("You", $action_title)) > 1){
		
		$pay_now_view = 1;
		
	}
	
}

if (empty($_POST['CME_Payment']) == false){
	
    $_POST['user_id'] = $_SESSION['user_id'];
	
    $result = $payment->process($_POST);
	
	$incomecme->insert_income($_POST);
	
	$cmehistory->insert_CMEActionHistory($_POST);
	
	$receipt_cme = $cmehistory->readAllReceipt($_SESSION['user_id']);

	$receipt_date = getdate($receipt_cme['action_date']);
	
	echo $cmehistory->PaymentSuccess();
	
}

// if(!empty($result) && $result == 'error') {
    // $error = 'Please input the valid Card Info.';
    // echo $cmehistory->PaymentError();
// }

// if(!empty($result) && $result == 'success') {
    // $cmehistory->create($_POST);
    // $incomecme->insert_income($_POST);
	// $cmehistory->insert_cmeActionHistory($_POST);
    // echo $cmehistory->PaymentSuccess();
// }

  $cme_historys = $cmehistory->readAll();
  $cme = $incomecme->readById($_SESSION['user_id']);

?>
<link href="examcme/css/script.css" rel="stylesheet" type="text/css">
<div class="modal fade" id="paymentContentModal_cme"  role="dialog" style="display:none;">
    <input type="hidden" id="hiddencontainer_cme" name="hiddencontainer_cme" value="1"/>
    <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content paymentContent">
            <div class="row top_body" style="margin: 0">
                <img src="examcme/image/logo.png" width="80" height="80">
                <div class="logo_title">
                    National Commission for Certification <br> of Anesthesiologist Assistants
                </div>
				
                <div class="today_date">
				
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					
                        <span aria-hidden="true">&times;</span>
						
                    </button>
					
                    <p><?php echo date('m/d/Y') ?></p>
					
                </div>
            </div>
            <div class="row section1">
                <div class="col-md-12">
                    <h5>
					
                        <?php echo $action_title; ?>
						
                    </h5>
					
                    <p>for June 1, <?php echo $cme_year;?> – June 1, <?php echo ($cme_year + 2);?> Cycle</p>
					
				</div>
				
				<div class="col-md-6">
				
                    <ul>
                        <li><a>CAA Name: <span><?php echo $userObject->data["login"]['full_name'];?></span></a></li>
						
                        <li><a>Amount due: <span>$<?php echo $pay_amount; ?></span></a></li>
						
                        <li><a>Due date: <span>06/01/<?php echo ($cme_year + 2);?></span></a></li>
						
                        <li><a>Date paid: <span><?php echo date('m/d/Y') ?></span></a></li>
						
                        <li><a>Amount paid: <span>$0(still due)</span></a></li>
						
                        <li><a>Amount due: <span>$<?php echo $pay_amount; ?> (pay below)</span></a></li>
                    </ul>
                </div>
				<div class="col-md-6"></div>
            </div>
            <div class="deadline"></div>

            <div class="section2">
			
                <form id="frmStripePaymentCME" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				
                    <div class="row">
					
                        <div class="col-md-7">
						
                            <div id="error-message">
							
                                <?php
                                    if(!empty($error)){
                                        echo $error;
                                    }
                                ?>
                            </div>
							
                            <div class="row form-group">
							
                                <div class="col-md-6">
								
                                    <label>Card Number</label>
									
                                    <input class="form-input" id="card-number-cme" type="text" name="number" placeholder="Type your card Number" required autofocus /><span class="errorContainer"></span>
                                </div>
                                <div class="col-md-6">

                                        <label>Expiration Date</label>
                                        <input class="form-input" id="card-expiry-element-cme" type="text" name="expire_date" placeholder="MM/YY"/>

                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label>Security Code</label>
                                    <input class="form-input" id="code-cme" type="text" name="code" placeholder="Type your security Code"/>
                                </div>
                            </div>

                            <div class="deadline2"></div>

                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label>Name on card</label>
                                    <input class="form-input" id="name-cme" type="text" name="name" placeholder="Type your name"/>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label>StreetAddress</label>
                                    <input class="form-input" id="address-cme" type="text" name="address" placeholder="Type your street address"/>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label>City</label>
                                    <input class="form-input" id="city-cme" type="text" name="city" placeholder="Type your city"/>
                                </div>
                                <div class="col-md-6">

									<label>State</label>
									<input class="form-input" id="state-cme" type="text" name="state" placeholder="Type your state"/>

                                </div>
                            </div>
                            <div class="row form-group" style="margin-bottom: 0 !important;">
                                <div class="col-md-6">
                                    <label>Zip</label>
                                    <input id="zip-cme" class="form-input" type="text" name="zip" placeholder="Type your zip code"/>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-5">
                            <div class="pay_title">
                                <h5>PAY NOW</h5>
                                <div class="deadline2" style="border-color: rgb(240,240,240);"></div>
                                <p>Total: </p>
                                <h2>$<?php echo $pay_amount; ?></h2>
                            </div>
                            <div class="form-bottom">
                                <div style="color: rgb(112, 112, 112)">
                                    Note: We do not save or keep credit card information for future payments of cmes or Exams
                                </div>
                                <div id="submit-btn">
								<?php 
								if($pay_now_view == 1){
									echo '<input type="button" id="select_exam_date" value="Pay Now"/>';
								}else if($pay_now_view == 0){
									echo '<input type="submit" class="form-submit" name="CME_Payment" id="payment_now" value="Pay Now"/>';
								}
								?>	
                                </div>
                                <div id="loader" style="margin-top: 30px">
                                    <img alt="loader" src="examcme/image/LoaderIcon.gif" style="width: 67px;height: 50px;">
                                </div>
                                <div class="section3">
                                    <li><a onclick="cme_privacy_fun()" style="cursor:pointer;">Privacy</a></li>
                                    <li><a onclick="cme_terms_fun()" style="cursor:pointer;">Terms and Conditions</a></li>
                                </div>
                            </div>
							<input type="hidden" id="cme_name" name="cme_name" value="<?php echo $userObject->data["login"]['full_name']; ?>"/>
							
							<input type="hidden" id="cme_date" name="cme_date" value="<?php echo $cme['due_date'] ?>"/>
							
							<input type="hidden" id="amount" name="amount" value="<?php echo $main_amount; ?>"/>
							
							<input type="hidden" id="due_date" name="due_date" value="<?php echo $cme['due_date'] ?>"/>
							
							<input type="hidden" id="late_date" name="late_date" value="<?php echo $cme['due_date'] ?>"/>
							
							<input type="hidden" id="late_amount" name="late_amount" value="<?php echo $late_amount; ?>"/>
							
							<input type="hidden" id="action_title" name="action_title" value="<?php echo $action_title?>"/>
							
							<input type="hidden" id="pay_num" name="pay_num" value="<?php echo $pay_num?>"/>
							
							<input type="hidden" id="cme_year" name="cme_year" value="<?php echo $cme_year;?>"/>
							
							<input type='hidden' name='type' value='cme'>
							
                            <input type='hidden' name='currency_code' value='USD'>
							
                            <input type='hidden' name='item_name' value='Test Product'>
							
                            <input type='hidden' name='item_number' value='PHPPOTEG#1'>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>

</div>


<!--CME Receipt-->
<div id="CME_receipt_print">
	<div class="modal fade" id="receiptContentModal_cme"  role="dialog" style="display:none;">

		<div class="modal-dialog modal-lg" role="document">

			<div id="receiptmodal_body_cme" class="modal-content paymentContent" style="min-height: auto;">

				<div class="row top_body" style="margin: 0">
					<img src="examcme/image/logo.png" width="80" height="80">

					<div class="logo_title">
						National Commission for Certification <br> of Anesthesiologist Assistants
					</div>

					<div class="today_date">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<p><?php echo date('m/d/Y') ?></p>
					</div>
				</div>

				<div class="row section1" style="padding: 20px 15px 45px 15px">
					<div class="col-md-12">
						<div class="receipt_head">
							<h6>RECEIPT</h6>
							<p>Payment Successful</p>
						</div>
						<h5>
							<?php echo $receipt_cme['receipt_title']; ?>
						</h5>
						<p>for June 1, <?php echo $cme_year;?> – June 1, <?php echo ($cme_year + 2);?> Cycle</p>
						<ul>
							<li><a>CAA name: <span><?php echo $userObject->data["login"]['full_name'];?></span></a></li>
							<li><a>Amount due: <span><?php echo '$'.$cmehistory->readActionAmount($receipt_cme['amount_num']); ?></span></a></li>
							<li><a>Due date: <span><?php echo "6/1/".($receipt_cme['cme_cycle_start'] + 2); ?></span></a></li>
							<li><a>Date paid: <span><?php echo $receipt_date['mon']."/".$receipt_date['mday']."/".$receipt_date['year'] ?></span></a></li>
							<li><a>Amount paid: <span><?php echo '$'.$cmehistory->readActionAmount($receipt_cme['amount_num']); ?> (still due)</span></a></li>
							<li><a>Amount due: <span>$0 (pay below)</span></a></li>
						</ul>
					</div>

				</div>
				<div class="deadline"></div>

				<div class="row receipt_body">
					<div class="col-md-4">
						<p style="margin-bottom: 15px">Next CME Submission:	</p>
						<h6>June. 1, <?php echo ($receipt_cme['cme_cycle_start'] + 2);?> - June. 1, <?php echo ($receipt_cme['cme_cycle_start'] + 4);?></h6>
					</div>
					<div class="col-md-8">
					<p>CME submissions have been accepted; however, all CAAs are subject to an audit and notified accordingly if any discrepancies are found. Within 24-48 hours your certificate will be updated to show the new expiration date. Thank you!</p>
					</div>
				</div>

				<div class="receipt_bottom">
					<a href="http://localhost/member/?content=content/cmehistory"><i class="fas fa-arrow-left"></i>Back to CME History</a>
					<a href="" onclick="javascript:receipt_print_cme(document.getElementById('CME_receipt_print'));"><i class="fa fa-print" aria-hidden="true"></i>Print</a>
					<a href="email"><i class="fas fa-envelope"></i>Email</a>
				</div>
			</div>
		</div>     
	</div>

</div>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

<script src="examcme/js/script.js"></script>
