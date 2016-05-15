<?php
	
	include_once('class.dbConnection.php');
    class ForumsClass{
         public $link;
		 public $forum_name;
       
         public function __construct(){
            $db_Connnection = new dbConnection();
            $this->link =  $db_Connnection->connect();
            return $this->link;
        }
		
		public function getUserForums($user){
			$query = $this->link->query("SELECT * FROM user_forums WHERE created_by = '$user'");
            $count = $query->rowCount();
            if($count>0){
                $results = $query->fetchAll();
                return $results; 
            }
            return $count;
		}
	
		public function agorasForums(){
			$query = $this->link->query("SELECT * FROM agoras_frorums");
            $count = $query->rowCount();
            if($count>0){
                $results = $query->fetchAll();
                return $results; 
            }
            return $count;
		}
		
		public function customForums($id){
			$query = $this->link->query("SELECT * FROM user_forums WHERE id='$id'");
            $count = $query->rowCount();
            if($count>0){
                $results = $query->fetchAll();
                return $results; 
            }
            return $count;
		}
		
		public function follow_status($user,$forum_id){
			$query = $this->link->query("SELECT * FROM follow_agoras WHERE user = '$user' AND forum_id='$forum_id'");
            $count = $query->rowCount();
			return $count;
		}
		
		public function getForumFollowing($user){
			$query = $this->link->query("SELECT * FROM follow_agoras WHERE user = '$user'");
			$count = $query->rowCount();
			if($count>0){
                $results = $query->fetchAll();
                return $results;
            }
            return $count;	
		}
		
		public function getforumname($id){
            $query = $this->link->query("SELECT forum_name FROM agoras_frorums WHERE id= $id ");
            $r = $query->fetch(PDO::FETCH_OBJ);
            $this->forum_name = $r->forum_name; 
        }
		
		public function customForums_check($user){
			$query = $this->link->query("SELECT * FROM user_forums WHERE created_by = '$user'");
            $count = $query->rowCount();
            return $count;
		}
		
		public function follow($user,$forum_id){
			$follow_status=$this->follow_status($user,$forum_id);
            if($follow_status>0){
				$query = $this->link->query("DELETE FROM follow_agoras where `user`='$user' AND `forum_id`='$forum_id'");
			}else{
				$query = $this->link->prepare("INSERT INTO follow_agoras (user,forum_id) VALUES(?,?)");
				$values = array($user,$forum_id);
				$query->execute($values);
			}
		}
		
		public function createForum($created_by,$forum_name,$description){
			$query = $this->link->prepare("INSERT INTO user_forums (created_by,forum_name,description) VALUES(?,?,?)");
            $values = array($created_by,$forum_name,$description);
            $query->execute($values);
            $count = $query->rowCount();
		}
		
		///////////////custom forums class functions
		public function follow_status1($user,$forum_id){
			$query = $this->link->query("SELECT * FROM follow_customforums WHERE user = '$user' AND forum_id='$forum_id'");
            $count = $query->rowCount();
			return $count;
		}
		
		public function getForumFollowing1($user){
			$query = $this->link->query("SELECT * FROM follow_customforums WHERE user = '$user'");
			$count = $query->rowCount();
			if($count>0){
                $results = $query->fetchAll();
                return $results;
            }
            return $count;	
		}
	
		public function getUsersLimit($id){
			$query = $this->link->query("SELECT * FROM follow_customforums WHERE forum_id='$id' LIMIT 8");
            $count = $query->rowCount();
            if($count>0){
                $result = $query->fetchAll();
                return $result;
            }else{
                return $count;
            }
		}
		
		public function getAllUsers($id){
			$query = $this->link->query("SELECT * FROM follow_customforums WHERE forum_id='$id'");
            $count = $query->rowCount();
            if($count>0){
                $result = $query->fetchAll();
                return $result;
            }else{
                return $count;
            }
		}
		
		public function searchForums($serched_name){
            $query = $this->link->query("SELECT forum_name FROM user_forums WHERE forum_name LIKE '$serched_name%' ");
            $count = $query->rowCount();
            if($count>0){
                $results = $query->fetchAll();
                return $results;
            }
            return $count;
        }
		
		public function getFollowedForums($user){
			$query = $this->link->query("SELECT agoras_frorums.id,agoras_frorums.forum_name,agoras_frorums.description FROM agoras_frorums LEFT JOIN follow_agoras ON agoras_frorums.id = follow_agoras.forum_id WHERE follow_agoras.user = '$user'");
            $count = $query->rowCount();
            if($count>0){
                $results = $query->fetchAll();
                return $results;
            }
            return $count;
		}
		
		public function getFollowedCustomForums($user){
			$query = $this->link->query("SELECT user_forums.id,user_forums.forum_name,user_forums.description FROM user_forums LEFT JOIN follow_customforums ON user_forums.id = follow_customforums.forum_id WHERE follow_customforums.user = '$user'");
            $count = $query->rowCount();
            if($count>0){
                $results = $query->fetchAll();
                return $results;
            }
            return $count;
		}
		
		public function follow1($user,$forum_id){
			$follow_status=$this->follow_status1($user,$forum_id);
            if($follow_status>0){
				$query = $this->link->query("DELETE FROM follow_customforums where `user`='$user' AND `forum_id`='$forum_id'");
			}else{
				$query = $this->link->prepare("INSERT INTO follow_customforums (user,forum_id) VALUES(?,?)");
				$values = array($user,$forum_id);
				$query->execute($values);
			}
		}
		
		public function getCustomForumFollowing($user){
			$query = $this->link->query("SELECT * FROM follow_customforums WHERE user = '$user'");
			$count = $query->rowCount();
			if($count>0){
                $results = $query->fetchAll();
                return $results;
            }
            return $count;	
		}
		
	}    
?>