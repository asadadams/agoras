<?php
    include_once('inc/header.php'); 
    $userObj = new manageUsers();
 	$postObj = new postsClass();

    $post_id = $_GET['id'];
    if(login_user()==true){
        $get_info = $userObj->getUser($user_in);
        foreach($get_info as $info){
            $user_id = $info['id'];
        }
        
    }
?>          <body onload='loadComments()'>
			</br>
            <!--Main Body-->
            <div class='container12' >
                <div class='column8'>
                    
					<?php
                         $post_val = $postObj->getPostID($post_id);
                        if($post_val){
                            foreach($post_val as $val){
								$post_id = $val['id'];
                                $userpost_id = $val['user_id'];
                                $title = $val['title'];
                                $text = $val['text'];
                                $forum = $val['forum'];
                                $username = $val['username'];
                                $date = time_ago($val['date']);
                                $get_Userinfo= $userObj->getUserInfo($userpost_id);
                                
                                
                                    foreach($get_Userinfo as $info){
                                        $profile_pic = $info['profile_pic'];
                                    }
                           
                                 
                                if($profile_pic==''){
                                    $profile_pic="img/default_profile.png";
                                }else{
                                    $profile_pic="userdata/profile_pic/".$profile_pic;
                                }
                                $user_profile=$userObj->user_profile_fetch(@$user_id);
								$posts_number=$postObj->usersPosts(@$user_id);
								$comments=$postObj->getComments($post_id);
								$comments_number = $postObj->comments_count;
                                echo "
                        <div class='post1'>
                            <div class='header'>
                                $title
                                <div class='top_info'>
                                    submitted by <a href='$username'>$username</a>
                                </div>
                            </div>
                            $text
                            
                            <div class='footer'>
                                <div id='user'>
                                    <img src='$profile_pic'>
                                    <div style='float:right; padding:3px;'>
                                        submitted by <a href='$username'>$username</a></br>
                                        $posts_number posts
                                  
                                    </div>
                                </div> 
                                submitted $date to <a href='forum.php?forum_name=$forum'>$forum</a></br></br>
                                
                            </div>
                        
							
							<div class='comments_area'>
								<a href='#' class='Menu_show' post_id='$post_id'>comment($comments_number)</a>
								<div id='thecomments'></div>
							</div>
						</div>
                        <div id='comment'>
                            <img src='$user_profile'>
                            <input type='text' class='comment_text' post_id='$post_id' user_post='$userpost_id' placeholder='Add a commment' style='width:580px;'><input type='button' value='Post' class='btn post_comment' style='margin-left:9px; height:30px; border-radius:0px;'>
                        	<div class='show_comment'></div>
						</div>
                            ";
                            }
                            
                        }
                    ?>
               
                </div>
				<?php
					if(login_user()==true){
						echo "
							 <div class='column4'>
								<div class='aside notifications'>
										<div class='aside_head'>
											<a href='' class='badge1' data-badge=''>Notifications</a>
										</div>
										<div id='notification_msg'></div>
										<div id='notification_comment'></div>
									</div>
                			</div>
						";		
					}
				?>
            </div>
            <!--Main Body-->    
            </div>
        </div>
        <?php include_once('inc/footer.php');?>  
    </body>

</html>
