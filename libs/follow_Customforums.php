<?php
    include_once('../libs/session.php');
    include_once('../classes/class.Forum.php');
    login_user(); 
  
	$forumObj = new ForumsClass();

 

    if(isset($_POST['user']) && isset($_POST['forum_id'])){
		$user = $_POST['user'];
		$forum_id = $_POST['forum_id'];
		if($forumObj->follow_status1($user,$forum_id)>0){
			echo "+follow";
			$forumObj->follow1($user,$forum_id);
		}else{
			echo "-unfollow";
			$forumObj->follow1($user,$forum_id);
		}
		
    }
?>