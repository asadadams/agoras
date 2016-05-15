<title>Account</title>
<?php
    include_once('inc/header.php');
	$messagesObj = new MessagesClass();
    $userObj = new manageUsers();
	
    if(login_user()==true){
        $get_info = $userObj->getUser($user_in);
        foreach($get_info as $info){
            $user_id = $info['id'];
        }
    }else{
        header('location:error405');
    }
	
	$get_info = $userObj->getUser($user_in);
    foreach($get_info as $info){
        $username = $info['username'];
        $email = $info['email'];
        $status = $info['status'];
		$key = $info['hashkey'];
		$db_password = $info['password'];
		if($status==1){
			$status_detail ='Activated';
		}else{
			$status_detail ="Not activated  <a href='sendActivation.php?email=$email&user=$username&p=Secured&key=$key'>Resend activation email</a>";
		}
    }

	
?>          </br>
            <!--Main Body-->
            <div class='container12'>
				
                <div class='column8' style='border:1px solid #e8eaec; margin-top:10px; padding-bottom:7px;'>
                	 
								<div  class='member' style='font-size:0.9em;'>
									<img src='img/account.png' style='float:left; margin-left:0px;'><div style='padding:14px; text-align:center; float:left;'><h1>Account Settings</h1></div>
									
								</div>
								</br>
								
								<div class='' style='margin-bottom:10px;'>
									<div class='column2'>
										Email
									</div>

									<div class='column5'>
										<b><?php echo $email;?></b></br> <a href='#' id='change_email'>Change email</a>
										<div id='changer_email'>
											<input type='email' class='medium-fld medium-fld2' id='new_email' style='width:320px;'><input type='submit' id='save_email' class='btn-save' value='Save'>
											<div id='email_feedback' style='margin:4px;'><span style='font-size:0.8em'>Please note that you use your email in loging into your account</span></div>
										</div>
									</div>
		
								</div></br></br></br></br><span class='main_hr'></span></br>
								
								<div class='' style='margin-bottom:10px;'>
									<div class='column2'>
										Password
									</div>

									<div class='column5'>
										<a href='#' id='change_password'>Change password</a>
										<div id='changers'>
											<input type='password' placeholder='Enter in the current password' class='medium-fld medium-fld2' id='current_password' style='width:320px;'></br>
											<input type='password' placeholder='Enter in a new password' class='medium-fld medium-fld2' id='new_password' style='width:320px;'><input type='submit' id='save_password' class='btn-save' value='Save'>
										</div>
										<div id='password_feedback' style='margin:4px;'></div>
									</div>
		
								</div></br></br></br></br><span class='main_hr'></span></br>
								
								<div class='' style='margin-bottom:10px;'>
									<div class='column2'>
										Account status
									</div>

									<div class='column3'>
										<b><?php echo $status_detail;?></b>
									</div>
								</div>
<a href='logout.php'><input type='button' class='btn2' value='Logout' style='margin:80px 0px 0px 200px;'></a>
				</div>
         		
            </div>
            <!--Main Body-->    
            </div>
        </div>
        <?php include_once('inc/footer.php');?>  
    </body>

</html>
