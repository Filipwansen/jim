<?php

class AddCMEObject {
 
    // database connection and table name
    private $conn;
    private $table_name = "tbl_add_cme";
	private $table_payment = "action_history_cme";
	
    public function __construct(){

        global $db;

        $this->conn = $db;

    }

    //add cme
    public function insert_cme($data){
				
		$cme_cycle = $this->readCMECycle();
		
		$submit_day = getdate();
		//file upload start
		$target_dir = "examcme/uploads/";
		$filename = $_FILES["upload_file"]["name"];
		$file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
		$file_ext = substr($filename, strripos($filename, '.')); // get file name
		$filesize = $_FILES["upload_file"]["size"];
		$allowed_file_types = array('.doc','.docx','.rtf','.pdf', '.gif', '.jpg', '.png', '.jpeg');	

		if (in_array($file_ext,$allowed_file_types))
		{	
			// Rename file
			//$newfilename = md5($file_basename) . $file_ext;
			$newfilename = "cme_" . $submit_day[0] . $file_ext;
			if (file_exists($target_dir . $newfilename))
			{
				// file already exists error
				echo "You have already uploaded this file.";
			}
			else
			{		
				move_uploaded_file($_FILES["upload_file"]["tmp_name"], $target_dir . $newfilename);
				//echo "File uploaded successfully.";		
			}
		}
		elseif (empty($file_basename))
		{	
			// file selection error
			echo "Please select a file to upload.";
		} 
		else
		{
			// file type error
			echo "Only these file typs are allowed for upload: " . implode(', ',$allowed_file_types);
			unlink($_FILES["upload_file"]["tmp_name"]);
		}
		
		//Both checkbox make sure
		if($data['cme_check1'] == "on" && $data['cme_check1'] == "on"){
			$acknowledgements = 1;
		}else{
			$acknowledgements = 0;
		}
		
		///
		$add_credit_both = 0;
		///
		if(empty($data['anesthesia_credits']) == false){
			$cme_type = 1;
			$cme_hours = $data['anesthesia_credits'];
			
			if($cme_hours == '1/4'){
				
				$cme_hours = 0.25;
				
			}else if($cme_hours == '1/2'){
				
				$cme_hours = 0.5;
				
			}else if ($cme_hours == '3/4'){
				
				$cme_hours = 0.75;
				
			}
			
			$query_add1 = "INSERT INTO " . $this->table_name . " (user_id, date_submitted, cme_type, cme_hours, cme_doc, cme_provider, acknowledgements, cme_cycle_start) VALUES ('". $_SESSION['user_id'] ."', '". $submit_day[0] ."', '". $cme_type . "', '". $cme_hours ."', '". $target_dir . $newfilename ."', '". $data['cme_provider'] ."', '". $acknowledgements ."', '". $cme_cycle ."') ";
			
			if($this->conn->execute($query_add1)){
				
				$add_credit_both = 1;
				
			}
			
		}
		
		if(empty($data['other_credits']) == false){
			$cme_type = 2;
			$cme_hours = $data['other_credits'];
			
			if($cme_hours == '1/4'){
				
				$cme_hours = 0.25;
				
			}else if($cme_hours == '1/2'){
				
				$cme_hours = 0.5;
				
			}else if ($cme_hours == '3/4'){
				
				$cme_hours = 0.75;
				
			}
			
			$query_add2 = "INSERT INTO " . $this->table_name . " (user_id, date_submitted, cme_type, cme_hours, cme_doc, cme_provider, acknowledgements, cme_cycle_start) VALUES ('". $_SESSION['user_id'] ."', '". $submit_day[0] ."', '". $cme_type . "', '". $cme_hours ."', '". $target_dir . $newfilename ."', '". $data['cme_provider'] ."', '". $acknowledgements ."', '". $cme_cycle ."') ";
			
			if($this->conn->execute($query_add2)){
				
				$add_credit_both = 1;
				
			}
		
		}
		
		if(empty($data['anesthesia_credits']) == true && empty($data['other_credits']) == true){
			
			$query_add3 = "INSERT INTO " . $this->table_name . " (user_id, date_submitted, cme_type, cme_hours, cme_doc, cme_provider, acknowledgements, cme_cycle_start) VALUES ('". $_SESSION['user_id'] ."', '". $submit_day[0] ."', '', '', '". $target_dir . $newfilename ."', '". $data['cme_provider'] ."', '". $acknowledgements ."', '". $cme_cycle ."') ";
			
			if($this->conn->execute($query_add3)){
				
				$add_credit_both = 1;
				
			}
		
		}
		
		if($add_credit_both == 1){
			
			echo "<script>location.href='http://localhost/member/?content=content/cmehistory'</script>";
			
		}else if($add_credit_both == 0){

			echo "<script>alert('There was an error adding')</script>";
		}
		
    }

