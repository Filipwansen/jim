$(function(){
		$('.blog-like').click(function(){
		
		var post_id=$(this).data("postid");
		var user_id=$(this).data("userid");
		
		if($(this).hasClass("active")){
		    var data = { 'act':'setLikes', 'id':post_id, 'user_id':user_id, 'likes':'minus' };
				$(this).removeClass('active');
		}else{
		    var data = { 'act':'setLikes', 'id':post_id, 'user_id':user_id, 'likes':'plus' };
				$(this).addClass('active');
		}
		
		var url = api_path + "/blog/api.php";
		alert(url);return;
		$.ajax({
		    url: url, 
		    type: "GET",
		    dataType: 'json',
		    data: data,
		    success: function(res){
		        $(".blog-like").html(res + " Likes");
		    }
		});
		
	})
});
