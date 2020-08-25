<?php
    class Commentaire{

        // Connection
        private $conn;

        // Table
        private $db_table = "commentaire";

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
        public function getCommentaires(){
            $sqlQuery = "SELECT * FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        public function getfichecommentaires(){
            $sqlQuery = "SELECT * FROM  fichecommentaire order by created desc";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        public function getfichecommentairesParOuvrage(){
            $sqlQuery = "SELECT
                       *
                      FROM fichecommentaire 
                      WHERE 
                      idOuvrage = 7  ";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->idOuvrage);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->idCommentaire = $dataRow['idCommentaire'];
            $this->idMembre = $dataRow['idMembre'];
            $this->idOuvrage = $dataRow['idOuvrage'];
            $this->created = $dataRow['created'];
            $this->message = $dataRow['message'];
            $this->photo = $dataRow['photo'];
            $this->nom = $dataRow['nom'];
            $this->prenom = $dataRow['prenom'];


        }    
        // CREATE
        public function addCommentaire(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                    idMembre = :idMembre, 
                    idOuvrage = :idOuvrage,
                    message = :message,
                    created = :created
                    ";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->idMembre=htmlspecialchars(strip_tags($this->idMembre));
            $this->idOuvrage=htmlspecialchars(strip_tags($this->idOuvrage));
            $this->message=htmlspecialchars(strip_tags($this->message));
            $this->created=htmlspecialchars(strip_tags($this->created));
        
            // bind data
            $stmt->bindParam(":idMembre", $this->idMembre);
            $stmt->bindParam(":idOuvrage", $this->idOuvrage);
            $stmt->bindParam(":message", $this->message);
            $stmt->bindParam(":created", $this->created);

            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // READ single
        public function getSingleCommentaire(){
            $sqlQuery = "SELECT
                       *
                      FROM
                        ". $this->db_table ."
                    WHERE 
                        idCommentaire = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->idCommentaire);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->idCommentaire = $dataRow['idCommentaire'];
            $this->idMembre = $dataRow['idMembre'];
            $this->idOuvrage = $dataRow['idOuvrage'];
            $this->message = $dataRow['message'];
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
        public function updateCommentaire(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        message = :message
                        
                    WHERE 
                    idCommentaire = :idCommentaire";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->idMembre=htmlspecialchars(strip_tags($this->idMembre));
            $this->idOuvrage=htmlspecialchars(strip_tags($this->idOuvrage));
            $this->idCommentaire=htmlspecialchars(strip_tags($this->idCommentaire));
            $this->message=htmlspecialchars(strip_tags($this->message));
            $this->created=htmlspecialchars(strip_tags($this->created));
        
            // bind data
            $stmt->bindParam(":idMembre", $this->idMembre);
            $stmt->bindParam(":idOuvrage", $this->idOuvrage);
            $stmt->bindParam(":idCommentaire", $this->idCommentaire);
            $stmt->bindParam(":message", $this->message);
            $stmt->bindParam(":created", $this->created);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteCommentaire(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE idCommentaire = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->idCommentaire=htmlspecialchars(strip_tags($this->idCommentaire));
        
            $stmt->bindParam(1, $this->idCommentaire);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>