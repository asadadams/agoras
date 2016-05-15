<title>Messages</title>
<?php
    include_once('inc/header.php'); 
    $userObj = new manageUsers();
    $messagesObj = new MessagesClass();
    if(login_user()==true){
        $get_info = $userObj->getUser($user_in);
        foreach($get_info as $info){
            $user_id = $info['id'];
        }  
    }else{
        header('location:error405');
    }
?>   
            <h1>Messages</h1></br>
            <!--Main Body-->
            <div class='container12'>
                <div class='column8'>
                    
                <div id='tabs'>
                 <ul>
                    <li><a href='#inbox'>Inbox</a></li>
                    <li><a href="#sent_msgs">Sent</a></li>
                    <li><a href="#private_msg">Send a private message</a></li>
                </ul>
                <div id='inbox'>
                    <ul id="tabs">
                        <li class="active">all</li>
                        <li>read</li>
                        <li>unread</li>
                    </ul>
                    <ul id="tab">
                        <li class="active">    
                            <?php
                                $getAll = $messagesObj->getAllMessage($user_id);   
                                if($getAll!=0){
                                    foreach($getAll as $message){
                                        $msg_id = $title = $message['title'];
                                        $title = $message['title'];
                                        $msg = $messagesObj->custom_echo($message['message'],60);
                                        $date = $message['date'];
                                        $date = $message['date'];
                                        $msg_id = $message['id'];
                                        $id = $message['user1'];
                                        $user2 = $message['user2'];
                                        
                                        $profile_pic=$userObj->user_profile_fetch($id);
                                        $getUser = $messagesObj->getUsername($id);
                                        $user1name = $messagesObj->username;
                                    echo "
                                        <a href='msg.php?id=$msg_id'>
                                            <div  class='themsg' >
                                                <img src='$profile_pic' style='float:left;'>
                                                </br><span class='username'>$user1name</span></br><b>$title</b> - $msg</br><div class='msg_options'>Sent ";echo time_ago($date);echo"<a href='#' message_id='$msg_id' user1='$id' user2='$user2' class='delete_msg'><img src='img/delete.png'></a></div>
                                                <span class='main_hr'></span>
                                            </div>
                                        </a>
                                        <div id='del'></div>
                                    ";
                                    }
                                }else{
                                    echo "
                                <div class='about' style='font-size:1.1em; margin-top:20px; height:30px;'>
                                    <img src='img/msg.png' width='40' style='float:left; margin:0px; padding:0px;'>
                                     <div style='float:left;margin-left:3px; margin-top:5px;'>
                                     No messages
                                     </div>
                                </div>";
                                }
                            ?>   
                        </li>
                        
                        <li>
                            <?php
                                $getreadMsg = $messagesObj->getReadMsg($user_id);  
                                if($getreadMsg!=0){
                                    foreach($getreadMsg as $message){
                                        $title = $message['title'];
                                        $msg = $messagesObj->custom_echo($message['message'],60);
                                        $date = $message['date'];
                                        $id = $message['user1'];
                                        $date = $message['date'];
                                        
                                        $profile_pic='';
                                        $profile_pic=$userObj->user_profile_fetch($id);
                                        $getUser = $messagesObj->getUsername($id);
                                        $user1name = $messagesObj->username; 
                                    echo "
                                        <a href='msg.php?id=$msg_id'>
                                            <div  class='themsg' >
                                                <img src='$profile_pic' style='float:left;'>
                                                </br><span class='username'>$user1name</span></br><b>$title</b> - $msg</br><div class='msg_options'>Sent ";echo time_ago($date);echo"</div>
                                            <span class='main_hr'></span>
                                            </div>
                                        </a>
                                        <div id='del'></div>
                                    ";

                                    }
                                }else{
                                    echo "
                                    <div class='about' style='font-size:1.1em; margin-top:20px; height:30px;'>
                                        <img src='img/msg.png' width='40' style='float:left; margin:0px; padding:0px;'>
                                         <div style='float:left;margin-left:3px; margin-top:5px;'>
                                         No read messages
                                         </div>
                                    </div>";
                                }
                            ?> 
                        </li>
                        <li>
                          <?php
                                $getunreadMsg = $messagesObj->getTypeMessage($user_id,0);  
                                if($getunreadMsg!=0){
                                    foreach($getunreadMsg as $message){
                                        $title = $message['title'];
                                        $msg = $messagesObj->custom_echo($message['message'],60);
                                        $date = $message['date'];
                                        $id = $message['user1'];
                                        $date = $message['date'];
                                        $msg_id = $message['id'];
                                        
                                        $profile_pic='';
                                        $profile_pic=$userObj->user_profile_fetch($id);
                                        $getUser = $messagesObj->getUsername($id);
                                        $user1name = $messagesObj->username;    
                                    echo "
                                        <a href='msg.php?id=$msg_id'>
                                            <div  class='themsg' >
                                                <img src='$profile_pic' style='float:left;'>
                                                </br><span class='username'>$user1name</span></br><b>$title</b> - $msg</br><div class='msg_options'>Sent ";echo time_ago($date);echo"</div>
                                                <span class='main_hr'></span>    
                                            </div>
                                        </a>
                                        <div id='del'></div>
                                    ";

                                    }
                                }else{
                                echo "
                                 <div class='about' style='font-size:1.1em; margin-top:20px; height:30px;'>
                                    <img src='img/msg.png' width='40' style='float:left; margin:0px; padding:0px;'>
                                     <div style='float:left;margin-left:3px; margin-top:5px;'>
                                     No unread messages
                                     </div>
                                </div>";
                                }
                            ?> 
                        </li>
                    </ul>
             
                    </div>
                <div id='sent_msgs'>
                    <?php
                        $getSentMessage = $messagesObj->getSentMessage($user_id);  
                        if($getSentMessage!=0){
                            foreach($getSentMessage as $message){
                                $title = $message['title'];
                                $msg = $messagesObj->custom_echo($message['message'],60);
                                $date = $message['date'];
                                $msg_id = $message['id'];
                                $id = $message['user1'];
                                $user2 = $message['user2'];
                                $profile_pic=$userObj->user_profile_fetch($user2);
                                $getUser = $messagesObj->getUsername($user2);
                                $user1name = $messagesObj->username;   
                                echo"
                                    <a href='msg.php?id=$msg_id'>
                                            <div  class='themsg' >
                                                <img src='$profile_pic' style='float:left;'>
                                                </br>To: <span class='username'>$user1name</span></br><b>$title</b> - $msg</br><div class='msg_options'>";echo time_ago($date);echo"<a href='#' message_id='$msg_id' user1='$id' user2='$user2' class='delete_msg'><img src='img/delete.png'></a></div>
                                                <span class='main_hr'></span>    
                                            </div>
                                        </a>
                                        <div id='del'></div>
                                    ";
                            }
                        }else{
                            echo "
                                <div class='about' style='font-size:1.1em; margin-top:20px; height:30px;'>
                                    <img src='img/msg.png' width='40' style='float:left; margin:0px; padding:0px;'>
                                     <div style='float:left;margin-left:3px; margin-top:5px;'>
                                     No sent messages
                                     </div>
                                </div>";
                        }
                            ?>
                </div>
                <div id='private_msg'>
                    <div id='result' style='margin:0px;'></div>
                    <label for='to'>To</label>
                    <input type='text' class='medium-fld' id='to' placeholder="Person's username">
                    <div id="suggesstion-box"></div> 
                    </br></br>
                    <label for='title'>Title</label>
                    <input type='text' class='medium-fld' id='title' placeholder="Title of message">
                      </br></br>                   
                    <label for='title'>Message</label>
                    <textarea rows='9' cols='' id='message'></textarea>
                     </br></br>
                    <input type='button' value='Send' id='send' class="btn float_right">
                </div>
            </div>
                    
                </div>
                <div class='column4'>
                    <div class='aside notifications'>
							<div class='aside_head'>
								<a href='' class='badge1' data-badge='0'>Notifications</a>
							</div>
							<div id='notification_msg'><div id='not_text'>You have no new message notifications</div></div>
							<div id='notification_comment'></div>
                		</div>
                    
                </div>
            </div>
            <!--Main Body-->    
            </div>
        </div>
        <?php include_once('inc/footer.php');?>  
    </body>

</html>
