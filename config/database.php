<?php 
    class Database {
        private $host = "sql12.freemysqlhosting.net";
        private $database_name = "sql12362178";
        private $username = "sql12362178";
        private $password = "bK3jZusRsE";

        public $conn;

        public function getConnection(){
            $this->conn = null;
            try{
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database_name, $this->username, $this->password);
                $this->conn->exec("set names utf8");
            }catch(PDOException $exception){
                echo "Database could not be connected: " . $exception->getMessage();
            }
            return $this->conn;
        }
    }  
?>