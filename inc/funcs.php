<?php
//Time ago function 
function time_ago($date){

    if(empty($date)) {
        return "No date provided";
    }

    $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");

    $lengths = array("60","60","24","7","4.35","12","10");

    $now = time();

    $unix_date = strtotime($date);

    // check validity of date

    if(empty($unix_date)) {
        return "Bad date";
    }

    // is it future date or past date

    if($now > $unix_date) {

    $difference = $now - $unix_date;

    $tense = "ago";

    } else {

    $difference = $unix_date - $now;
    $tense = "ago";}

    for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {

    $difference /= $lengths[$j];

    }

    $difference = round($difference);

    if($difference != 1) {

    $periods[$j].= "s";

    }

    return "$difference $periods[$j] {$tense}";

}

  function after ($this, $inthat)
    {
        if (!is_bool(strpos($inthat, $this)))
        return substr($inthat, strpos($inthat,$this)+strlen($this));
    };
	/*Function for posts when a user is logged in
		if $sel=1 then
			posts for login
		else
			posts for index when not loged in
	*/
	 function posts($Section_posts,$user_info,$postObj,$user_id,$sel){
		if($Section_posts){
			foreach($Section_posts as $val){
				$post_id = $val['id'];
				$userpost_id = $val['user_id'];
				$title = $val['title'];
				$text = $val['text'];
				$forum = $val['forum'];
				$username = $val['username'];
				$date = time_ago($val['date']);
				$profile_pic=$user_info->user_profile_fetch(@$userpost_id);
				if(login_user()==true){
					$post_elements="<input type='text' class='comment_text' post_id='$post_id' user_post='$userpost_id' placeholder='Add a commment'><input type='button' value='Post' class='btn post_comment' style='margin-left:9px; height:30px; border-radius:0px;'>";
				}else{
					$post_elements="<input type='text' class='comment_text' placeholder='Add a commment'><input type='button' value='Post' class='btn notuser2' style='margin-left:9px; height:30px; border-radius:0px;' onclick='slideDown()'>";
				}
				
				$user_profile=$user_info->user_profile_fetch(@$user_id);
				$posts_number=$postObj->usersPosts(@$userpost_id);
				$comments=$postObj->getComments($post_id);
				$comments_number = $postObj->comments_count;
				if($sel==1){
					echo "
					<div class='post1' style='width:522px;'>
						<div class='header'>
							<a href='post.php?id=$post_id'>$title</a>
							<div class='top_info'>
								submitted by <a href='$username'>$username</a>
						</div>
					</div>
						$text

					<div class='footer'>
						<div id='user'>
						<img src='$profile_pic'>
						<div style='float:right; padding:3px;'>
							submitted by <a href='$username'>$username</a></br>
							$posts_number posts</br>
							
						</div>
					</div> 
						submitted $date to <a href='forum.php?forum_name=$forum'>$forum</a></br></br>

					</div>


					<div class='comments_area'>
						<a href='#' class='Menu_show' post_id='$post_id'>comment($comments_number)</a>
						<div id='thecomments'></div>
						</div>
					</div>
			<div id='comment' style='width:549px;'>
				<img src='$user_profile'>
				$post_elements
				<div class='show_comment'></div>
			</div>
		";
				}else if($sel==2){
					echo "
						
							<div class='column2 post1' style='width:220px;'>
							<div class='header'>
								<a href='post.php?id=$post_id'>$title</a>
							</div>
							$text
							<div class='footer'>
								<div id='user' style='width:200px; float:left; padding:0px;'>
									<img src='$profile_pic' style='float:left;'>
									<div style='float:left;padding:3px;'>
										submitted by <a href='$username'>$username</a></br>
										$posts_number posts</br>
									
									</div>
								</div></br></br></br></br></br></br>
							submitted $date to <a href='forum.php?forum_name=$forum'>$forum</a></br></br>
							</div>
							</div>
										
					";
				}else{
					echo "
						
							<div class='column3 post1'>
							<div class='header'>
								<a href='post.php?id=$post_id'>$title</a>
							</div>
							$text
							<div class='footer'>
								<div id='user' style='width:230px; float:left;'>
									<img src='$profile_pic' style='float:left;'>
									<div style='float:left;padding:3px;'>
										submitted by <a href='$username'>$username</a></br>
										$posts_number posts</br>
									
									</div>
								</div></br></br></br></br></br></br>
							submitted $date to <a href='forum.php?forum_name=$forum'>$forum</a></br></br>
							</div>
							</div>
										
					";
				}
				
			}

		}
	}

?>
