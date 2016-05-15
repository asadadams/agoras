<?php
    function verifymail($email,$username,$password,$key){
        $to      = 'root@localhost.com';
        $subject = 'Signup | Verification'; 
        $message = '

        Thanks for joining our community!
        Your account has been successfully created, you can login with the following credentials after you have activated your account by clicking the url below.

        ------------------------
        Username: '.$username.'
        Password: '.$password.'
        ------------------------

        Please click this link to activate your account:
        http://localhost/agoras/activate.php?key='.$key.'&user='.$username.'

        ';

        $headers = 'From:noreply@agoras.com' . "\r\n";
        mail($to, $subject, $message, $headers);
    }
?>