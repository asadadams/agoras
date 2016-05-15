<?php
    include_once('class.dbConnection.php');
    class postsClass{
         public $link;
         public $posts_count;
		 public $comments_count;
        
         public function __construct(){
            $db_Connnection = new dbConnection();
            $this->link =  $db_Connnection->connect();
            return $this->link;
        }
        
          public function createPost($user_id,$username,$title,$text_post,$forum,$date){
            $query = $this->link->prepare("INSERT INTO posts (user_id,username,title,text,forum,date) VALUES(?,?,?,?,?,?)");
            $values = array($user_id,$username,$title,$text_post,$forum,$date);
            $query->execute($values);
            $count = $query->rowCount();
            return $count;
        }
        
         public function getPosts(){
            $query = $this->link->query("SELECT * FROM posts ORDER BY id DESC LIMIT 3");
            $count = $query->rowCount();
            if($count>0){
                $result = $query->fetchAll();
                return $result;
            }
        }
		
		public function usersPosts($user){
			$query = $this->link->query("SELECT user_id FROM posts WHERE user_id = '$user'");
            $count = $query->rowCount();
            return $count;
		}
		
		public function getPostsForLogin(){
			$query = $this->link->query("SELECT * FROM posts ORDER BY id DESC LIMIT 2");
            $count = $query->rowCount();
            if($count>0){
                $result = $query->fetchAll();
                return $result;
            }
		}
		
		public function getPostID($id){
			$query = $this->link->query("SELECT * FROM posts WHERE id='$id'");
            $count = $query->rowCount();
            if($count>0){
                $result = $query->fetchAll();
                return $result;
            }
		}
        
		public function getFollowersPosts($id){
			$query = $this->link->query("SELECT * FROM posts WHERE user_id='$id'");
            $count = $query->rowCount();
            if($count>0){
                $result = $query->fetchAll();
                return $result;
            }
		}
		
        public function getForumPosts($forum_name){
            $query = $this->link->query("SELECT * FROM posts WHERE forum='$forum_name'");
            $count = $query->rowCount();
            $this->posts_count = $count;
            if($count>0){
                $result = $query->fetchAll();
                return $result;
            }
        }
		
		public function postComment($post_id,$user_post,$user_from,$comment,$date,$notification){
			$query = $this->link->prepare("INSERT INTO comments (post_id,user_post,user_from,comment,date,notification) VALUES(?,?,?,?,?,?)");
            $values = array($post_id,$user_post,$user_from,$comment,$date,$notification);
            $query->execute($values);
		}
    	
		public function getComments($post_id){
			$query = $this->link->query("SELECT * FROM comments WHERE post_id='$post_id'");
            $count = $query->rowCount();
            $this->comments_count = $count;
            if($count>0){
                $result = $query->fetchAll();
                return $result;
            }
		}
		
		public function getCommentsNoti($user_id,$notification){
			$query = $this->link->query("SELECT * FROM comments WHERE user_post='$user_id' AND notification='$notification'");
            $count = $query->rowCount();
            $this->comments_count = $count;
            if($count>0){
                $result = $query->fetchAll();
                return $result;
            }
		}
		
		public function getUserPosts($user_id){
			$query = $this->link->query("SELECT * FROM posts WHERE user_id='$user_id'");
            $count = $query->rowCount();
            $this->comments_count = $count;
            if($count>0){
                $result = $query->fetchAll();
                return $result;
            }
		}
			
    }
?>

