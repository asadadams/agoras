<title>Activation Email</title>
<?php
	include('libs/verify_mail.php');
    $signup_css='1';
    include_once('inc/header.php');
    $email = $_GET['email'];
    $user = $_GET['user'];
	$p = $_GET['p'];
	$key = $_GET['key'];
    
?>
    <div class='container12'>
        <div class='column5 successful'>
            <?php
				$email_service=after('@',$email);
				echo "An confirmation email for activation has been sent to your email address <a href='$email_service'>$email</a>" ;
				
            	verifymail($email,$user,$p,$key);
            ?>
        </div>
    </div>

        </div>
        <?php include_once('inc/footer.php');?>  
    </body>

</html>