    // get rows count
    public function countAll($id){
		
        $query = "SELECT * FROM " . $this->table_name . " WHERE user_id = ".$id;
        $stmt = $this->conn->getCount( $query );

        return $stmt;
    }

    public function readPaging($from_record_num, $records_per_page){
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY created ASC LIMIT {$from_record_num}, {$records_per_page}";
//    		print "query:$query<br>\n";
        $stmt = $this->conn->getData( $query );

        return $stmt;
    }

    // read all datas
    public function readAll(){
        $query = "SELECT * FROM " . $this->table_name;
        //print "query:$query<br>\n";
        $stmt = $this->conn->getData( $query );

        return $stmt;
    }


    // read data by id
    public function readAllById($id, $cme_cycle) {
		
        if ( $id!="" ) $this->id=$id;
		
        $query = "SELECT * FROM " . $this->table_name . " WHERE user_id = ". $this->id ." AND cme_cycle_start = ". $cme_cycle ." ORDER BY id DESC";
        //print_r($query);exit;
        $stmt = $this->conn->getData( $query );

        return $stmt;
		
    }

    //read CME category or type
    public function readCMEType($num){
		
		$cme_type = array("", "Anesthesia", "Other"); 
		
		return $cme_type[$num];
		
	}

	//read CME provider
	public function readCMEProvider($num){
	
		$cme_provider = array("Select", "AMA", "ACCME", "AAPA", "AHA – include note “ACLS or PALS instruction only");
		
		return $cme_provider[$num];
		
	}	
	
    public function readCreditsCompleted($id, $cme_cycle){
		
		$total_credits = "";
		
		$query = "SELECT SUM(cme_hours) as credits_completed FROM ". $this->table_name ." WHERE user_id = ". $id ." AND cme_cycle_start = ". $cme_cycle;
		
		$stmt = $this->conn->getData( $query );
		
		$credits = $stmt[0]['credits_completed'];
		
		$int_float = explode('.', $credits);
		
		if(count($int_float) > 1){
			
			$credit_int = $int_float[0];
			
			$credit_float = $int_float[1];
			
			if($credit_float == '25'){
			
				$credit_float = "<sup>1</sup>&frasl;<sub>4</sub>";
			
			}else if($credit_float == '5'){
				
				$credit_float = "<sup>1</sup>&frasl;<sub>2</sub>";
				
			}else if ($credit_float == '75'){
				
				$credit_float = "<sup>3</sup>&frasl;<sub>4</sub>";
				
			}
			if($credit_int == 0){
				
				$total_credits = $credit_float;
				
			}else{
				 
				$total_credits = $credit_int."&nbsp".$credit_float;
				
			}
			
		}else{
			
			if(empty($credits)){
				$total_credits = 0;
			}else{
				$total_credits = $credits;
			}
			
		}
		
        return $total_credits;

	}
	
    public function readCreditsNeeded($id, $cme_cycle){
		
		$rest_credits = "";
		
		$query = "SELECT SUM(cme_hours) as credits_completed FROM ". $this->table_name ." WHERE user_id = ". $id ." AND cme_cycle_start = ". $cme_cycle;
		
		$stmt = $this->conn->getData( $query );
		
		$credits = (40 - $stmt[0]['credits_completed']);
		
		$int_float = explode('.', $credits);
		
		if(count($int_float) > 1){
			
			$credit_int = $int_float[0];
			
			$credit_float = $int_float[1];
			
			if($credit_float == '25'){
			
				$credit_float = "<sup>1</sup>&frasl;<sub>4</sub>";
			
			}else if($credit_float == '5'){
				
				$credit_float = "<sup>1</sup>&frasl;<sub>2</sub>";
				
			}else if ($credit_float == '75'){
				
				$credit_float = "<sup>3</sup>&frasl;<sub>4</sub>";
				
			}
			
			if($credit_int == 0){
				
				$rest_credits = $credit_float;
				
			}else{
				
				$rest_credits = $credit_int."&nbsp".$credit_float;
				
			}
			
		}else{
			
			if(empty($credits)){
				$rest_credits = 0;
			}else{
				$rest_credits = $credits;
			}
		}

        return $rest_credits;

	}
	
