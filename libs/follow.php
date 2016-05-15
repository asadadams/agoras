<?php
    include_once('../libs/session.php');
    include_once('../classes/class.manageUsers.php');
    login_user(); 
    $userObj = new manageUsers();

    $get_info = $userObj->getUser($user_in);
        foreach($get_info as $info){
        $user_id = $info['id'];
    } 

    if(isset($_POST['user1']) && isset($_POST['user2'])){
		$user1 = $_POST['user1'];
		$user2 = $_POST['user2'];
		if($userObj->follow_status($user1,$user2)>0){
			echo "+follow";
			$userObj->follow($user1,$user2);
		}else{
			echo "-unfollow";
			$userObj->follow($user1,$user2);
		}
		
    }
?>