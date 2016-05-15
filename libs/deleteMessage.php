<?php
    include_once('../libs/session.php');
    include_once('../classes/class.manageUsers.php');
    include_once('../classes/class.Messages.php');
    login_user(); 
    $userObj = new manageUsers();
    $messageObj = new MessagesClass();

    $get_info = $userObj->getUser($user_in);
        foreach($get_info as $info){
        $user_id = $info['id'];
    } 

    if(isset($_POST['message_id']) && isset($_POST['user1']) && isset($_POST['user2'])){
        $message_id = $_POST['message_id'];
        $user1 = $_POST['user1'];
        $user2 = $_POST['user2'];
        $userToDelete='';
        $getMsg=$messageObj->getMessage($message_id);
        foreach($getMsg as $msg){
            $deletedby_receiver=$msg['deletedby_receiver'];
            $deletedby_sender=$msg['deletedby_sender'];
        }
        if($user_id==$user1){
            $messageObj->deleteMessage(1,$deletedby_receiver,$message_id);                                                     
        }
        if($user_id==$user2){
            $messageObj->deleteMessage($deletedby_sender,1,$message_id);
        }
		echo "<div class='error'>You just deleted a message</div>";   
    }
?>