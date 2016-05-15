<?php
    include_once('class.dbConnection.php');
    class MessagesClass{
         public $link;
         public $username;
         public $unread_msg_count; //For polling
        
         public function __construct(){
            $db_Connnection = new dbConnection();
            $this->link =  $db_Connnection->connect();
            return $this->link;
        }
        
        public function getAllMessage($user2){
            $query = $this->link->query("SELECT * FROM message WHERE user2 = $user2 AND deletedby_receiver=0");
            $count = $query->rowCount();
            if($count>0){
                $results = $query->fetchAll();
                return $results; 
            }
            return $count;
        }
        
        public function getTypeMessage($user2,$type){
            $query = $this->link->query("SELECT * FROM message WHERE user2 = '$user2' AND read_val='$type'");
            $count = $query->rowCount();
            $this->unread_msg_count = $count;
            if($count>0){
                $results = $query->fetchAll();
                return $results; 
            }
            return $count;
        }
        
        public function getReadMsg($user2){
            $query = $this->link->query("SELECT * FROM message WHERE user2 = '$user2' AND read_val='1' AND deletedby_receiver='0'");
            $count = $query->rowCount();
            if($count>0){
                $results = $query->fetchAll();
                return $results; 
            }
            return $count;
        }
        
	
		
        public function getMessage($msg_id){
            $query = $this->link->query("SELECT * FROM message WHERE id=$msg_id");
           	$count = $query->rowCount();
            if($count>0){
                $results = $query->fetchAll();
                return $results; 
            }
            return $count;
        }
        
        public function getSentMessage($user1){
            $query = $this->link->query("SELECT * FROM message WHERE user1 = $user1 AND deletedby_sender=0");
             $count = $query->rowCount();
            if($count>0){
                $results = $query->fetchAll();
                return $results; 
            }
            return $count;
        }
        
        public function getUsername($user1id){
            $query = $this->link->query("SELECT username FROM users WHERE id= $user1id ");
            $r = $query->fetch(PDO::FETCH_OBJ);
            $this->username = $r->username; 
        }
        
        public function createMessage($user1,$user2,$title,$message,$date){
            $query = $this->link->prepare("INSERT INTO message (user1,user2,title,message,date) VALUES(?,?,?,?,?)");
            $values = array($user1,$user2,$title,$message,$date);
            $query->execute($values);
        }
        
        public function deleteMessage($val1,$val2,$id){
            $query = $this->link->prepare("UPDATE `message` SET `deletedby_sender`=:val1,`deletedby_receiver`=:val2 WHERE id='$id'");
            $query->bindValue(":val1", $val1);
            $query->bindValue(":val2", $val2);
            $query->execute();

           //$query = $this->link->query("UPDATE posts SET username='$username' WHERE id='$id'");
        }
        
        public function readMessage($id){
            $query = $this->link->prepare("UPDATE `message` SET `read_val`=1 WHERE id='$id'");
            $query->execute();
        }
        
        public function custom_echo($string,$length){
            if(strlen($string)<=$length){
                return $string;
            }else{
                $final_string = substr($string,0,$length);
                return $final_string.'...';
            }
        }
    }
?>