<?php
    class LectureSurPlace{

        // Connection
        private $conn;

        // Table
        private $db_table = "LectureSurPlace";

        // Columns
        public $idLectureSurPlace;
        public $idMembre;
        public $idOuvrage;
        public $DateLecture;
        public $created;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getLectureSurPlaces(){
            $sqlQuery = "SELECT * FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        public function getFicheLectureSurPlaces(){
            $sqlQuery = "SELECT * FROM  fichelecturesp order by dateLecture desc";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function addLectureSurPlace(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                    idMembre = :idMembre, 
                    idOuvrage = :idOuvrage,
                    DateLecture = :DateLecture,
                    created = :created
                    ";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->idMembre=htmlspecialchars(strip_tags($this->idMembre));
            $this->idOuvrage=htmlspecialchars(strip_tags($this->idOuvrage));
            $this->DateLecture=htmlspecialchars(strip_tags($this->DateLecture));
            $this->created=htmlspecialchars(strip_tags($this->created));
        
            // bind data
            $stmt->bindParam(":idMembre", $this->idMembre);
            $stmt->bindParam(":idOuvrage", $this->idOuvrage);
            $stmt->bindParam(":DateLecture", $this->DateLecture);
            $stmt->bindParam(":created", $this->created);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }
         // READ single
         public function getSingleLectureSurPlace(){
            $sqlQuery = "SELECT
                        *
                        FROM
                        ". $this->db_table ."
                    WHERE 
                    idLectureSurPlace = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1,$this->idLectureSurPlace);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->idMembre = $dataRow['idMembre'];
            $this->idOuvrage = $dataRow['idOuvrage'];
            $this->DateLecture = $dataRow['DateLecture'];
            $this->created = $dataRow['created'];
          
        }        
        // detail lecture grupe
        public function detailLecture(){
            $sqlQuery = "SELECT * FROM  detailLecture
                        
                    WHERE 
                    idOuvrage = ?
                    ";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->idOuvrage);

            $stmt->execute();
            return $stmt;
        }        

        // UPDATE
        public function updateLectureSurPlace(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        idMembre = :idMembre, 
                        idOuvrage = :idOuvrage,
                        DateLecture = :DateLecture,
                        created = :created

                    WHERE 
                    idLectureSurPlace = :idLectureSurPlace";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->idMembre=htmlspecialchars(strip_tags($this->idMembre));
            $this->idOuvrage=htmlspecialchars(strip_tags($this->idOuvrage));
            $this->DateLecture=htmlspecialchars(strip_tags($this->DateLecture));
            $this->idLectureSurPlace=htmlspecialchars(strip_tags($this->idLectureSurPlace));
            $this->created=htmlspecialchars(strip_tags($this->created));
        
            // bind data
            $stmt->bindParam(":idMembre", $this->idMembre);
            $stmt->bindParam(":idOuvrage", $this->idOuvrage);
            $stmt->bindParam(":DateLecture", $this->DateLecture);
            $stmt->bindParam(":idLectureSurPlace", $this->idLectureSurPlace);
            $stmt->bindParam(":created", $this->created);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteLectureSurPlace(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE idLectureSurPlace = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->idLectureSurPlace=htmlspecialchars(strip_tags($this->idLectureSurPlace));
        
            $stmt->bindParam(1, $this->idLectureSurPlace);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>