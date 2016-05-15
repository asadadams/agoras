<title>Create a post</title>
<?php
	$active_tab_submit = '1';
    include_once('inc/header.php');
	$forumObj = new ForumsClass();
    $userObj = new manageUsers();
	$postObj = new postsClass();
    if(login_user()==true){
        $get_info = $userObj->getUser($user_in);
        foreach($get_info as $info){
            $user_id = $info['id'];
        }
        
    }else{
        header('location:error405');
    }
	/*User post*/
    if(isset($_POST['user_post']) && isset($_POST['forum_name']) && isset($_POST['title'])){
        $user_post= strip_tags($_POST['user_post']);
        $title = strip_tags($_POST['title']);
        $forum_name= strip_tags($_POST['forum_name']);
        $date = date('Y-m-d');
        if(!empty($user_post) && !empty($forum_name) && !empty($title)){
        	echo "<div class='success'>Your text has been successfuly posted</div>";
        	$postObj->createPost($user_id,$user_in,$title,$user_post,$forum_name,$date);
        }else{
            echo  "<div class='error'>All feild are requireed</div>";
        }
    }
?>          </br>
            <!--Main Body-->
				<h3>Submit a post</h3>
         		<div class="container12 main" style="border:1px solid #e8eaec; padding-bottom:15px;">
					<div class='column6'>
					 <form action='submit.php' method='POST'>
						 <div class='post_element'>
							 <h3>Title</h3></br>
                        	<input type='text' class='medium-fld' placeholder='Title' name='title'>
						 </div>
						 <div class='post_element'>
							 <h3>Text</h3>
                        	<textarea class='txtarea-fld' rows='5' cols='42' spellcheck='false' name='user_post' placeholder='Speak your mind'></textarea></br>
						</div>
						
						<div class='post_element'>
							<h3>Post to</h3></br>
                        	<input type='text' class='medium-fld' style='background-color:#dddddd;' placeholder='Select from below the forums you have followed' name='forum_name' id='forum_to' readonly>
							<div id="suggesstion-box">
								<span style='font-size:0.8em;font-style:italic;'>Agoras default forums you are following &#x25BC</span></br>
								<?php
									$followed_Agorasforums = $forumObj->getFollowedForums($user_id);
									if($followed_Agorasforums!=0){
										foreach($followed_Agorasforums as $name){
											$forum_name = $name['forum_name'];

											echo "
											<ul id='username-list'>
												<li class='selected_forum'>$forum_name</p></li>
											</ul>
											";
										}   
									}else{
										echo "<div style='background-color:#dddddd;'>You are currently not following any forum of agoras default forums</div>";
									}
									
									echo "</br><span style='font-size:0.8em;font-style:italic;'>Custom forums you are following &#x25BC</span></br>";
									$followed_Customforums = $forumObj->getFollowedCustomForums($user_id);
									if($followed_Customforums!=0){
										foreach($followed_Customforums as $name){
											$forum_name = $name['forum_name'];

											echo "
											<ul id='username-list'>
												<li class='selected_forum'>$forum_name</p></li>
											</ul>
											";
										}   
									}else{
										echo "<div style='background-color:#dddddd;'>You are currently not following any forum created by another user</div>";
									}
				
								?>
							</div> 
						 </div>
						
                        <input type='submit' class='btn-post1' value='Submit this text post >>'>
                        </form>
					
					</div>
					</br></br>
				</div>
            <!--Main Body-->    
            </div>
        </div>
        <?php include_once('inc/footer.php');?>  
    </body>

</html>
