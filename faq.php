<title>FAQ'S</title>
<?php
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
				<h2>FAQ'S</h2>
                <div class='column8' >
					<div class='info_page'>
						<div class='aside_head'>
							What is agoras?
						</div>
						<div style='padding:10px;'>
							Agoras is an open platform containing various forums which gives you the power to discuss various topics and issues. Agoras is an open source
							platform created with the goal of helping the general public in sharing their ideas and connecting with individuals with the same idealogy through forums.
						</div>
					</div>
					
					<div class='info_page'>
						<div class='aside_head'>
							How do i upload a profile pic
						</div>
						<div style='padding:10px;'>
							When you are logged into your account click on your user name on top of the website. This will open your profile page where you
							can change your profile pic and basic information about you.
						</div>
					</div>
                	
					<div class='info_page'>
						<div class='aside_head'>
							I didn't receive a verification email
						</div>
						<div style='padding:10px;'>
							When logged in you can report any bug you notice. A report a bug form can be found on the right side if you log in
						</div>
					</div>
					
					<div class='info_page'>
						<div class='aside_head'>
							How do i report bugs
						</div>
						<div style='padding:10px;'>
							After registering an email is always sent to the email used for registering. If you dont see the email in your inbox check your spam folder for the email.
							You can also resend email by going to account settings on your profile page.
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
