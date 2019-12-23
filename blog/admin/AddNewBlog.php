<?php
    
    if(isset($_POST) && !empty($_POST)) {
        if($_POST["blog_id"] == "") {
            $blog->created = $_POST['created'];
            $blog->author = $_POST['author'];
            $blog->title = $_POST['title'];
            $blog->contents = $_POST['editor'];
            $blog->publish = $_POST['publish'];           		    $_POST['user_id'] = $_SESSION['user_id'];            			if(empty($_POST['author']) == false){								$blog->addphoto($_POST, $_FILES);							}						$result = $blog->create();
            if($result) {
               print "<script>location.href='?content=../blog/admin/ViewAllBlogs&li_class=Blog';</script>\n";
                exit;
            }
        }else{
            $blog->id = $_POST["blog_id"];
            $blog->created = $_POST['created'];
            $blog->author = $_POST['author'];
            $blog->title = $_POST['title'];
            $blog->contents = $_POST['editor'];
            $blog->publish = $_POST['publish'];
		    $_POST['user_id'] = $_SESSION['user_id'];            			if(empty($_POST['author']) == false){								$blog->addPhoto($_POST, $_FILES);							}						$result = $blog->update();
            if($result) {
                print "<script>location.href='?content=../blog/admin/ViewAllBlogs&li_class=Blog';</script>\n";
                exit;
            }
        }
    }

    if(isset($_GET["act"]) && $_GET["act"] == "edit"){
        $blog->id = $_GET['id'];
        $result = $blog->readWithWhere("id = ".$_GET['id']);        		$photo_name = $blog->viewPhoto($_GET['id']);		
        $rec = $result[0];
    }
    
?><style>.profile_photo{	width:120px;	height:120px;	border-radius:50%;	background-position: top 20px;	background-repeat: no-repeat;	background-size: 120px;	}.profile_photo div{	visibility: hidden;	width:120px;	height:120px;	border-radius:50%;	font-size: 17px;}.profile_photo:hover div{	visibility: visible;	cursor:pointer;	background: rgba(25,32,45,.7);}</style>
<link rel="stylesheet" href="../assets/fonts/font-awesome/fontawesome-all.min.css">
                <div class="member-card card">
                    <h3>Add New Blog</h3>
                    <div class="row">
                        <div class="col-md-12">
                            <form action="?content=../blog/admin/AddNewBlog&li_class=Blog" method="post" enctype="multipart/form-data" id="blogForm"  autocomplete="off" >
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group border-b-1">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <label>Date:</label>
                                            </div>
                                            <div class="col-md-11">
                                                <input type="hidden" name="blog_id" id="blog_id" class="form-control border-0" value="<?php echo isset($rec["id"]) ? $rec["id"] : "" ?>" />
                                                <input type="text" name="created" id="created" class="form-control border-0 datepicker" value="<?php echo isset($rec["created"]) ? $rec["created"] : "" ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group border-b-1">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <label>From:</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" name="author" id="author" class="form-control border-0" value="<?php echo isset($rec["author"]) ? $rec["author"] : "" ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group border-b-1">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <label>Title:</label>
                                            </div>
                                            <div class="col-md-11">
                                                <input type="text" name="title" id="title" class="form-control border-0" value="<?php echo isset($rec["title"]) ? $rec["title"] : "" ?>" />
                                            </div>
                                        </div>
                                    </div>
                                </div>																<div class="col-md-4">                                    <div class="form-group">                                        <div class="row">                                            <div class="col-md-12" style="height:120px;">												<div class="profile_photo" id="profile_photo" style="background-image: url('../<?php															if(empty($photo_name) == false){																																if(empty($photo_name[0]['photo']) == false){																																		echo $photo_name[0]['photo'];																																}else{																																		echo"assets/images/ceo.png";																																	}															} 															else echo"assets/images/ceo.png";															?>');">																														<div align="center"><i class="fa fa-camera" style="color:#ffffff; padding-top:35%"></i><br><font style="color:white">Edit picture</font><input type="file" class="form-control" style="cursor:pointer; margin-top: -75px; opacity:0; height: 100px;" id="add_picture_file" name="add_picture_file" accept="image/x-png,image/gif,image/jpeg" /></div>																																					</div>											</div>																					</div>																			</div>																	</div>
                            </div>
                            <div class="form-group border-b-1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <textarea id="editor" name="editor" class="editor form-control border-0">
                                            <?php echo isset($rec["contents"]) ? $rec["contents"] : "" ?>
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="publish" id="publish" class="form-control border-0" value="No" />
                            <div class="form-group clearfix">
                                <div class="right">
                                    <div class="right margin-l-30">
                                        <button class="btn btn-success" id="publishBlog">Publish</button>
                                        <button class="btn btn-primary" id="saveBlog">Save</button>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
<script>
    $(document).ready(function() {
        $("#publishBlog").on("click", function(){
            $("#publish").val("Yes");

            blogForm.submit();
        });
        
        $("#saveBlog").on("click", function(){
            blogForm.submit();
        });				$('.datepicker').datepicker({					autoclose: true,						format: 'yyyy-mm-dd'				});	
    });$("#add_picture_file").change(function() {	  readURL(this);  });function readURL(input) {	  if (input.files && input.files[0]) {	  	var reader = new FileReader();		reader.onload = function(e) {				 $('#profile_photo').css({			 "background": "url("+ e.target.result +") no-repeat",			 "background-size": "120px"			 			 });			}		reader.readAsDataURL(input.files[0]);	  }  }</script>


