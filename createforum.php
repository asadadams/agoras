<title>Create a forum</title>
<?php
    include_once('inc/header.php');
	$forumObj = new ForumsClass();
    $userObj = new manageUsers();
    if(login_user()==true){
        $get_info = $userObj->getUser($user_in);
        foreach($get_info as $info){
            $user_id = $info['id'];
        }
        
    }else{
        header('location:error405');
    }
	if(isset($_POST['forumname']) && isset($_POST['description'])){
        $forumname = strip_tags(trim($_POST['forumname']));
        $description = strip_tags(trim($_POST['description']));
        if(!empty($forumname) && !empty($description)){
			if(strlen($forumname)<5 || strlen($forumname)>25){
				echo "<div class='error'>Forum name should be between 5 and 25 characters</div>";
			}else{
				if(strlen($description)<5){
					echo "<div class='error'>Description should not be less than 5 characters</div>";
				}else{
					$forumObj->createForum($user_id,$forumname,$description);
					echo "<div class='success'>Your forum have been successfully created</div>";
				}
			}
		}else{
			echo "<div class='error'>All feilds are required</div>";
		}
	
	}
?>          </br>
            <!--Main Body-->
            <div class='container12'>
				<h2>Create a forum</h2>
                <div class='column8' style='border:1px solid #e8eaec;margin-top:10px;'>
               
				<form style='padding:20px;' action='createforum.php' method='POST'> 
					<label for='forumname'>Forum name</label></br>
                     <input type='text' name='forumname' placeholder='Forum name' class='medium-fld medium-fld2'>
                     </br></br>
                     <label for='description'>Description</label></br>
					 <textarea cols='20' name='description' rows='9' placeholder='Add short description'></textarea>
                     <input type='submit' class='btn2' value='Create a forum' style='margin:10px 0px 0px 0px; width:250px;'>
					 <span style='font-size:0.8em;'>By creating a forum you are agreeing to all our <a href='#'>terms and condition</a></span>
				</form>            
				
				</div>
         		
            </div>
            <!--Main Body-->    
            </div>
        </div>
        <?php include_once('inc/footer.php');?>  
    </body>

</html>
