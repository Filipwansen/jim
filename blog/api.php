<?php
require_once( "../../includes/util.php");

require_once( "../../classes/user.class.php");

$userObject = new userObject();
$userObject->init( $_SESSION['user_id'] );

require_once( "../classes/database.class.php");
global $db;

$db = new Database();

require_once "classes/blog.class.php";

$blog = new BlogObject();

if($_GET['act'] == 'setLikes')
{
    $blog->id = $_GET['id'];
    $result = $blog->readWithWhere("id = ".$_GET['id']);
    $rec = $result[0];

    $likes = $rec["likes"];

    if($_GET['likes'] == 'plus'){

        $blog->setUserLike( $_GET["user_id"] );
    }

    $result = $blog->updateLikes();
}

echo json_encode($blog->likes);

?>