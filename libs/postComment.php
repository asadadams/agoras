<?php
    include_once('../libs/session.php');
    include_once('../classes/class.manageUsers.php');
    include_once('../classes/class.Posts.php');
    login_user(); 
    $userObj = new manageUsers();
    $commentObj = new postsClass();
	
	 $get_info = $userObj->getUser($user_in);
        foreach($get_info as $info){
        $user_id = $info['id'];
    } 

    if(isset($_POST['comment_text']) && isset($_POST['post_id'])){
        $comment_text = $_POST['comment_text'];
		$user_post = $_POST['user_post'];
        $post_id = $_POST['post_id'];
     	$date = date('Y-m-d H:i:s');
		if($user_post==$user_id){
			$notification=1;
		}else{
			$notification=0;
		}
		if(!empty($comment_text)){
			$commentObj->postComment($post_id,$user_post,$user_id,$comment_text,$date,$notification);
			echo 'Your comment was posted successfully';
		}else{
			echo 'Please enter what you would like to comment';
		}
    }
?>