    public function readCreditsType($id, $num, $cme_cycle){
		
		$rest_credits = "";
		
		$query = "SELECT SUM(cme_hours) as credits_completed FROM ". $this->table_name ." WHERE user_id = ". $id ." AND cme_type = ". $num ." AND cme_cycle_start = ". $cme_cycle;
		
		$stmt = $this->conn->getData( $query );
		
		if($num == 1){ 
		
			$credits = (30 - $stmt[0]['credits_completed']);
			
		}
		
		if($num == 2){ 
		
			$credits = (10 - $stmt[0]['credits_completed']);
			
		}

		$int_float = explode('.', $credits);
		
		if(count($int_float) > 1){
			
			$credit_int = $int_float[0];
			
			$credit_float = $int_float[1];
			
			if($credit_float == '25'){
			
				$credit_float = "<sup>1</sup>&frasl;<sub>4</sub>";
			
			}else if($credit_float == '5'){
				
				$credit_float = "<sup>1</sup>&frasl;<sub>2</sub>";
				
			}else if ($credit_float == '75'){
				
				$credit_float = "<sup>3</sup>&frasl;<sub>4</sub>";
				
			}
			
			if($credit_int == 0){
				
				$rest_credits = $credit_float;
				
			}else{
				
				$rest_credits = $credit_int."&nbsp".$credit_float;
				
			}
			
		}else{
			
			if(empty($credits)){
				$rest_credits = 0;
			}else{
				$rest_credits = $credits;
			}
		}

        return $rest_credits;

	}
	
	//get current CME cycle 
	public function readCMECycle(){
		
		global $userObject;
		
		$cme_first_year = $userObject->vitals["first_year"];
        
		$date = getdate();
		
		$date_june = mktime(0,0,0,6,1,$date['year']);// june.1 of this year
		
		$this_year = $date['year'];
		
		if($cme_first_year % 2 == 0){ //even member
			
			if($this_year % 2 == 0){ //even year
				
				//before june.1
				if($date[0] < $date_june){
					
					$cme_cycle_start = $this_year - 2;	
				//after june.1	
				}else if($date[0] > $date_june){
					
					$cme_cycle_start = $this_year;
					
				}
				
			}else{//odd year 
			
				$cme_cycle_start = $this_year - 1;
							
			}
			
		}else{//odd member
			
			if($this_year % 2 == 0){ //even year
			
				$cme_cycle_start = $this_year - 1;
						
			}else{//odd year
			
				//before june.1
				if($date[0] < $date_june){
					
					$cme_cycle_start = $this_year - 2;	
				//after june.1	
				}else if($date[0] > $date_june){
					
					$cme_cycle_start = $this_year;
					
				}
						
			}
		
		}
		
		$query = "SELECT * FROM " . $this->table_payment . " WHERE user_id = " . $_SESSION['user_id'] . " AND cme_cycle_start = " . $cme_cycle_start;
        
		$stmt = $this->conn->getCount( $query );
		
		if($stmt > 0){
			
			$cme_cycle_start = ($cme_cycle_start + 2);
			
		}

		return $cme_cycle_start;
		
	}
	
	public function selectCMECycle($id){
		
		$query = "SELECT DISTINCT cme_cycle_start FROM ". $this->table_name ." WHERE user_id = ". $id ." ORDER BY cme_cycle_start DESC";
		
		$stmt = $this->conn->getData( $query );
		
		$cycle = $this->readCMECycle();
		
		//$credit = $this->readCreditsCompleted($id, $cycle);
		
		//$select_val = array(($cycle + 2));
		
		$select_val = array($cycle);
		
		foreach($stmt as $val){
			
			if($select_val[0] != $val['cme_cycle_start']){
				
				array_push($select_val, $val['cme_cycle_start']);
				
			}
		
		}
		return $select_val;
		
	}
	
	
	//get current CME cycle exactly. This is for pay_now button. 
	public function readCMECyclePayButton(){
		
		global $userObject;
		
		$cme_first_year = $userObject->vitals["first_year"];
        
		$date = getdate();
		
		$date_june = mktime(0,0,0,6,1,$date['year']);// june.1 of this year
		
		$this_year = $date['year'];
		
		if($cme_first_year % 2 == 0){ //even member
			
			if($this_year % 2 == 0){ //even year
				
				//before june.1
				if($date[0] < $date_june){
					
					$cme_cycle_start = $this_year - 2;	
				//after june.1	
				}else if($date[0] > $date_june){
					
					$cme_cycle_start = $this_year;
					
				}
				
			}else{//odd year 
			
				$cme_cycle_start = $this_year - 1;
							
			}
			
		}else{//odd member
			
			if($this_year % 2 == 0){ //even year
			
				$cme_cycle_start = $this_year - 1;
						
			}else{//odd year
			
				//before june.1
				if($date[0] < $date_june){
					
					$cme_cycle_start = $this_year - 2;	
				//after june.1	
				}else if($date[0] > $date_june){
					
					$cme_cycle_start = $this_year;
					
				}
						
			}
		
		}

		$make_sure_cycle = $this_year - $cme_cycle_start;
		
		if($make_sure_cycle == 0){
			
			$cme_cycle_start = $cme_cycle_start - 2;
		
		}

		return $cme_cycle_start;
		
	}
	
    public function readCMEPaymentVerify($id, $cycle)
	{
		
		$query = "SELECT * FROM " . $this->table_payment . " where user_id = ". $id ." AND cme_cycle_start = ".$cycle;
		
		$stmt = $this->conn->getCount( $query );
			
		return $stmt;
	}		
	
}
?>