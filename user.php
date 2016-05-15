<?php
	$profile_title=1;
    include_once('inc/header.php'); 
    $postObj = new postsClass();
    $userObj = new manageUsers();
 	$forumObj = new ForumsClass();

    $user=$_GET['user'];
    $check_user_availability = $userObj->getUser($user);
	$get_info = $userObj->getUser(@$user_in);
	if($get_info>0){
		foreach($get_info as $info){
    		$user_id = $info['id'];
     	}	
	}
    if(!$check_user_availability){
        header('location:error404');
    }
    $get_info = $userObj->getUser($user);
    foreach($get_info as $info){
        $id = $info['id'];
        $username = $info['username'];
        $email = $info['email'];
        $date_registered = $info['date'];
    }
	/*Clearing follow notification*/
	$userObj->clearFollow_Not($id,@$user_id);
    $getUserInfo = $userObj->getUserInfo($id);
    if($getUserInfo!=0){
        foreach($getUserInfo as $info){
            $twitter = $info['twitter'];
            $facebook = $info['facebook'];
            $website = $info['website'];
            $bio = $info['bio'];
            $location = $info['location'];
            $profile_pic = $info['profile_pic'];
            $mobile = $info['mobile'];
            $interested = $info['interested'];
        }     
    }
    
    $location =@$location;
    $facebook =@$facebook;
    $twitter =@$twitter;
    $website =@$website;
    $bio =@$bio;
    $mobile =@$mobile;


    if(@$profile_pic==''){
        $profile_pic="img/default_profile.png";
    }else{
        $profile_pic="userdata/profile_pic/".$profile_pic;
    }

    
    if(isset($_FILES['profilepic']['name'])){
        $name=$_FILES['profilepic']['name'];
        $size=$_FILES['profilepic']['size'];
        $type=$_FILES['profilepic']['type'];
        $ProfilePicerror;
        if(!empty($name)){
            if(($type=="image/jpeg") ||($type=="image/png")||($type=="image/gif")){
                if(($size < 5242880)){
                    $chars="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                    $rand_name=substr(str_shuffle($chars),0,10);
                    mkdir("userdata/profile_pic/$rand_name");
                    move_uploaded_file($_FILES['profilepic']['tmp_name'],"userdata/profile_pic/$rand_name/".$name);
                    $profilepic_name=$name;
                        $userObj->uploadProfilePic($id,$rand_name.'/'.$profilepic_name);
                        header("Location:$username");
                }else{
                   $ProfilePicerror='Your profile pic is greater than 5MB';
                }
            }else{
               $ProfilePicerror='Select an image ';
            }
        }else{
            $ProfilePicerror="Please choose a file";
        }
    }
