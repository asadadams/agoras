<?php
    include_once('libs/session.php');
    include_once('classes/class.manageUsers.php');
    include_once('classes/class.Posts.php');
    include_once('classes/class.Messages.php');
	include_once('classes/class.Forum.php');
    include_once('funcs.php');
    $page_url= $_SERVER['SCRIPT_NAME'];
	@$search=$_GET['keyword'];
    login_user();  
	if(isset($profile_title)){
		$title=$_GET['user'];
	}else{
		$title='Agoras - An Open Forum';
	}
?>
<!DOCTYPE>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $title;?></title>
        <link type="text/css" href="css/1140.css" rel="stylesheet">
        <link rel='shortcut icon' href="img/logo.png" type='image/png'>
        <link type="text/css" href="css/jquery-ui.css" rel="stylesheet">
        <link type="text/css" href="css/filestyle.min.css" rel="stylesheet">
        <link type="text/css" href="css/texteditor.css" rel="stylesheet">
        <link type="text/css" href="css/main.css" rel="stylesheet">
		
		
    </head>
    <body >
        <header>
            
                <div class="container12">
                       <?php if(isset($user_in)){echo"<img class='profile' src='img/profile.png' width='30'>";}?> 
                    <div class="float_right">
                        <ul>
                            <li>
								<form action='search.php' method='GET'>
									<input type="text" name="keyword" class='search-top' placeholder="Search">
								</form>
							</li>
                           
                            <?php 
                                if(login_user()){
                                    echo "
                            <li><a href='logout.php'>logout</a></li>
                            <li><a href='$user_in'>$user_in</a></li>                
                                    ";
                                }else{
                                    echo"
                            <li><a href='signup.php?reg=0'>login</a></li>
                            <li><a href='signup.php?reg=1'>sign up</a></li>
                                    ";
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </header>
        <div class="container12">
        <!-- End of the header[top bar]-->
            <div class="container12">
                <nav>
                    <div class="column7 logo">
                        <a href="index" ><img src="img/logo.png" alt='agoras.com - An Open Forum' <?php if(isset($signup_css)){?> class="float_right"<?php }?>/></a>
                    </div>
                    <div class="column5 <?php if(isset($signup_css)){?>display_none<?php }?>">
                        <ul>
                            <li><a href=''>#KNUST</a></li>
                            <li class="<?php if(isset($active_tab_submit)){?>active_tab<?php }?>"><a href='submit'>Post a text</a></li>
                            <li class="<?php if(isset($active_tab_users)){?>active_tab<?php }?>"><a href='members.php'>Users</a></li>
                            <li><a href=''>General</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
            <!-- End of top nav-->
