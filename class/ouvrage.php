<?php
    class Ouvrage{

        // Connection
        private $conn;

        // Table
        private $db_table = "Ouvrage";

        // Columns
        public $idAuteur;
        public $titre;
        public $editeur;
        public $nombrePage;
        public $prix;
        public $idGenre;
        public $langue;
        public $anneeEdition;
        public $dateEntree;
        public $quantite;
        public $etatActuel;
        public $origine;
        public $lieuEdition;
        public $description;
        public $codeBarre;
        public $created;
        public $photo;
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getOuvrages(){
            $sqlQuery = "SELECT * FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        public function getFicheOuvrages(){
            $sqlQuery = "SELECT * FROM  ficheOuvrage order by created desc";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        public function getFicheOuvragesApa(){
            $sqlQuery = "SELECT * FROM  ficheOuvrage order by nomAuteur";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        
        //view progessionlecture
        public function getProgressionLectureOuvrages(){
            $sqlQuery = "SELECT * FROM  progressionlecture";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        //le plus lu
        public function getPluslu(){
            $sqlQuery = "SELECT * FROM  pluslu";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        //le plus lu
        public function ouvrageParLangue(){
            $sqlQuery = "SELECT * FROM  ouvrageParLangue ";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function addOuvrage(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                    idAuteur = :idAuteur, 
                    titre = :titre,
                    editeur = :editeur,
                    nombrePage = :nombrePage, 
                    prix = :prix,
                    idGenre = :idGenre,
                    langue = :langue, 
                    anneeEdition = :anneeEdition,
                    dateEntree = :dateEntree,
                    quantite = :quantite, 
                    etatActuel = :etatActuel,
                    origine = :origine,
                    lieuEdition = :lieuEdition, 
                    description = :description,
                    codeBarre = :codeBarre,
                    created = :created,
                    photo = :photo
                    ";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->idAuteur=htmlspecialchars(strip_tags($this->idAuteur));
            $this->titre=htmlspecialchars(strip_tags($this->titre));
            $this->editeur=htmlspecialchars(strip_tags($this->editeur));
            $this->nombrePage=htmlspecialchars(strip_tags($this->nombrePage));
            $this->prix=htmlspecialchars(strip_tags($this->prix));
            $this->idGenre=htmlspecialchars(strip_tags($this->idGenre));
            $this->langue=htmlspecialchars(strip_tags($this->langue));
            $this->anneeEdition=htmlspecialchars(strip_tags($this->anneeEdition));
            $this->dateEntree=htmlspecialchars(strip_tags($this->dateEntree));
            $this->quantite=htmlspecialchars(strip_tags($this->quantite));
            $this->etatActuel=htmlspecialchars(strip_tags($this->etatActuel));
            $this->origine=htmlspecialchars(strip_tags($this->origine));
            $this->lieuEdition=htmlspecialchars(strip_tags($this->lieuEdition));
            $this->description=htmlspecialchars(strip_tags($this->description));
            $this->codeBarre=htmlspecialchars(strip_tags($this->codeBarre));
            $this->created=htmlspecialchars(strip_tags($this->created));
            $this->photo=htmlspecialchars(strip_tags($this->photo));
        
            // bind data
            $stmt->bindParam(":idAuteur", $this->idAuteur);
            $stmt->bindParam(":titre", $this->titre);
            $stmt->bindParam(":editeur", $this->editeur);
            $stmt->bindParam(":nombrePage", $this->nombrePage);
            $stmt->bindParam(":prix", $this->prix);
            $stmt->bindParam(":idGenre", $this->idGenre);
            $stmt->bindParam(":langue", $this->langue);
            $stmt->bindParam(":anneeEdition", $this->anneeEdition);
            $stmt->bindParam(":dateEntree", $this->dateEntree);
            $stmt->bindParam(":quantite", $this->quantite);
            $stmt->bindParam(":etatActuel", $this->etatActuel);
            $stmt->bindParam(":origine", $this->origine);
            $stmt->bindParam(":lieuEdition", $this->lieuEdition);
            $stmt->bindParam(":description", $this->description);
            $stmt->bindParam(":codeBarre", $this->codeBarre);
            $stmt->bindParam(":created", $this->created);
            $stmt->bindParam(":photo", $this->photo);
            
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }
        //Find Ouvrage written by an author
        public function getOuvrageByIdAuteur(){
            $sqlQuery = "SELECT
                        *
                        FROM
                        ficheOuvrage
                    WHERE 
                    idAuteur = ?
                   ";
    
            $stmt = $this->conn->prepare($sqlQuery);
    
            $stmt->bindParam(1, $this->idAuteur);
    
            $stmt->execute();
    
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->nomGenre = $dataRow['nomGenre']; 
            $this->descriptionGenre = $dataRow['descriptionGenre']; 
            $this->nomAuteur = $dataRow['nomAuteur']; 
            $this->idAuteur = $dataRow['idAuteur'];
            $this->titre = $dataRow['titre'];
            $this->editeur = $dataRow['editeur'];
            $this->nombrePage = $dataRow['nombrePage'];
            $this->prix = $dataRow['prix'];
            $this->idGenre = $dataRow['idGenre'];
            $this->langue = $dataRow['langue'];
            $this->anneeEdition = $dataRow['anneeEdition'];
            $this->dateEntree = $dataRow['dateEntree'];
            $this->quantite = $dataRow['quantite'];
            $this->etatActuel = $dataRow['etatActuel'];
            $this->origine = $dataRow['origine'];
            $this->lieuEdition = $dataRow['lieuEdition'];
            $this->description = $dataRow['description'];
            $this->codeBarre = $dataRow['codeBarre'];
            $this->created = $dataRow['created'];
            $this->photo = $dataRow['photo'];
          
        } 
       // Find by idOuvrage from view ficheouvrage
       public function getSingleOuvrageView(){
        $sqlQuery = "SELECT
                    *
                    FROM
                    ficheOuvrage
                WHERE 
                idOuvrage = ?
                LIMIT 0,1";

        $stmt = $this->conn->prepare($sqlQuery);

        $stmt->bindParam(1, $this->idOuvrage);

        $stmt->execute();

        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->nomGenre = $dataRow['nomGenre']; 
        $this->descriptionGenre = $dataRow['descriptionGenre']; 
        $this->nomAuteur = $dataRow['nomAuteur']; 
        $this->idAuteur = $dataRow['idAuteur'];
        $this->titre = $dataRow['titre'];
        $this->editeur = $dataRow['editeur'];
        $this->nombrePage = $dataRow['nombrePage'];
        $this->prix = $dataRow['prix'];
        $this->idGenre = $dataRow['idGenre'];
        $this->langue = $dataRow['langue'];
        $this->anneeEdition = $dataRow['anneeEdition'];
        $this->dateEntree = $dataRow['dateEntree'];
        $this->quantite = $dataRow['quantite'];
        $this->etatActuel = $dataRow['etatActuel'];
        $this->origine = $dataRow['origine'];
        $this->lieuEdition = $dataRow['lieuEdition'];
        $this->description = $dataRow['description'];
        $this->codeBarre = $dataRow['codeBarre'];
        $this->created = $dataRow['created'];
        $this->photo = $dataRow['photo'];
      
    }  
        // READ single
        public function getSingleOuvrage(){
            $sqlQuery = "SELECT
                        *
                        FROM
                        ". $this->db_table ."
                    WHERE 
                    idOuvrage = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->idOuvrage);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->idAuteur = $dataRow['idAuteur'];
            $this->titre = $dataRow['titre'];
            $this->editeur = $dataRow['editeur'];
            $this->nombrePage = $dataRow['nombrePage'];
            $this->prix = $dataRow['prix'];
            $this->idGenre = $dataRow['idGenre'];
            $this->langue = $dataRow['langue'];
            $this->anneeEdition = $dataRow['anneeEdition'];
            $this->dateEntree = $dataRow['dateEntree'];
            $this->quantite = $dataRow['quantite'];
            $this->etatActuel = $dataRow['etatActuel'];
            $this->origine = $dataRow['origine'];
            $this->lieuEdition = $dataRow['lieuEdition'];
            $this->description = $dataRow['description'];
            $this->codeBarre = $dataRow['codeBarre'];
            $this->created = $dataRow['created'];
            $this->photo = $dataRow['photo'];
          
        }  
           // READ single
           public function findIdByColumn(){
            $sqlQuery = "SELECT
                        *
                        FROM
                        ". $this->db_table ."
                    WHERE 
                    titre = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->titre);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->idOuvrage = $dataRow['idOuvrage'];
            $this->idAuteur = $dataRow['idAuteur'];
            $this->titre = $dataRow['titre'];
            $this->editeur = $dataRow['editeur'];
            $this->nombrePage = $dataRow['nombrePage'];
            $this->prix = $dataRow['prix'];
            $this->idGenre = $dataRow['idGenre'];
            $this->langue = $dataRow['langue'];
            $this->anneeEdition = $dataRow['anneeEdition'];
            $this->dateEntree = $dataRow['dateEntree'];
            $this->quantite = $dataRow['quantite'];
            $this->etatActuel = $dataRow['etatActuel'];
            $this->origine = $dataRow['origine'];
            $this->lieuEdition = $dataRow['lieuEdition'];
            $this->description = $dataRow['description'];
            $this->codeBarre = $dataRow['codeBarre'];
            $this->created = $dataRow['created'];
            $this->photo = $dataRow['photo'];
          
        }       
       // UPDATE etat Actuel
       public function updateEtatOuvrage(){
        $sqlQuery = "UPDATE
                    ". $this->db_table ."
                SET
                  
                    etatActuel = :etatActuel
                WHERE 
                idOuvrage = :idOuvrage";
    
        $stmt = $this->conn->prepare($sqlQuery);
    
        $this->idOuvrage=htmlspecialchars(strip_tags($this->idOuvrage));
        $this->etatActuel=htmlspecialchars(strip_tags($this->etatActuel));
        // bind data
        $stmt->bindParam(":idOuvrage", $this->idOuvrage);
        $stmt->bindParam(":etatActuel", $this->etatActuel);
      
        if($stmt->execute()){
           return true;
        }
        return false;
    }
        // UPDATE
        public function updateOuvrage(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        idAuteur = :idAuteur,
                        titre = :titre,
                        editeur = :editeur,
                        nombrePage = :nombrePage, 
                        prix = :prix,
                        idGenre = :idGenre,
                        langue = :langue, 
                        anneeEdition = :anneeEdition,
                        dateEntree = :dateEntree,
                        quantite = :quantite, 
                        etatActuel = :etatActuel,
                        origine = :origine,
                        lieuEdition = :lieuEdition, 
                        description = :description,
                        codeBarre = :codeBarre,
                        created = :created,
                        photo = :photo
                    WHERE 
                    idOuvrage = :idOuvrage";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->idOuvrage=htmlspecialchars(strip_tags($this->idOuvrage));
            $this->idAuteur=htmlspecialchars(strip_tags($this->idAuteur));
            $this->titre=htmlspecialchars(strip_tags($this->titre));
            $this->editeur=htmlspecialchars(strip_tags($this->editeur));
            $this->nombrePage=htmlspecialchars(strip_tags($this->nombrePage));
            $this->prix=htmlspecialchars(strip_tags($this->prix));
            $this->idGenre=htmlspecialchars(strip_tags($this->idGenre));
            $this->langue=htmlspecialchars(strip_tags($this->langue));
            $this->anneeEdition=htmlspecialchars(strip_tags($this->anneeEdition));
            $this->dateEntree=htmlspecialchars(strip_tags($this->dateEntree));
            $this->quantite=htmlspecialchars(strip_tags($this->quantite));
            $this->etatActuel=htmlspecialchars(strip_tags($this->etatActuel));
            $this->origine=htmlspecialchars(strip_tags($this->origine));
            $this->lieuEdition=htmlspecialchars(strip_tags($this->lieuEdition));
            $this->description=htmlspecialchars(strip_tags($this->description));
            $this->codeBarre=htmlspecialchars(strip_tags($this->codeBarre));
            $this->created=htmlspecialchars(strip_tags($this->created));
            $this->photo=htmlspecialchars(strip_tags($this->photo));
        
            // bind data
            $stmt->bindParam(":idOuvrage", $this->idOuvrage);
            $stmt->bindParam(":idAuteur", $this->idAuteur);
            $stmt->bindParam(":titre", $this->titre);
            $stmt->bindParam(":editeur", $this->editeur);
            $stmt->bindParam(":nombrePage", $this->nombrePage);
            $stmt->bindParam(":prix", $this->prix);
            $stmt->bindParam(":idGenre", $this->idGenre);
            $stmt->bindParam(":langue", $this->langue);
            $stmt->bindParam(":anneeEdition", $this->anneeEdition);
            $stmt->bindParam(":dateEntree", $this->dateEntree);
            $stmt->bindParam(":quantite", $this->quantite);
            $stmt->bindParam(":etatActuel", $this->etatActuel);
            $stmt->bindParam(":origine", $this->origine);
            $stmt->bindParam(":lieuEdition", $this->lieuEdition);
            $stmt->bindParam(":description", $this->description);
            $stmt->bindParam(":codeBarre", $this->codeBarre);
            $stmt->bindParam(":created", $this->created);
            $stmt->bindParam(":photo", $this->photo);
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteOuvrage(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE idOuvrage = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->idOuvrage=htmlspecialchars(strip_tags($this->idOuvrage));
        
            $stmt->bindParam(1, $this->idOuvrage);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>