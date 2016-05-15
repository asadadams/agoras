<?php
    include_once('inc/header.php'); 
    $forum_name=$_GET['forum_name'];
    $postObj = new postsClass();  
    $post_val = $postObj->getForumPosts($forum_name);
?>   
            
            
                <!--Main Body-->
            <div class="container12 main">
                <div class="column9 posts">
                    <div class='forum_header' align='center'>
                        <h2>/<?php echo $forum_name;?> forum <span>[ <?php echo $postObj->posts_count.' post(s)';?> ]</span></h2>
                    </div>
                    
                
                    <?php
                         
                        if($post_val){
                            foreach($post_val as $val){
								$id = $val['id'];
                                $title = $val['title'];
                                $text = $val['text'];
                                $forum = $val['forum'];
                                $username = $val['username'];
								$date = time_ago($val['date']);
                                echo "
                                <div class='post1'>
                        <div class='header'>
                            <a href='post.php?id=$id'>$title</a>
                        </div>
                        $text
                        <div class='footer'>
                            submitted $date ago by <a href=''>$username</a> to <a href='forum.php?forum_name=$forum'>$forum</a></br></br>
                        </div>
                    </div>
                            ";
                            }
                        }
                    ?>
                </div>
            </div>
            <!--Main Body-->               

    
            </div>
        </div>
        
        <?php include_once('inc/footer.php');?>  
    </body>

</html>
