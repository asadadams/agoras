<?php
    session_start();
    function login_user(){
       if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
            global $user_in;
            $user_in = $_SESSION['username'];
            return true;
       }else{
            return false;
        } 
    }
    
?>