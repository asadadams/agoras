<title>Users</title>
<?php
	$active_tab_users='1';
    include_once('inc/header.php');
	
    $userObj = new manageUsers();
    if(login_user()==true){
        $get_info = $userObj->getUser($user_in);
        foreach($get_info as $info){
            $user_id = $info['id'];
        }
        
    }else{
        header('location:error405');
    }
?>          </br>
            <!--Main Body-->
            <div class='container12'>
                <div class='column8' style='border:1px solid #e8eaec;margin-top:10px;'>
               		<form action='$page_url' method='POST'>
                        <input type='text' class='medium-fld' placeholder='Title' name='title'>
                        <textarea class='txtarea-fld' rows='5' cols='42' spellcheck='false' name='user_post' placeholder='Speak your mind'></textarea></br>
                        <a href='#' id='forumlist_link'>Choose a forum</a></br>
                        <div class='categories' id='cat'>
                            <input type='text' class='medium-fld' id='forum_name' name='forum_name'>
                            <ul>
                                <li><a href='#' class='forum_link'>programming</a></li>
                                <li><a href='#' class='forum_link'>games</a></li>
                                <li><a href='#' class='forum_link'>movies</a></li>
                                <li><a href='#' class='forum_link'>anime</a></li>
                                <li><a href='#' class='forum_link'>fashion</a></li>
                                <li><a href='#' class='forum_link'>engineering</a></li>
                                <li><a href='#' class='forum_link'>knust</a></li>
                            </ul>
                        </div>
                        <input type='submit' class='btn-post1' value='Submit this text post >>'> or <a>submit a link post</a>
                        </form>
				</div>
            </div>
            <!--Main Body-->    
            </div>
        </div>
        <?php include_once('inc/footer.php');?>  
    </body>

</html>
