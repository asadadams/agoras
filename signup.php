<?php
    include('libs/verify_mail.php');
    $signup_css='1';
    if(isset($_GET['reg'])){
        $reg_var = $_GET['reg'];
        if($reg_var){
           echo "<title>agoras.com - SignUp</title>";
        }else{
            echo "<title>agoras.com - Login</title>";
        }
        
        
    }
    include_once('inc/header.php');
    $users = new manageUsers();
    if(isset($_POST['username_signup']) && isset($_POST['email_signup']) && isset($_POST['password_signup']) && isset($_POST['password2_signup'])){
        $username_signup = strip_tags(trim($_POST['username_signup']));
        $email_signup = strip_tags(trim($_POST['email_signup']));
        $password_signup = strip_tags(trim($_POST['password_signup']));
        $repassword_signup = strip_tags(trim($_POST['password2_signup']));
        $encrypt_pswd = md5($password_signup);
        $date = date('Y-m-d');
        $key=md5($username_signup.$email_signup);
        $error;
        
        if(!empty($username_signup) && !empty($email_signup) && !empty($password_signup) &&!empty($repassword_signup)){
            if(strstr($email_signup,'@') && strstr($email_signup,'.') && strstr($email_signup,'com')){
                if($password_signup==$repassword_signup){
                    if(strlen($password_signup)<3 || strlen($password_signup)>25){
                        $error='Password should be between 3 and 25 characters long';
                    }else{
                        $checkEmailAvailablity = $users->checkEmailAvailable($email_signup);
                        if($checkEmailAvailablity){
                            $error='Email already have already been registered';
                        }else{
                            try{    
                                $check_user_availability = $users->getUser($username_signup);
                                if(!$check_user_availability){
                            $register_user=$users->registerUser($username_signup,$email_signup,$encrypt_pswd,$date,$key);
                                    $init_login = $users->getUser($username_signup);
                                    foreach($init_login as $login_firstTime){
                                        $_SESSION['username']=$login_firstTime['username'];
                                        if(isset($_SESSION['username'])){
                                            verifymail($email_signup,$username_signup,$password_signup,$key);
                                            $user_in = $_SESSION['username'];
                                            header('location:index.php');
                                        }
                                    }
                                }else{
                                    $error ='Sorry the display name[username] already exist';
                                }
                            }catch(Exception $ex){
                                $error= 'signup error: '.$ex->getMessage();
                            }
                        }
                    }
                }else{
                    $error='The passwords you entered do not match';
                }
            }else{
                $error='Please enter in a valid email address';
            }
        }else{
            $error='All fields are required';
        }
    }
    if(isset($_POST['email_login']) && isset($_POST['password_login'])){
        $email_login = strip_tags(trim($_POST['email_login']));
        $password_login = strip_tags(trim($_POST['password_login']));
        $encrypt_loginPswd = md5($password_login);
        $error_login;
        if(!empty($email_login) && !empty($password_login)){
            $users_login = $users->loginUser($email_login,$encrypt_loginPswd);
            if($users_login){
                try{
                    $init_login = $users->getUser($users_login);
                    foreach($init_login as $login_firstTime){
                        $_SESSION['username']=$login_firstTime['username'];
                        if(isset($_SESSION['username'])){
                            $user_in = $_SESSION['username'];
                            header('location:index.php');
                        }
                    }
                }catch(Exception $ex){
                    $error= 'Signin error: '.$ex->getMessage();
                }
            }else{
                $error_login='Wrong email and password combination';
            }
        }else{
            $error_login='All fields are required';
        }
    }
?>   
<?php
    
?>
            <!--Main Body-->
            <div class="container12">
                <div class="signup_top" id='signup_top_txt' <?php if(isset($reg_var)){if(!$reg_var){echo "style='display:none'";}}?>>
                    <span class="signup_top_txt">Join our community<img src="img/community.png"> and share</span>
                </div>
                </br>
                <div class="column3 sign_up" <?php if(isset($reg_var)){if(!$reg_var){echo "style='display:none'";}}?> id='signup_form'>
                    <form action="<?php echo $page_url;?>?reg=1" method="POST">
                        <?php if(isset($error)){echo "<div class='error'>$error</div></br></br>";}?>
                        <label for="display_name">Display name:</label></br>
                        <input type="text" name="username_signup" placeholder="John.Doe" class='large-fld' value="<?php if(isset($username_signup)){echo $username_signup;}?>"></br>
                
                        <label for="display_name">Email:</label></br>
                        <input type="email" name="email_signup" placeholder="you@example.org" class='large-fld' value="<?php if(isset($email_signup)){echo $email_signup;}?>"></br>

                        <label for="display_name">Password:</label></br>
                        <input type="password" name="password_signup" placeholder="******" class='large-fld'></br>

                        <label for="display_name">Retype-Password:</label></br>
                        <input type="password" name="password2_signup" placeholder="******" class='large-fld'></br>

                        <input type="submit" name="signup" value="SignUp" class='btn'> or <a href="" id='have_account'>already have an account?</a>
                        <hr>
                        <div class="signup_txt">
                            By registering, you agree to our <a href="">Terms of use</a> and <a href="">Our Privacy Policy</a>
                        </div>
                    </form>
                </div>
                
                

                <div class="column3 login" id='login_form' <?php if(isset($reg_var)){if($reg_var){echo "style='display:none'";}}?>>
                    <form action="<?php echo $page_url;?>?reg=0" method="POST">
                        <?php if(isset($error_login)){echo "<div class='error'>$error_login</div></br></br>";}?>
                        <label for="email">Email:</label></br>
                        <input type="email" name="email_login" placeholder="you@example.org" class='large-fld'></br>

                        <label for="display_name">Password:</label></br>
                        <input type="password" name="password_login" placeholder="******" class='large-fld'></br>
                        <input type="checkbox" name="remember_me">remember me <a href="" class="float_right">forgot password?</a></br>
                        <input type="submit" name="login" value="Login" class='btn float_right'>
                    </form>
                </div>
                
                <div class="column3 login" id='login_txt' <?php if(isset($reg_var)){if($reg_var){echo "style='display:none'";}}?>>
                     Don't have an account? <a href="signup.php?reg=1" id='create_account'>Create one today for free!</a>
                </div>

                

            </div>
            <!--Main Body-->    
        </div>
        <?php include_once('inc/footer.php');?>  
    </body>

</html>
