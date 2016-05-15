<?php
    include_once('../libs/session.php');
    include_once('../classes/class.manageUsers.php');
    login_user(); 
    $userObj = new manageUsers();
   
  
    
    if(isset($_POST['bio']) && isset($_POST['displayname']) && isset($_POST['location']) && isset($_POST['twitter']) && isset($_POST['facebook'])&& isset($_POST['website'])&& isset($_POST['mobile'])){
        $bio = $_POST['bio'];
        $displayname = strip_tags(trim($_POST['displayname']));
        $location = strip_tags(trim($_POST['location']));
        $twitter = strip_tags(trim($_POST['twitter']));
        $facebook = strip_tags(trim($_POST['facebook']));
        $website = strip_tags(trim($_POST['website']));
        $mobile = strip_tags(trim($_POST['mobile']));
        if(!empty($displayname)){
             $get_info = $userObj->getUser($user_in);
            foreach($get_info as $info){
                $id = $info['id'];
                $userObj->editProfile($displayname,$id);
                $userObj-> updateUserInfo($id,$bio,$location,$twitter,$facebook,$mobile,$website);
                $_SESSION['username']=$displayname;
                if(isset($_SESSION['username'])){
                    $user_in = $_SESSION['username'];
                }
                echo 'success';
            }
        }else{
            echo "<div class='error'>Your display name is empty</div>";
        }
    }
?>