?>			
			<body <?php if(login_user()==false){echo "onload='slideDown()'";}?> >
            <!--Main Body-->
            <div class="container12 main" style="border:1px solid #e8eaec;">
			<?php
					echo "
						<div  class='top_slider' >
							<span class='username'>$user</span> is on agoras.<a href='signup.php?reg=1'>Join now for free</a> or <a href='signup.php?reg=0'>already having an account</a>
						</div>		
					";
			?>
                <div class="column9 posts">
                    <?php 
						$followers=$userObj->followers_check($id);
						$following=$userObj->following_check($id);
						echo "
							<ul class='fllw'>
								<li><a href='connect.php?type=followers&id=$id'>Followers: $followers</a></li>
								<li><a href='connect.php?type=following&id=$id'>Following: $following</a></li>
							</ul>
						";
						
					$follow_status=$userObj->follow_status(@$user_id,$id);
					if($follow_status>0){
						$btn_value = '-unfollow';
					}else{
						$btn_value = '+follow';
					}
					if(@$user_id!=$id && login_user()==true){
						echo "
						<input type='button' class='btn-follow float_right' user1='$user_id' user2='$id' class='btn-follow' style='margin-right:60px;' value='$btn_value'>  
						";	
					}
                    if($bio!=''){
                        echo "
                        <div class='about' style='margin-top:30px;'>
                            <h1>Bio:</h1>
                            $bio
                        </div>
                    </br>
                        ";
                    }elseif(login_user()==true && $user_in==$username){
                        echo "
                            <div style='margin:0px 0px 0px 0px; height:120px; font-size:0.9em;' class='about'>
                            <img src='img/ss.png' style='float:left; padding-left:0px'>
                            <div style='float:left;margin-left:3px;'>
                                <h2 style='color:#509fb6'>Write a Bio!</h2></br>
                                You currently have no bio. Bio helps other users to know a little about you and this is a very essential part </br>
                                of agoras. Please do well to write a little about yourself. We have also given you the ability to format your</br> bio..Write a little about yourself, and also
                                provide us with your location to have a nice experience.
                            </div>
                        </div>
                      ";
                    }
                    
                    ?>    
                    <div id='tabs'>
                        <ul>
                            <?php if(login_user()==true && $user_in==$username){ echo "<li><a href='#editProfile'>Edit Profile</a></li>";}?>
                            <li><a href="#posts">Posts</a></li>
							<li><a href="#forums">Following forums</a></li>
                        </ul>
						<div id='forums'>
							<?php
									
								echo "<span style='font-size:0.8em;font-style:italic;'>Agoras default forums you are following &#x25BC</span></br>";
								
									$followed_Agorasforums = $forumObj->getFollowedForums($id);
									if($followed_Agorasforums!=0){
										foreach($followed_Agorasforums as $name){
											$forum_name = $name['forum_name'];
											echo "
											<ul id='username-list'>
												<a href='forum.php?forum_name=$forum_name'><li class='selected_forum'>$forum_name</p></li></a>
											</ul>
											";
										}   
									}else{
										echo "<div style='background-color:#dddddd;'>You are currently not following any agoras default forum</div>";
									}
							
							
								echo "</br><span style='font-size:0.8em;font-style:italic;'>Custom forums you are following &#x25BC</span></br>";
									$followed_Customforums = $forumObj->getFollowedCustomForums($id);
									if($followed_Customforums!=0){
										foreach($followed_Customforums as $name){
											$forum_name = $name['forum_name'];
											$forum_id = $name['id'];		
											echo "
											<ul id='username-list'>
												<a href='forum1.php?id=$forum_id'><li class='selected_forum'>$forum_name</p></li></a>
											</ul>
											";
										}   
									}else{
										echo "<div style='background-color:#dddddd;'>You are currently not following any forum created by another user</div>";
									}
							?>
							</div>
                        <div id='posts'>
                           <?php
								$User_posts=$postObj->getUserPosts($id);
								
								posts($User_posts,$userObj,$postObj,$id,1);
							?>
                        </div>
                        <?php  if(login_user()==true && $user_in==$username){ echo "
                        <div id='editProfile'>
                            <div class=''>
                                <div class='column3'>";
                                    if(isset($ProfilePicerror)){ echo "<div class='error' style='width:130px;'>$ProfilePicerror</div>";}
                                    echo "
                                    <div id='profile_img' style='width:190px;'>
                                        <img id='profile_pic' src='$profile_pic' align='center'>
                                    </div>
                                    <form action='$username' method='POST' enctype='multipart/form-data'>
                                        <input type='file' class='jfilestyle' accept='image/*' name='profilepic' data-input='false' data-buttonText='Choose picture'>
                                        <input type='submit' class='btn-trans' value='Upload picture'>
                                    </form>
                                  
                                </div>
                                
                                
                                   
                                    <label for='displayname'>Display name</label></br>
                                    <input type='text' value='$username' id='displayname' class='medium-fld edit-profile medium-fld2'>
                                    </br></br>
                                    <label for='location'>Location</label></br>
                                    <input type='text' id='location' placeholder='Add Location' value='$location' class='medium-fld edit-profile medium-fld2'>
                                    </br></br>
                                    <label for='mobile'>Mobile Phone</label></br>
                                    <input type='text' value='$mobile' placeholder='+233-xxx-xxx-xxx' id='mobile' class='medium-fld edit-profile medium-fld2'>
                                    </br></br>
                                   
                               
                            </div>
                            </br></br></br>
                            <div class='bio'>
                                About Me</br>
                                <textarea class='editor edit-profile' id='txtbio'>$bio</textarea>
                            </div>
                            <div style='margin-bottom:30px; margin-top:30px;'>
                                  Web</br></br>
                                  <div class='column2'>
                                  Twiiter username</br>
                                  <input type='text' id='twitter' value='$twitter' placeholder='@j.doe' class='twitter-fld social-fld edit-profile' >
                                  </div>
                                
                                  <div class='column2'style='margin-left:70px;'>
                                  Facebook link</br>
                                  <input type='text' id='facebook' placeholder='www.facebook.com/j.doe' value='$facebook' class='facebook-fld social-fld edit-profile'>
                                  </div>
                                  
                                  <div class='column2' style='margin-left:70px;'>
                                  Website link</br>
                                  <input type='text' id='website' placeholder='www.example.com' value='$website' class='website-fld social-fld edit-profile'>
                                  </div>
                                  
                            </div>
                            ";?>
							</br></br></br>                                       
                            Interested in</br>
                            <input type='text' class='medium-fld medium-fld2' id='interested' placeholder='What are you interested in?'><input type='button' id='save_interested' class='btn-small btn_mobile' value='Add'>
                            </br>
                            <div class='interested_box'>
                                <?php
                                    if(@$interested!=''){
                                        $interested_array=explode(',',$interested);
                                        foreach($interested_array as $element){
                                            echo "<div class='outer_box'><div style='float:left'>$element</div><a href='#' element='$element' class='remove_element'>Remove</a><span class='main_hr'></span></br></div>";
                                        }   
                                    }
                                ?>
                            </div>
                            </br></br></br>

                            <?php echo"
                            <input type='submit' class='btn float_right' id='save_profile' disabled value='Save changes' style='width:130px;'>
                        <div id='result'></div>  
                        </div>
                        ";
                        }
                        ?>

                    </div>

                </div>
                <div class="column3">
                    <div class='profile_info'>
						<?php

							$following_status=$userObj->follow_status($id,@$user_id);
							if($following_status>0){
								$following_text = 'FOLLOWS YOU';
							}
						?>
                        <h1><?php echo "$username"?> <?php if(isset($following_text)){echo "<span style='font-size:0.4em'>$following_text</span><span style='font-size:0.4em'>$following_text</span>";}?></h1>
                        <div id='profile_img' align='center'>
                            <img src='<?php echo $profile_pic?>' align='center'>
                        </div>
                        <div id='profile_element' >
                            <img src="img/email.png" style='float:left'>
                            <div style='float:left;'>
                                <?php echo $email;?>
                            </div>
                        </div>
                       </br>
                        <div id='profile_element' >
                            <img src="img/date.png" style='float:left'>
                            <div style='float:left;'>
                                member since <?php echo $date_registered;?>
                            </div>
                        </div>
                        </br>
                       </br></br>
					
                        <?php if(login_user()==true && $user_in==$username){
                                echo "
                        <div class='aside'>
                            <div class='aside_head'>
                                Menu
                            </div>
                                <div class='aside_body'>
                                    <ul>
                                        <a href='messages'><li>My Messages</li></a>
                                        <span class='main_hr'></span>
                                        <li><a href='account'>My Account</a></li>
                                    </ul>
                                </div>    
                        </div> ";
                         }?>
                         <div class='aside'>
                            <div class='aside_head'>
                                Connect
                            </div>
                            <div class='aside_body'>
                                <a href="<?php echo $facebook;?>" class="<?php if($facebook==''){echo 'display_none';}?>"><img src="img/web_fb.png" width='140'></a>
                                <a href="<?php echo $twitter;?>" class="<?php if($twitter==''){echo 'display_none';}?>"><img src="img/web_twitter.png"></a>
                                <a href="<?php echo 'mailto:'.$email;?>"><img src="img/web_email.png"></a>
                                <a href="<?php echo $website;?>" class="<?php if($website==''){echo 'display_none';}?>"><img src="img/web_website.png"></a>
                            </div>
                        </div>
                        </br>
                    </div>
   

				<?php
					if(login_user()==true){
						$forums_number = $forumObj->customForums_check($user_id);
						echo "
							<div class='aside' style='margin-top:50px;'>
                    <div class='aside_head' style='background-color:white;'>
                        Custom Forums($forums_number)
                    </div>
                    <div class='aside_body'>
						<ul>";
							$forums=$forumObj->getUserForums($user_id);
							if($forums!=0){
								foreach($forums as $forum){
									$forum_name=$forum['forum_name'];
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
					}
				?>
                </div>
                </div>
            </div>
            <!--Main Body-->    
            </div>
        </div>
        
        <?php include_once('inc/footer.php');?>  
    </body>

</html>
