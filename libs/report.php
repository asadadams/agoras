<?php
	include_once('../libs/session.php');
	if(isset($_POST['bug'])){
		$bug = $_POST['bug'];
		if(!empty($bug)){
			$to      = 'root@localhost.com';
        	$subject = 'A bug Report'; 
			$headers = 'From:noreply@agoras.com' . "\r\n";
			mail($to, $subject, $bug, $headers);
			echo "Bug has been successfully sent, we will take a look at it";
		}else{
			echo 'Please enter in what bug you would like to report to us';
		}
	}
?>