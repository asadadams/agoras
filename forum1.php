<?php
    include_once('inc/header.php'); 
    $id=$_GET['id'];
    $postObj = new postsClass();  
	$forumObj = new ForumsClass();
	$user_info = new manageUsers();
	$messagesObj = new MessagesClass();
	 if(login_user()==true){
        $get_info = $user_info->getUser($user_in);
        foreach($get_info as $info){
            $user_id = $info['id'];
        }   
    }
	$forum=$forumObj->customForums($id);
	foreach($forum as $forum){
		$forum_id = $forum['id'];
		$created_by = $forum['created_by'];
		$forum_name = $forum['forum_name'];
		$description = $forum['description'];
		$getUser = $messagesObj->getUsername($user_id);
        $creator = $messagesObj->username;
	}
?>   
            
            
                <!--Main Body-->
            <div class="container12 main">
                <div class="column6 posts" style='border:1px solid #e8eaec; padding:20px;'>
                    <div class='forum_header' align='center'>
                        <h2>/<?php echo $forum_name;?> forum </h2>
                    </div>
                	<?php
						$forum_posts=$postObj->getForumPosts($forum_name);
						if($forum_posts==0){
							echo "
								<div  class='member' style='font-size:0.9em; padding:30px; text-align:center;'>
									No Posts to this forum at the moment
								</div>
							";
						}else{
							posts($forum_posts,$user_info,$postObj,$user_id,1);	
						}
					?>
                </div>
                
                
                <div class="column3 ">
                    <div class='aside' style="margin-top:25px;">
						<div class='aside_head' style='background-color:white;'>
							<?php
								echo $forum_name; 
								if($created_by!=$user_id){
									$follow_status=$forumObj->follow_status1($user_id,$forum_id);
									if($follow_status>0){
										$btn_value = '-unfollow';
									}else{
										$btn_value = '+follow';
									}
									echo "<input type='button' class='follow-custom-forum float_right' user='$user_id' forum_id='$forum_id' value='$btn_value'>";
								}else{
									echo "<span style='font-size:0.6em; float:right;'>CREATED BY YOU</span>";
								}
							?>
						</div>
						<div class='aside_body' style="font-size:0.9em; padding:10px;">
							<?php echo $description;?></br></br>
							<span style='font-size:1.0em;'>Admin:<a href='<?php echo $creator;?>'><?php echo $creator;?></a></span>
						</div>
                	</div>
					
					 <div class='aside' style="margin-top:25px;">
						<div class='aside_head' style='background-color:white;'>
							Members
						</div>
						<div class='aside_body' style="font-size:0.9em; padding:10px;">
							<?php
								$members=$forumObj->getUsersLimit($forum_id);
								if($members!=0){
									foreach($members as $member){
										$user = $member['user'];
										$getUser = $messagesObj->getUsername($user);
                                        $username = $messagesObj->username;
										$user_profile=$user_info->user_profile_fetch($user);
										echo "<a href='$username'><img src='$user_profile' class='members_pic'></a>";
									}	
									echo "</br><a href='connect.php?type=forum_members&id=$forum_id'>See all members →</a> ";
								}else{
									echo "No members at the moment";
								}
							?>	
						</div>
                	</div>
                </div>
            </div>
            <!--Main Body-->               

    
            </div>
        </div>
        
        <?php include_once('inc/footer.php');?>  
    </body>

</html>
