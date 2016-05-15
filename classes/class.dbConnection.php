<?php
    class dbConnection{
        protected $db_conn;
        private $db_name='agoras_db';
        private $db_host='localhost';
        private $db_username='root';
        private $db_password='';
        
        public function connect(){
            try{
                $this->db_Conn = new PDO("mysql:host=$this->db_host;dbname=$this->db_name","$this->db_username","$this->db_password");
                return $this->db_Conn;
            }catch(PDOException $ex){
                return $ex->getMessage();
            }
        }
    }
?>