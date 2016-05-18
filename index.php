<?php
    include_once('inc/header.php'); 
    $postObj = new postsClass();
    $user_info = new manageUsers();
	$forumObj = new ForumsClass();
    if(login_user()==true){
        $get_info = $user_info->getUser($user_in);
        foreach($get_info as $info){
            $user_id = $info['id'];
			$username = $info['username'];
			$user_email = $info['email'];
        }   
    }

    /*anny post*/
    if(!isset($_POST['post']) && !isset($_POST['captcha_text'])){
        $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789';
        $_SESSION['captcha']=substr(str_shuffle($chars),0,5);
    }else{
        $post=strip_tags(trim($_POST['post']));
        $captcha_text=strip_tags(trim($_POST['captcha_text']));
        $anny_error;
        if(!empty($post) && !empty($captcha_text)){
            if($captcha_text==$_SESSION['captcha']){
               $anny_error= 'ok';
            }else{
                $anny_error='You entered in a wrong text';
				$captcha_text='';  
            }
        }else{
            $anny_error= 'All fields are required';
        }
    }
?>   
            <div class="container12">
                <?php
					echo "
						<div  class='top_slider' >
							 You must be a user to post a comment.<a href='signup.php?reg=1'>Join now for free</a> or <a href='signup.php?reg=0'>already having an account</a>
						</div>		
					";
                    if(isset($user_in)){
                        $active_user =$user_info->userActive($user_in);
                        if(!$active_user){
                            $email = $user_info->email;
                            $id = $user_info->id;
                            $info_boxid="info_box$id";
							$email_service=after('@',$email);
                            echo "<span style='display:none;' id='box_id'>$info_boxid</span><div class='info' id='$info_boxid'><button id='close'>close</button>A confirmation email has been sent to your email address <a href='$email_service'>$email</a></div>";
                        }
                    }
                    
                ?>
            </div>
            <?php if(!login_user()==true){
            echo "
            <div class='container12 about'>
                <div class='column3'>
                       Agoras is an open platform containing various forums which gives you the power to discuss various topics
                        and issues</br></br>
                        Agoras is opened to discuss these forums at the moment:</br>
                        <ul>
                            <li><a href='forum.php?forum_name=television'>Television</a></li>
                            <li><a href='forum.php?forum_name=sports'>Sports</a></li>
                            <li><a href='forum.php?forum_name=music'>Music</a></li>
                            <li><a href='forum.php?forum_name=science'>Science</a></li>
                            <li><a href='forum.php?forum_name=movies'>Movies</a></li>
                            <li><a href='forum.php?forum_name=fashion'>Fashion</a></li>
                            <li><a href='forum.php?forum_name=maths'>Maths</a></li>
                            <li><a href='forum.php?forum_name=knust'>#KNUST</a></li>
                            <li><a href='forum.php?forum_name=ug'>#UG</a></li>
                        </ul></br></br>
                        To get started started click on SignUp or login if you are alreay having an account</br></br>
                        <a href='signup.php?reg=1'><input type='button' class='btn' name='' value='Signup'></a>
                </div>
                <p class='about_top'>You can use agoras to: </p>
                <div class='column3'>
                        <img src='img/post.png'>
                        <p>Post whatever is on your mind<p>
                </div>
                <div class='column3'>
                        <img src='img/discuss.png'>
                        <p>Discuss isues around you<p>
                </div>
                <div class='column3'>
                        <img src='img/learn.png'>
                        <p>Learn about things happening around you<p>
                </div>
                </div>
				
				<div style='margin:30px;' class='container12'>
				<div class='column7'>
					<div id='Description_element'>
						<img src='img/join_forum.png' style='float:left;'> 
						<span id='Description'><span id='inner_dscription'>Join a forum</span> and learn what's happening around you.</span>
					</div>
					</br>
					<div id='Description_element'>
						<img src='img/share.png' style='float:left;'> 
						<span id='Description'><span id='inner_dscription'>Post and share </span> with the world</span>
					</div></br>
					<div id='Description_element'>
						<img src='img/open_source.png' style='float:left;'> 
						<span id='Description'><span id='inner_dscription'>Agoras is open source</span> help us develop. <a href='https://www.github.com/asadadams'>github.com/asadadams</a> </span>
					</div>
					
				</div>
				<div class='column4'>
					<img src='img/preview.png'>
				</div>
				</div>
				
			<div class='slider'>
				<div class='btn-bar'>
  					<div id='buttons'>
						<a id='prev' href='#'>&lt;</a>
    					<a id='next' href='#'>&gt;</a>
  					</div>
				</div>


				<div id='slides'>
				  <ul>
					<li class='slide'>
						<div class='slideTitle'>
							<p class='slideTitleText'>Simple and easy to use</p>
        				</div>
						<div class='slideContainer'>
							<p class='slideText'>Agoras is very easy to use. Just register, follow forums and get posts to that forum directly on your homepage. You also have the ability to create your own forum.</p>
						</div>
					</li>
					<li class='slide'>
						<div class='slideTitle'>
							<p class='slideTitleText'>Help us to develop</p>
        				</div>
						<div class='slideContainer'>
							<p class='slideText'>If you are a developer and want to help in developing agoras is easy. All source code to agoras is open source, help us in developing agoras better. <a href='https://www.github.com/asadadams'>github.com/asadadams</a></p>
						</div>
					</li>
				  </ul>
  				</div>
			</div>
			</br>
			<div class='main_hr'></div>
			<img src='img/homePic2.png' >
			&nbsp &nbsp
			<img src='img/homePic1.png' >
			&nbsp &nbsp &nbsp &nbsp
			<img src='img/homePic3.png' >
				</br>
				";
                }
                ?>
                <!--Main Body-->
            <div class="container12 main">
				<?php
					if(login_user()==true){
					$followers=$user_info->followers_check($user_id);
					$following=$user_info->following_check($user_id);

					$getUserInfo = $user_info->getUserInfo($user_id);
					if($getUserInfo!=0){
						foreach($getUserInfo as $info){
							$profile_pic = $info['profile_pic'];
						}     
					}

					  if(@$profile_pic==''){
						$profile_pic="img/default_profile.png";
					  }else{
						$profile_pic="userdata/profile_pic/".$profile_pic;
					  }
				?>
               <div class='column3'>
				   <?php
				   		
							echo "
								<div class='profile_info' style='border:1px solid black; padding:8px; height:340px; border-radius:4px;'>
									<h1>$username</h1>
									<div id='profile_img' align='center'>
										<img src='$profile_pic' align='center'>
									</div>
									<div id='profile_element' >
										<span style='float:left'>Followers</span>
										<div id='profileElement_data' style='padding-left:26px;'>
											<a style='padding-left:28px;' href='connect.php?type=followers&id=$user_id'>$followers Followers</a>
										</div>
									</div>
								   </br>
									<div id='profile_element' >
										<span style='float:left'>Following</span>
										<div id='profileElement_data' style='padding-left:26px;'>
											<a style='padding-left:28px;' href='connect.php?type=following&id=$user_id'>$following Following</a>
										</div>
									</div>
									</br>
								</div>	
								
								<div style='margin-top:10px; border:1px solid black; border-radius:4px;'>
									<div class='aside_head'>
                        				Report a bug
                    				</div>
									<div style='padding:8px;'>
										<input type='text' id='bug' class='medium-fld' user='$user_email' placeholder='What problem are you experiencing' name='bug_content'>
										<button id='report' class='btn2' style='width:247px; margin-top:5px;'>Report a bug</button>
									</div>
								</div>
							";
						}
				   ?>
						</div>
                <div class="column6 posts"> 
					<?php
						/*If a user is logged in posts of users are displayed here*/
						if(login_user()==true){
							$following=$user_info->getFollowing(@$user_id);
							if($following==0){
								echo "
						<div style='margin:0px 0px 20px 0px; height:520px; font-size:0.9em;' class='about mobile-about'>
                            <h1>Welcome to agoras $user_in</h2>
                            <div style='float:left;margin-left:0px;margin-top:50px;'>
								<img src='img/inform1.png' style='float:left; padding-left:0px'>
                                <h2 style='color:#509fb6'>Follow a friend!</h2></br>
								You are currently not following anyone. <a href='#'>Search for a friend</a> or <a href='#'>invite a friend</a>.By following a friend
								you will get all posts from them.
                            </div>
							
							<div style='float:left;margin-top:50px;'>
								<img src='img/inform3.png' style='float:left; padding-left:0px'>
                                <h2 style='color:#509fb6'>Forums!</h2></br>
								With agoras you have the ability to create and follow other forums. <a href='#'>Look for a forum of interest</a> or <a href='#'>create one right away</a> 
                            </div>
							
							<div style='float:left;margin-top:50px;'>
								<img src='img/inform2.png' style='float:left; padding-left:0px'>
                               <h2 style='color:#509fb6'>Make your first post!</h2></br>
								Make your very first post to a forum of interest or post to your own forum by creating a forum....Simple!!!
                            </div>
                        </div>
								";
							}else{
								foreach($following as $follow){
									$User_following = $follow['user2'];
									$followers_post=$postObj->getFollowersPosts($User_following);
									
									posts($followers_post,$user_info,$postObj,$user_id,1);
								}
						}
						$forum_following=$forumObj->getForumFollowing($user_id);
						if($forum_following!=0){
						echo "
							<div style='background-color: #e8eaec; padding:10px; margin-bottom:15px;'>
								<h3>Posts from forums you are following</h3>
							</div>
						";
						
							foreach($forum_following as $forum){
								$forum_id = $forum['forum_id'];
								$forumObj->getforumname($forum_id);
								$forum_name=$forumObj->forum_name;
								$forum_posts=$postObj->getForumPosts($forum_name);
								
								posts($forum_posts,$user_info,$postObj,$user_id,1);
								
							}
						}
						?>
					Posts from other users in agoras default forums &#x25BC</br>
						<?php
							$post_val = $postObj->getPostsForLogin();
							posts($post_val,$user_info,$postObj,@$user_id,2);
						?>
						</div> 
						<?
						}else{
							/*Need modification*/
                   
                         	$post_val = $postObj->getPosts();
							echo "<div style='margin:30px;' class='container12'>";
		         			posts($post_val,$user_info,$postObj,@$user_id,0);
                 	echo "</div>";
						}
						
					?>
					
                
                
                <div class="column3 ">
                    
				<?php if(login_user()==true){
					echo "
						<div class='aside notifications' style='margin-top:30px;'>
							<div class='aside_head'>
								<a href='' class='badge1' data-badge='0'>Notifications</a>
							</div>
							<div id='notification_msg'><div id='not_text'>You have no new message notifications</div></div>
							<div id='notification_comment'></div>
							<div id='notification_follow'></div>
                		</div>	
					";
					echo "
					<div class='aside' style='margin-top:50px;'>
                    <div class='aside_head' style='background-color:white;'>
                        Custom Forums("; echo $forumObj->customForums_check($user_id); echo")
                    </div>
					<div class='aside_body'>
						<ul>
					";
							$forums=$forumObj->getUserForums($user_id);
							if($forums!=0){
								foreach($forums as $forum){
									$forum_name=$forum['forum_name'];
									$id=$forum['id'];
									echo"
										
											<li><a href='forum1.php?id=$id'>$forum_name</a></li>
										
									";
								}
							}else{
								echo 'You have not created any forums at the moment';
							}
					echo "
						</ul>
						<a href='createforum'><input type='button' class='btn2' value='Create a forum' style='margin:0px 0px 0px 0px; width:250px;'></a>
                    </div>
					</div>
					";
				}?>    
		<?php
			if(login_user()==true){
				echo "
					<div class='aside'>
                    			<div class='aside_head'>
                        			Agoras forums to follow
                    			</div>
                    			<div class='aside_body'>
                        		<ul>
				";
				$agoras_forums=$forumObj->agorasForums();	
							foreach($agoras_forums as $ag_forum){
								$forum_name = $ag_forum['forum_name'];
								$forum_id = $ag_forum['id'];
								
									$follow_status=$forumObj->follow_status($user_id,$forum_id);
									if($follow_status>0){
										$btn_value = '-unfollow';
									}else{
										$btn_value = '+follow';
									}
									$follow_btn="<input type='button' class='btn-follow-forum float_right' user='$user_id' forum_id='$forum_id' value='$btn_value'>";
								
								echo "
									<li><a href=''>$forum_name</a>$follow_btn</li></br>
								";
							}
			}else{

			}
		?>

                        </ul>
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
<?php };?>
