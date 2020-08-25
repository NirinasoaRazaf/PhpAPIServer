<?php
include_once '../../config/database.php';
require "../../jwt/vendor/autoload.php";
use \Firebase\JWT\JWT;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$databaseService = new Database();
$conn = $databaseService->getConnection();
$data = json_decode(file_get_contents("php://input"));
$wordToSearch=$data->wordToSearch;
if ($wordToSearch!=null){

    
    $query = "SELECT * FROM ficheouvrage WHERE titre LIKE '%$wordToSearch%' OR description LIKE '%$wordToSearch%' or nomAuteur like '%$wordToSearch%' or nombrePage like '%$wordToSearch%' or editeur like '%$wordToSearch%' ";
    $stmt = $conn->prepare( $query );
    $stmt->execute();
    $count = $stmt->rowCount();
    if($count == 0){
        echo json_encode(array("message" => "Could not find data."));
    }else{
        $ouvrageArr = array();
 
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $nomGenre = $row['nomGenre'];
            $descriptionGenre = $row['descriptionGenre'];
            $nomAuteur = $row['nomAuteur'];
            $nationalite = $row['nationalite'];
            $dateNaissance = $row['dateNaissance'];
            $idOuvrage = $row['idOuvrage'];
            $idAuteur = $row['idAuteur'];
            $titre = $row['titre'];
            $editeur = $row['editeur'];
            $nombrePage = $row['nombrePage'];
            $prix = $row['prix'];
            $idGenre = $row['idGenre'];
            $langue = $row['langue'];
            $anneeEdition = $row['anneeEdition'];
            $dateEntree = $row['dateEntree'];
            $quantite = $row['quantite'];
            $etatActuel = $row['etatActuel'];
            $origine = $row['origine'];
            $lieuEdition = $row['lieuEdition'];
            $description = $row['description'];
            $created = $row['created'];
            $photo = $row['photo'];
            $codeBarre = $row['codeBarre'];
         
             extract($row);
            $e = array(
                "nomGenre" => $nomGenre,
                "descriptionGenre" => $descriptionGenre,
                "nomAuteur" => $nomAuteur,
                "nationalite" => $nationalite,
                "dateNaissance" => $dateNaissance,
                "idOuvrage" => $idOuvrage,
                "idAuteur" => $idAuteur,
                "titre" => $titre,
                "editeur" => $editeur,
                "nombrePage" => $nombrePage,
                "prix" => $prix,
                "idGenre" => $idGenre,
                "langue" => $langue,
                "anneeEdition" => $anneeEdition,
                "dateEntree" => $dateEntree,
                "quantite" => $quantite,
                "etatActuel" => $etatActuel,
                "origine" => $origine,
                "lieuEdition" => $lieuEdition,
                "description" => $description,
                "codeBarre" => $codeBarre,
                "created" => $created,
                "photo" => $photo
         

           );

           array_push($ouvrageArr, $e);
        }
        echo json_encode($ouvrageArr);
        }
       
    }
    else{
         
    $query = "SELECT * FROM ficheouvrage WHERE titre LIKE '%$wordToSearch%' OR description LIKE '%$wordToSearch%' or nomAuteur like '%$wordToSearch%'";
    $stmt = $conn->prepare( $query );
    $stmt->execute();
  
        $ouvrageArr = array();
 
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $nomGenre = $row['nomGenre'];
            $descriptionGenre = $row['descriptionGenre'];
            $nomAuteur = $row['nomAuteur'];
            $nationalite = $row['nationalite'];
            $dateNaissance = $row['dateNaissance'];
            $idOuvrage = $row['idOuvrage'];
            $idAuteur = $row['idAuteur'];
            $titre = $row['titre'];
            $editeur = $row['editeur'];
            $nombrePage = $row['nombrePage'];
            $prix = $row['prix'];
            $idGenre = $row['idGenre'];
            $langue = $row['langue'];
            $anneeEdition = $row['anneeEdition'];
            $dateEntree = $row['dateEntree'];
            $quantite = $row['quantite'];
            $etatActuel = $row['etatActuel'];
            $origine = $row['origine'];
            $lieuEdition = $row['lieuEdition'];
            $description = $row['description'];
            $created = $row['created'];
            $photo = $row['photo'];
            $codeBarre = $row['codeBarre'];
         
             extract($row);
            $e = array(
                "nomGenre" => $nomGenre,
                "descriptionGenre" => $descriptionGenre,
                "nomAuteur" => $nomAuteur,
                "nationalite" => $nationalite,
                "dateNaissance" => $dateNaissance,
                "idOuvrage" => $idOuvrage,
                "idAuteur" => $idAuteur,
                "titre" => $titre,
                "editeur" => $editeur,
                "nombrePage" => $nombrePage,
                "prix" => $prix,
                "idGenre" => $idGenre,
                "langue" => $langue,
                "anneeEdition" => $anneeEdition,
                "dateEntree" => $dateEntree,
                "quantite" => $quantite,
                "etatActuel" => $etatActuel,
                "origine" => $origine,
                "lieuEdition" => $lieuEdition,
                "description" => $description,
                "codeBarre" => $codeBarre,
                "created" => $created,
                "photo" => $photo
         

           );

           array_push($ouvrageArr, $e);
        }
        echo json_encode($ouvrageArr);
        } 
    

?>