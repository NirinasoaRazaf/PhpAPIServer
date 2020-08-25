<?php
    class Auteur{

        // Connection
        private $conn;

        // Table
        private $db_table = "Auteur";

        // Columns
        public $idAuteur;
        public $nomAuteur;
        public $dateNaissance;
        public $nationalite;
        public $created;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getAuteurs(){
            $sqlQuery = "SELECT * FROM " . $this->db_table . " order by created desc";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function addAuteur(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                    nomAuteur = :nomAuteur, 
                    dateNaissance = :dateNaissance, 
                    nationalite = :nationalite,
                    created = :created
                    ";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->nomAuteur=htmlspecialchars(strip_tags($this->nomAuteur));
            $this->dateNaissance=htmlspecialchars(strip_tags($this->dateNaissance));
            $this->nationalite=htmlspecialchars(strip_tags($this->nationalite));
            $this->created=htmlspecialchars(strip_tags($this->created));
        
            // bind data
            $stmt->bindParam(":nomAuteur", $this->nomAuteur);
            $stmt->bindParam(":dateNaissance", $this->dateNaissance);
            $stmt->bindParam(":nationalite", $this->nationalite);
            $stmt->bindParam(":created", $this->created);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // READ single
        public function getSingleAuteur(){
            $sqlQuery = "SELECT
                        idAuteur, 
                        nomAuteur, 
                        dateNaissance, 
                        nationalite,
                        created
                      FROM
                        ". $this->db_table ."
                    WHERE 
                    idAuteur = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->idAuteur);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->nomAuteur = $dataRow['nomAuteur'];
            $this->dateNaissance = $dataRow['dateNaissance'];
            $this->nationalite = $dataRow['nationalite'];
            $this->created = $dataRow['created'];
          
        }  
        //Find by Column      
        public function findIdByColumn(){
            $sqlQuery = "SELECT
                       *
                      FROM
                        ". $this->db_table ."
                    WHERE 
                        nomAuteur = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->nomAuteur);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->idAuteur = $dataRow['idAuteur'];
            $this->nomAuteur = $dataRow['nomAuteur'];
            $this->dateNaissance = $dataRow['dateNaissance'];
            $this->nationalite = $dataRow['nationalite'];
            $this->created = $dataRow['created'];

    
        }   
        // UPDATE
        public function updateAuteur(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        nomAuteur = :nomAuteur, 
                        dateNaissance = :dateNaissance, 
                        nationalite = :nationalite,
                        created = :created
                    WHERE 
                    idAuteur = :idAuteur";
        
            $stmt = $this->conn->prepare($sqlQuery);

            $this->nomAuteur=htmlspecialchars(strip_tags($this->nomAuteur));
            $this->dateNaissance=htmlspecialchars(strip_tags($this->dateNaissance));
            $this->nationalite=htmlspecialchars(strip_tags($this->nationalite));
            $this->idAuteur=htmlspecialchars(strip_tags($this->idAuteur));
            $this->created=htmlspecialchars(strip_tags($this->created));
        
            // bind data
            $stmt->bindParam(":nomAuteur", $this->nomAuteur);
            $stmt->bindParam(":dateNaissance", $this->dateNaissance);
            $stmt->bindParam(":nationalite", $this->nationalite);
            $stmt->bindParam(":idAuteur", $this->idAuteur);
            $stmt->bindParam(":created", $this->created);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteGenre(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE idAuteur = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->idAuteur=htmlspecialchars(strip_tags($this->idAuteur));
        
            $stmt->bindParam(1, $this->idAuteur);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>