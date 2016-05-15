<title>Search</title>
<?php
    include_once('inc/header.php');
	if(isset($_GET['keyword'])){
		$keyword=strip_tags(trim($_GET['keyword']));
		if(!empty($keyword)){
			
		}else{
			echo "Please type in what you would like to search ";
		}
	}
    $userObj = new manageUsers();
	$forumsObj = new ForumsClass();
    if(login_user()==true){
        $get_info = $userObj->getUser($user_in);
        foreach($get_info as $info){
            $user_id = $info['id'];
        }   
    }

    
?>          </br>
            <!--Main Body-->
            <div class='container12'>
				<h2>Search results for "<?php echo $keyword;?>"</h2>
                <div class='column8' style='border:1px solid #e8eaec;margin-top:10px;'>
                	<div id='tabs'>
                        <ul>
                            <li><a href="#users">Users</a></li>
							<li><a href="#forums">Forums</a></li>
                        </ul>
						
						<div id='users'>
							<?php
										$return_name = $userObj->searchUsers($keyword);
										if($return_name!=0 && !empty($keyword)){
											foreach($return_name as $name){
												$name_returned = $name['username'];
												$profile_pic = $name['profile_pic'];

												if(@$profile_pic==''){
													$profile_pic="img/default_profile.png";
												}else{
														$profile_pic="userdata/profile_pic/".$profile_pic;
												}

												echo "
												<ul id='username-list'>
													<a href='$name_returned'><li><img src='$profile_pic' width='25' class='img-circle'><p style='margin-top:8px;'>$name_returned</p></li></a>     
												</ul>
												";
											}   
										}else{
											echo "Oops, Nothing found";
										}
							?>
						</div>
						<div id='forums'>
							<?php
										$return_forum=$forumsObj->searchForums($keyword);
										if($return_forum!=0 && !empty($keyword)){
											foreach($return_forum as $forum){
												$forum_name = $forum['forum_name'];
												echo "
												<ul id='username-list'>
													<a href='forum.php?forum_name=$forum_name'><li><p style='margin-top:8px;'>$forum_name</p></li></a>
												</ul>
												";
											}   
										}else{
											echo "Oops, Nothing found";
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
