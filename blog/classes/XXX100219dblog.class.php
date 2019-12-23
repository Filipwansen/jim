<?php

class BlogObject {
 
    // database connection and table name
    private $conn;
    private $table_name = "bloglists";
    private $views_table_name = "blogviews";
    private $likes_table_name = "bloglikes";
 
    // object properties
    public $id;
    public $created;    
    public $author;
    public $title;
    public $contents;
    public $views;
    public $likes;
    public $publish;
 
    public function __construct(){
    		global $db;
    		
        //$db = Database::getInstance();
        $this->conn = $db;
        
        //$db = new Database;
        
        //exit(0);
    }
 
    // create blog
    public function create(){ 
	
		$check = "SELECT * FROM " . $this->table_name . " WHERE contents = '" . $this->contents ."' AND title = '" . $this->title . "'";
		$check_count = $this->conn->getCount($check);
		if($check_count > 0){
			
			$query = "UPDATE " . $this->table_name . " SET created = '" . $this->created . "', author = '" . $this->author . "', title = '" . $this->title . "', contents = '" . $this->contents . "', publish = '" . $this->publish . "' WHERE contents = '" . $this->contents ."' AND title = '" . $this->title . "'";
			
		}else{
			
			$query = "INSERT INTO " . $this->table_name . " (created, author, title, contents, publish) VALUES ('" . $this->created . "', '" . $this->author . "','" . $this->title . "','" . $this->contents . "','" . $this->publish . "') ";
			
		}
  
        if($this->conn->execute($query)){
            return true;
        }else{
            return false;
        } 
    }

