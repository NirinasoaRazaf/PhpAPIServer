<?php
require "../../jwt/vendor/autoload.php";
use \Firebase\JWT\JWT;
    class UtilisateurAdmin{

        // Connection
        private $conn;

        // Table
        private $db_table = "UtilisateurAdmin";

        // Columns
        public $idAdmin;
        public $nom;
        public $prenom;
        public $email;
        public $contact;
        public $motdepasse;
        public $photo;
        public $created;
      

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getUtilisateurAdmins(){
            $sqlQuery = "SELECT * FROM " . $this->db_table . " order by created desc";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
          // Nombre admin
          public function getNombreAdmin(){
            $sqlQuery = "SELECT * FROM nombreadmin";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function addUtilisateurAdmin(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                    nom = :nom, 
                    prenom = :prenom,
                    email = :email,
                    contact = :contact, 
                    motdepasse = :motdepasse,
                    photo = :photo,
                    created = :created
                    ";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->nom=htmlspecialchars(strip_tags($this->nom));
            $this->prenom=htmlspecialchars(strip_tags($this->prenom));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->contact=htmlspecialchars(strip_tags($this->contact));
            $this->motdepasse=htmlspecialchars(strip_tags($this->motdepasse));
            $this->photo=htmlspecialchars(strip_tags($this->photo));
            $this->created=htmlspecialchars(strip_tags($this->created));
            // bind data
            $stmt->bindParam(":nom", $this->nom);
            $stmt->bindParam(":prenom", $this->prenom);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":contact", $this->contact);
            $password_hash = password_hash($this->motdepasse, PASSWORD_BCRYPT);
            $stmt->bindParam(':motdepasse', $password_hash);

            $stmt->bindParam(":photo", $this->photo);
            $stmt->bindParam(":created", $this->created);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }
        public function login(){
            $sqlQuery = "SELECT
                        *
                        FROM
                        ". $this->db_table ."
                    WHERE 
                    email = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->email);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->nom = $dataRow['nom'];
            $this->prenom = $dataRow['prenom'];
            $this->email = $dataRow['email'];
            $this->contact = $dataRow['contact'];
            $this->motdepasse = $dataRow['motdepasse'];
            $this->photo = $dataRow['photo'];
            $this->created = $dataRow['created'];
      
          
        }     
        // READ single
        public function findUserByEmail(){
            $sqlQuery = "SELECT
                        *
                        FROM
                        ". $this->db_table ."
                    WHERE 
                    email = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->email);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->idAdmin = $dataRow['idAdmin'];
            $this->nom = $dataRow['nom'];
            $this->prenom = $dataRow['prenom'];
            $this->email = $dataRow['email'];
            $this->contact = $dataRow['contact'];
            $this->motdepasse = $dataRow['motdepasse'];
            $this->photo = $dataRow['photo'];
            $this->created = $dataRow['created'];
      
          
        } 
              
        public function getSingleUtilisateurAdmin(){
            $sqlQuery = "SELECT
                        *
                        FROM
                        ". $this->db_table ."
                    WHERE 
                    idAdmin = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->idAdmin);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->nom = $dataRow['nom'];
            $this->prenom = $dataRow['prenom'];
            $this->email = $dataRow['email'];
            $this->contact = $dataRow['contact'];
            $this->motdepasse = $dataRow['motdepasse'];
            $this->photo = $dataRow['photo'];
            $this->created = $dataRow['created'];
      
          
        }        

        // UPDATE
        public function updateUtilisateurAdmin(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                    nom = :nom, 
                    prenom = :prenom,
                    email = :email,
                    contact = :contact, 
                    photo = :photo,
                    motdepasse = :motdepasse,
                    created = :created

                    WHERE 
                    idAdmin = :idAdmin
                    ";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->nom=htmlspecialchars(strip_tags($this->nom));
            $this->prenom=htmlspecialchars(strip_tags($this->prenom));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->contact=htmlspecialchars(strip_tags($this->contact));
            $this->photo=htmlspecialchars(strip_tags($this->photo));
            $this->idAdmin=htmlspecialchars(strip_tags($this->idAdmin));
            $this->created=htmlspecialchars(strip_tags($this->created));
            $this->motdepasse=htmlspecialchars(strip_tags($this->motdepasse));
        
            // bind data
            $stmt->bindParam(":nom", $this->nom);
            $stmt->bindParam(":prenom", $this->prenom);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":contact", $this->contact);
            $stmt->bindParam(":photo", $this->photo);
            $stmt->bindParam(":idAdmin", $this->idAdmin);
            $stmt->bindParam(":created", $this->created);
            $password_hash = password_hash($this->motdepasse, PASSWORD_BCRYPT);
            $stmt->bindParam(':motdepasse', $password_hash);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteUtilisateurAdmin(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE idAdmin = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->idAdmin=htmlspecialchars(strip_tags($this->idAdmin));
        
            $stmt->bindParam(1, $this->idAdmin);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>