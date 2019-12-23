<?php

error_reporting(E_ALL);



require("../profiletest/utils.php");



//$con = mysqli_connect("localhost","hashone122718",'+R8s1mBQIU38',"profilehashone");

global $con;



$host = "localhost";

$user = "root";

$pass = "123456";

$db = "nccaadb";

$con = mysqli_connect($host,$user,$pass,$db);



// Check connection

if (mysqli_connect_errno())

  {

  echo "Failed to connect to MySQL: " . mysqli_connect_error();

  exit(1);

  }

  



		//file_path = "members.csv";

		//$file_path = "extra.csv";

		$file_path = "stats.csv";

		

		$delimiter=',';

		



		$i=0;

		$handle = @fopen($file_path, "r");

		if ($handle) {

			while (($csv = fgetcsv($handle, 4096, $delimiter )) !== false) {



				print "csv:<pre><br>\n";

				var_dump( $csv );

				print "</pre><br>\n";



				//$temp_password = randomPassword();

				$temp_password="123456";



				//Name,Unique Identifier,Name,CERT#,Email,First Year,Designation



		

				$full_name = $csv[0]; 



				$names = split_name($full_name);

				

				$f_name = addslashes($names[0]);

				$l_name = addslashes($names[1]);



				$full_name = addslashes($full_name);

				

				$role="CAA";

				$is_certified=1;



				if ( trim($id_crm)=="" ) $id_crm=generateCertificateNumber( 0, false );



				$id_crm = $csv[1]; 

				$id_certificate = $csv[2];

				$email = $csv[3];

				$first_year = $csv[4];

				$cdq_due = date("Y-m-d", strtotime($csv[5]));

				$cme_due = date("Y-m-d", strtotime($csv[6]));





				$user_id='';

  	  	$query = "SELECT `id` FROM users WHERE `email` = '". $email ."'";

	    	$result = mysqli_query($con,$query);

				if ( $result ) {

					while ($row = mysqli_fetch_object($result)) {

						$user_id = stripslashes($row->id);

					}

				}



	

				if ( $user_id!='') {

					print "<br><br>Email:".$email." FOUND, id:".$user_id.", update nbme:".$id_crm.", cert:".$id_certificate."<br><br>\n";

					$uquery = "UPDATE users SET `temp_password`='1', `password`='".$temp_password."', `is_certified`='".$is_certified."', `full_name`='".$full_name."', `role`='".$role."',`last_import`='".date("Y-m-d H:i:s")."'  WHERE `id`='".$user_id."'";

					print "uquery:$uquery<br>\n";

		    	$uresult = mysqli_query($con,$uquery);



					

				} else {

					print "Email:".$email." not found insert user and nbme:".$id_crm.", cert:".$id_certificate."<br>\n";

					

					$uquery = "INSERT INTO `users` (`user`, `email`, `password`, `status`, `is_certified`, `full_name`, `temp_password`, `role`, `last_login`) VALUES('', '".$email."', '".$temp_password."', 0, '".$is_certified."', '".$full_name."', 1, '".$role."', '0000-00-00 00:00:00');";

					print "uquery:$uquery<br>\n";

		    	$uresult = mysqli_query($con,$uquery);

		    	$user_id=mysqli_insert_id($con);

				}







				if ( $user_id!='') {



					$asi_id="";

	  	  	$squery = "SELECT `id` FROM final_account_security_information WHERE `user_id` = '". $user_id ."'";

					print "squery:$squery<br>\n";

	    		$sresult = mysqli_query($con,$squery);

		    	if ( $sresult ) {

		    		//print "has result<br>\n";

						while ($row = mysqli_fetch_object($sresult)) {

							$asi_id = stripslashes($row->id);

							//print "row ( $asi_id ):<pre><br>\n";

							//var_dump( $row );

							//print "</pre><br>\n";

						}

					}

					

					if ( $asi_id!="") {

						$uquery = "UPDATE final_account_security_information SET `active`='1', `password`='".$temp_password."'";

						if ( $id_crm!='') $uquery .= ", `id_crm`='".$id_crm."' ";

						if ( $id_certificate!='') $uquery .= ", `id_certificate`='".$id_certificate."' ";

						$uquery .= " WHERE `id`='".$asi_id."'";

						print "uquery:$uquery<br>\n";

			    	$uresult = mysqli_query($con,$uquery);

					} else {

						$uquery = "INSERT INTO `final_account_security_information` (`user_id`, `id_crm` ";

						$uquery .= ", `id_certificate` ";

						$uquery .= ", `username`, `password`, `active`) VALUES('".$user_id."', '".$id_crm."' ";

						$uquery .= ", '".$id_certificate."' ";

						$uquery .= ", '".$email."', '".$temp_password."', '1');";

						print "uquery:$uquery<br>\n";

			    	$uresult = mysqli_query($con,$uquery);

					}







					$admin_id="";

	  	  	$squery = "SELECT `id` FROM admin WHERE `user_id` = '". $user_id ."'";

					print "squery:$squery<br>\n";

	    		$sresult = mysqli_query($con,$squery);

		    	if ( $sresult ) {

						while ($row = mysqli_fetch_object($sresult)) {

							$admin_id = stripslashes($row->id);

						}

					}

					

					if ( $admin_id!="") {

						//



						$uquery = "UPDATE `admin` SET `l_name`='".$l_name."' `password`='".$temp_password."', `email`='".$email."', `modified`='".time()."' ";

						$uquery .= " WHERE `id`='".$admin_id."'";

						print "uquery:$uquery<br>\n";

			    	$uresult = mysqli_query($con,$uquery);

					} else {

						$uquery = "INSERT INTO `admin` ( `name`, `l_name`, `username`, `password`, `email`, `type`, `role`, `balance`, `default`, `enabled`, `status`, `date`, `created`, `modified`, `user_id`) VALUES(NULL, '".$l_name."', '', '".$temp_password."', '".$email."', NULL, NULL, 0, 0, 1, '',  NULL, '".time()."', NULL, '".$user_id."');";

						print "uquery:$uquery<br>\n";

			    	$uresult = mysqli_query($con,$uquery);

					}







					$aci_id="";

	  	  	$squery = "SELECT `id` FROM final_address_contact_information WHERE `user_id` = '". $user_id ."'";

					print "squery:$squery<br>\n";

	    		$sresult = mysqli_query($con,$squery);

		    	if ( $sresult ) {

						while ($row = mysqli_fetch_object($sresult)) {

							$aci_id = stripslashes($row->id);

						}

					}

					

					if ( $aci_id!="") {

						//



						$uquery = "UPDATE final_address_contact_information SET `active`='1', `email_default`='".$email."', `confirm_email`='".$email."'";

						$uquery .= " WHERE `id`='".$aci_id."'";

						print "uquery:$uquery<br>\n";

			    	$uresult = mysqli_query($con,$uquery);

					} else {

						$uquery = "INSERT INTO `final_address_contact_information` (`user_id`, `email_default`, `confirm_email`, `active`) VALUES('".$user_id."', '".$email."', '".$email."', '1');";

						print "uquery:$uquery<br>\n";

			    	$uresult = mysqli_query($con,$uquery);

					}



					$gi_id="";

	  	  	$squery = "SELECT `final_generalinform_id` FROM final_generalinform WHERE `user_id` = '". $user_id ."'";

					print "squery:$squery<br>\n";

	    		$sresult = mysqli_query($con,$squery);

		    	if ( $sresult ) {

						while ($row = mysqli_fetch_object($sresult)) {

							$gi_id = stripslashes($row->final_generalinform_id);

						}

					}

					

					if ( $gi_id!="") {

						//



						$uquery = "UPDATE final_generalinform SET `f_name`='".$f_name."', `l_name`='".$l_name."'";

						$uquery .= " WHERE `final_generalinform_id`='".$gi_id."'";

						print "uquery:$uquery<br>\n";

			    	$uresult = mysqli_query($con,$uquery);

					} else {

						$uquery = "INSERT INTO `final_generalinform` (`user_id`, `f_name`, `l_name`) VALUES('".$user_id."', '".$f_name."', '".$l_name."');";

						print "uquery:$uquery<br>\n";

			    	$uresult = mysqli_query($con,$uquery);

					}







					$ts_id="";

	  	  	$squery = "SELECT `id` FROM `temp_stats` WHERE `user_id` = '". $user_id ."'";

					print "squery:$squery<br>\n";

	    		$sresult = mysqli_query($con,$squery);

		    	if ( $sresult ) {

		    		//print "has result<br>\n";

						while ($row = mysqli_fetch_object($sresult)) {

							$ts_id = stripslashes($row->id);

							//print "row ( $asi_id ):<pre><br>\n";

							//var_dump( $row );

							//print "</pre><br>\n";

						}

					}

					

					if ( $ts_id!="") {

						$uquery = "UPDATE `temp_stats` SET `id_crm` = '". $id_crm ."', `id_certificate` = '". $id_certificate ."', `first_year` = '". $first_year ."', `cdq_due` = '". $cdq_due ."', `cme_due` = '". $cme_due ."' ";

						$uquery .= " WHERE `id`='".$ts_id."'";

						print "uquery:$uquery<br>\n";

			    	$uresult = mysqli_query($con,$uquery);

					} else {

						$uquery = "INSERT INTO `temp_stats` ( `user_id`, `id_crm`, `id_certificate`, `first_year`, `cdq_due`, `cme_due` ) VALUES ( '".$user_id."', '". $id_crm ."', '". $id_certificate ."', '". $first_year ."', '". $cdq_due ."', '". $cme_due ."' );";

						print "uquery:$uquery<br>\n";

			    	$uresult = mysqli_query($con,$uquery);

					}









				}





			}



			if (!feof($handle)) {

			    echo "Error: unexpected fgets() fail\n";

			}

			fclose($handle);

		}



function split_name($name) {

    $name = trim($name);

    $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);

    $first_name = trim( preg_replace('#'.$last_name.'#', '', $name ) );

    return array($first_name, $last_name);

}



?>