    // get rows count 
    public function countAll(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE publish = 'Yes'";
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
    public function readAll(){
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id DESC";
		
        //print "query:$query<br>\n";
        $stmt = $this->conn->getData( $query );
 
        return $stmt;
    }

    // read datas with where
    public function readWithWhere($where){
        $query = "SELECT * FROM " . $this->table_name . " WHERE " . $where;
        $stmt = $this->conn->getData( $query );
 
        return $stmt;
    }

    // read all publish datas 
    public function readAllPublish(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE publish = 'Yes'";
        $stmt = $this->conn->getData( $query );
 
        return $stmt;
    }

    // read data by id 
    public function readById($id="") {
				if ( $id!="" ) $this->id=$id;
				
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = " . $this->id;  
        $stmt = $this->conn->getData( $query );
 
        return $stmt;
    }

    // read data by author 
    public function readByAuthor( $author=""){
 				if ( $author!="" ) $this->author=$author;       
 				
 				$query = "SELECT * FROM " . $this->table_name . " WHERE author = '" . $this->author . "'";  
        $stmt = $this->conn->getData( $query );
 
        return $stmt;
    }

    // update blog
    public function update(){ 
        $query = "UPDATE " . $this->table_name . " SET created = '" . ($this->created) . "', author = '" . ($this->author) . "', title = '" . ($this->title) . "', contents = '" . ($this->contents) . "', publish = '" . ($this->publish) . "' WHERE id = " . $this->id;
  
        if($this->conn->execute($query)){
            return true;
        }else{
            return false;
        } 
    }

    // update blog's views
    public function updateViews(){ 
        $query = "UPDATE " . $this->table_name . " SET views = " . ($this->views + 1) . " WHERE id = " . $this->id;
  
        if($this->conn->execute($query)){
            return true;
        }else{
            return false;
        } 
    }

    // update blog's likes
    public function updateLikes(){ 
        $query = "UPDATE " . $this->table_name . " SET likes = " . $this->likes . " WHERE id = " . $this->id;
  
        if($this->conn->execute($query)){
            return true;
        }else{
            return false;
        } 
    }
    
    public function getTotalViews( ) {
				$views = 0;
				
 				$query = "SELECT * FROM " . $this->table_name . " WHERE id = '" . $this->id . "'";  
        $stmt = $this->conn->getData( $query );
    	
    		if ( is_array( $stmt ) ) {
    			if ( $stmt[0]["views"] > 0 ) $views = $stmt[0]["views"];
    		}
    		
    		return( $views );
    }
    

    public function getTotalLikes( ) {
				$likes = 0;
				
 				$query = "SELECT * FROM " . $this->table_name . " WHERE id = '" . $this->id . "'";  
        $stmt = $this->conn->getData( $query );
    	
    		if ( is_array( $stmt ) ) {
    			if ( $stmt[0]["likes"] > 0 ) $likes = $stmt[0]["likes"];
    		}
    		
    		return( $likes );
    }
    
    public function getUserView( $user_id=0 ) {
				$view = false;
				
 				$query = "SELECT * FROM " . $this->views_table_name . " WHERE post_id = '" . $this->id . "' AND user_id = '" . $user_id . "'";  
        $stmt = $this->conn->getData( $query );
    	
    		if ( is_array( $stmt ) ) {
    			if ( isset( $stmt[0]["id"] ) ) $view=true;
    		}
    		
    		return( $view );
    }

    public function setUserView( $user_id=0 ) {
    	
 				$query = "DELETE FROM " . $this->views_table_name . " WHERE post_id = '" . $this->id . "' AND user_id = '" . $user_id . "'";  
        $stmt = $this->conn->execute( $query );
    		
 				$query = "INSERT INTO " . $this->views_table_name . " ( post_id, user_id ) VALUES ( '" . $this->id . "', '" . $user_id . "' )";  
        $stmt = $this->conn->execute( $query );

    		return;
    }
     
    public function getUserLike( $user_id=0 ) {
				$like = false;
				
 				$query = "SELECT * FROM " . $this->likes_table_name . " WHERE post_id = '" . $this->id . "' AND user_id = '" . $user_id . "'";  
        $stmt = $this->conn->getData( $query );
    	
    		
    		if ( is_array( $stmt ) ) {
    			if ( isset( $stmt[0]["id"] ) ) $like=true;
    		}
    		
    		return( $like );
    }

    public function setUserLike( $user_id=0 ) {
    		
 				$query = "DELETE FROM " . $this->likes_table_name . " WHERE post_id = '" . $this->id . "' AND user_id = '" . $user_id . "'";  
        $stmt = $this->conn->execute( $query );
    		
 				$query = "INSERT INTO " . $this->likes_table_name . " ( post_id, user_id ) VALUES ( '" . $this->id . "', '" . $user_id . "' )";  
        $stmt = $this->conn->execute( $query );

    		return;
    }

    public function clearUserLike( $user_id=0 ) {
    		
 				$query = "DELETE FROM " . $this->likes_table_name . " WHERE post_id = '" . $this->id . "' AND user_id = '" . $user_id . "'";  
        $stmt = $this->conn->execute( $query );
    		
    		return;
    }

    public function getUserViewCount( $user_id=0 ) {
				$view_count = 0;
				
 				$query = "SELECT COUNT(*) AS view_count FROM " . $this->views_table_name . " WHERE  user_id = '" . $user_id . "'";  
        $stmt = $this->conn->getData( $query );
    	
    		if ( is_array( $stmt ) ) {
    			if ( $stmt[0]["view_count"] > 0 ) $view_count = $stmt[0]["view_count"];
    		}
    		
    		return( $view_count );
    }

    public function getUserNewCount( $user_id=0 ) {
				$total_count = 0;
				$new_count = 0;
				
 				$query = "SELECT COUNT(*) AS total_count FROM " . $this->table_name . "  WHERE publish = 'Yes'";
        $stmt = $this->conn->getData( $query );
    	
    		if ( is_array( $stmt ) ) {
    			if ( $stmt[0]["total_count"] > 0 ) $total_count = $stmt[0]["total_count"];
    		}
    		
    		$new_count = $total_count - $this->getUserViewCount( $user_id );
    		
    		return( $new_count );
    }


    // delete blog
    public function delete(){   
        if($this->conn->delete($this->id, $this->table_name)){
            return true;
        }else{
            return false;
        } 
    }
    
    public function output_script() {
				$outputHTML =<<<EOD
<script src="./assets/js/script.js" type="text/javascript"></script>

<script>
    $(document).ready(function() {
        $(".blog-like").on("click", function(){
            var blog_id = $(this).attr("id");

            if($(this).hasClass("active")){
                var data = { 'act':'setLikes', 'id':blog_id, 'likes':'plus' };
            }else{
                var data = { 'act':'setLikes', 'id':blog_id, 'likes':'minus' };
            }

            $.ajax({
                url: "api.php", 
                type: "GET",
                dataType: 'json',
                data: data,
                success: function(res){
                    $(".blog-like").html(res + " Likes");
                }
            });
        })
    })
</script>
EOD;

				return( $outputHTML );
		}
    
    public function output_single( $id="" ) {
				if ( $id!="" ) $this->id=$id;
				
				$outputHTML = "";
				
				$results = $this->readById();
				if (( $results ) && ( is_array($results))) {
					$rec=$results[0];
					$post_id = $rec["id"];
					$likes = $rec["likes"];
					$title = $rec["title"];
					$author = $rec["author"];
					$created = date("m/d/Y", strtotime($rec["created"]));
					$contents = $rec["contents"];
					
					$user_id = $_SESSION["user_id"];
					$user_likes = $this->getUserLike( $user_id );
					if ( $user_likes ) $like_class=" active ";
					else $like_class = "";
					
					$outputHTML .=<<<EOD
                                                <div class="blog-main block-border ncca-right-padding">
                                                    <p class="midium-title title-bottom-border text-uppercase">BLOG
                                                        <span class="blog-like {$like_class}" data-postid="{$post_id}" data-userid="{$user_id}"> {$likes}  likes</span>
                                                    </p>
													
													<a href="?content=blog/template/blogviewall" class="backbtn"><span class="glyphicon glyphicon-chevron-left"></span>< Back</a>
													
                                                    <div class="blog-main-container" style="margin-top:15px;">
                                                        <h1 class="blog-title"> {$title} </h1>
                                                        <div class="author-time row">
                                                            <div class="col-9">
                                                                <img src="./assets/images/profile-img.png" alt="" class="img-fluid">
                                                                <span class="author-name"><h4> {$author} </h4><p>NCCAA CEO</p></span>
                                                            </div>
                                                            <div class="col-3 text-right">
                                                                <p class="post-time"> {$created} </p>
                                                            </div>
                                                        </div>
                                                        <div class="blog-content">
                                                            {$contents} 
                                                        </div>
                                                    </div>
                                                </div>
EOD;

    	}
    	
    	return($outputHTML);
    }


    public function output_list_admin(  ) {
				
				$outputHTML = "";
				
				$results = $this->readAll();

				if ( $results )  {
					$outputHTML .=<<<EOD
                <div class="member-card card">
                    <h3>Blog</h3>
                    <div class="form-group">

                        <div class="right">
                            <a href="AddNewBlogAdmin.php" class="btn btn-primary">Add Post</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>


                    <table id="memberTable" class="table stable table-striped table-bordered nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Added</th>
                                <th>Title </th>
                                <th>Author </th>
                                <th>Views</th>
                                <th>Likes</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
EOD;
					foreach ($result as $rec) {

						$post_id = $rec["id"];
						$views = $rec["views"];
						$likes = $rec["likes"];
						$title = $rec["title"];
						$author = $rec["author"];
						$created = date("m/d/Y", strtotime($rec["created"]));
						$contents = $rec["contents"];
						$outputHTML .=<<<EOD
                            <tr>
                                <td> {$created} </td>
                                <td><a href="?action=viewarticle&id={$post_id}"> {$title} </a></td>
                                <td><a href="?action=viewauthor&author={$author}"> {$author} </a></td>
                                <td><a href=""> {$views} </a></td>
                                <td><a href=""> {$likes} </a></td>
                                <td class="text-center"><a href="AddNewBlogAdmin.php?act=edit&id=<{$id}" title="Edit"><span class="glyphicon glyphicon-edit"></span></a><a onclick="confirmDelete($(this)); return false;" href="ViewAllBlogsAdmin.php?act=del&id={$id}" title="Delete"><span class="glyphicon glyphicon-trash"></span></a></td>
                            </tr>
EOD;

 				}

					$outputHTML .=<<<EOD
                        </tbody>
                    </table>
                </div>
               </div>
EOD;


    	}
    	
    	return($outputHTML);
    }


    public function output_table(  ) {
				//print "output_list _GET:<pre><br>\n";
				//var_dump( $_GET );
				//print "</pre><br>\n";
				
		    // page given in URL parameter, default page is one
  		  $page = isset($_GET['page']) ? $_GET['page'] : 1;
 		   	// set number of records per page
 		   	$records_per_page = 10;
 		   	// calculate for the query LIMIT clause
 		   	$from_record_num = ($records_per_page * $page) - $records_per_page;

 		   	$results = $this->readPaging($from_record_num, $records_per_page);

				//print "results:<pre><br>\n";
				//var_dump( $results );
				//print "</pre><br>\n";
				     
    		$total_rows = $this->countAll();
				
				//print "<br>total_rows:$total_rows<br>\n";
				
				$outputHTML = "";
				
				if ( $results )  {
					//print "there was a result<br>\n";
					
					$outputHTML .=<<<EOD
                                                    <p class="midium-title title-bottom-border text-uppercase">VIEW BLOG POSTS</p>
                                                    <div class="blog-main-container">

                    <table id="memberTable" class="table stable table-striped table-bordered nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Added</th>
                                <th>Title </th>
                                <th>Author </th>
                                <th>Views</th>
                                <th>Likes</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
EOD;
					foreach ($results as $rec) {

						//print "rec:<pre><br>\n";
						//var_dump( $rec );
						//print "</pre><br>\n";

						$post_id = $rec["id"];
						$views = $rec["views"];
						$likes = $rec["likes"];
						$title = $rec["title"];
						$author = $rec["author"];
						$created = date("m/d/Y", strtotime($rec["created"]));
						$contents = $rec["contents"];
						$outputHTML .=<<<EOD
                            <tr>
                                <td> {$created} </td>
                                <td><a href="?action=viewarticle&id={$post_id}"> {$title} </a></td>
                                <td><a href="?action=viewauthor&author={$author}"> {$author} </a></td>
                                <td><a href=""> {$views} </a></td>
                                <td><a href=""> {$likes} </a></td>
                                <td class="text-center"><a href="?content=blog/template/viewarticle&id=<{$id}" title="Edit"><span class="glyphicon glyphicon-edit"></span></a><a onclick="confirmDelete($(this)); return false;" href="ViewAllBlogsAdmin.php?act=del&id={$id}" title="Delete"><span class="glyphicon glyphicon-trash"></span></a></td>
                            </tr>
EOD;

 				}

					$outputHTML .=<<<EOD
                        </tbody>
                    </table>
                                                        <div class="row">
                                                            <div class="col-md-6 col-xs-0"></div>
                                                            <div class="col-md-6 col-xs-12">
                                                                <div class="pagination">
                                                                    <a href="?content=blogviewall">&laquo;</a>
EOD;

                                                                    // calculate total pages
                                                                    $total_pages = ceil($total_rows / $records_per_page);
                                                                    // range of links to show
                                                                    $range = 2;                                                                    
                                                                    // display links to 'range of pages' around 'current page'
                                                                    $initial_num = $page - $range;
                                                                    $condition_limit_num = ($page + $range)  + 1;
                                                                    
                                                                    for ($x=$initial_num; $x<$condition_limit_num; $x++) {
                                                                        // be sure '$x is greater than 0' AND 'less than or equal to the $total_pages'
                                                                        if (($x > 0) && ($x <= $total_pages)) {    
                                                                            // current page
                                                                            if ($x == $page) {
                                                                                //echo "<a class='active' href=\"#\">$x <span class=\"sr-only\">(current)</span></a>";
                                                                            } 
                                                                            // not current page
                                                                            else {
                                                                                echo "<a href='?content=blog/template/blogviewall&page=$x'>$x</a>";
                                                                            }
                                                                        }
                                                                    }


					$outputHTML .=<<<EOD
                                                                    <a href="?content=blog/template/blogviewall&page={$total_pages}">&raquo;</a>
                                                                </div>
                                                            </div>
                                                        </div>                                                
                                                    </div>
                                                </div>                                        
EOD;


    	}
    	
    	return($outputHTML);
    }
 


    public function output_list(  ) {
				//print "output_list _GET:<pre><br>\n";
				//var_dump( $_GET );
				//print "</pre><br>\n";
				
		    // page given in URL parameter, default page is one
  		  $page = isset($_GET['page']) ? $_GET['page'] : 1;
 		   	// set number of records per page
 		   	$records_per_page = 10;
 		   	// calculate for the query LIMIT clause
 		   	$from_record_num = ($records_per_page * $page) - $records_per_page;

 		   	$results = $this->readPaging($from_record_num, $records_per_page);

				//print "results:<pre><br>\n";
				//var_dump( $results );
				//print "</pre><br>\n";
				     
    		$total_rows = $this->countAll();
				
				//print "<br>total_rows:$total_rows<br>\n";
				
				$outputHTML = "";
				
				if ( $results )  {
					//print "there was a result<br>\n";
					
					$outputHTML .=<<<EOD
                                                    <p class="midium-title title-bottom-border text-uppercase">VIEW BLOG POSTS</p>
                                                    <div class="blog-main-container">
EOD;
					foreach ($results as $rec) {

						//print "rec:<pre><br>\n";
						//var_dump( $rec );
						//print "</pre><br>\n";

						$post_id = $rec["id"];
						$views = $rec["views"];
						$likes = $rec["likes"];
						$title = $rec["title"];
						$author = $rec["author"];
						$created = date("m/d/Y", strtotime($rec["created"]));
						$contents1 = $rec["contents"];
						$contents = substr($contents1, 0, 380);
						$outputHTML .=<<<EOD
                            
                                                        <div class="author-time row">
                                                            <div class="col-12">
                                                                <img src="./assets/images/profile-img.png" alt="" class="img-fluid">
                                                                <span class="author-name2"><h4 style="font-size:20px;"> {$author} </h4><p>NCCAA CEO</p></span>
                                                            </div>                              
                                                        </div>
                                                        <div class="blog-content con">
                                                            <a href="?content=blog/template/viewarticle&id={$post_id}" style="color:black; font-size:22px;"> {$title} </a>
                                                            <div class="row" style="margin-top:15px; margin-bottom:15px;">
                                                                <div class="col-12 ">{$contents}...&nbsp;&nbsp;
																<a href="?content=blog/template/viewarticle&id={$post_id}">Read More</a>
																</div>                              
                                                            </div>
                                                        </div>

EOD;

 				}

					$outputHTML .=<<<EOD
                                                        <div class="row">
                                                            <div class="col-md-6 col-xs-0"></div>
                                                            <div class="col-md-6 col-xs-12">
                                                                <div class="pagination">
                                                                    <a href="?content=blog/template/blogviewall&page=1">&laquo;</a>&nbsp;
EOD;

                                                                    // calculate total pages
                                                                    $total_pages = ceil($total_rows / $records_per_page);
                                                                    // range of links to show
                                                                    $range = 2;                                                                    
                                                                    // display links to 'range of pages' around 'current page'
                                                                    $initial_num = $page - $range;
                                                                    $condition_limit_num = ($page + $range)  + 1;
                                                                    
                                                                    for ($x=$initial_num; $x<$condition_limit_num; $x++) {
                                                                        // be sure '$x is greater than 0' AND 'less than or equal to the $total_pages'
                                                                        if (($x > 0) && ($x <= $total_pages)) {    
                                                                            // current page
                                                                            if ($x == $page) {
                                                                                $outputHTML .= "<a class='active' href=\"#\">$x <span class=\"sr-only\">(current)</span></a>&nbsp;";
                                                                            } 
                                                                            // not current page
                                                                            else {
                                                                                $outputHTML .= "<a href='?content=blog/template/blogviewall&page=$x'>$x</a>&nbsp;";
                                                                            }
                                                                        }
                                                                    }


					$outputHTML .=<<<EOD
                                                                    <a href="?content=blog/template/blogviewall&page={$total_pages}">&raquo;</a>
                                                                </div>
                                                            </div>
                                                        </div>                                                
                                                    </div>
                                                </div>                                        
EOD;


    	}
    	
    	return($outputHTML);
    }



  
}
?>