<?php
	
    if(isset($_GET["id"]) && $_GET["id"]){
    	// marked as readed 
        $email->updateReadById($_GET['id']);

        $row = $email->getById($_GET['id']);

        $rows = $email->getAllChainsByid($_GET['id']);

    }
    else{
    	echo "No Data!";
    	return;
    }

?>
<style>
.preview_post img {
	
	width:794px;	
}

</style>

<div class="member-card card">
    <h3>Email</h3>
    <a href="?content=../emailblast/admin/ViewAllBlastEmail&li_class=EmailBlast" class="backbtn"><span class="glyphicon glyphicon-chevron-left"></span>Back</a>
    
<div class="previewEmail">
	<div class="tab-content" id="myTabContent" style="padding-top: 20px">

    <div class="tab-pane show active" id="home" role="tabpanel" aria-labelledby="home-tab">

        <div class="block-border ncca-right-padding">

            <div class="row">

                <div class="col-md-12">

                <h3 class="fs-14 mb-1 w-6">From: <?= $row['sender_fullname']?> ( <?= $row['sender_email']?> )</h3>

                <h3 class="fs-14 mb-1 w-6">To: <span style="color:#969696;"><?= $row['receiver_fullname']?> ( <?= $row['receiver_email']?> )</span></h3>
                </div>
                <div class="col-md-12">
                    <p class="fs-14 text-md-right" style="color:#969696;"><?= $row['regdate']?></p>
                </div>
            </div>
			<hr>
			<h3 class="fs-14"><?= $row['subject']?></h3>

			<?php foreach($rows as $key=>$r){?>
				<strong style="font-size: 9pt; background-color: #f0f0f0">
					<i class="fa fa-pencil-alt"></i> <?= $r['sender_fullname']?> : <?= $r['regdate']?>
				</strong>
				<div class="email-msg">
				  <?= $r['content']?>

				<?php if($r['attach'] != ""){ ?>
					<i class="fas fa-paperclip" style="color: #23527c"></i>
					<a href="../upload/<?= $r['attach']?>" target="_blank" download><?= $r['attach']?></a>
				<?php } ?>

				</div>
	          	<hr style="margin-top: 30px;margin-bottom: 5px;">
          	<?php }?>

            <div class="row">
	            <div class="col-md-12">
	                <a href="javascript:void(0)" class="btn btn-default px-4 cl-fff" id="reply_preview_email">
	                    <i class="fas fa-reply"></i>Reply
	                </a>
	            </div>
            </div>

    <div id="reply_send_box" style="display: none;">
    	<form id="emailAdminForm" action="../emailblast/admin/BlastEmailproc.php" method="post" enctype="multipart/form-data"  autocomplete="off" >
	      	<div class="reply mt-2">

	      		<a onclick="$('#my_file').click();" class="btn btn-secondary w-6 mb-3" style="background-color: #e5e5e5; color:#000; border: 0; margin-bottom: 10px">
	      		    <i class="fas fa-paperclip"></i>
	      		    Attach Files
	      		</a>&nbsp;<label id="filenameshow" style=""></label>

	      		<!-- <input type="hidden" name="receiver_ids" value="<?= $row['receiver_id']?>"> -->
	      		<?php 
	      			/* If receiver_id is the same as like me, then replace with sender_id */
	      			if( $row['sender_role'] == 'Admin' ){

	      				$sender = $row['sender_id'];
	      				$receiver = $row['receiver_id'];
	      			}
	      			else{

	      				$sender = $row['receiver_id'];
	      				$receiver = $row['sender_id'];
	      			}

	      			/*>> set the latest email*/
	      			$parent_id = isset($rows[ count($rows)-1 ]['id']) ? $rows[count($rows)-1]['id'] : $_GET['id'];
	      		?>
	      		<input type="hidden" name="receiver_ids" value="<?= $receiver?>">
	      		<input type="hidden" name="sender_id" 	 value="<?= $sender ?>">
	      		<input type="hidden" name="receiver_type" value="members">
	      		<input type="hidden" name="parent_id" 	 value="<?= $parent_id ?>">
	      		<input type="hidden" name="title" 		 value="<?= $row['subject'] ?>">

	      		<input type="file" id="my_file" style="display: none;" name="attached">
	                <script>
	                    $('#my_file').on('change', function(){
	                        $('#filenameshow').text(this.value.replace(/.*[\/\\]/, ''));
	                    });
	                </script>
	        	<div id="summernote"></div>
	            <input type="hidden" name="msg_contents">
	      	</div>

	      	<div class="text-right my-3" style="margin-top: 10px">
	          	<button type="submit" class="btn btn-primary px-4 cl-fff" name="submit"><i class="fas fa-paper-plane"></i>  SEND</button>
	      	</div>  
      	</form>          	
    </div>
	    </div>

	</div>   

</div>

</div>

</div>

<script src="https://cdn.ckeditor.com/4.11.3/standard/ckeditor.js"></script>
<script>
  CKEDITOR.replace( 'summernote' );
  $('#reply_preview_email').click(function(e){
  		$(this).css('display', 'none');
  		$('#reply_send_box').show();
  });
</script>
