<?php
    class Membre{

        // Connection
        private $conn;

        // Table
        private $db_table = "membre";

        // Columns
        public $nom;
        public $prenom;
        public $adresse;
        public $filiere;
        public $cin;
        public $delivreA;
        public $telephone;
        public $domaine;
        public $email;
        public $dateNaissance;
        public $photo;
        public $codeBarre;
        public $created;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getMembres(){
            $sqlQuery = "SELECT * FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        // Nombre membre
        public function getNombremembre(){
            $sqlQuery = "SELECT * FROM nombreMembre";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        // CREATE
        public function addMembre(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                    nom = :nom, 
                    prenom = :prenom,
                    adresse = :adresse,
                    filiere = :filiere, 
                    cin = :cin,
                    delivreA = :delivreA,
                    telephone = :telephone, 
                    domaine = :domaine,
                    email = :email,
                    dateNaissance = :dateNaissance, 
                    photo = :photo,
                    codeBarre = :codeBarre,
                    created = :created
                    ";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->nom=htmlspecialchars(strip_tags($this->nom));
            $this->prenom=htmlspecialchars(strip_tags($this->prenom));
            $this->adresse=htmlspecialchars(strip_tags($this->adresse));
            $this->filiere=htmlspecialchars(strip_tags($this->filiere));
            $this->cin=htmlspecialchars(strip_tags($this->cin));
            $this->delivreA=htmlspecialchars(strip_tags($this->delivreA));
            $this->telephone=htmlspecialchars(strip_tags($this->telephone));
            $this->domaine=htmlspecialchars(strip_tags($this->domaine));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->dateNaissance=htmlspecialchars(strip_tags($this->dateNaissance));
            $this->photo=htmlspecialchars(strip_tags($this->photo));
            $this->codeBarre=htmlspecialchars(strip_tags($this->codeBarre));
            $this->created=htmlspecialchars(strip_tags($this->created));
        
            // bind data
            $stmt->bindParam(":nom", $this->nom);
            $stmt->bindParam(":prenom", $this->prenom);
            $stmt->bindParam(":adresse", $this->adresse);
            $stmt->bindParam(":filiere", $this->filiere);
            $stmt->bindParam(":cin", $this->cin);
            $stmt->bindParam(":delivreA", $this->delivreA);
            $stmt->bindParam(":telephone", $this->telephone);
            $stmt->bindParam(":domaine", $this->domaine);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":dateNaissance", $this->dateNaissance);
            $stmt->bindParam(":photo", $this->photo);
            $stmt->bindParam(":codeBarre", $this->codeBarre);
            $stmt->bindParam(":created", $this->created);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // READ single
        public function getSingleMembre(){
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
            
            $this->nom = $dataRow['nom'];
            $this->prenom = $dataRow['prenom'];
            $this->adresse = $dataRow['adresse'];
            $this->filiere = $dataRow['filiere'];
            $this->cin = $dataRow['cin'];
            $this->delivreA = $dataRow['delivreA'];
            $this->telephone = $dataRow['telephone'];
            $this->domaine = $dataRow['domaine'];
            $this->email = $dataRow['email'];
            $this->dateNaissance = $dataRow['dateNaissance'];
            $this->photo = $dataRow['photo'];
            $this->codeBarre = $dataRow['codeBarre'];
            $this->created = $dataRow['created'];
      
          
        }        

        // UPDATE
        public function updateMembre(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        nom = :nom, 
                        prenom = :prenom,
                        adresse = :adresse,
                        filiere = :filiere,
                        cin = :cin, 
                        delivreA = :delivreA,
                        telephone = :telephone,
                        domaine = :domaine, 
                        email = :email,
                        dateNaissance = :dateNaissance,
                        photo = :photo, 
                        codeBarre = :codeBarre,
                        created = :created
                    WHERE 
                    idMembre = :idMembre";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->idMembre=htmlspecialchars(strip_tags($this->idMembre));
            $this->nom=htmlspecialchars(strip_tags($this->nom));
            $this->prenom=htmlspecialchars(strip_tags($this->prenom));
            $this->adresse=htmlspecialchars(strip_tags($this->adresse));
            $this->filiere=htmlspecialchars(strip_tags($this->filiere));
            $this->cin=htmlspecialchars(strip_tags($this->cin));
            $this->delivreA=htmlspecialchars(strip_tags($this->delivreA));
            $this->telephone=htmlspecialchars(strip_tags($this->telephone));
            $this->domaine=htmlspecialchars(strip_tags($this->domaine));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->dateNaissance=htmlspecialchars(strip_tags($this->dateNaissance));
            $this->photo=htmlspecialchars(strip_tags($this->photo));
            $this->codeBarre=htmlspecialchars(strip_tags($this->codeBarre));
            $this->created=htmlspecialchars(strip_tags($this->created));
        
            // bind data
            $stmt->bindParam(":idMembre", $this->idMembre);
            $stmt->bindParam(":nom", $this->nom);
            $stmt->bindParam(":prenom", $this->prenom);
            $stmt->bindParam(":adresse", $this->adresse);
            $stmt->bindParam(":filiere", $this->filiere);
            $stmt->bindParam(":cin", $this->cin);
            $stmt->bindParam(":delivreA", $this->delivreA);
            $stmt->bindParam(":telephone", $this->telephone);
            $stmt->bindParam(":domaine", $this->domaine);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":dateNaissance", $this->dateNaissance);
            $stmt->bindParam(":photo", $this->photo);
            $stmt->bindParam(":codeBarre", $this->codeBarre);
            $stmt->bindParam(":created", $this->created);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteMembre(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE idMembre = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->idMembre=htmlspecialchars(strip_tags($this->idMembre));
        
            $stmt->bindParam(1, $this->idMembre);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>