<?php	
    if(isset($_GET["id"]) && $_GET["id"]){
    	// marked as readed 
        // $blastemail->updateReadById($_GET['id']);

        $row = $blastemail->getById($_GET['id']);

        // $rows = $blastemail->getAllChainsByid($_GET['id']);

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
    <h3>Blast Email View</h3>
    <a href="?content=../emailblast/admin/ViewAllBlastEmail&li_class=EmailBlast" class="backbtn"><span class="glyphicon glyphicon-chevron-left"></span>Back</a>
    
<div class="previewEmail" align="center">
	<div style="text-align: left; padding-left: 10px; padding-right: 10px;">
		<div>
			<label>Subject: </label><span> <?= $row['subject']?></span>	
		</div>

		<div>
			<label>From: </label><span> <?= $row['sender_email']?></span>
		</div>

		<div>
			<label>To: </label>
			<?php $rr = strlen($row['receiver_emails']) > 90 ? substr($row['receiver_emails'], 0, 90)."..." : $row['receiver_emails'];?>
			<?php
				$ToMails = explode(',', $row['receiver_emails']);
				count($ToMails);
			?>
			<span> <?= count($ToMails)?> User - </span>
			<span title="<?= trim($row['receiver_emails'])?>"><?= $rr ?></span>
		</div>

		<div>
			<label>CC: </label><span><?= $row['receiver_cc']?></span>
			<label style="margin-left: 10px">BCC: </label><span><?= $row['receiver_bcc']?></span>	
		</div>

	</div>
	<iframe src="../../member/emailblast/admin/Template.php?id=<?= $_GET["id"]?>" style="width: 640px; min-height: 1650px; border: none;"></iframe>
</div>

</div>

