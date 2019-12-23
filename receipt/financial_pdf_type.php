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

require_once "../admin/classes/financial.class.php";

global $financial;

$financial = new FinancialObject();

$info = "";

$total_amount = "";

$total_amount_num = "";

if(empty($_GET['financial_exam_type']) == false){
	
	$info = $financial->readFinancialByExamType($_GET['financial_exam_type']);
	
	$total_amount = $financial->total_count_type($_GET['financial_exam_type']);
	
}

$table = "";

$header = '
<!DOCTYPE HTML>
<html>
<head>
    <title></title>
	<link href="../css/jquery-ui.min.css" rel="stylesheet" type="text/css">
	<link href="../css/jquery-ui.structure.min.css" rel="stylesheet" type="text/css">
	<link href="../css/jquery-ui.theme.min.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="../admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="../admin/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="../admin/css/select.dataTables.min.css">
    <link rel="stylesheet" href="../admin/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="../admin/css/jquery-ui.css">
    <link rel="stylesheet" href="../admin/css/jquery.gritter.css">
    <link rel="stylesheet" type="text/css" href="../admin/fonts/fonts.css">
    <link href="../admin/css/style.css" type="text/css" rel="stylesheet" />
	<style>
	
	   tr td {
		   
		   height: 30px !important;
		   
		   padding: 0px 10px 0px 10px;
		   
	   }
	
	   tr th {
		   
		   height: 30px !important;
		   
		   padding: 0px 10px 0px 10px;
		   
	   }
	   
	   thead tr th {
		   
		   background-color: #e5e5e5;
		   
	   }
	   
	   .total_num{


		}

		.total_num h2{

			font-size: 15px;

			color: #000000;

			margin: 0;

			text-align: right;

			margin-right: 10px;

			font-weight: bold;

		}

		.total_num h2 span{

			font-weight: normal;


		}

	   
	</style>
</head>
<body>

    <div class="row" style="height:40px;"></div>
	
    <div class="row" style="height:40px; margin-left:40px;">
	
		<div class="col-md-12" align="left"><font style="font-size: 20px;">Financial Ledger</font>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;'. date("m/d/Y") .'</div>
	
	</div>
	
	<div class="row" style="margin:0px 40px 0px 40px;">
	
		<div class="col-md-12" align="center">
		
			<table id="financialLedgerDetail" class="table table-striped table-bordered nowrap" style="width:100%">

				<thead>

					<tr>

						<th align="center">#</th>

						<th>Date</th>

						<th>Member</th>

						<th>Amount</th>

					</tr>

				</thead>

				<tbody>';
				if($info != ""){
					if(count($info) > 0){
						for($i=0; $i < count($info); $i++){
							
						$table .= "<tr id='financial_tr". $i ."' style='cursor:pointer;'>

							<td align='center' style='cursor:pointer;'>". ($i + 1) ."</td>

							<td>". $financial->convert_date($info[$i]["action_date"]) ."</td>

							<td>". $info[$i]['first_name']." ".$info[$i]['last_name'] ."</td>

							<td>". $financial->pay_amount($info[$i]['amount_num'], $info[$i]['exam_type']) ."</td>

						</tr>";

					 }
						
					}else{
						
						$table = "<tr style='cursor:pointer;'><td colspan='4' align='center'>No registered data</td></tr>";
								
					}
				}
			
			$footer1 = '</tbody>

			</table>
		</div>
        
		<div class="col-md-12">
		
			<div class="total_num">

				<h2>Total <span>';
				if($total_amount != "") $total_amount_num = "$".number_format($total_amount, 2);
			$footer2 ='</span></h2>

			</div>
			
		</div>
	</div>	
	
</body>
</html>
';

$out = $header.$table.$footer1.$total_amount_num.$footer2;


include('../vendor/autoload.php');
$mpdf = new \Mpdf\Mpdf([
    'mode' => 'utf-8',
    'format' => [190, 236],
    'margin_top' => 0,
    'margin_left' => 0,
    'margin_right' => 0,
    'margin_bottom' => 0,
]);
$mpdf->WriteHTML($out);
$mpdf->Output();

?>