<?php
    $signup_css='1';
    include_once('inc/header.php');
    $username_mail = $_GET['user'];
    $key_mail = $_GET['key'];
    $user = new manageUsers();
?>
    <div class='container12'>
        <div class='column5 successful'>
            <?php
                 $activate_user = $user->getUser($username_mail);
                if($activate_user){ 
                    foreach($activate_user as $active_user){
                        $hashkey = $active_user['hashkey'];
                        if($hashkey==$key_mail){
                           $user->activate_theUser($username_mail);
                            echo 'Your account has been  successfully activated.</br></br><a href=\'\'>Continue to home page</a>';
                        }else{
                            echo 'Oops, something went wrong';
                        }
                    }   
                }else{
                    echo 'Your username is not in our datatbase';
                }
            ?>
        </div>
    </div>

        </div>
        <?php include_once('inc/footer.php');?>  
    </body>

</html>