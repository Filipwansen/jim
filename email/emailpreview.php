<?php 
    if($_SESSION['user_id'] == "" || empty($_SESSION['user_id'])){

        header('Location: ../logincaamember.php');
    }

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
<div class="ncca-right-block ">

    <div class="tab-content" id="myTabContent">

     <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

      <div class="block-border ncca-right-padding new_msg_style new_msg_style_2 ">

        <p class="midium-title title-bottom-border text-uppercase">Read Message</p>       

            <h5 class="fs-16 w-4 my-3 "><?= $row['subject']?></h5>

            <div class="row">

                <div class="col-md-8">

                    <h3 class="fs-14 mb-1 w-6"><span class="bld_cl">From:</span> <?= $row['sender_fullname']?> ( <?= $row['sender_email']?> )</h3>

                    <h3 class="fs-14 mb-1 w-6"><span class="bld_cl">To:</span> <span style="color:#969696;"><?= $row['receiver_fullname']?> ( <?= $row['receiver_email']?> )</span> </h3>

                </div>

                <div class="col-md-4">

                    <p class="fs-14 text-md-right" style="color:#969696;">
                        <?= substr( date('r', strtotime($row['regdate'])), 0, 22) ?>                        
                    </p>

                </div>

            </div>
            <hr>
            <?php foreach($rows as $key=>$r){?>
                <strong style="font-size: 10pt; background-color: #f0f0f0">
                    <i class="fa fa-pencil-alt"></i> <?= $r['sender_fullname']?> : <?= $r['regdate']?>
                </strong>
                <div class="email-msg" style="padding: 10px 0px 15px 0px">
                  <?= $r['content']?>

                <?php if($r['attach'] != ""){ ?>
                    <i class="fas fa-paperclip" style="color: #23527c"></i>
                    <a href="./upload/<?= $r['attach']?>" target="_blank" download><?= $r['attach']?></a>
                <?php } ?>

                </div>
                <hr style="margin-top: 0px;margin-bottom: 5px;">
            <?php }?>

            <div id="reply_preview_email">
                <div class="text-left my-3">
                   <a href="?content=content/emailviewall&item=emailpage" class="back_txt_color">&lt; Back</a>
                </div>

                <div class="reply text-right my-3">
                    <a href="javascript:void(0)" class="btn btn-outline-secondary my-5 px-3" id="reply_preview_email_btn">
                        <i class="fas fa-reply-all"></i>Reply
                    </a>
                </div>                
            </div>

            <div id="reply_send_box" style="display: none; padding-top: 20px">
                <form id="emailUserForm" action="./email/admin/emailproc.php" method="post" enctype="multipart/form-data"  autocomplete="off" >
                    <div>

                        <a onclick="$('#my_file').click();" class="btn btn-secondary w-6 mb-3" style="background-color: #e5e5e5; color:#000; border: 0; margin-bottom: 3px!important">
                            <i class="fas fa-paperclip"></i>
                            Attach Files
                        </a>&nbsp;<label id="filenameshow" style=""></label>
                        <?php 
                            /* If receiver_id is the same as like me, then replace with sender_id */
                            $receiver = $_SESSION['user_id'] == $row['sender_id'] ? $row['receiver_id'] : $row['sender_id'];

                            /*>> set the latest email*/
                            $parent_id = isset($rows[ count($rows)-1 ]['id']) ? $rows[count($rows)-1]['id'] : $_GET['id'];
                        ?>
                        <input type="hidden" name="receiver_ids" value="<?= $receiver?>">
                        <input type="hidden" name="sender_id" value="<?= $_SESSION['user_id']?>">
                        <input type="hidden" name="receiver_type" value="members">
                        <input type="hidden" name="parent_id" value="<?= $parent_id ?>">
                        <input type="hidden" name="title" value="<?= $row['subject'] ?>">
                        <input type="hidden" name="emailType" value="user">

                        <input type="file" id="my_file" style="display: none;" name="attached">
                            <script>
                                $('#my_file').on('change', function(){
                                    $('#filenameshow').text(this.value.replace(/.*[\/\\]/, ''));
                                });
                            </script>
                        <div id="summernote"></div>
                        <input type="hidden" name="msg_contents" required>
                    </div>

                    <div style="margin-top: 10px; text-align: right;">
                        <button type="submit" class="btn btn-primary px-4 cl-fff" name="submit"><i class="fas fa-paper-plane"></i>  SEND</button>
                    </div>  
                </form>             
            </div>

        </div>


    </div>   

  </div>

</div>

<script src="./admin/js/jquery.gritter.min.js"></script>
<link rel="stylesheet" href="./admin/css/jquery.gritter.css">
<script src="https://cdn.ckeditor.com/4.11.3/standard/ckeditor.js"></script>
<script>
  CKEDITOR.replace( 'summernote' );
  $('#reply_preview_email_btn').click(function(e){
        $('#reply_preview_email').css('display', 'none');
        $('#reply_send_box').show();
  });
</script>

<style type="text/css">
    .bg-error{
        background: rgba(183, 101, 101, 0.9);
        margin-top: 30px;
    }
</style>

<script type="text/javascript">
    /*==========>> Email send js script*/
    $('#emailUserForm').on('submit', function(e){
        var data = CKEDITOR.instances.summernote.getData();
        $('input[name="msg_contents"]').val(data.trim());
        var r_ids = $('input[name="receiver_ids"]').val();

        if( data.length <= 0 ){

            var msg = 'Please type the message contents.';
        }
        else if( r_ids.length <=0 ){

            var msg = 'Please Select the Receiver. <br> Please retry with another name.';
        }

        if (data.length <= 0 || r_ids.length <=0) {

            jQuery.gritter.add({

                title: 'Caution!',

                text: msg,

                sticky: false,

                class_name: 'bg-error',

                time: '3000'                

            });
            e.preventDefault();
            return;
        }

    });
</script>