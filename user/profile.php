<?php
session_start();
if (isset( $_SESSION['user_id'] ) ) {?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>NCCAA</title>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
<link rel="stylesheet" href="../style.css">
</head>
	
<body>
<div id="wrapper">
  <header id="header">
		<div class="container">
        	 <div class="logo"><a href="#"><img src="../images/logo.png" alt=""/></a></div>
             <h2>National Commission for Certification of Anesthesiologist Assistants</h2>
        </div> 
  </header><!--close header--> 
  
  <div id="content">
  	   <div class="content-inner">
       	    <h1>CAA MEMBER PROFILE</h1>
              <form class="modal-content animate" action="login-process.php" method="POST">
            <div class="form-sec">
            	 <div class="form-row">
                     <label>Set Your New Password</label>
                     <input type="password" class="form-input" "***********" name="newpsw">
                 </div>
                 <div class="form-row">
                     <label>Confirm Password</label>
                     <input type="password" class="form-input <?php if(isset($_SESSION['pwd_error'])) { ?>error-field<?php } ?>" "***********" name="confpsw">
                     
                     <?php if(isset($_SESSION['pwd_error'])) : ?>
        <span class="error-msg">
            <?= $_SESSION['pwd_error'] ?>
            <?php unset($_SESSION['pwd_error']); ?>
        </span>
    <?php endif; ?>
                 </div>                 
                 
                 <div class="submit-row" id="signin_btn">
                     <input type="submit" name="reset_pwd" class="form-submit" value="Sign in to your account">
                 </div>
            </div>
        </form>
            
            <div class="footer">
            	 <ul>
                 	<li><a href="#">Conditions of Use</a></li>
                    <li><a href="#">Privacy Notice</a></li>
                    <li><a href="#">Help</a></li>
                 </ul>
            </div>
       </div>
  </div><!--close content--> 
  
  
  
</div><!--close wrapper--> 

<script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
<script>
	jQuery(document).ready(function(e) {
		jQuery('#forgot_pass').hide();
        jQuery('#forgot_btn').click(function(e) {
			e.preventDefault();
            jQuery('#forgot_pass').slideToggle('fast');
			jQuery('#signin_btn').toggleClass('hideme');
			jQuery('#forgot_btn').toggleClass('active');
        });
    });
</script>
	
</body>
</html>
<?php }else{
    
header("location: ../index.php");

} ?>