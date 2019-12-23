<?php
    require_once "classes/blog.class.php";

    $blog = new BlogObject();

    if($_GET['act'] == 'setLikes')
    {
        $blog->id = $_GET['id'];
        $result = $blog->readWithWhere("id = ".$_GET['id']);
        $rec = $result[0];

        $likes = $rec["likes"];

        if($_GET['likes'] == 'plus'){
            $blog->likes = $likes + 1;
        }else{
            $blog->likes = $likes - 1;
        }

        $result = $blog->updateLikes();
    }

    echo json_encode($blog->likes);

?>