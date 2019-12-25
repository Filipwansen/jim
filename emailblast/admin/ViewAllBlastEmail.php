<?php

    if(empty($_SESSION['user_id']) || $_SESSION['user_id'] == ""){

        header('Location: /logincaamember.php');
    }

    if(isset($_GET['act']) && $_GET['act'] == 'del'){

        $blastemail->removeById($_GET['id']);
    }

    $result = $blastemail->getAllBlastEmails();
?>

<div class="member-card card">

    <h3>ALL BLAST EMAIL</h3>

    <div class="form-group">
        <div class="right">
            <a href="?content=../emailblast/admin/AddNewBlastEmail&li_class=EmailBlast" class="btn btn-primary">+ Compose New Blast Email</a>
        </div>
        <div class="clearfix"></div>
    </div>

    <table id="viewAllEmailTbl" class="table table-striped table-bordered nowrap" style="width:100%">

        <thead>
          <tr>
            <th>From</th>
            <th>To</th>
            <th>Subject</th>
            <th>Send Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>            
    <?php foreach($result as $key=>$row){ ?>
        <tr>
            <td><?= $row['sender_email']?></td>
            <td>
                <?php $rr = strlen($row['receiver_emails']) > 30 ? substr($row['receiver_emails'], 0, 30)."..." : $row['receiver_emails'];?>
                <?= $rr?>                    
            </td>
            <td>
                <?php $rowContents = strlen($row['subject']) > 27 ? substr($row['subject'], 0, 27)."..." : $row['subject'];?>
                <a href="?content=../emailblast/admin/PreviewBlastEmail&li_class=EmailBlast&id=<?= $row['id'] ?>" title="<?= $row['subject']?>">
                    <?= $rowContents?> 
                </a>
            </td>
            <td ><?= date( 'Y-m-d H:i', strtotime($row['regdate']) ) ?></td>
            <td class="text-center">
                <a href="?content=../emailblast/admin/PreviewBlastEmail&li_class=EmailBlast&act=edit&id=<?= $row['id'] ?>" title="View"> 
                    <span class="glyphicon glyphicon-eye-open"></span>
                </a>
                <a onclick="confirmDelete($(this)); return false;" href="?content=../emailblast/admin/ViewAllBlastEmail&li_class=EmailBlast&act=del&id=<?= $row['id'] ?>" title="Delete">
                    <span class="glyphicon glyphicon-trash"></span>
                </a>
            </td>
        </tr>
    <?php }?>    
        </tbody>
    </table>
</div>
<?php 
if( isset($_SESSION["emailMSG"]['type']) ){ ?>
        
<script type="text/javascript">
$(document).ready(function() {
    jQuery.gritter.add({

        title: "<?php $_SESSION["emailMSG"]['type']==0 ? print('Notify!') : print('Success!')?>",

        text: "<?= $_SESSION["emailMSG"]['msg']?>",

        sticky: false,

        class_name: "<?php $_SESSION["emailMSG"]['type']==0 ? print('bg-error') : print('bg-success')?>",

        time: '5000'                

    });

});
</script>
<?php unset($_SESSION["emailMSG"]); ?>
<?php } ?>

<?php if( isset($_SESSION["resultMSG"]['type']) && $_SESSION["resultMSG"]['type']==1 ){ ?>
<script type="text/javascript">
$(document).ready(function() {
    jQuery.gritter.add({

        title: "Notify!",

        text: "<?= $_SESSION["resultMSG"]['msg']?>",

        sticky: false,

        class_name: "bg-error",

        time: '3000'                

    });
});
</script>
<?php unset($_SESSION["resultMSG"]); ?>
<?php } ?>