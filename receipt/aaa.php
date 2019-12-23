<?php

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
                    
                    <p>'.date("m/d/Y").'</p>
                </div>
            </div>

            <div class="row section1" style="padding: 20px 15px 45px 15px">
                <div class="col-md-12">
                    <div class="receipt_head">
                        <h6>RECEIPT</h6>
                        <p>Payment Successful</p>
                    </div>
                    <h5 id="receipt_exam">CDQ Exam Retake #1(actual exam actual exam June 2020)</h5>
                    <p>For 8th February, 2020</p>
                    <ul>
                        <li><a>CAA name: <span id="receipt_name">Sebah Abdulazia</span></a></li>
                        <li><a>Amount due: $ <span id="receipt_retake_amount">75</span></a></li>
                        <li><a>Due date: <span id="receipt_due_date">07/02/2019</span> (does not guarantee a seat)</a></li>
                        <li><a>Date paid: <span id="receipt_date_paid">07/02/2019</span></a></li>
                        <li><a>Amount paid: <span id="receipt_amount_paid">0</span> (still due)</a></li>
                        <li><a>Amount due: $ <span id="receipt_amount_due">75</span> (pay below)</a></li>
                    </ul>
                </div>

            </div>
            <div class="deadline"></div>

            <div class="row receipt_body">
                <div class="col-xs-3">
                    <p style="margin-bottom: 15px">Next CME Submission:	</p>
                    <h5>Feb, 2026</h5>
                    <p>or</p>
                    <h5>June, 2026</h5>
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