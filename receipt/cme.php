<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once("../config.php");


session_start();

//print_r($_SESSION);

if(empty($_SESSION['user_id']) || $_SESSION['user_id'] == "" )

{

    header('Location: /logincaamember.php');

}


require_once("../../includes/util.php");

require_once("../../classes/user.class.php");

$userObject = new userObject();

$userObject->init( $_SESSION['user_id'] );

require_once("../classes/database.class.php");

global $db;

$db = new Database();

include_once "../examcme/classes/historycme.class.php";

$cmehistory = new PaymentHistoryCME();

$receipt_cme = $cmehistory->readByReceiptId($_GET['receipt_id']);

if((empty($_GET['exam_type']) == false) && ($_GET['exam_type'] == "CME")){
	
	$receipt_cme = $cmehistory->readReceiptHistory($_GET['receipt_id']);
	
}

$receipt_date = getdate($receipt_cme['action_date']);

$out = '
<!DOCTYPE HTML>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="../../assets/fonts/font-awesome/fontawesome-all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
    <link href="css/script.css" rel="stylesheet" type="text/css"/>
</head>
<body>


        <div id="receiptmodal_body" class="paymentContent" style="min-height: auto;">

            <div class="row top_body" style="margin: 0">
			
                <div class="col-xs-2" style="padding: 0px">
                    <img src="img/logo.png" width="80" height="80">
                </div>

                <div class="col-xs-7 logo_title">
                    National Commission for Certification <br> of Anesthesiologist Assistants
                </div>

                <div class="col-xs-2 today_date">
				
                    <p>'. $receipt_date['mon'] . "/" . $receipt_date['mday'] . "/" . $receipt_date['year'] .'</p>
                </div>
            </div>

            <div class="row section1" style="padding: 20px 15px 45px 15px">
                <div class="col-md-12">
                    <div class="receipt_head">
                        <h6>RECEIPT</h6>
                        <p>Payment Successful</p>
                    </div>
                    <h5>
                        '. $receipt_cme['receipt_title'] .'
                    </h5>
                    <p>June. 1, ' . $receipt_cme['cme_cycle_start'] . " – June 1, " . ($receipt_cme['cme_cycle_start'] + 2) .' Cycle</p>
                    <ul>
                        <li><a>CAA name: <span>'. $userObject->data["login"]['full_name'] .'</span></a></li>
                        <li><a>Amount due: <span>'. '$'.$cmehistory->readActionAmount($receipt_cme['amount_num']) .'</span></a></li>
                        <li><a>Due date: <span>6/1/' . ($receipt_cme['cme_cycle_start'] + 2) . '</span></a></li>
                        <li><a>Date paid: <span>'. $receipt_date['mon']."/".$receipt_date['mday']."/".$receipt_date['year'] .'</span></a></li>
                        <li><a>Amount paid: <span>'. '$'.$cmehistory->readActionAmount($receipt_cme['amount_num']) .' (still due)</span></a></li>
                        <li><a>Amount due: <span>$0 (pay below)</span></a></li>
                    </ul>
                </div>

            </div>
            <div class="deadline"></div>

            <div class="row receipt_body">
                <div class="col-xs-4">
                    <p style="margin-bottom: 15px">Next CME Submission:	</p>
                    <h6>June. 1, ' . ($receipt_cme['cme_cycle_start'] + 2) . " – June 1, " . ($receipt_cme['cme_cycle_start'] + 4) .'</h6>
                </div>
                <div class="col-xs-7">
					<p>CME submissions have been accepted; however, all CAAs are subject to an audit and notified accordingly if any discrepancies are found. Within 24-48 hours your certificate will be updated to show the new expiration date. Thank you!</p>
                </div>
            </div>

		</div>
    
</body>
</html>
';

include('../vendor/autoload.php');
$mpdf = new \Mpdf\Mpdf([
    'mode' => 'utf-8',
    'format' => [220, 185],
    'margin_top' => 0,
    'margin_left' => 0,
    'margin_right' => 0,
    'margin_bottom' => 0,
]);
$mpdf->WriteHTML($out);
$mpdf->Output();

?>