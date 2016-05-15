<?php
	include_once('../libs/session.php');
    include_once('../classes/class.manageUsers.php');
    login_user(); 
    $userObj = new manageUsers();
	$get_info = $userObj->getUser($user_in);
    foreach($get_info as $info){
		$db_password = $info['password'];
    }

	

	if(isset($_POST['current_password']) && isset($_POST['new_password'])){
		$current_password=md5($_POST['current_password']);
		$new_password=$_POST['new_password'];
		$encrypt_newPassword=md5($new_password);
		if(!empty($current_password) && !empty($new_password)){
			if($db_password==$current_password){
				 if(strlen($new_password)<3 || strlen($new_password)>25){
                        echo "<span style='color:#D8000C;'>Password should be between 3 and 25 characters long</span>";
                   }else{
					$userObj->updatePassword($user_in,$encrypt_newPassword);
					 echo 'Your password have been successfully changed';
				 }
			}else{
				echo "<span style='color:#D8000C;'>Wrong current password</span>";
			}
		}else{
			echo "<span style='color:#D8000C;'>Please fill in all feilds</span>";
		}
	}
?>