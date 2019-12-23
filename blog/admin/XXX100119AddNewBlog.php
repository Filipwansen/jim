<?php
    
    if(isset($_POST) && !empty($_POST)) {
        if($_POST["blog_id"] == "") {
            $blog->created = $_POST['created'];
            $blog->author = $_POST['author'];
            $blog->title = $_POST['title'];
            $blog->contents = $_POST['editor'];
            $blog->publish = $_POST['publish'];

            $result = $blog->create();
            
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

            $result = $blog->update();
            
            if($result) {
                print "<script>location.href='?content=../blog/admin/ViewAllBlogs&li_class=Blog';</script>\n";
                exit;
            }
        }
    }

    if(isset($_GET["act"]) && $_GET["act"] == "edit"){
        $blog->id = $_GET['id'];
        $result = $blog->readWithWhere("id = ".$_GET['id']);
        $rec = $result[0];
    }
    
?>

                <div class="member-card card">
                    <h3>Add New Blog</h3>

                    <div class="row">
                        <div class="col-md-12">
                            <form action="?content=../blog/admin/AddNewBlog&li_class=Blog" method="post" id="blogForm">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group border-b-1">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <label>Date:</label>
                                            </div>
                                            <div class="col-md-11">
                                                <input type="hidden" name="blog_id" id="blog_id" class="form-control border-0" value="<?php echo isset($rec["id"]) ? $rec["id"] : "" ?>" />
                                                <input type="text" name="created" id="created" class="form-control border-0" value="<?php echo isset($rec["created"]) ? $rec["created"] : "" ?>" />
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
                                </div>
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
        })
        
        $("#saveBlog").on("click", function(){
            blogForm.submit();
        })
    })
</script>


