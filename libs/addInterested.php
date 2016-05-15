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
    if($getUserInfo!=0){
        foreach($getUserInfo as $info){
            $interested_db = $info['interested'];
        }     
    }else{
        $interested_db ='';
    }
    
    if(isset($_POST['interested'])){
        $interested = $_POST['interested'];
        if(!empty($interested)){
            $userObj->Update('userinfo','interested',$interested,$id);    
            $interested_array=explode(',',$interested_db);
            if($interested_db!=''){
                foreach($interested_array as $element){
                    echo "<div class='outer_box'><div style='float:left'>$element</div><a href='#' element='$element' class='remove_element'>Remove</a><span class='main_hr'></span></br></div>";
                }   
            }
                echo "<div class='outer_box'><div style='float:left'>$interested</div><a href='#' element='$interested' class='remove_element'>Remove</a><span class='main_hr'></span></br></div>";
        }else{
            echo "<div class='error'>Enter in something</div>";
        }
    }
?>
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/main.js" type="text/javascript"></script>