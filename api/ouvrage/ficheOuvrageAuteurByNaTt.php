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
$nomAuteur = isset($_GET['nomAuteur']) ? $_GET['nomAuteur'] : die();
$titre = isset($_GET['titre']) ? $_GET['titre'] : die();

if ($nomAuteur!=null){
 
  
    $query = "SELECT * FROM ficheouvrage WHERE nomAuteur='$nomAuteur' and titre='$titre'";
    $stmt = $conn->prepare( $query );
    $stmt->execute();
    $count = $stmt->rowCount();
    if($count == 0){
        echo json_encode(array("message" => "Could not find data."));
    }else{
        $auteurArr = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $nomGenre = $row['nomGenre'];
            $descriptionGenre = $row['descriptionGenre'];
            $idOuvrage = $row['idOuvrage'];
            $nomAuteur = $row['nomAuteur'];
            $titre = $row['titre'];
            $editeur = $row['editeur'];
            $nombrePage = $row['nombrePage'];
            $prix = $row['prix'];
            $idGenre = $row['idGenre'];
            $anneeEdition = $row['anneeEdition'];
            $dateEntree = $row['dateEntree'];
            $quantite = $row['quantite'];
            $etatActuel = $row['etatActuel'];
            $origine = $row['origine'];
            $lieuEdition = $row['lieuEdition'];
            $description = $row['description'];
            $codeBarre = $row['codeBarre'];
            $created = $row['created'];
            $photo = $row['photo'];
            $origine = $row['idAuteur'];
            
       
             extract($row);
            $e = array(
                "nomGenre" => $nomGenre,
                "descriptionGenre" => $descriptionGenre,
                "idOuvrage" => $idOuvrage,
                "nomAuteur" => $nomAuteur,
                "titre" => $titre,
                "editeur" => $editeur,
                "nombrePage" => $nombrePage,
                "prix" => $prix,
                "idGenre" => $idGenre,
                "anneeEdition" => $anneeEdition,
                "dateEntree" => $dateEntree,
                "quantite" => $quantite,
                "etatActuel" => $etatActuel,
                "origine" => $origine,
                "lieuEdition" => $lieuEdition,
                "description" => $description,
                "codeBarre" => $codeBarre,
                "created" => $created,
                "photo" => $photo,
                "idAuteur" => $idAuteur
         

           );

           array_push($auteurArr, $e);
        }
        echo json_encode($auteurArr);
        }
       
    }
    else{
        http_response_code(404);
        echo json_encode("Auteur not found.");
    
    }
?>