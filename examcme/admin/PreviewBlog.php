<?php
    if(isset($_GET["id"]) && $_GET["id"]){
        $blog->id = $_GET['id'];
        $result = $blog->readWithWhere("id = ".$_GET['id']);
        $rec = $result[0];
    }
    
?>
                <div class="member-card card">
                    <h3>Blog</h3>
                    <div class="previewBlog">
                        <h1> <?php echo $rec["title"]; ?> </h1>
                        <div class="form-group clearfix">
                            <div class="left">
                                <div class="image">
                                    <img src="./admin/images/demoPic2.png" alt="" class="img-responsive" />
                                </div>
                                <div class="blogauth">
                                    <h5> <?php echo $rec["author"]; ?> </h5>
                                    <p>NCCAA Director</p>
                                </div>
                            </div>
                            <div class="right">
                                <p class="emaildate"> <?php $date=date_create($rec['created']); echo date_format($date, "m/d/Y"); ?> </p>
                            </div>
                        </div>
                        <div class="form-group clearfix border-b-1">
                            <?php echo $rec["contents"]; ?> 
                        </div>
                   </div>
                </div>

