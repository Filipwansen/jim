<?php

class EmailGroupObject {
 
    // database connection and table name
    private $conn;
    private $table_user = "email_group";
    // object properties
    public $id;
 
    public function __construct($db){
    	
        $this->conn = $db;
    }
 
	//read action_mon
    public function readActionExamMon($id){
		
    }

    // read all groups
    public function readAll(){
		
		$query = "SELECT * FROM `".$this->table_user."` where `is_active` = 1";

        $groupsLists = $this->conn->getGroupDataArray( $query );
        		
		if(empty($groupsLists) == false){
            return $groupsLists;		    
		}
    }

    public function updateGetRow($group_id, $user_id){
        // remove $user_id in $group_id row of users_id column
        $query = "SELECT `users_id` FROM `".$this->table_user."` where `is_active` = 1 AND `id`=".$group_id;
        $group = $this->conn->getData( $query );

        $users = isset($group[0]['users_id']) ? $group[0]['users_id']: null;
        if($users==null) return ['res'=>0,  'val'=>'']; 


        $users = explode(',', $users); $uu = [];
        foreach ($users as $key => $uid) {
            if($uid != $user_id){
                array_push($uu, $uid);
            }
        }

        $uu = join(',', $uu);

        $query = "update `".$this->table_user."` set `users_id`='".$uu."' where `id`=".$group_id;
        $res = $this->conn->execute($query);

        if($res){
            return ['res'=>1,  'val'=>$uu];
        }
        else{
            return ['res'=>0,  'val'=>''];   
        }        
    }

    public function addGroupUsers($group_id, $user_ids){
        // remove $user_id in $group_id row of users_id column
        $query = "SELECT `users_id` FROM `".$this->table_user."` where `is_active` = 1 AND `id`=".$group_id;
        $group = $this->conn->getData( $query );

        $users_db = isset($group[0]['users_id']) ? $group[0]['users_id']: null;
        if($users_db==null) return ['res'=>0,  'val'=>'']; 

        $user_ids = explode(',', $user_ids);
        $users_db = explode(',', $users_db); 
        $uu = [];
        foreach ($users_db as $key => $uid) {
            if(!in_array($uid, $user_ids)){
                array_push($uu, $uid);
            }
        }
        $uu = array_merge($uu, $user_ids);
        $uu = join(',', $uu);
        
        $query = "update `".$this->table_user."` set `users_id`='".$uu."' where `id`=".$group_id;
        $res = $this->conn->execute($query);

        if($res){
            return ['res'=>1,  'val'=>$uu];
        }
        else{
            return ['res'=>0,  'val'=>''];   
        }  
    }

/*>> Add new group database process*/
public function addNewGroup($g_name, $users_id){
    // $query = "SELECT COUNT(*) AS cnt FROM `".$this->table_user."` where `is_active` = 1 AND `group_name`=".$g_name;
    $query = "SELECT * FROM `".$this->table_user."` where `is_active` = 1 AND `group_name`='".$g_name."'";
    $cnt = $this->conn->getCount($query);
    $cnt = $cnt == false ? 0 : $cnt;

    // return ['res'=>$query, 'cnt'=>$cnt];

    if($cnt <= 0 && isset($users_id)){

        $sql = "INSERT INTO `".$this->table_user."` (`group_name`, `users_id`, `is_active`) VALUES('".$g_name."', '".$users_id."', 1 )";
        $res = $this->conn->execute($sql);
        return $res ? ['res'=>1] : ['res'=>0];
    }
    else{

        return ['res'=>-1];//already exsit
    }

}

    public function deleteGroupById($group_id){

        $query = "UPDATE `".$this->table_user."` SET `is_active` = 0 WHERE `id`=".$group_id;
        $res = $this->conn->execute($query);
        return $res;
    }

	//update users
    public function updateUser($data){		
		
    }

	//add the new users
    public function addUser($data){		
		
    }
}
?>