<?php
//include_once 'blog/classes/blog.class.php';
//$blog = new BlogObject;

global $blog;

?><style>a.morelink {		text-decoration:none;	outline: none;	}.morecontent span {		display: none;}</style>

<div class="tab-content" id="myTabContent">
	<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
		<div class="blog-main block-border ncca-right-padding">
			<?php echo $blog->output_list(  ); ?>
		</div>
	</div>     
</div><script>$(document).ready(function() {	var showChar = 380;	var ellipsestext = "... ";	var moretext = "Read More";	var lesstext = "Read Less";	$('.more').each(function() {		var content = $(this).html();		if(content.length > showChar) {			var c = content.substr(0, showChar);			var h = content.substr(showChar-1, content.length - showChar);			var html = c + '<span class="moreelipses">'+ellipsestext+'</span>&nbsp;<span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">'+moretext+'</a></span>';			$(this).html(html);		}	});	$(".morelink").click(function(){		if($(this).hasClass("less")) {			$(this).removeClass("less");			$(this).html(moretext);		} else {			$(this).addClass("less");			$(this).html(lesstext);		}		$(this).parent().prev().toggle();		$(this).prev().toggle();		return false;	});});</script>