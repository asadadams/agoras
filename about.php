<title>About agoras</title>
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
				<h2>About Agoras</h2>
                <div class='column8'>
					
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
						<div style='padding:10px;'>
							Agoras is opened to discuss these forums at the moment:
							Television, Sports, Music, Science, Movies, Fashion, Maths, #KNUST, #UG. With agoras every user is given the ability to create his/her own forum for other users to follow.
						</div>
					</div>
					
					<div class='info_page'>
						<div style='padding:10px;'>
							By being a user you can follow your friends on agoras and get their posts to other forums directly on agoras homepage. You can also browse through your friend's profile. To get started <a href="signup.php?reg=1">signup</a> or <a href="signup.php?reg=0">login</a> if you are already having an 
							account
						</div>
					</div>
					
					<div class='info_page' style='background-color:#e8eaec'>
						<div style='padding:10px;'>
							One of the main vision of agoras was to make it open source so that every developer out there who wants to be part of agoras developer team can help out.For more information you can contact us on 
							(+233)0242928745 or email us on <a href='mailto:clarkpeace.adams@gmail.com'>clarkpeace.adams@gmail.com</a> </br></br>
							
							<b><i>All source codes can be found at:</i></b>
							<a href='https://www.github.com/asadadams'>www.github.com/asadadams</a> 
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
