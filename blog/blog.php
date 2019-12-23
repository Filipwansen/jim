
<?php

require_once "classes/blog.class.php";

global $blog;

$blog = new BlogObject();

add_menu( "blog", "Blog", "../blog/admin/ViewAllBlogs&li_class=Blog" );
    
?>

