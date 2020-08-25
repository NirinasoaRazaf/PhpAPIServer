<?php
    class Favori{

        // Connection
        private $conn;

        // Table
        private $db_table = "favori";

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
        public function getFavoris(){
            $sqlQuery = "SELECT * FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        public function getficheFavoris(){
            $sqlQuery = "SELECT * FROM  ficheFavori order by created desc";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        public function getficheFavoriParMembre(){
            $sqlQuery = "SELECT
                       *
                      FROM ficheFavori
                      WHERE 
                      idOuvrage = ?  ";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->idOuvrage);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->idFavori = $dataRow['idFavori'];
            $this->idMembre = $dataRow['idMembre'];
            $this->idOuvrage = $dataRow['idOuvrage'];
            $this->created = $dataRow['created'];
             $this->photo = $dataRow['photo'];
            $this->titre = $dataRow['titre'];
            $this->nomAuteur = $dataRow['nomAuteur'];
            $this->nomGenre = $dataRow['nomGenre'];
            $this->langue = $dataRow['langue'];


        }    
        // CREATE
        public function addFavori(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                    idMembre = :idMembre, 
                    idOuvrage = :idOuvrage,
                    created = :created

                    
                    ";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->idMembre=htmlspecialchars(strip_tags($this->idMembre));
            $this->idOuvrage=htmlspecialchars(strip_tags($this->idOuvrage));
            $this->created=htmlspecialchars(strip_tags($this->created));
        
            // bind data
            $stmt->bindParam(":idMembre", $this->idMembre);
            $stmt->bindParam(":idOuvrage", $this->idOuvrage);
             $stmt->bindParam(":created", $this->created);

            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // READ single
        public function getSingleFavori(){
            $sqlQuery = "SELECT
                       *
                      FROM
                        ". $this->db_table ."
                    WHERE 
                    idFavori = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->idFavori);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->idFavori = $dataRow['idFavori'];
            $this->idMembre = $dataRow['idMembre'];
            $this->idOuvrage = $dataRow['idOuvrage'];
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
        public function updateFavori(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        message = :message
                        
                    WHERE 
                    idFavori = :idFavori";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->idMembre=htmlspecialchars(strip_tags($this->idMembre));
            $this->idOuvrage=htmlspecialchars(strip_tags($this->idOuvrage));
            $this->idFavori=htmlspecialchars(strip_tags($this->idFavori));
            
            $this->created=htmlspecialchars(strip_tags($this->created));
        
            // bind data
            $stmt->bindParam(":idMembre", $this->idMembre);
            $stmt->bindParam(":idOuvrage", $this->idOuvrage);
            $stmt->bindParam(":idFavori", $this->idFavori);
          
            $stmt->bindParam(":created", $this->created);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteFavori(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE idOuvrage = ? and idMembre= ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->idOuvrage=htmlspecialchars(strip_tags($this->idOuvrage));
            $this->idMembre=htmlspecialchars(strip_tags($this->idMembre));
        
            $stmt->bindParam(1, $this->idOuvrage);
            $stmt->bindParam(2, $this->idMembre);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>