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

include_once "../../incomecdq/classes/historycdq.class.php";

$cdqhistory = new PaymentHistoryCdq();

$receipt_cdq = $cdqhistory->readByReceiptId($_GET['receipt_id']);

// if((empty($_GET['exam_type']) == false) && ($_GET['exam_type'] == "CDQ")){
	
// 	$receipt_cdq = $cdqhistory->readReceiptHistory($_GET['receipt_id']);
	
// }

$receipt_date = date('d/m/Y',$receipt_cdq['action_date']);
if($receipt_cdq['exam_mon'] == 2) 
    $t_daye = 'Feb '. $receipt_cdq['exam_year']; 
else 
    $t_daye = 'June '. $receipt_cdq['exam_year'];

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
				
                    <p> For '. $t_daye .'</p>
                </div>
            </div>

            <div class="row section1" style="padding: 20px 15px 45px 15px">
                <div class="col-md-12">
                    <div class="receipt_head">
                        <h6>RECEIPT</h6>
                        <p>Payment Successful</p>
                    </div>
                    <h5>
                        '. $receipt_cdq['receipt_title'] .'
                    </h5>
                    <p>For '. $cdqhistory->readActionExamMon($receipt_cdq['exam_mon']).". 1, ".$receipt_cdq['exam_year'] .'</p>
                    <ul>
                        <li><a>CAA name: <span>'. $userObject->data["login"]['full_name'] .'</span></a></li>
                        <li><a>Amount due: <span>'. '$'.$receipt_cdq['paid_amount'] .'</span></a></li>
                        <li><a>Due date: <span>'. $receipt_cdq['exam_mon']."/1/".$receipt_cdq['exam_year'] .' (does not guarantee a seat)</span></a></li>
                        <li><a>Date paid: <span>'. $receipt_date.'</span></a></li>
                        <li><a>Amount paid: <span>'. '$'.$receipt_cdq['paid_amount'] .' (still due)</span></a></li>
                        <li><a>Amount due: <span>$0 (pay below)</span></a></li>
                    </ul>
                </div>

            </div>
            <div class="deadline"></div>

            <div class="row receipt_body">
                <div class="col-xs-3">
                    <p style="margin-bottom: 15px">Next CME Submission:	</p>
                    <h5>Feb, '. ($receipt_cdq['exam_year'] + 6) .'</h5>
                    <p>or</p>
                    <h5>June, '. ($receipt_cdq['exam_year'] + 6) .'</h5>
                </div>
                <div class="col-xs-8">
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