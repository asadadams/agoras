<title>Error</title>
<?php
    include_once('inc/header.php'); 
?>   
        <!--Main Body-->              
            <div class='error2'>
                <h2>Sorry, you must be a user to view this page.</h2>
                <h4><b>Already having an account, <a href='signup.php?reg=0'>Login</a> or Don't have an account? <a href='signup.php?reg=1'>Create one today for free!</a></b></h4></br>
                <img src='img/405.png'></br></br>
                <a href='javascript:javascript:history.go(-1)' >Go back to the previous page</a> | <a href='index'>Go to the Homepage</a> | <a href='contact_us'>Contact Us</a></br></br></br>
            </div>
        
            </div>
            <!--Main Body-->               

    
            </div>
        </div>
        
        <?php include_once('inc/footer.php');?>  
    </body>
    <script language="javascript">
        function goBack(){
        window.history.back()
	}
</script>
</html>
