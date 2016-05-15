<?php
    include_once('../libs/session.php');
    include_once('../classes/class.manageUsers.php');
    login_user(); 
    $userObj = new manageUsers();
    $get_info = $userObj->getUser($user_in);
    foreach($get_info as $info){
        $id = $info['id'];        
    }
    $getUserInfo = $userObj->getUserInfo($id);
    foreach($getUserInfo as $info){
        $interested_db = $info['interested'];
    }  
    if(isset($_POST['interested'])){
        echo $interested = $_POST['interested'];
        $userObj->remove('userinfo','interested',$id,$interested_db,$interested);
    }
?>