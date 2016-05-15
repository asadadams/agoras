<title>Users</title>
<?php
	$active_tab_users='1';
    include_once('inc/header.php');
	
    $userObj = new manageUsers();
    if(login_user()==true){
        $get_info = $userObj->getUser($user_in);
        foreach($get_info as $info){
            $user_id = $info['id'];
        }
        
    }else{
		$user_id = '';
	}
?>          </br>
            <!--Main Body-->
            <div class='container12'>
				<h2>Users</h2>
                <div class='column8' style='border:1px solid #e8eaec;margin-top:10px;'>
                	 <?php
						$allusers=$userObj->getAllUsers();	
						foreach($allusers as $user){
							$id= $user['id'];
							$username = $user['username'];
							$email = $user['email'];
							$profile_pic=$userObj->user_profile_fetch($id);
							$follow_status=$userObj->follow_status($user_id,$id);
							if($follow_status>0){
								$btn_value = '-unfollow';
							}else{
								$btn_value = '+follow';
							}
								if($id==$user_id){
									echo "
										<div  class='member' >
											<img src='$profile_pic' style='float:left;'>
											</br><a href='$username'><span class='username'>$username</span> </a>
											<span style='float:center'>[$email]</span>
											<span style='float:right;margin-right:10px;'>This is you</span>                        
                                		</div>
									";
								}else{
								echo "
									<div  class='member' >
                                        <img src='$profile_pic' style='float:left;'>
                                    	</br><a href='$username'><span class='username'>$username</span> </a>
										<span style='float:center'>[$email]</span>
										";
										if(login_user()==true){
											echo "<input type='button' class='btn-follow float_right' user1='$user_id' user2='$id' class='btn-follow' style='margin-right:10px;' value='$btn_value'>  ";
										}    
										echo "
                                	</div>
									
								";
								}
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
