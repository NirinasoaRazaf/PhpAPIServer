<?php
    class UtilisateurMembre{

        // Connection
        private $conn;

        // Table
        private $db_table = "UtilisateurMembre";

        // Columns
        public $idUtilisateurMembre;
        public $idMembre;
        public $email;
        public $motdepasse;
        public $created;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getUtilisateurMembres(){
            $sqlQuery = "SELECT * FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        public function getNombreutilisateurmembre(){
            $sqlQuery = "SELECT * FROM nombreUtilisateurMembre";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        public function getUM(){
            $sqlQuery = "SELECT * FROM ficheUM";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function addUtilisateurMembre(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                    idMembre = :idMembre, 
                    email=:email,
                    motdepasse = :motdepasse,
                    created = :created
                    ";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->idMembre=htmlspecialchars(strip_tags($this->idMembre));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->motdepasse=htmlspecialchars(strip_tags($this->motdepasse));
            $this->created=htmlspecialchars(strip_tags($this->created));
        
            // bind data
            $stmt->bindParam(":idMembre", $this->idMembre);
            $stmt->bindParam(":email", $this->email);
            $password_hash = password_hash($this->motdepasse, PASSWORD_BCRYPT);
            $stmt->bindParam(':motdepasse', $password_hash);

            $stmt->bindParam(":created", $this->created);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // READ single
        public function getSingleUtilisateurMembre(){
            $sqlQuery = "SELECT
                        *
                        FROM
                        ". $this->db_table ."
                    WHERE 
                    idMembre = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->idMembre);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->idUtilisateurMembre = $dataRow['idUtilisateurMembre'];
            $this->idMembre = $dataRow['idMembre'];
            $this->motdepasse = $dataRow['motdepasse'];
            $this->email = $dataRow['email'];
            $this->created = $dataRow['created'];
          
        }        

        // UPDATE
        public function updateUtilisateurMembre(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        idMembre = :idMembre, 
                        motdepasse = :motdepasse,
                        created = :created
                    WHERE 
                    idUtilisateurMembre = :idUtilisateurMembre";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->idMembre=htmlspecialchars(strip_tags($this->idMembre));
            $this->motdepasse=htmlspecialchars(strip_tags($this->motdepasse));
            $this->idUtilisateurMembre=htmlspecialchars(strip_tags($this->idUtilisateurMembre));
            $this->created=htmlspecialchars(strip_tags($this->created));
        
            // bind data
            $stmt->bindParam(":idMembre", $this->idMembre);
            $stmt->bindParam(":motdepasse", $this->motdepasse);
            $stmt->bindParam(":idUtilisateurMembre", $this->idUtilisateurMembre);
            $stmt->bindParam(":created", $this->created);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteUtilisateurMembre(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE idUtilisateurMembre = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->idUtilisateurMembre=htmlspecialchars(strip_tags($this->idUtilisateurMembre));
        
            $stmt->bindParam(1, $this->idUtilisateurMembre);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>