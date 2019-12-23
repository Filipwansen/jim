<?php



class EmailObject {

 

    // database connection and table name

    private $conn;

    private $table_name = "email_message";

    public $id;

    public $sender_id;    

    public $receiver_id;

    public $subject;

    public $attach;

    public $content;

    public $read;

    public $regdate;

    public $opendate;

    public $is_del;

    public $p_id;

 

    public function __construct($db){

    	// global $db;   		

        $this->conn = $db;        

    }

 

    // create 

    public function create(){ 
	
        $query = "INSERT INTO ".$this->table_name." (sender_id, receiver_id, subject, attach, content, p_id) VALUES(".$this->sender_id.", '".$this->receiver_id."', '".$this->subject."', '".$this->attach."', '".$this->content."', ".$this->p_id.")";

        if($this->p_id > 0){ $this->updateUnReadById($this->p_id); }

        if($this->conn->execute($query)){

            return true;

        }else{

            return false;
        } 

    }

    // get the users id
    public function get_users_ids($g_ids){

        $ss = " WHERE `role` !='admin' AND id=";
        $ss .= preg_replace("/\,/", " OR id= ", $g_ids);

        $g_arr = explode(",", $g_ids); $uu = [];

        foreach ($g_arr as $key => $g_id) {

            $query = "SELECT `users_id` FROM `email_group` WHERE `id`=".$g_id;
            $g_uids = $this->conn->getData($query);

            if(count($g_uids) <= 0 ) continue;

            $g_uids = explode(',', $g_uids[0]['users_id']);

            if($key == 0){

                $uu = $g_uids;
            }
            else{

                foreach ($g_uids as $kk => $uid) {
                    if( !in_array($uid, $uu) )
                            array_push($uu, $uid);
                }
            }
        }

        $uu = join(',', $uu);
        return $uu;
    }



    // get rows count 

    public function countAll(){

        $query = "SELECT * FROM " . $this->table_name . " WHERE is_del = 0";

        $stmt = $this->conn->getCount( $query );

        return $stmt;

    }



    public function readPaging($from_record_num, $records_per_page){ 

        $query = "SELECT * FROM " . $this->table_name . " WHERE publish = 'Yes' ORDER BY created DESC LIMIT {$from_record_num}, {$records_per_page}";     

    		//print "query:$query<br>\n"; 

        $stmt = $this->conn->getData( $query );

        return $stmt;
    }



    // read all datas
    public function getAll($user_id){

        $query = "SELECT * FROM `v_email_message` WHERE ( `sender_id` =".$user_id." OR `receiver_id`=".$user_id." ) AND `is_del`=0 AND `p_id`=0 ORDER BY id DESC ";
        $stmt = $this->conn->getData( $query );

        return $stmt;
    }

    // Admin read all but only gets all of the chain mail...
    public function getAllAdmin(){

        $query = "SELECT * FROM `v_email_message` WHERE `p_id` = 0 AND `is_del`=0 ORDER BY id DESC ";        
        $stmt = $this->conn->getData( $query );

        return $stmt;
    }

    public function getById($id){
        $query = "SELECT * FROM `v_email_message` WHERE `id` = ".$id;
        $row = $this->conn->getData($query);
        return $row[0];
    }

    /*Mark as readed state*/
    public function updateReadById($id){

        if($id > 0){
            
            $p_id = $this->getChainRootId($id);
            $query = "UPDATE `email_message` SET `read` = 1 WHERE `id`=".$p_id;
            $this->conn->execute($query);
        }        
    }

    /* Mark as unreaded state*/
    public function updateUnReadById($p_id){

        if($p_id > 0){

            $id = $this->getChainRootId($p_id);
            $query = "UPDATE `email_message` SET `read` = 0 WHERE `id`=".$id;
            $this->conn->execute($query);
        }
    }
    
    /*Get the All recoders with rootId*/
    public function getAllChainsByid($id){

        $parentRowID = $this->getChainRootId($id);
        if($parentRowID <= 0) return [];

        // Get the whole chain recodes
        $cnt = 1; $rows = [];
        do{

            $row = $this->getById($parentRowID);
            array_push($rows, $row);

            $query = "SELECT `id` FROM `email_message` WHERE `p_id`=".$row['id'];
            $rr = $this->conn->getData($query);

            if(is_array($rr) && count($rr) > 0){
                $parentRowID = $rr[0]['id'];
            }
            else{
                $cnt = 0;
            }

        } while ($cnt > 0);

        return $rows;        
    }

    /*Get the email chain with email id*/
    public function getChainRootId($id){
        // Get the root recode with id 
        $pID = 1; $rID = $id; 

        do {

            $r = $this->getRowById($rID);

            if(count($r) <= 0) return 0;

            $rID = $r['p_id'];
            $pID = $r['id'];

        } while ($rID > 0);

        return $pID;
    }

    public function getRowById($id){

        $sql = "SELECT `p_id`, `id` FROM `email_message` WHERE `id` =".$id;
        $row = $this->conn->getData($sql);

        return count($row) > 0 ? $row[0] : [];
    }

    /*Remove email msg*/
    public function removeById($p_id){

        if($p_id > 0){

            $ids = $this->getAllChainsByid($p_id);

            foreach ($ids as $key => $id) {
                $sql = "DELETE FROM `email_message` WHERE `id`=".$id['id'];
                $this->conn->execute($sql);
            }
        }

    }

    /*Get the unread email count*/
    public function getUnreadCnt($user_id){

        $query = "SELECT * FROM `email_message` WHERE `p_id` = 0 AND `read` = 0 AND ( `sender_id`=".$user_id." OR `receiver_id`=".$user_id.") ";

        $stmt = $this->conn->getCount( $query );

        return $stmt;
    }

    /*Get the Admin Lists from user tbl*/
    public function getAdmins(){
        // $sql = "SELECT * FROM `users` WHERE `role` = 'Admin' ";
        $sql = "SELECT * FROM `users` WHERE (`email`='soren@nccaa.org' OR `email`='cynthia.m@nccaa.org') AND `role` = 'Admin' ";
        $row = $this->conn->getData($sql);

        return $row;
    }

    /*Get user*/
    public function getUser($id){

        $query = "SELECT * FROM `users` WHERE `id`=".$id;
        $row = $this->conn->getData($query);

        return $row[0];
    }

}

?>