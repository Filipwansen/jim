<?php

	session_start();

	require_once("../../config.php");

	if(empty($_SESSION['user_id']) || $_SESSION['user_id'] == "" )
	{
		header('Location: /logincaamember.php');
	}

	require_once("../../../includes/util.php");

	require_once("../../classes/database.class.php");

	require_once("email_group.class.php");

	require_once("users.class.php");
	
	global $conn;

	$conn = new Database();

	$usersObject = new usersObject($conn);

	if( isset($_GET['userdata']) ){
		// $userIds = explode(',', $_GET['userdata'] );
		$ss = " WHERE `role` !='admin' AND id=";
		$ss .= preg_replace("/\,/", " OR id= ", $_GET['userdata']);

		$usersList = $usersObject->readByIds($ss);

		$rows = array();
		foreach ($usersList as $key => $user) {

			$delDom = '<a href="javascript:void(0)" userid="'.$user[1].'"><i class="fas fa-trash-alt"></i></a>';
			array_push($rows, [ $user[1], $user[2], $user[3], $delDom ]);
		}
		$usersList = $rows;
	}
	else{
		// define the delete & deleted after action
		if(isset($_GET['function']) && $_GET['function'] == 'delup'){ /* <<== delete & update */

			$group_id = isset($_GET['group_id']) ? $_GET['group_id'] : 0;
			$user_id  = isset($_GET['user_id']) ? $_GET['user_id'] : 0;
			// if($group_id==0 || $user_id==0){ echo json_encode(array('statusCode' => 0, 'data' => [])); return; }
			if($group_id==0){ echo json_encode(array('statusCode' => 0, 'data' => [])); return; }

			$groupsObject = new EmailGroupObject($conn);
			$res = $groupsObject->updateGetRow($group_id, $user_id);
			if($res['res']==1){

				$ss = " WHERE `role` !='admin' AND id=";
				$ss .= preg_replace("/\,/", " OR id= ", $res['val']);

				$usersList = $usersObject->readByIds($ss);

				$rows = array();
				foreach ($usersList as $key => $user) {

					$delDom = '<a href="javascript:void(0)" userid="'.$user[1].'"><i class="fas fa-trash-alt"></i></a>';
					array_push($rows, [ $user[1], $user[2], $user[3], $delDom ]);
				}
				$usersList = $rows;	
			}			
		}
		// define deletet group
		elseif (isset($_GET['function']) && $_GET['function']=='delgroup' ) { /*<<= delete group*/

			$group_id = isset($_GET['group_id']) ? $_GET['group_id'] : 0;
			if($group_id==0){ echo json_encode(array('statusCode' => 0, 'data' => [])); return; }

			$groupsObject = new EmailGroupObject($conn);
			$res = $groupsObject->deleteGroupById($group_id);
			$usersList = $res ? [] : null;
		}
		elseif (isset($_GET['function']) && $_GET['function']=='addusers') {

			$group_id = isset($_GET['group_id']) ? $_GET['group_id'] : 0;
			if($group_id==0){ echo json_encode(array('statusCode' => 0, 'data' => [])); return; }

			$user_ids = isset($_GET['users']) ? $_GET['users'] : null;

			$groupsObject = new EmailGroupObject($conn);
			$res = $groupsObject->addGroupUsers($group_id, $user_ids);

			if($res['res']==1){

				$ss = " WHERE `role` !='admin' AND id=";
				$ss .= preg_replace("/\,/", " OR id= ", $res['val']);

				$usersList = $usersObject->readByIds($ss);

				$rows = array();
				foreach ($usersList as $key => $user) {

					$delDom = '<a href="javascript:void(0)" userid="'.$user[1].'"><i class="fas fa-trash-alt"></i></a>';
					array_push($rows, [ $user[1], $user[2], $user[3], $delDom ]);
				}
				$usersList = $rows;	
			}
		}
		elseif (isset($_GET['function']) && $_GET['function']=='addgroup') { /*<<= Add new group*/
			$g_name = isset($_GET['g_name']) ? $_GET['g_name'] : null;
			if($g_name==null){ echo json_encode(array('statusCode' => 0, 'data' => [])); return; }

			$user_ids = isset($_GET['users']) ? $_GET['users'] : null;

			$groupsObject = new EmailGroupObject($conn);
			$res = $groupsObject->addNewGroup($g_name, $user_ids);

			echo json_encode($res);
			// echo json_encode(['res'=>$user_ids]);
			return; 

			// if($res['res']==1){

			// 	$ss = " WHERE `role` !='admin' AND id=";
			// 	$ss .= preg_replace("/\,/", " OR id= ", $res['val']);

			// 	$usersList = $usersObject->readByIds($ss);

			// 	$rows = array();
			// 	foreach ($usersList as $key => $user) {

			// 		$delDom = '<a href="javascript:void(0)" userid="'.$user[1].'"><i class="fas fa-trash-alt"></i></a>';
			// 		array_push($rows, [ $user[1], $user[2], $user[3], $delDom ]);
			// 	}
			// 	$usersList = $rows;	
			// }

		}
		else{

			$usersList = $usersObject->readAll();
		}

	}


	if(isset($usersList)){	

		echo json_encode(['data' => $usersList]);		

	}else{		

		echo json_encode(array('statusCode' => 0, 'data' => []));

	}
?>