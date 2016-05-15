<title>Connect</title>
<?php
	$active_tab_users='1';
    include_once('inc/header.php');
	$messagesObj = new MessagesClass();
    $userObj = new manageUsers();
	$forumObj = new ForumsClass();
	$type=$_GET['type'];
	if($type=='followers'){
		$user_id=$_GET['id'];
		$top_title='Followers';
		$no_c='No followers.';
	}elseif($type=='following'){
		$user_id=$_GET['id'];
		$top_title='Following';
		$no_c='No following anyone at the moment.';
	}elseif($type='forum_members'){
		$forum_id=$_GET['id'];
		$user_id=$_GET['id'];
		$top_title='Members of this forum';
		$no_c='There is currently no one following this forum.';
	}else{
		header('location:error404');
	}
?>          </br>
            <!--Main Body-->
            <div class='container12'>
				<h2><?php echo $top_title;?></h2>
                <div class='column8' style='border:1px solid #e8eaec; margin-top:10px;'>
                	 <?php
						if($type=='followers'){
							$getConnect=$userObj->getFollowers($user_id);
						}elseif($type=='following'){
							$getConnect=$userObj->getFollowing($user_id);
						}elseif($type=='forum_members'){
							$getConnect=$forumObj->getAllUsers($forum_id);
						}
						if($getConnect!=0){
							foreach($getConnect as $user){
								
								if($type=='forum_members'){
									$user1=$user['user'];
								}else{
									$user1= $user['user1'];
								}
								$messagesObj->getUsername($user1);
								$username=$messagesObj->username;
								$profile_pic=$userObj->user_profile_fetch($user1);
								$follow_status=$userObj->follow_status($user_id,$user1);
								
								if($type=='following'){
									$user2= $user['user2'];	
									$messagesObj->getUsername($user2);
									$username=$messagesObj->username;
									$profile_pic=$userObj->user_profile_fetch($user2);
									$follow_status=$userObj->follow_status($user_id,$user2);
									$user1=$user2;
								}
								
								
								if($follow_status>0 ){
									$btn_value = '-unfollow';
								}else{
									$btn_value = '+follow';
								}
									echo "
										<div  class='member' >
											<img src='$profile_pic' style='float:left;'>
											</br><a href='$username'><span class='username'>$username</span> </a>";
										?>
											<?php
												if(login_user()==true){
													echo "<input type='button' class='btn-follow float_right' user1='$user_id' user2='$user1' class='btn-follow' style='margin-right:10px;' value='$btn_value'>";
												}
										echo "
										</div>
									";
							}	
						}else{
							echo "
								<div  class='member' style='font-size:0.9em;'>
									<img src='img/invite.png' style='float:left; margin-left:0px;'><div style='padding:30px; text-align:center; float:left;'>$no_c<a href='#'>Invite a friend to join agoras</a></div>
								</div>
							";
						}
					?>
				</div>
				
         		
            </div>
            <!--Main Body-->    
            </div>
        </div>
        <?php include_once('inc/footer.php');?>  
    </body>

</html>
