<?php

    if(empty($_SESSION['user_id']) || $_SESSION['user_id'] == "")
    {
        header('Location: /logincaamember.php');
    }

    if(isset($_GET['act']) && $_GET['act'] == 'del'){

        $email->removeById($_GET['id']);
    }

    $result = $email->getAllAdmin();
?>

<div class="member-card card">

    <h3>EMAIL</h3>

    <div class="form-group">

        <div class="right">

            <a href="?content=../email/admin/AddNewEmail&li_class=Email" class="btn btn-primary">+ Compose New Message</a>

        </div>

        <div class="clearfix"></div>
        
    </div>


    <table id="viewAllEmailTbl" class="table table-striped table-bordered nowrap" style="width:100%">

        <thead>
          <tr>
            <th>From</th>
            <th>To</th>
            <th>Subject</th>
            <th>Date</th>
            <th>Actions</th>
          </tr>
        </thead>

        <tbody>
    <?php foreach($result as $key=>$row){?>
        <tr style="<?php if($row['read'] == 0) echo 'background-color: #dcdcdc;' ?>">
            <td><?= $row['sender_email']?></td>
            <td><?= $row['receiver_email']?></td>
            <td>
                <?php $rowContents = strlen($row['subject']) > 27 ? substr($row['subject'], 0, 27)."..." : $row['subject'];?>
                <a href="?content=../email/admin/PreviewEmail&li_class=Email&id=<?= $row['id'] ?>" title="<?= $row['subject']?>">
                    <?= $rowContents?> 
                </a>
            </td>
            <td style="width: 20%"><?= $row['regdate']; ?></td>
            <td class="text-center">
                <a href="?content=../email/admin/PreviewEmail&li_class=Email&act=edit&id=<?= $row['id'] ?>" title="View"> 
                  <span class="glyphicon glyphicon-eye-open"></span>
                </a>
                <!-- <a onclick="confirmDelete($(this)); return false;" href="?content=../email/admin/ViewAllEmail&li_class=Email&act=del&id=<?= $row['id'] ?>" title="Delete"> -->
                <a onclick="confirmDelete($(this)); return false;" href="?content=../email/admin/ViewAllEmail&li_class=Email&act=del&id=<?= $row['id'] ?>" title="Delete">
                    <span class="glyphicon glyphicon-trash"></span>
                </a>
            </td>
        </tr>
    <?php }?>
        </tbody>
    </table>
</div>
<?php 
if( isset($_SESSION["resultMSG"]['type']) ){ ?>
        
<script type="text/javascript">
$(document).ready(function() {
    jQuery.gritter.add({

        title: "<?php $_SESSION["resultMSG"]['type']==0 ? print('Notify!') : print('Success!')?>",

        text: "<?= $_SESSION["resultMSG"]['msg']?>",

        sticky: false,

        class_name: "<?php $_SESSION["resultMSG"]['type']==0 ? print('bg-error') : print('bg-success')?>",

        time: '3000'                

    });
})
</script>
<?php unset($_SESSION["resultMSG"]); ?>
<?php } ?>