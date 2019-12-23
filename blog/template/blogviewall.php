<?php
//include_once 'blog/classes/blog.class.php';
//$blog = new BlogObject;

global $blog;

?><style>.author-photo{	border-radius:50%;}</style>
<div class="tab-content" id="myTabContent">
	<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
		<div class="blog-main block-border ncca-right-padding">
			<?php echo $blog->output_list(  ); ?>
		</div>
	</div>     
</div>