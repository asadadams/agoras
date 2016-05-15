<?php
    include_once('../libs/session.php');
    include_once('../classes/class.manageUsers.php');
    include_once('../classes/class.Messages.php');
    login_user(); 
    $userObj = new manageUsers();
    $messageObj = new MessagesClass();



    if(isset($_POST['to']) && isset($_POST['title']) && isset($_POST['message'])){
        $to = strip_tags(trim($_POST['to']));
        $title = strip_tags(trim($_POST['title']));
        $message = strip_tags(trim( $_POST['message']));
        $date = date('Y-m-d H:i:s');
        
        if(!empty($to) && !empty($title) && !empty($message)){
            $check_user_availability = $userObj->getUser($to);
            $getUserin_info = $userObj->getUser($user_in);
            if($check_user_availability){
                if($to!=$user_in){    
                    foreach($check_user_availability as $info){
                        $user2id = $info['id'];
                    } 
                    foreach($getUserin_info as $info){
                        $user1id = $info['id'];
                    } 
                    $messageObj->createMessage($user1id,$user2id,$title,$message,$date);
                    echo "<div class='success'>Your message have been sent successfully</div>";
                }else{
                    echo "<div class='error'>You can't send a message to yourself</div>";
                }
            }else{
                echo "<div class='error'>The user you are sending the message to doesn't exist</div>";
            }
        }else{
            echo "<div class='error'>All fields are required</div>";
        }
    }
?>