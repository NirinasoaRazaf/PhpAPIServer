<?php 
    class Database {
        private $host = "bpagzq63hjirvjmu4et1-mysql.services.clever-cloud.com";
        private $database_name = "bpagzq63hjirvjmu4et1";
        private $username = "uc6xfxyyckvxlw6v";
        private $password = "dQ11M9g1lHk2Rb8T9HuG";

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