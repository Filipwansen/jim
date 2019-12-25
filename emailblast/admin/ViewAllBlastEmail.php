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

    <h3>BLAST EMAIL</h3>

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
            <th>Date</th>
            <th>Actions</th>
          </tr>
        </thead>

        <tbody>
    <!-- <?php foreach($result as $key=>$row){?>
        <tr style="<?php if($row['read'] == 0) echo 'background-color: #dcdcdc;' ?>">
            <td><?= $row['sender_email']?></td>
            <td><?= $row['receiver_email']?></td>
            <td>
                <?php $rowContents = strlen($row['subject']) > 27 ? substr($row['subject'], 0, 27)."..." : $row['subject'];?>
                <a href="?content=../emailblast/admin/PreviewBlastEmail&li_class=EmailBlast&id=<?= $row['id'] ?>" title="<?= $row['subject']?>">
                    <?= $rowContents?> 
                </a>
            </td>
            <td style="width: 20%"><?= $row['regdate']; ?></td>
            <td class="text-center">
                <a href="?content=../emailblast/admin/PreviewBlastEmail&li_class=EmailBlast&act=edit&id=<?= $row['id'] ?>" title="View"> 
                  <span class="glyphicon glyphicon-eye-open"></span>
                </a>
                <a onclick="confirmDelete($(this)); return false;" href="?content=../emailblast/admin/ViewAllEmail&li_class=EmailBlast&act=del&id=<?= $row['id'] ?>" title="Delete">
                    <span class="glyphicon glyphicon-trash"></span>
                </a>
            </td>
        </tr>
    <?php }?> -->
        <tr style="" role="row" class="odd">
            <td class="sorting_1">cynthia.m@nccaa.org</td>
            <td>danaburgio@gmail.com</td>
            <td>
                <a href="?content=../emailblast/admin/PreviewBlastEmail&amp;li_class=EmailBlast&amp;id=102" title="Test #2">
                    Test #2 
                </a>
            </td>
            <td style="width: 20%">2019-12-21 01:03:44</td>
            <td class="text-center">
                <a href="?content=../emailblast/admin/PreviewBlastEmail&amp;li_class=EmailBlast&amp;act=edit&amp;id=102" title="View"> 
                  <span class="glyphicon glyphicon-eye-open"></span>
                </a>
                <a onclick="confirmDelete($(this)); return false;" href="?content=../emailblast/admin/ViewAllEmail&amp;li_class=EmailBlast&amp;act=del&amp;id=102" title="Delete">
                    <span class="glyphicon glyphicon-trash"></span>
                </a>
            </td>
        </tr>
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