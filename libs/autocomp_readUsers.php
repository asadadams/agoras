<?php
    include_once('../libs/session.php');
    include_once('../classes/class.manageUsers.php');
    $userObj = new manageUsers();
    if(isset($_POST['keyword'])){
    if(!empty($_POST['keyword'])){
        $keyword=strip_tags(trim($_POST['keyword']));
        $return_name = $userObj->searchUsers($keyword);
        if($return_name!=0){
            foreach($return_name as $name){
                $name_returned = $name['username'];
                $profile_pic = $name['profile_pic'];
                
                if(@$profile_pic==''){
        $profile_pic="img/default_profile.png";
    }else{
        $profile_pic="userdata/profile_pic/".$profile_pic;
    }
                
                echo "
                <ul id='username-list'>
                    <li class='selected_user'><img src='$profile_pic' width='25' class='img-circle'><p style='margin-top:8px;'>$name_returned</p></li>
                </ul>
                ";
            }   
        }
    }
    }
?>
 <script src="js/jquery.js" type="text/javascript"></script>
<script src="js/main.js" type="text/javascript"></script>
