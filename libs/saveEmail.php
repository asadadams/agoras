<?php
	include_once('../libs/session.php');
    include_once('../classes/class.manageUsers.php');
    login_user(); 
    $userObj = new manageUsers();
	

	

	if(isset($_POST['new_email'])){
		$new_email=$_POST['new_email'];
		if(!empty($new_email)){
			$checkEmailAvailablity = $userObj->checkEmailAvailable($new_email);
            if($checkEmailAvailablity){
            	echo "<span style='color:#D8000C;'>Email already have already been registered</span>";
            }else{
				$userObj->updateEmail($user_in,$new_email);
				echo "New email address: $new_email";
			}
		}else{
			echo "<span style='color:#D8000C;'>Enter in your email address</span>";
		}
	}
?>