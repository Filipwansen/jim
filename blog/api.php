<?phpini_set('display_errors', 1);ini_set('display_startup_errors', 1);error_reporting(E_ALL);require_once("../config.php");
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
    $result = $blog->readWithWhere("id = ".$_GET['id']);    	$get_userLike = $blog->getUserLike($_GET['user_id']);	
    $rec = $result[0];

    $likes = $rec["likes"];

    if($_GET['likes'] == 'plus'){        		if($get_userLike){						$blog->likes = $likes;					}else{						$blog->likes = $likes + 1;					}

        $blog->setUserLike( $_GET["user_id"] );
    }

    $result = $blog->updateLikes();
}

echo json_encode($blog->likes);

?>