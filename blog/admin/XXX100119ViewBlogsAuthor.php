<?php

    if(isset($_GET["act"]) && $_GET["act"] == "del"){
        $blog->id = $_GET["id"]; 
        $blog->delete();
    }

    if(isset($_GET["author"]) && $_GET["author"]){
        $blog->author = $_GET['author'];
        $result = $blog->readWithWhere("author = '".$_GET['author'] . "'");
    }
    
?>


                <div class="member-card card">
                    <h3>View Blog By Author</h3>
                    <div class="form-group">

                        <div class="right">
                            <a href="?content=../blog/admin/AddNewBlog&li_class=Blog" class="btn btn-primary">Add Post</a>
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
                        
                            <?php
                            if ($result) {
                                foreach ($result as $rec) {
                            ?>
                            <tr>
                                <td> <?php $date=date_create($rec['created']); echo date_format($date, "m/d/y"); ?> </td>
                                <td><a href="?content=../blog/admin/PreviewBlog&li_class=Blog&id=<?php echo $rec['id'] ?>"> <?php echo $rec['title'] ?> </a></td>
                                <td><a href="?content=../blog/admin/ViewBlogsAuthor&li_class=Blog&author=<?php echo $rec['author'] ?>"> <?php echo $rec['author'] ?> </a></td>
                                <td><a href=""> <?php echo $rec['views'] ?> </a></td>
                                <td><a href=""> <?php echo $rec['likes'] ?> </a></td>
                                <td class="text-center"><a href="?content=../blog/admin/AddNewBlog&li_class=Blog&act=edit&id=<?php echo $rec['id'] ?>" title="Edit"><span class="glyphicon glyphicon-edit"></span></a><a onclick="confirmDelete($(this)); return false;" href="ViewBlogsAuthorAdmin.php?li_class=Blogact=del&id=<?php echo $rec['id'] ?>&author=<?php echo $rec['author'] ?>" title="Delete"><span class="glyphicon glyphicon-trash"></span></a></td>
                            </tr>
                            <?php
                                }
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
 
 