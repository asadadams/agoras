<?php
    include_once('class.dbConnection.php');
    class manageUsers{
        public $link;
        public $email;
        public $id;
        
        public function __construct(){
            $db_Connnection = new dbConnection();
            $this->link =  $db_Connnection->connect();
            return $this->link;
        }
        
        public function registerUser($username,$email,$password,$date,$hash_key){
            $query = $this->link->prepare("INSERT INTO users (username,email,password,date,hashkey) VALUES(?,?,?,?,?)");
            $values = array($username,$email,$password,$date,$hash_key);
            $query->execute($values);
            $count = $query->rowCount();
            return $count;
        }
        
        public function userActive($username){
            $query = $this->link->query("SELECT * FROM users WHERE username = '$username'");
            while($r=$query->fetch(PDO::FETCH_OBJ)){
                $this->email = $r->email;
                $this->id = $r->id;
                return $r->status;
            }
        }
        
        public function activate_theUser($username){
            $query = $this->link->query("UPDATE users SET status='1' WHERE username='$username'");
        }
        
        public function checkEmailAvailable($email){
            $query = $this->link->query("SELECT * FROM users WHERE email = '$email'");
            $results = $query->fetchAll();
            $count = count($results);
            return $count;
        }
        
        public function getUser($username){
            $query = $this->link->query("SELECT * FROM users WHERE username = '$username'");
            $count = $query->rowCount();
            if($count==1){
                $result = $query->fetchAll();
                return $result;
            }
        }
        
        public function getUserInfo($id){
            $query = $this->link->query("SELECT * FROM userinfo WHERE user_id = '$id'");
            $count = $query->rowCount();
            if($count==1){
                $result = $query->fetchAll();
                return $result;
            }else{
                return $count;
            }
        }
        
		public function getAllUsers(){
			$query = $this->link->query("SELECT * FROM users");
            $count = $query->rowCount();
            if($count>0){
                $result = $query->fetchAll();
                return $result;
            }else{
                return $count;
            }
		}
		
		
        public function loginUser($email,$password){
            $query = $this->link->query("SELECT * FROM users WHERE email = '$email' AND password='$password'");
            $count = $query->rowCount();
            while($r=$query->fetch(PDO::FETCH_OBJ)){
                return $r->username;
            }
        }
        
         public function uploadProfilePic($id,$pic_destination){
             $query = $this->link->query("SELECT * FROM userinfo WHERE user_id = '$id'");
             $count = $query->rowCount();
             if($count==1){
                 $query = $this->link->query("UPDATE userinfo SET profile_pic='$pic_destination' WHERE user_id='$id'");
             }else{
                $query = $this->link->prepare("INSERT INTO userinfo (user_id,profile_pic) VALUES(?,?)");
                $values = array($id,$pic_destination);
                $query->execute($values);  
             }
        }
        
        public function editProfile($username,$id){
            $query = $this->link->prepare("UPDATE `users` SET `username`=:username WHERE id='$id'");
            $query->bindValue(":username", $username);
            $query->execute();

           $query = $this->link->query("UPDATE posts SET username='$username' WHERE id='$id'");
        }
        
        public function Update($table,$feildname,$value,$id){
            $query = $this->link->query("SELECT * FROM $table WHERE user_id = '$id'");
            $count = $query->rowCount();
            if($count==1){
                $query = $this->link->query("SELECT $feildname FROM $table WHERE user_id = '$id'");
                $r=$query->fetch(PDO::FETCH_OBJ);
                $feild_array= $r->$feildname;
                $explode_array=explode(",",$feild_array);
                $counter=count($explode_array); 
                if($feild_array==""){
                    $counter=count(NULL);
                }
                if($counter==NULL){
                   $query = $this->link->prepare("UPDATE `$table` SET `$feildname`=concat($feildname,:feildname) WHERE id='$id'");
                }elseif($counter>=1){
                    $query = $this->link->prepare("UPDATE `$table` SET `$feildname`=concat($feildname,',',:feildname) WHERE id='$id'");
                }
                $query->bindValue(":feildname",$value);
                $query->execute(); 
            }else{
                $query = $this->link->prepare("INSERT INTO $table (user_id,$feildname) VALUES(?,?)");
                $values = array($id,$value);
                $query->execute($values);  
            }
        }
        function eexplode($separator,$string){
            $array = explode($separator,$string);
            foreach($array as $key => $val){
                if(empty($val)){
                    unset($array[$key]);
                }
            }
            return $array;
        }
        public function remove($table,$feildname,$id,$array,$interested){
            $explode_array=explode(",",$array);
            $remove_element=str_replace("$interested","", $explode_array);
            $new_array=implode(",",$remove_element);
            $implode_array = implode(',',$this->eexplode(",",$new_array));
            $query = $this->link->prepare("UPDATE `$table` SET `$feildname`=:feildname WHERE id='$id'");
            $query->bindValue(":feildname",$implode_array);
            $query->execute(); 
        }
        
        public function updateUserInfo($id,$bio,$location,$twitter,$facebook,$mobile,$website){
            $query = $this->link->query("SELECT * FROM userinfo WHERE user_id = '$id'");
            $count = $query->rowCount();
            if($count>0){
                $query = $this->link->prepare("UPDATE userinfo SET `bio`=:bio,`location`=:location,`twitter`=:twitter,`facebook`=:facebook,`website`=:website,`mobile`=:mobile WHERE user_id='$id'");
                $query->bindValue(":twitter", $twitter);
                $query->bindValue(":facebook", $facebook);
                $query->bindValue(":website", $website);
                $query->bindValue(":bio", $bio);
                $query->bindValue(":location", $location);
                $query->bindValue(":mobile", $mobile);
                $query->execute();
            }else{
                $query = $this->link->prepare("INSERT INTO userinfo (user_id,bio,location,twitter,facebook,mobile,website) VALUES(?,?,?,?,?,?,?)");
                $values = array($id,$bio,$location,$twitter,$facebook,$mobile,$website);
                $query->execute($values);  
            }
        }
        
		public function updatePassword($username,$password){
			$query = $this->link->prepare("UPDATE users SET `password`=:password WHERE username='$username'");
            $query->bindValue(":password", $password);
            $query->execute();	
		}
        
		public function updateEmail($username,$email){
			$query = $this->link->prepare("UPDATE users SET `email`=:email WHERE username='$username'");
            $query->bindValue(":email", $email);
            $query->execute();	
		}
		
        public function searchUsers($serched_name){
            $query = $this->link->query("SELECT users.username,userinfo.profile_pic FROM users LEFT JOIN userinfo ON users.id = userinfo.user_id WHERE users.username LIKE '$serched_name%' ");
            $count = $query->rowCount();
            if($count>0){
                $results = $query->fetchAll();
                return $results;
            }
            return $count;
        }
        
        public function user_profile_fetch($user_id){
			 if(@$profile_picin==''){
					$profile_picin="img/default_profile.png";
			}
			$getUserFetched = $this->getUserInfo($user_id);
			if($getUserFetched!=0){
				foreach($getUserFetched as $info){
					$profile_picin = $info['profile_pic'];  
					$profile_picin="userdata/profile_pic/".$profile_picin;
				}
			}
			return $profile_picin;
    	}
		
		 public function updateFeild($table,$feildname,$value,$feildname2,$value2,$feildname3,$valu3){
            $query = $this->link->prepare("UPDATE `$table` SET `$feildname`=:value WHERE $feildname2='$value2' AND $feildname3='$valu3'");
			$query->bindValue(":value", $value);
            $query->execute();
        }
		
		
		
		public function followers_check($user1){
			$query = $this->link->query("SELECT * FROM follow_users WHERE user2 = '$user1'");
            $count = $query->rowCount();
            return $count;
		}
		public function following_check($user1){
			$query = $this->link->query("SELECT * FROM follow_users WHERE user1 = '$user1'");
            $count = $query->rowCount();
			return $count;
		}
		public function getFollowing($user1){
			$query = $this->link->query("SELECT * FROM follow_users WHERE user1 = '$user1'");
			$count = $query->rowCount();
			if($count>0){
                $results = $query->fetchAll();
                return $results;
            }
            return $count;
		}
				
		public function getFollowers($user){
			$query = $this->link->query("SELECT * FROM follow_users WHERE user2 = '$user'");
			$count = $query->rowCount();
			if($count>0){
                $results = $query->fetchAll();
                return $results;
            }
            return $count;
		}	
		public function follow_status($user1,$user2){
			$query = $this->link->query("SELECT * FROM follow_users WHERE user1 = '$user1' AND user2='$user2'");
            $count = $query->rowCount();
			return $count;
		}
		public function follow_notification($user1){
			$query = $this->link->query("SELECT * FROM follow_users WHERE user2 = '$user1' AND notification='1'");
            $count = $query->rowCount();
            if($count>0){
                $results = $query->fetchAll();
                return $results;
            }
            return $count;
		}
		
		public function follow($user1,$user2){
			$follow_status=$this->follow_status($user1,$user2);
            if($follow_status>0){
				$query = $this->link->query("DELETE FROM follow_users where `user1`='$user1' AND `user2`='$user2'");
			}else{
				$query = $this->link->prepare("INSERT INTO follow_users (user1,user2,notification) VALUES(?,?,1)");
				$values = array($user1,$user2);
				$query->execute($values);
			}
			
		}
		
		public function clearFollow_Not($user1,$user2){
           $query = $this->link->prepare("UPDATE `follow_users` SET `notification`=0 WHERE user1='$user1' AND user2='$user2'");
           $query->execute();
        }
    }
?>