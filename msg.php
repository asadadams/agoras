<?php
    include_once('inc/header.php'); 
    $userObj = new manageUsers();
    $messagesObj = new MessagesClass();
    $msg_id = $_GET['id'];
    if(login_user()==true){
        $get_info = $userObj->getUser($user_in);
        foreach($get_info as $info){
            $user_id = $info['id'];
        }
        
    }else{
        header('location:error404');
    }
?>          </br>
            <!--Main Body-->
            <div class='container12'>
                <div class='column8'>
                    
                    <?php
                        $getAll = $messagesObj->getMessage($msg_id);  
                        if($getAll!=0){
                        foreach($getAll as $message){
                            $title = $message['title'];
                            $msg = $message['message'];
                            $date = $message['date'];
                            $id = $message['user1'];
                            $user_2 = $message['user2'];
                            $date = $message['date'];
                            $msg_id = $message['id'];
                             
                            
                            if($user_id==$id){
                                    $id=$user_2;
                                    $header_msg="Message to ";
                                }else{
                                    $header_msg="Message from ";
                                    $messagesObj->readMessage($msg_id);
                                }
                            
                            $getUserInfo = $userObj->getUserInfo($id);
                            if($getUserInfo!=0){
                                foreach($getUserInfo as $info){
                                    $profile_pic = $info['profile_pic'];
                                }
                            }
                                $getUser = $messagesObj->getUsername($id);
                                $user1name = $messagesObj->username;
                                
                                if(@$profile_pic==''){
                                    $profile_pic="img/default_profile.png";
                                }else{
                                    $profile_pic="userdata/profile_pic/".$profile_pic;
                                }  
                                echo "        
                                        <div  class='message_body'>
                                            <img src='$profile_pic' style='float:left; width:50px;'>
                                             </br><b>$header_msg $user1name</b></br></br><span class='main_hr'></span></br></br>$msg</br>
                                             <span id='msg_footer'>Sent "; echo time_ago($date); echo"</span>
                                        </div>
                                        <div id='result' style='margin:0px;'></div>
                                        <span class='main_hr'></span>
                                    ";
                        }
                                }
                        ?>  
                <?php
                    if(@$profile_picin==''){
                        $profile_picin="img/default_profile.png";
                    }
                    $getUserSending = $userObj->getUserInfo($user_id);
                    if($getUserSending!=0){
                        foreach($getUserSending as $info){
                          $profile_picin = $info['profile_pic'];  
                            $profile_picin="userdata/profile_pic/".$profile_picin;
                        }
                    }
                ?>
                <div  class='reply' style='padding:0px;'>
                    <input type="hidden" id='user_replyto' value='<?php echo $user1name;?>'>
                    <input type="hidden" id='user_sending' value='<?php echo $user_id;?>'>
                    <input type="hidden" id='reply_title' value='Reply to: <?php echo $title;?> '>
                    <img src='<?php echo $profile_picin;?>' style='float:left;'>
                    </br><textarea rows='4' cols='1' placeholder='Message here' id='reply_msg'></textarea>
                    <input type='submit' value='send' id='replyMsg' class='btn' style='float:right;margin-top:15px;margin-right:10px;'>
                 </div>
                    
                </div>
                <div class='column4'>
                    sdfas
                </div>
            </div>
            <!--Main Body-->    
            </div>
        </div>
        <?php include_once('inc/footer.php');?>  
    </body>

</html>
