<?php
    class Genres{

        // Connection
        private $conn;

        // Table
        private $db_table = "genre";

        // Columns
        public $idGenre;
        public $nomGenre;
        public $description;
        public $created;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getGenres(){
            $sqlQuery = "SELECT * FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function addGenre(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                    nomGenre = :nomGenre, 
                    description = :description,
                    created = :created
                    ";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->nomGenre=htmlspecialchars(strip_tags($this->nomGenre));
            $this->description=htmlspecialchars(strip_tags($this->description));
            $this->created=htmlspecialchars(strip_tags($this->created));
        
            // bind data
            $stmt->bindParam(":nomGenre", $this->nomGenre);
            $stmt->bindParam(":description", $this->description);
            $stmt->bindParam(":created", $this->created);

            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // READ single
        public function getSingleGenre(){
            $sqlQuery = "SELECT
                       *
                      FROM
                        ". $this->db_table ."
                    WHERE 
                        idGenre = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->idGenre);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->idGenre = $dataRow['idGenre'];
            $this->nomGenre = $dataRow['nomGenre'];
            $this->description = $dataRow['description'];
            $this->created = $dataRow['created'];

    
        }      
             // Find by Column
        public function findIdByColumn(){
            $sqlQuery = "SELECT
                       *
                      FROM
                        ". $this->db_table ."
                    WHERE 
                        nomGenre = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->nomGenre);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->idGenre = $dataRow['idGenre'];
            $this->nomGenre = $dataRow['nomGenre'];
            $this->description = $dataRow['description'];
            $this->created = $dataRow['created'];

    
        }   

        // UPDATE
        public function updateGenre(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        nomGenre = :nomGenre, 
                        description = :description,
                        created = :created
                    WHERE 
                        idGenre = :idGenre";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->nomGenre=htmlspecialchars(strip_tags($this->nomGenre));
            $this->description=htmlspecialchars(strip_tags($this->description));
            $this->idGenre=htmlspecialchars(strip_tags($this->idGenre));
            $this->created=htmlspecialchars(strip_tags($this->created));
        
            // bind data
            $stmt->bindParam(":nomGenre", $this->nomGenre);
            $stmt->bindParam(":description", $this->description);
            $stmt->bindParam(":idGenre", $this->idGenre);
            $stmt->bindParam(":created", $this->created);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteGenre(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE idGenre = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->idGenre=htmlspecialchars(strip_tags($this->idGenre));
        
            $stmt->bindParam(1, $this->idGenre);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>