<?php
    include_once('../libs/session.php');
    include_once('../classes/class.manageUsers.php');
    include_once('../classes/class.Messages.php');
	include_once('../classes/class.Posts.php');
	include_once('../inc/funcs.php');

    $userObj = new manageUsers();
    $messagesObj = new MessagesClass();
	$commentObj = new postsClass();

    if(login_user()==true){
        $get_info = $userObj->getUser($user_in);
        foreach($get_info as $info){
            $user_id = $info['id'];
        }  
    }
    
    if($_POST['action']=='msg_poll'){
        $getunreadMsg = $messagesObj->getTypeMessage($user_id,0);  
        if($getunreadMsg>0){
            foreach($getunreadMsg as $message){
                $date = $message['date'];
                $user_from_id = $message['user1'];
                $date = $message['date'];
                $msg_id = $message['id'];
                $getUser = $messagesObj->getUsername($user_from_id);
                $user_from_name = $messagesObj->username; 
                
                echo "
                <div id='not_msg'>
                <a href='msg.php?id=$msg_id'>
                    You have a message from $user_from_name
                </a></div><span class='main_hr'></span>
               ";
            }
        }else{
            echo "<div id='not_text'>You have no new message notifications</div>";
        }   
    }
	
	if($_POST['action']=='comments_poll'){
		$getCommentNot = $commentObj->getCommentsNoti($user_id,0);  
		if($getCommentNot>0){
			foreach($getCommentNot as $comment){
				$id = $comment['id'];
                $user_from = $comment['user_from'];
				$post_id = $comment['post_id'];
            	$date = time_ago($comment['date']); 
				$comment = $messagesObj->custom_echo($comment['comment'],20);
				
			
				$posts=$commentObj->getPostID($post_id);
				foreach($posts as $p){
					$post_title = $messagesObj->custom_echo($p['title'],23);
				}
                $getUser = $messagesObj->getUsername($user_from);
                $user_from_name = $messagesObj->username;
                echo "
                <div id='not_comment'>
                <a href='post.php?id=$post_id'>
                    $user_from_name commented on your post '$post_title'
                </a></div><span class='main_hr'></span>
               ";
            }
		}   
	}
	
	if($_POST['action']=='follow_poll'){
		$getfollowNot = $userObj->follow_notification($user_id);  
		if($getfollowNot>0){
			foreach($getfollowNot as $follow){
                $user1 = $follow['user1'];
				$user2 = $follow['user2'];
				$getUser = $messagesObj->getUsername($user1);
                $user1_name = $messagesObj->username; 
                echo "
                
                <div id='not_follow'><a href='$user1_name'>
                    $user1_name just followed you
                </a></div><span class='main_hr'></span>
               ";
            }
		}   
	}

	if($_POST['action']=='comment_poll'){
		global $post_id;
		$post_id = $_POST['post_id'];
		$comments=$commentObj->getComments($post_id);
		
		if($comments>0){
			foreach($comments as $comment){
				$id = $comment['id'];
				$comment_text = $comment['comment'];
				$date = time_ago($comment['date']);
				$user_from =$comment['user_from'];
				$userObj->updateFeild('comments','notification',1,'id',$id,'user_post',$user_id);
				$profile_pic=$userObj->user_profile_fetch($user_from);
				$getUser = $messagesObj->getUsername($user_from);
                $user_from_name = $messagesObj->username; 
				echo "
				<div style='margin-bottom:18px;'>
				<img src='$profile_pic' style='width:30px height:30px; float:left'><span class='main_hr'></span><a href='$user_from_name'><span class='username'>$user_from_name</span></a>    $comment_text
				</br><span style='font-size:0.8em;'>$date</span></br>
				</div>
				";
			}
		}else{
			echo 'No comments yet';
		}
	}

   if($_POST['action']=='notification_number'){
       $getunreadMsg = $messagesObj->getTypeMessage($user_id,0);
	   $getCommentNot = $commentObj->getCommentsNoti($user_id,0);  
       echo $messagesObj->unread_msg_count+$commentObj->comments_count;
   }
	


?>