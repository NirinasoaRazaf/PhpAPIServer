<?php
    class DemandeAccesMembre{

        // Connection
        private $conn;

        // Table
        private $db_table = "DemandeAccesMembre";

        // Columns
        public $idDemandeAccesMembre;
        public $idMembre;
        public $estValide;
        public $motif;
        public $created;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
        
        // GET ALL
        public function getficheDemandeAcces(){
            $sqlQuery = "SELECT * FROM ficheDemandeAcces
            ";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        public function getDemandeAccesMembresNV(){
            $sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE 
            estValide = 'ko'";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        public function getNombreDemandeAccesMembresNV(){
            $sqlQuery = "SELECT * FROM  nombreDemandeNVTotal WHERE 
            estValide = 'ko'";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        public function getDemandeAccesMembres(){
            $sqlQuery = "SELECT * FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        public function getficheDemandeAccesMembres(){
            $sqlQuery = "SELECT * FROM  fichecommentaire order by created desc";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        public function getficheDemandeAccesMembre(){
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
        public function addDemandeAccesMembre(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                    idMembre = :idMembre, 
                    estValide = :estValide,
                    motif = :motif,
                    created = :created
                    ";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->idMembre=htmlspecialchars(strip_tags($this->idMembre));
            $this->estValide=htmlspecialchars(strip_tags($this->estValide));
            $this->motif=htmlspecialchars(strip_tags($this->motif));
            $this->created=htmlspecialchars(strip_tags($this->created));
        
            // bind data
            $stmt->bindParam(":idMembre", $this->idMembre);
            $stmt->bindParam(":estValide", $this->estValide);
            $stmt->bindParam(":motif", $this->motif);
            $stmt->bindParam(":created", $this->created);

            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // READ single
       

        public function getSingleDemandeAccesMembre(){
            $sqlQuery = "SELECT
                       *
                        
                      FROM
                        ". $this->db_table ."
                    WHERE 
                        idMembre = ?
                     ORDER By created desc LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->idMembre);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->idDemandeAccesMembre = $dataRow['idDemandeAccesMembre'];
            $this->idMembre = $dataRow['idMembre'];
            $this->estValide = $dataRow['estValide'];
            $this->motif = $dataRow['motif'];
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
        public function updateDemandeAccesMembre(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                    estValide = :estValide
                        
                    WHERE 
                    idDemandeAccesMembre = :idDemandeAccesMembre";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
        
            $this->estValide=htmlspecialchars(strip_tags($this->estValide));
            $this->idDemandeAccesMembre=htmlspecialchars(strip_tags($this->idDemandeAccesMembre));
          
        
            // bind data
       
            $stmt->bindParam(":estValide", $this->estValide);
            $stmt->bindParam(":idDemandeAccesMembre", $this->idDemandeAccesMembre);
        
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteDemandeAccesMembre(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE idDemandeAccesMembre = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->idDemandeAccesMembre=htmlspecialchars(strip_tags($this->idDemandeAccesMembre));
        
            $stmt->bindParam(1, $this->idDemandeAccesMembre);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>