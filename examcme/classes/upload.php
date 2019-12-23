<?php
require_once( BASE_PATH . "includes/util.php");

require_once( BASE_PATH . "classes/user.class.php");

$userObject = new userObject();
$userObject->init( $_SESSION['user_id'] );

require_once( BASE_PATH . "member/classes/database.class.php");
global $db;

$db = new Database();

require_once "addcme.class.php";

global $addcme;
$addcme = new AddCMEObject();

if (empty($_POST) == false){
	
	$addcme->insert_cme($_POST);
	
}

?>
