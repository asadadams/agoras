setInterval(function(){
    $.post('poll/poll.php',{action:'msg_poll'},function(data){
        $('#notification_msg').html(data);
    })
	$.post('poll/poll.php',{action:'comments_poll'},function(data){
        $('#notification_comment').html(data);
    })
	$.post('poll/poll.php',{action:'follow_poll'},function(data){
        $('#notification_follow').html(data);
    })
     $.post('poll/poll.php',{action:'notification_number'},function(data){
        $('.badge1').attr('data-badge',data);
    })
},500);

//Showing a menu
     $('.Menu_show').click(function(e){
		e.preventDefault();
        $(this).closest('div').find('#thecomments').slideToggle();
		var btn = $(this);
		var post_id = $(this).attr('post_id');
		setInterval(function(){
			 $.post('poll/poll.php',{action:'comment_poll',post_id:post_id},function(data){
        		btn.closest('div').find('#thecomments').html(data);
    		})
		},100);
    });

function loadComments(){
	$('#thecomments').slideToggle();
	var post_id =$('.Menu_show').attr('post_id')
	setInterval(function(){
		$.post('poll/poll.php',{action:'comment_poll',post_id:post_id},function(data){
			$('.Menu_show').closest('div').find('#thecomments').html(data);
		})
	},100);
}


	 
